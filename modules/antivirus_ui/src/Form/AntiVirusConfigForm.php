<?php

namespace Drupal\antivirus_ui\Form;

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
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable antivirus scanning'),
      '#config_target' => 'antivirus.settings:enabled',
    ];
    $form['require_scan'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('File must be scanned'),
      '#config_target' => 'antivirus.settings:require_scan',
    ];
    $form['require_clean'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('File must not be infected'),
      '#config_target' => 'antivirus.settings:require_clean',
    ];

    return parent::buildForm($form, $form_state);
  }

}
