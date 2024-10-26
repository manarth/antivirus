<?php

namespace Drupal\antivirus_ui\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\SubformState;
use Drupal\Core\Plugin\PluginFormInterface;
use Drupal\antivirus_core\PluginDefinition\AntiVirusPluginInterface;

/**
 * Form handler for editing antivirus scanner entities.
 */
class AntiVirusScannerForm extends EntityForm {

  /**
   * The entity being used by this form.
   *
   * @var \Drupal\antivirus_core\Entity\AntiVirusScannerInterface
   */
  protected $entity;

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /** @var \Drupal\antivirus_core\Entity\AntiVirusScannerInterface */
    $entity = $this->entity;

    /** @var \Drupal\antivirus_core\PluginDefinition\AntiVirusPluginInterface */
    $plugin = $this->plugin();

    $form['plugin'] = [
      '#type' => 'value',
      '#value' => $plugin->getPluginId(),
    ];

    $form['id'] = [
      '#title'         => $this->t('ID'),
      '#type'          => 'textfield',
      '#default_value' => $entity->id(),
      '#disabled'      => !$entity->isNew(),
      '#required'      => $entity->isNew(),
    ];

    $form['label'] = [
      '#title'         => $this->t('Label'),
      '#type'          => 'textfield',
      '#default_value' => $entity->label(),
      '#required'      => TRUE,
    ];

    $form['description'] = [
      '#title'         => $this->t('Description'),
      '#type'          => 'textarea',
      '#default_value' => $entity->description(),
    ];

    $form['plugin_info'] = [
      '#type' => 'details',
      '#title' => $this->t('Plugin'),
      '#open' => TRUE,
    ];
    $form['plugin_info']['admin_label'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $plugin->getPluginDefinition()['admin_label'],
    ];

    // Allow each plugin to provide their own in-line configuration subform.
    if ($plugin instanceof PluginFormInterface) {
      $form['plugin_info']['configuration'] = [
        '#tree' => TRUE,
      ];
      $subform_state = SubformState::createForSubform($form['plugin_info']['configuration'], $form, $form_state);
      $form['plugin_info']['configuration'] = $plugin
        ->buildConfigurationForm($form['plugin_info']['configuration'], $subform_state);
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);
    if ($result === SAVED_NEW || $result === SAVED_UPDATED) {
      // Don't override the redirect if it's already set.
      if ($form_state->getRedirect() === NULL) {
        $form_state->setRedirect('entity.antivirus_scanners.collection');
      }
    }
    return $result;
  }

  /**
   * Get the plugin instance.
   *
   * @return \Drupal\antivirus_core\PluginDefinition\AntiVirusPluginInterface
   *   For existing entities, this is the configured plugin instance.
   *   For new entities, this will be a new instantiation of the plugin.
   */
  protected function plugin() : AntiVirusPluginInterface {
    if (!$this->entity->isNew()) {
      return $this->entity->getPluginInstance();
    }

    // The plugin is instantiated by the routing param-converter.
    // @see \Drupal\antivirus\Routing\ParamConverter\AntiVirusPluginParamConverter
    return $this->getRequest()->get('plugin');
  }

}
