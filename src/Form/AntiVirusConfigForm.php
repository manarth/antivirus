<?php

namespace Drupal\antivirus\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure the antivirus settings.
 */
class AntiVirusConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'antivirus.settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'antivirus.settings',
      'antivirus.scanners',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['enabled'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable antivirus scanning'),
      '#config_target' => 'antivirus.settings:enabled'
    );

    return parent::buildForm($form, $form_state);
  }

}
