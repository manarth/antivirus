<?php

namespace Drupal\antivirus\Event;

use Drupal\file\FileInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Event prior to an AntiVirus scan to determine if a file should be scanned.
 */
class AntiVirusPreScanEvent extends Event {

  /**
   * Decision whether the file should be scanned.
   *
   * @var bool
   */
  protected bool $performScan = TRUE;

  /**
   * Constructor.
   *
   * @param \Drupal\file\FileInterface $file
   *   The file to be scanned.
   */
  public function __construct(protected readonly FileInterface $file) {
  }

  /**
   * Fetch the file being scanned.
   *
   * @return \Drupal\file\FileInterface
   *   The file being scanned.
   */
  public function getFile() : FileInterface {
    return $this->file;
  }

  /**
   * Check whether the file should be scanned.
   *
   * @return bool
   *   TRUE if the file should be scanned.
   */
  public function shouldFileBeScanned() : bool {
    return $this->performScan;
  }

  /**
   * Enable scanning for this file.
   */
  public function enableScan() : void {
    $this->performScan = TRUE;
  }

  /**
   * Disable scanning for this file.
   */
  public function disableScan() : void {
    $this->performScan = FALSE;
  }

}
