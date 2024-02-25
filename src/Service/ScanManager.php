<?php

namespace Drupal\antivirus\Service;

use Drupal\antivirus\Event\AntiVirusPreScanEvent;
use Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface;
use Drupal\Core\Config\Config;
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
   * Constructor.
   *
   * @param \Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface $pluginManager
   *   The plugin manager service for AntiVirus plugins.
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
   *   The event dispatcher service.
   * @param \Drupal\Core\Config\Config $config
   *   The list of configured scanners.
   */
  public function __construct(protected AntiVirusPluginManagerInterface $pluginManager,
                              protected EventDispatcherInterface $eventDispatcher,
                              protected Config $config) {
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
   */
  public function scan(FileInterface $file) {
    $results = [];
    foreach ($this->getScanners() as $scanner) {
      $results[] = $scanner->scan($file);
    }

    return $results;
  }

  /**
   * Get the scanner plugin instances.
   *
   * @return \Drupal\antivirus\PluginDefinition\AntiVirusPluginInterface[]
   *   The instantiated plugin definitions using the `antivirus.scanners`
   *   config definition.
   */
  public function getScanners() : array {
    $scanners = [];
    foreach ($this->config->get() as $definition) {
      $scanners[] = $this
        ->pluginManager
        ->createInstance($definition['provider'], $definition['configuration'] ?? []);
    }
    return $scanners;
  }

}
