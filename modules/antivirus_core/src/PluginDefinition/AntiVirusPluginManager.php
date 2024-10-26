<?php

namespace Drupal\antivirus_core\PluginDefinition;

use Drupal\antivirus_core\Attribute\AntiVirus;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Plugin manager for AntiVirus plugins.
 */
class AntiVirusPluginManager extends DefaultPluginManager implements AntiVirusPluginManagerInterface {

  /**
   * Path where the plugins should be stored.
   */
  const PLUGIN_SUBDIR = 'Plugin/AntiVirus';

  /**
   * Interface to be implemented by all plugins of this type.
   */
  const PLUGIN_INTERFACE = AntiVirusPluginInterface::class;

  /**
   * Attribute which identifies a plugin.
   */
  const PLUGIN_ATTRIBUTE = AntiVirus::class;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    \Traversable $namespaces,
    CacheBackendInterface $cache_backend,
    ModuleHandlerInterface $module_handler,
  )
  {
    parent::__construct(
      self::PLUGIN_SUBDIR,
      $namespaces,
      $module_handler,
      self::PLUGIN_INTERFACE,
      self::PLUGIN_ATTRIBUTE
    );
  }

}
