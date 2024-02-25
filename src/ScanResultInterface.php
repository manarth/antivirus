<?php

namespace Drupal\antivirus;

/**
 * Result of an antivirus scan for a single file.
 */
interface ScanResultInterface {

  /**
   *
   */
  public function getOutcome() : ScanOutcome;

  /**
   *
   */
  public function getReason() : string;

  /**
   *
   */
  public function getVirusName() : string;

  /**
   *
   */
  public function setReason(string $reason);

  /**
   *
   */
  public function setVirusName(string $virusName);

}
