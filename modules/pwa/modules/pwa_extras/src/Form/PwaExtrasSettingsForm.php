<?php

namespace Drupal\pwa_extras\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * PWA Extras admin settings form.
 */
class PwaExtrasSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pwa_extras_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('pwa_extras.settings.apple');

    $form['apple'] = [
      '#type' => 'details',
      '#title' => $this->t('Apple/IOS Specific Settings'),
      '#open' => TRUE,
    ];

    $form['apple']['touch_icons'] = [
      "#type" => 'checkboxes',
      "#title" => $this->t('Touch Icons'),
      "#options" => str_replace('<', '&lt;', pwa_extras_apple_touch_icons()),
      '#default_value' => $config->get('touch_icons'),
    ];

    $form['apple']['meta_tags'] = [
      "#type" => 'checkboxes',
      "#title" => $this->t('Meta Tags'),
      "#options" => str_replace('<', '&lt;', pwa_extras_apple_meta_tags()),
      '#default_value' => $config->get('meta_tags'),
    ];

    $form['apple']['color_select'] = [
      "#type" => 'select',
      "#title" => $this->t('Select color for status-bar-style'),
      '#options' => [
        'default' => $this->t('Default'),
        'black' => $this->t('Black'),
        'black_translucent' => $this->t('Black-translucent'),
      ],
      '#states' => [
        'invisible' => [
          ':input[value="meta-status-bar-style"]' => ['checked' => FALSE],
        ],
      ],
      '#default_value' => $config->get('color_select'),
    ];

    $form['apple']['home_screen_icons'] = [
      "#type" => 'checkboxes',
      "#title" => $this->t('Add to homescreen icons'),
      "#options" => str_replace('<', '&lt;', pwa_extras_apple_home_screen_icons()),
      '#default_value' => $config->get('home_screen_icons'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {}

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('pwa_extras.settings.apple');

    $values = $form_state->getValues();
    $config->set('touch_icons', $values['touch_icons'])
      ->set('meta_tags', $values['meta_tags'])
      ->set('color_select', $values['color_select'])
      ->set('home_screen_icons', $values['home_screen_icons'])
      ->save();
    parent::submitForm($form, $form_state);
  }

  /**
   * @return config settings.
   */
  protected function getEditableConfigNames() {
    return ['pwa_extras.settings.apple'];
  }
}
