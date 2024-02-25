<?php

namespace Drupal\antivirus;

/**
 * Result of an antivirus scan for a single file.
 */
class ScanResult implements ScanResultInterface {

  /**
   * The reason for a particular outcome.
   *
   * @var string
   */
  protected string $reason;

  /**
   * The virus name, if a virus was detected.
   *
   * @var string
   */
  protected string $virusName;

  /**
   * Constructor.
   *
   * @param \Drupal\antivirus\ScanOutcome $outcome
   *   The outcome of the scan.
   * @param string $reason
   *   The Virus name or error message.
   */
  public function __construct(protected readonly ScanOutcome $outcome) {
  }

  /**
   * @{inheritdoc}
   */
  public function getOutcome() : ScanOutcome {
    return $this->outcome;
  }

  /**
   * @{inheritdoc}
   */
  public function getReason() : string {
    return $this->reason;
  }

  /**
   * @{inheritdoc}
   */
  public function getVirusName() : string {
    return $this->virusName;
  }

  /**
   * @{inheritdoc}
   */
  public function setReason(string $reason) : self {
    $this->reason = $reason;
    return $this;
  }

  /**
   * @{inheritdoc}
   */
  public function setVirusName(string $virusName) : self {
    $this->virusName = $virusName;
    return $this;
  }

}
