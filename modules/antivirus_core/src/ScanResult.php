<?php

namespace Drupal\antivirus_core;

/**
 * Result of an antivirus scan for a single file.
 */
class ScanResult implements ScanResultInterface {

  /**
   * The filename of the scanned file.
   *
   * @var string
   */
  protected string $filename = '';

  /**
   * The reason for a particular outcome.
   *
   * @var string
   */
  protected string $reason = '';

  /**
   * The virus name, if a virus was detected.
   *
   * @var string
   */
  protected ?string $virusName = null;

  /**
   * Constructor.
   *
   * @param \Drupal\antivirus_core\ScanOutcome $outcome
   *   The outcome of the scan.
   */
  public function __construct(protected readonly ScanOutcome $outcome) {
  }

  /**
   * {@inheritdoc}
   */
  public function getOutcome() : ScanOutcome {
    return $this->outcome;
  }

  /**
   * {@inheritdoc}
   */
  public function getFilename() : string {
    return $this->filename;
  }

  /**
   * {@inheritdoc}
   */
  public function getReason() : string {
    return $this->reason;
  }

  /**
   * {@inheritdoc}
   */
  public function getVirusName() : ?string {
    return $this->virusName;
  }

  /**
   * {@inheritdoc}
   */
  public function setFilename(string $filename) : self {
    $this->filename = $filename;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setReason(string $reason) : self {
    $this->reason = $reason;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setVirusName(string $virusName) : self {
    $this->virusName = $virusName;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isInfected() : bool {
    return $this->outcome == ScanOutcome::INFECTED;
  }

  /**
   * {@inheritdoc}
   */
  public function isScanned() : bool {
    return $this->outcome == ScanOutcome::CLEAN || $this->outcome == ScanOutcome::INFECTED;
  }

  /**
   * {@inheritdoc}
   */
  public function isNotScanned() : bool {
    return $this->outcome == ScanOutcome::UNCHECKED || $this->outcome == ScanOutcome::UNKNOWN;
  }

}
