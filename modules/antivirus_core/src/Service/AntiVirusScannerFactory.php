<?php

namespace Drupal\antivirus_core\Service;

use Drupal\antivirus_core\Collection\ScannersList;
use Drupal\antivirus_core\Collection\ScannersListInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Factory service to create a collection of scanner entities.
 */
class AntiVirusScannerFactory {

  /**
   * All defined scanner entities.
   *
   * @var \Drupal\antivirus_core\Collection\ScannersListInterface
   */
  protected readonly ScannersListInterface $scanners;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $etm
   *   The entity-type manager service.
   */
  public function __construct(EntityTypeManagerInterface $etm) {
    $this->scanners = new ScannersList(
      $etm
        ->getStorage('antivirus_scanner')
        ->loadMultiple()
    );
  }

  /**
   * Get the scanner entities.
   *
   * @return \Drupal\antivirus_core\Collection\ScannersListInterface
   *   Collection of the scanner entities.
   */
  public function getScanners() : ScannersListInterface {
    return $this->scanners;
  }

}
