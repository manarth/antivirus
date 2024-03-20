<?php

namespace Drupal\antivirus_core;

/**
 * Result of an antivirus scan for a single file.
 */
interface ScanResultInterface {

  /**
   * Get the outcome of the scan.
   *
   * @return \Drupal\antivirus_core\ScanOutcome
   *   An enum determining whether the file was infected, etc.
   */
  public function getOutcome() : ScanOutcome;

  /**
   * Get the filename of the file scanned.
   *
   * @return string
   *   The filename of the file which was scanned.
   */
  public function getFilename() : string;

  /**
   * Get the reason provided, in the event of a scan error.
   *
   * @return string
   *   The reason for a scanning error.
   */
  public function getReason() : string;

  /**
   * Get the name of the virus, if the file was found to be infected.
   *
   * @return string
   *   The name of the virus.
   */
  public function getVirusName() : ?string;

  /**
   * Set the filename of the file scanned.
   *
   * @param string $filename
   *   The filename of the file which was scanned.
   *
   * @return self
   *   For fluent method chaining.
   */
  public function setFilename(string $filename) : self;

  /**
   * Set the reason provided, in the event of a scan error.
   *
   * @param string $reason
   *   The reason for a scanning error.
   *
   * @return self
   *   For fluent method chaining.
   */
  public function setReason(string $reason) : self;

  /**
   * Set the name of the virus, if the file was found to be infected.
   *
   * @param string $virusName
   *   The name of the virus.
   *
   * @return self
   *   For fluent method chaining.
   */
  public function setVirusName(string $virusName) : self;

}
