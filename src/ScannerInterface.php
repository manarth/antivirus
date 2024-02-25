<?php

namespace Drupal\antivirus;

use Drupal\file\FileInterface;

/**
 * Scan a file or check whether a scanner is available.
 */
interface ScannerInterface {

  /**
   * Scan a file.
   *
   * @param \Drupal\file\FileInterface $file
   *   The file to scan.
   *
   * @return \Drupal\antivirus\ScanResultInterface
   *   The result of the scan.
   */
  public function scan(FileInterface $file) : ScanResultInterface;

  /**
   * Test whether the AntiVirus service is available.
   *
   * @return bool
   *   TRUE if the AntiVirus service is reachable.
   */
  public function isAvailable() : bool;

}
