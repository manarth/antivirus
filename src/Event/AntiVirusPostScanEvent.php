<?php

namespace Drupal\antivirus\Event;

use Drupal\file\FileInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Event subsequent to an AntiVirus scan.
 */
class AntiVirusPostScanEvent extends Event {

  protected $results;

  /**
   * Constructor
   *
   * @param \Drupal\file\FileInterface $file
   *   The file to be scanned.
   */
  public function __construct(protected FileInterface $file) {
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

}
