<?php

namespace Drupal\pwa;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Url;

/**
 * Manifest JSON building service.
 */
class Manifest implements ManifestInterface {

  /**
   * The configuration manager.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  private $languageManager;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactoryInterface $config_factory, LanguageManagerInterface $language_manager) {
    $this->configFactory = $config_factory;
    $this->languageManager = $language_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function getOutput() {
    // Get values.
    $values = $this->getCleanValues();
      $manifest_data['orientation'] = 'portrait';
    if (isset($values['site_name'])) {
      $manifest_data['name'] = $values['site_name'];
    }
    if (isset($values['short_name'])) {
      $manifest_data['short_name'] = $values['short_name'];
    }
    if (isset($values['display'])) {
      $manifest_data['display'] = $values['display'];
    }
    if (isset($values['background_color'])) {
      $manifest_data['background_color'] = $values['background_color'];
    }
    if (isset($values['theme_color'])) {
      $manifest_data['theme_color'] = $values['theme_color'];
    }
    if (isset($values['description'])) {
      $manifest_data['description'] = $values['description'];
    }
    if (isset($values['lang'])) {
      $manifest_data['lang'] = $values['lang'];
    }
    if (isset($values['image'])) {
      $manifest_data['icons'][0]['src'] = $values['image'];
      $manifest_data['icons'][0]['sizes'] = '512x512';
      $manifest_data['icons'][0]['type'] = 'image/png';
    }
    if (isset($values['image_small'])) {
      $manifest_data['icons'][1]['src'] = $values['image_small'];
      $manifest_data['icons'][1]['sizes'] = '192x192';
      $manifest_data['icons'][1]['type'] = 'image/png';
    }
    if (isset($values['image_very_small'])) {
      $manifest_data['icons'][2]['src'] = $values['image_very_small'];
      $manifest_data['icons'][2]['sizes'] = '144x144';
      $manifest_data['icons'][2]['type'] = 'image/png';
    }
    if (isset($values['start_url'])) {
      $manifest_data['start_url'] = $values['start_url'];
    }
    $manifest_data['scope'] = '/';

    \Drupal::moduleHandler()->alter('pwa_manifest', $manifest_data);

    return Json::encode($manifest_data);
  }

  /**
   * {@inheritdoc}
   */
  public function deleteImage() {
    $config = $this->configFactory->get('pwa.config');
    $image = $config->get('image');
    // Image exists and is NOT default.
    if (!empty($image) && $image[0] == '/') {
      // Image.
      $path = getcwd() . $image;
      unlink($path);
      // Image_small.
      unlink($path . 'copy.png');
      // Image_very_small.
      unlink($path . 'copy2.png');
    }
  }

  /**
   * Checks the values in config and add default value if necessary.
   *
   * @return array
   *   Values from the configuration.
   */
  private function getCleanValues() {
    // Set defaults.
    $lang = $this->languageManager->getDefaultLanguage();
    $site_name = $this->configFactory->get('system.site')->get('name');
    $path = \Drupal::request()->getSchemeAndHttpHost() . '/' . drupal_get_path('module', 'pwa');
    $output = [
      'site_name' => $site_name,
      'short_name' => $site_name,
      'background_color' => '#ffffff',
      'theme_color' => '#ffffff',
      'display' => 'standalone',
      'image' => $path . '/assets/druplicon-512.png',
      'image_small' => $path . '/assets/druplicon-192.png',
      'image_very_small' => $path . '/assets/druplicon-144.png',
    ];

    $config = $this->configFactory->get('pwa.config');
    $config_data = $config->get();
    foreach ($config_data as $key => $value) {
      if ($value !== '') {
        $output[$key] = $value;
      }
    }

    // Image from theme.
    if ($config->get('default_image')) {
      $image = theme_get_setting('logo.path');
      $output['image'] = $image;
      $output['image_small'] = $image;
      $output['image_very_small'] = $image;
    }

    return $output;
  }

}
