<?php

namespace Drupal\antivirus\Plugin\Validation\Constraint;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\antivirus\Service\ScanManager;
use Drupal\antivirus_core\ScanOutcome;
use Drupal\file\Plugin\Validation\Constraint\BaseFileConstraintValidator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;

/**
 * Validator for files subject to an antivirus scan.
 */
class FileIsCleanConstraintValidator extends BaseFileConstraintValidator implements ContainerInjectionInterface {

  /**
   * Constructor.
   *
   * @param \Drupal\antivirus\Service\ScanManager $scanManager
   *   The scan manager service.
   */
  public function __construct(protected ScanManager $scanManager) {
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('antivirus.scan_manager'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function validate($value, Constraint $constraint) {
    $file = $this->assertValueIsFile($value);
    if (!$constraint instanceof FileIsNotInfectedConstraint) {
      throw new UnexpectedTypeException($constraint, FileIsNotInfectedConstraint::class);
    }

    $results = $this->scanManager->scan($file);
    foreach ($results as $result) {
      switch ($result->getOutcome()) {
        case ScanOutcome::INFECTED:
          $this->context->addViolation(
            AntiVirusConstraintMessages::FILE_IS_INFECTED, [
              '%virus' => $result->getVirusName(),
            ]
          );
          break;

        case ScanOutcome::UNCHECKED:
          $this->context->addViolation(AntiVirusConstraintMessages::FILE_IS_UNCHECKED);
          break;

        case ScanOutcome::UNKNOWN:
          $this->context->addViolation(AntiVirusConstraintMessages::FILE_SCAN_OUTCOME_IS_UNKNOWN);
          break;
      }
    }
  }

}
