<?php

namespace Drupal\antivirus_core\Entity;

use Drupal\antivirus_core\PluginDefinition\AntiVirusPluginInterface;
use Drupal\antivirus_core\PluginDefinition\AntiVirusPluginManagerInterface;
use Drupal\antivirus_core\ScanResultInterface;
use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\file\FileInterface;

/**
 * An anti-virus scanner entity holds the configuration for a scanner instance.
 *
 * @ConfigEntityType(
 *   id = "antivirus_scanner",
 *   label = @Translation("Antivirus scanner"),
 *   handlers = {
 *     "list_builder" = "Drupal\antivirus_ui\Controller\AntiVirusScannerListBuilder",
 *     "form" = {
 *       "add"    = "Drupal\antivirus_ui\Form\AntiVirusScannerForm",
 *       "edit"   = "Drupal\antivirus_ui\Form\AntiVirusScannerForm",
 *       "delete" = "Drupal\antivirus_ui\Form\AntiVirusScannerDeleteForm",
 *     }
 *   },
 *   config_prefix = "antivirus",
 *   admin_permission = "administer antivirus",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "plugin",
 *     "configuration"
 *   },
 *   links = {
 *     "add-form"    = "/admin/config/media/antivirus/scanners/add/{plugin}",
 *     "edit-form"   = "/admin/config/media/antivirus/scanners/edit/{antivirus_scanner}",
 *     "delete-form" = "/admin/config/media/antivirus/scanners/delete/{antivirus_scanner}",
 *   }
 * )
 */
class AntiVirusScanner extends ConfigEntityBase implements AntivirusScannerInterface {

  /**
   * The scanner ID.
   *
   * @var string
   */
  protected string $id;

  /**
   * Label which names the scanner.
   *
   * @var string
   */
  protected string $label = "";

  /**
   * Optional description for the scanner instance.
   *
   * @var string
   */
  protected string $description = "";

  /**
   * Plugin ID for the scanner plugin.
   *
   * @var string
   */
  protected string $plugin = "";

  /**
   * Configuration to use when creating a plugin instance.
   *
   * @var array
   */
  protected array $configuration = [];

  /**
   * The anti-virus plugin manager service.
   *
   * @var \Drupal\antivirus_core\PluginDefinition\AntiVirusPluginManagerInterface
   */
  protected AntiVirusPluginManagerInterface $pluginManager;

  /**
   * {@inheritdoc}
   */
  public function description() : string {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function plugin() : string {
    return $this->plugin;
  }

  /**
   * {@inheritdoc}
   */
  public function configuration() : array {
    return $this->configuration;
  }

  /**
   * {@inheritdoc}
   */
  public function scanner() : AntiVirusPluginInterface {
    return $this->getPluginInstance();
  }

  /**
   * {@inheritdoc}
   */
  public function getPluginInstance() : AntiVirusPluginInterface {
    return $this
      ->pluginManager()
      ->createInstance($this->plugin(), $this->configuration());
  }

  /**
   * {@inheritdoc}
   */
  public function setPluginManager(AntiVirusPluginManagerInterface $plugin_manager) : void {
    $this->pluginManager = $plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function scan(FileInterface $file) : ScanResultInterface {
    return $this
      ->scanner()
      ->scan($file);
  }

  /**
   * Get the plugin manager for anti-virus plugins.
   *
   * @return \Drupal\antivirus_core\PluginDefinition\AntiVirusPluginManagerInterface
   *   The plugin manager service.
   */
  protected function pluginManager() : AntiVirusPluginManagerInterface {
    if (empty($this->pluginManager)) {
      $this->pluginManager = \Drupal::service('plugin.manager.antivirus');
    }
    return $this->pluginManager;
  }

}
