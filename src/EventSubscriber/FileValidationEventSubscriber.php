<?php

namespace Drupal\antivirus\EventSubscriber;

use Drupal\antivirus\Service\ScanManager;
use Drupal\Core\Validation\ConstraintManager;
use Drupal\file\Validation\FileValidationEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Subscribe to all file validation events.
 */
class FileValidationEventSubscriber implements EventSubscriberInterface {

  /**
   * Constructor.
   *
   * @param \Drupal\antivirus\Service\ScanManager $scanManager
   *   The service which performs pre-scan checks and scans.
   * @param \Drupal\Core\Validation\ConstraintManager $constraintManager
   *   The constraint manager service.
   * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
   *   A Symfony validator.
   */
  public function __construct(
    protected ScanManager $scanManager,
    protected ConstraintManager $constraintManager,
    protected ValidatorInterface $validator,) {
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() : array {
    return [
      FileValidationEvent::class => 'validateFile',
    ];
  }

  /**
   * Scan a file and attach any scan results.
   *
   * @param \Drupal\file\Validation\FileValidationEvent $event
   *   The file validation event.
   */
  public function validateFile(FileValidationEvent $event) : void {
    // @todo Ask the scan manager to collate constraints.

    $constraints[] = $this->constraintManager->create('FileIsVirusFree', []);
    $event->violations->addAll(
      $this->validator->validate($event->file, $constraints)
    );
  }

}
