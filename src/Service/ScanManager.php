<?php

namespace Drupal\antivirus\Service;

use Drupal\antivirus_core\Collection\ScannersListInterface;
use Drupal\file\FileInterface;

/**
 * Scan manager service.
 *
 * This service performs the scans and provides results.
 */
class ScanManager implements ScanManagerInterface {

  /**
   * Constructor.
   *
   * @param \Drupal\antivirus_core\Collection\ScannersListInterface $scanners
   *   Collection of all defined scanner entities.
   */
  public function __construct(protected ScannersListInterface $scanners) {
  }

  /**
   * {@inheritdoc}
   */
  public function scan(FileInterface $file) : array {
    $results = [];
    foreach ($this->getScanners() as $scanner) {
      $results[$scanner->id()] = $scanner->scan($file);
    }
    return $results;
  }

  /**
   * {@inheritdoc}
   */
  public function getScanners() : ScannersListInterface {
    return $this->scanners;
  }

}
