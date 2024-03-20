<?php

namespace Drupal\antivirus\Service;

use Drupal\antivirus\Event\AntiVirusPreScanEvent;
use Drupal\Core\Config\Config;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\file\FileInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Scan manager service.
 *
 * This determines whether a file should be scanned, performs the scans, and
 * provides the scan results.
 */
class ScanManager {

  /**
   * All defined scanner entities.
   *
   * @var \Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface[]
   */
  protected readonly array $scanners;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $etm
   *   The entity-type manager service.
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
   *   The event dispatcher service.
   * @param \Drupal\Core\Config\Config $config
   *   The config for the antivirus module.
   */
  public function __construct(
    EntityTypeManagerInterface $etm,
    protected EventDispatcherInterface $eventDispatcher,
    protected Config $config) {
    $this->scanners = $etm
      ->getStorage('antivirus_scanner')
      ->loadMultiple();
  }

  /**
   * Check whether a particular file should be scanned.
   *
   * @param \Drupal\file\FileInterface $file
   *   The file to be scanned.
   *
   * @return bool
   *   TRUE if the file should be scanned.
   */
  public function shouldFileBeScanned(FileInterface $file) : bool {
    $event = new AntiVirusPreScanEvent($file);
    $this->eventDispatcher->dispatch($event);
    return $event->shouldFileBeScanned();
  }

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
  public function scan(FileInterface $file) : array {
    $results = [];
    foreach ($this->getScanners() as $scanner) {
      $results[$scanner->id()] = $scanner->scan($file);
    }

    return $results;
  }

  /**
   * Get the scanner entities.
   *
   * @return \Drupal\antivirus_core\Entity\AntiVirusScannerInterface[]
   *   Each of the scanner entities.
   */
  public function getScanners() : array {
    return $this->scanners;
  }

}
