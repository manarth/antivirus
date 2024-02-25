<?php

namespace Drupal\antivirus\PluginDefinition;

use Drupal\antivirus\Attribute\AntiVirus;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Plugin manager for AntiVirus plugins.
 */
class AntiVirusPluginManager extends DefaultPluginManager implements AntiVirusPluginManagerInterface {

  /**
   * Path where AntiVirus plugins should be stored.
   */
  const PLUGIN_SUBDIR = 'Plugin/AntiVirus';

  /**
   * Interface to be implemented by all AntiVirus plugins.
   */
  const PLUGIN_INTERFACE = AntiVirusPluginInterface::class;

  /**
   * Attribute which identifies an AntiVirus plugin.
   */
  const PLUGIN_ATTRIBUTE = AntiVirus::class;

  // Plugin manager
  public function __construct(
    \Traversable $namespaces,
    CacheBackendInterface $cache_backend,
    ModuleHandlerInterface $module_handler) {

    parent::__construct(self::PLUGIN_SUBDIR,
                        $namespaces,
                        $module_handler,
                        self::PLUGIN_INTERFACE,
                        self::PLUGIN_ATTRIBUTE);
  }

}
