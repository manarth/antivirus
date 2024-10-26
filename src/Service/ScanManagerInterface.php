<?php

namespace Drupal\antivirus\Service;

use Drupal\antivirus_core\Collection\ScannersListInterface;
use Drupal\file\FileInterface;

/**
 * Scan manager service.
 *
 * This service performs the scans and provides results.
 */
interface ScanManagerInterface {

  /**
   * Perform a scan and provide the scan results.
   *
   * @param \Drupal\file\FileInterface $file
   *   The file to be scanned.
   *
   * @return \Drupal\antivirus_core\ScanResultInterface[]
   *   Results from each of the scans performed, indexed by the scanner entity
   *   ID.
   */
  public function scan(FileInterface $file) : array;

  /**
   * Get the scanner entities.
   *
   * @return \Drupal\antivirus_core\Collection\ScannersListInterface
   *   Collection of all defined scanner entities.
   */
  public function getScanners() : ScannersListInterface;

}
