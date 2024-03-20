<?php

namespace Drupal\antivirus\Entity;

use Drupal\antivirus\PluginDefinition\AntiVirusPluginInterface;
use Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface;
use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Scanner entities describe the configuration for an antivirus scanner.
 */
interface AntiVirusScannerInterface extends ConfigEntityInterface {

  /**
   * Get the description of this scanner.
   *
   * @return string
   *   A description of this scanner entity.
   */
  public function description() : string;

  /**
   * Get the ID of the anti-virus plugin used by this scanner.
   *
   * @return string
   *   The machine name of the anti-virus plugin.
   */
  public function plugin() : string;

  /**
   * Get the configuration of the anti-virus plugin used by this scanner.
   *
   * @return array
   *   Configuration to use when creating an instance of the plugin.
   */
  public function configuration() : array;

  /**
   * Alias for AntiVirusScannerInterface::getPluginInstance().
   *
   * @return \Drupal\antivirus\PluginDefinition\AntiVirusPluginInterface
   *   An anti-virus plugin instance.
   */
  public function scanner() : AntiVirusPluginInterface;

  /**
   * Create or fetch an instance of the anti-virus plugin used by this scanner.
   *
   * @return \Drupal\antivirus\PluginDefinition\AntiVirusPluginInterface
   *   An anti-virus plugin instance.
   */
  public function getPluginInstance() : AntiVirusPluginInterface;

  /**
   * Set or replace the plugin manager for anti-virus plugins.
   *
   * @param \Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface $plugin_manager
   *   The anti-virus plugin manager.
   */
  public function setPluginManager(AntiVirusPluginManagerInterface $plugin_manager) : void;

}
