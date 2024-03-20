<?php

namespace Drupal\antivirus\Controller;

use Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for page callbacks not handled by the entity providers.
 */
class AntiVirusController extends ControllerBase {

  /**
   * Constructor.
   *
   * @param \Drupal\antivirus\PluginDefinition\AntiVirusPluginManagerInterface $pluginManager
   *   The plugin manager for anti-virus plugins.
   */
  public function __construct(protected AntiVirusPluginManagerInterface $pluginManager) {
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.antivirus')
    );
  }

  /**
   * The "add scanner" page provides a list of the scanner plugins available.
   */
  public function addScannerPage() {
    $build = [];

    $build['links'] = [
      '#theme' => 'links',
      '#heading' => [
        'text' => $this->t('Antivirus scanners'),
        'level' => 'h2',
      ],
      '#links' => [],
    ];

    foreach ($this->pluginManager->getDefinitions() as $definition) {
      $build['links']['#links'][] = [
        'title' => $definition['admin_label'],
        'url' => Url::fromRoute('antivirus.admin.add_scanner', [
          'plugin' => $definition['id'],
        ]),
      ];
    }
    return $build;
  }

}
