<?php

namespace Drupal\antivirus\EventSubscriber;

use Drupal\antivirus\Service\ScanManager;
use Drupal\Core\Config\Config;
use Drupal\file\Validation\FileValidationEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Subscribe to all file validation events.
 */
class FileValidationEventSubscriber implements EventSubscriberInterface {

  /**
   * Constructor.
   *
   * @param \Drupal\antivirus\Service\ScanManager $scanManager
   *   The service which performs pre-scan checks and scans.
   * @param \Drupal\Core\Config\Config $config
   *   The configuration provided by `antivirus.settings`,
   */
  public function __construct(protected ScanManager $scanManager,
                              protected Config $config) {
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
    if (!$this->config->get('enabled')) {
      return;
    }

    if ($this->scanManager->shouldFileBeScanned($event->file)) {

      // /** @var \Drupal\antivirus\ScanResultInterface $result */
      // foreach ($this->scanManager->scan($event->file) as $result) {
      // }
    }
  }

}
