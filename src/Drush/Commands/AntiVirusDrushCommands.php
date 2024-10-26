<?php

namespace Drupal\antivirus\Drush\Commands;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drush\Attributes as CLI;
use Drush\Boot\DrupalBootLevels;
use Drush\Commands\DrushCommands;
use Psr\Container\ContainerInterface as DrushContainer;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Drush integration to manage the AntiVirus module via shell.
 */
class AntiVirusDrushCommands extends DrushCommands {

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   The config factory service.
   */
  public function __construct(protected ConfigFactoryInterface $configFactory) {
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, DrushContainer $drush): self {
    return new static(
      $container->get('config.factory'),
    );
  }

  /**
   * Enable antivirus scanning.
   */
  #[CLI\Bootstrap(DrupalBootLevels::CONFIGURATION)]
  #[CLI\Command(name: 'antivirus:enable')]
  public function enable() : void {
    $this
      ->configFactory
      ->getEditable('antivirus.settings')
      ->set('enabled', TRUE)
      ->save();
    $this->io()->success('Antivirus scanning is enabled.');
  }

  /**
   * Disable antivirus scanning.
   */
  #[CLI\Bootstrap(DrupalBootLevels::CONFIGURATION)]
  #[CLI\Command(name: 'antivirus:disable')]
  public function disable() : void {
    $this
      ->configFactory
      ->getEditable('antivirus.settings')
      ->set('enabled', FALSE)
      ->save();
    $this->io()->success('Antivirus scanning is disabled.');
  }

}
