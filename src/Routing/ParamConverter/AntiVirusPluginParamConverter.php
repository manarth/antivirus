<?php

namespace Drupal\antivirus\Routing\ParamConverter;

use Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface;
use Drupal\Core\ParamConverter\ParamConverterInterface;
use Symfony\Component\Routing\Route;

/**
 * Instantiate an antivirus plugin using its plugin ID.
 */
class AntiVirusPluginParamConverter implements ParamConverterInterface {

  /**
   * Constructor.
   *
   * @param \Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface $pluginManager
   *   The plugin manager for antivirus plugins.
   */
  public function __construct(protected AntiVirusPluginManagerInterface $pluginManager) {
  }

  /**
   * {@inheritdoc}
   */
  public function convert($value, $definition, $name, array $defaults) {
    if (!empty($value) && $this->pluginManager->hasDefinition($value)) {
      return $this
        ->pluginManager
        ->createInstance($value, []);
    }
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function applies($definition, $name, Route $route) {
    return !empty($definition['type']) && $definition['type'] == 'antivirus.plugin';
  }

}
