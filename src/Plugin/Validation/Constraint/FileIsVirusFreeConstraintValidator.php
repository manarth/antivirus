<?php

namespace Drupal\antivirus\Plugin\Validation\Constraint;

use Drupal\antivirus_core\ScanOutcome;
use Drupal\antivirus\Service\ScanManager;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\file\Plugin\Validation\Constraint\BaseFileConstraintValidator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;

/**
 * Validator for files subject to an antivirus scan.
 */
class FileIsVirusFreeConstraintValidator extends BaseFileConstraintValidator implements ContainerInjectionInterface {

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
    if (!$constraint instanceof FileIsVirusFreeConstraint) {
      throw new UnexpectedTypeException($constraint, FileIsVirusFreeConstraint::class);
    }
    /** @var \Drupal\antivirus\Plugin\Validation\Constraint\FileIsVirusFreeConstraint $constraint */

    $results = $this->scanManager->scan($file);
    foreach ($results as $result) {
      /** @var \Drupal\antivirus_core\ScanResultInterface $result */
      switch ($result->getOutcome()) {
        case ScanOutcome::INFECTED:
          $this->context->addViolation($constraint->fileIsInfected);
          break;

        case ScanOutcome::UNCHECKED:
          $this->context->addViolation($constraint->fileIsUnchecked);
          break;

        case ScanOutcome::UNKNOWN:
          $this->context->addViolation($constraint->fileScanOutcomeIsUnknown);
          break;
      }
    }
  }

}
