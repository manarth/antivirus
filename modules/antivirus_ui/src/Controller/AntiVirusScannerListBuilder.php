<?php

namespace Drupal\antivirus_ui\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * A list controller for anti-virus scanner entities.
 */
class AntiVirusScannerListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id']          = $this->t('ID');
    $header['label']       = $this->t('Label');
    $header['description'] = $this->t('Description');
    $header['plugin']      = $this->t('Scanner plugin');
    $header['available']   = $this->t('Available');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\antivirus_core\Entity\AntiVirusScannerInterface $entity */
    $row['id']          = $entity->id();
    $row['label']       = $entity->label();
    $row['description'] = $entity->description();
    $row['plugin']      = $entity->getPluginInstance()->getPluginDefinition()['admin_label'];
    $row['available']   = $entity->getPluginInstance()->isAvailable() ? 'Y' : 'N';
    return $row + parent::buildRow($entity);
  }

}
