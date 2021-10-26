<?php
/**
 * @file
 * Replace values in serviceworker.js
 */

namespace Drupal\pwa\Controller;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\State\StateInterface;
use Drupal\pwa\ManifestInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Cache\CacheableResponse;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Url;

/**
 * Default controller for the pwa module.
 */
class PWAController implements ContainerInjectionInterface {

  /**
   * The manifest service.
   *
   * @var \Drupal\pwa\ManifestInterface
   */
  private $manifest;

  /**
   * The state.
   *
   * @var \Drupal\Core\State\StateInterface
   */
  private $state;

  /**
   * ModuleHandler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  private $moduleHandler;

  /**
   * Constructor.
   *
   * @param \Drupal\pwa\ManifestInterface $manifest
   *   The manifest service.
   * @param \Drupal\Core\State\StateInterface $state
   *   The system state.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   */
  public function __construct(ManifestInterface $manifest, StateInterface $state, ModuleHandlerInterface $moduleHandler) {
    $this->manifest = $manifest;
    $this->state = $state;
    $this->moduleHandler = $moduleHandler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('pwa.manifest'),
      $container->get('state'),
      $container->get('module_handler')
    );
  }

  /**
   * Fetch the manifest content.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The HTTP request.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   The manifest file as a response object.
   */
  public function pwa_manifest(Request $request) {
    $response = new CacheableResponse($this->manifest->getOutput(), 200, [
      'Content-Type' => 'application/json',
    ]);
    $meta_data = $response->getCacheableMetadata();
    $meta_data->addCacheTags(['manifestjson']);
    $meta_data->addCacheContexts(['languages:language_interface']);
    return $response;
  }

  /**
   * Fetch all resources.
   *
   * @param array $pages
   *   The page URL.
   *
   * @return array
   *   Returns an array of the CSS and JS file URLs.
   */
  public function _pwa_fetch_offline_page_resources($pages) {

    // For each Drupal path, request the HTML response and parse any CSS/JS found
    // within the HTML. Since this is the pure HTML response, any DOM modifications
    // that trigger new requests cannot be accounted for. An example would be an
    // asynchronously-loaded webfont.

    $resources = [];

    foreach ($pages as $page) {
      try {
        // URL is validated as internal in ConfigurationForm.php.
        $url = Url::fromUserInput($page, ['absolute' => TRUE])->toString(TRUE);
        $url_string = $url->getGeneratedUrl();
        $response = \Drupal::httpClient()->get($url_string, array('headers' => array('Accept' => 'text/plain')));

        $data = $response->getBody();
        if (empty($data)) {
          continue;
        }
      }
      catch (\Exception $e) {
        continue;
      }

      $page_resources = [];

      // Get all DOM data.
      $dom = new \DOMDocument();
      @$dom->loadHTML($data);

      $xpath = new \DOMXPath($dom);
      foreach ($xpath->query('//script[@src]') as $script) {
        $page_resources[] = $script->getAttribute('src');
      }
      foreach ($xpath->query('//link[@rel="stylesheet"][@href]') as $stylesheet) {
        $page_resources[] = $stylesheet->getAttribute('href');
      }
      foreach ($xpath->query('//style[@media="all" or @media="screen"]') as $stylesheets) {
        preg_match_all(
          "#(/(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie",
          ' ' . $stylesheets->textContent,
          $matches
        );
        $page_resources = array_merge($page_resources, $matches[0]);
      }
      foreach ($xpath->query('//img[@src]') as $image) {
        $page_resources[] = $image->getAttribute('src');
      }

      // Allow other modules to alter cached asset URLs for this page.
      $this->moduleHandler->alter('pwa_cache_urls_assets_page', $page_resources, $page, $xpath);

      $resources = array_merge($resources, $page_resources);
    }

    $dedupe = array_unique($resources);
    $dedupe = array_values($dedupe);
    // Allow other modules to alter the final list of cached asset URLs.
    $this->moduleHandler->alter('pwa_cache_urls_assets', $dedupe);
    return $dedupe;
  }

  /**
   * Replace the serviceworker file with variables from Drupal config.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current request object.
   *
   * @return mixed
   */
  public function pwa_serviceworker_file_data(Request $request) {
    $path = drupal_get_path('module', 'pwa');

    $sw = file_get_contents($path . '/js/serviceworker.js');

    // Get module configuration.
    $config = \Drupal::config('pwa.config');

    // Get URLs from config.
    $cacheUrls = pwa_str_to_list($config->get('urls_to_cache'));
    $cacheUrls[] = $config->get('offline_page');
    $exclude_cache_url = pwa_str_to_list($config->get('urls_to_exclude'));

    // Initialize a CacheableMetadata object.
    $cacheable_metadata = new CacheableMetadata;
    $cacheable_metadata->addCacheableDependency($config);
    $cacheable_metadata
      ->setCacheMaxAge(86400)
      ->setCacheContexts(['url']);

    // Get icons list and convert into array of sources.
    $manifest = Json::decode($this->manifest->getOutput());
    $cacheIcons = [];
    if (!empty($manifest['icons'])) {
      foreach ($manifest['icons'] as $icon) {
        $cacheIcons[] = $icon['src'];
      }
    }

    // Combine URLs from admin UI with manifest icons.
    $cacheWhitelist = array_merge($cacheUrls, $cacheIcons);

    // Allow other modules to alter the URL's. Also pass the CacheableMetadata
    // object so these modules can add cacheability metadata to the response.
    $this->moduleHandler->alter('pwa_cache_urls', $cacheWhitelist, $cacheable_metadata);
    $this->moduleHandler->alter('pwa_exclude_urls', $exclude_cache_url, $cacheable_metadata);

    // Active languages on the site.
    $languages = \Drupal::languageManager()->getLanguages();

    // Get the skip-waiting setting.
    $skip_waiting = $config->get('skip_waiting') ? 'true' : 'false';

    // Set up placeholders.
    $replace = [
      '[/*cacheUrls*/]' => Json::encode($cacheWhitelist),
      '[/*activeLanguages*/]' => Json::encode(array_keys($languages)),
      '[/*exclude_cache_url*/]' => Json::encode($exclude_cache_url),
      "'/offline'/*offlinePage*/" => "'" . $config->get('offline_page') . "'",
      '[/*modulePath*/]' => '/' . drupal_get_path('module', 'pwa'),
      '1/*cacheVersion*/' => '\'' . $this->pwa_get_cache_version() . '\'',
      'false/*pwaSkipWaiting*/' => $skip_waiting,
    ];
    if (!empty($cacheUrls)) {
      $replace['[/*cacheUrlsAssets*/]'] = Json::encode($this->_pwa_fetch_offline_page_resources($cacheUrls));
    }

    $this->moduleHandler->alter('pwa_replace_placeholders', $replace);

    // Fill placeholders and return final file.
    $data = str_replace(array_keys($replace), array_values($replace), $sw);

    $response = new CacheableResponse($data, 200, [
      'Content-Type' => 'application/javascript',
      'Service-Worker-Allowed' => '/',
    ]);
    $response->addCacheableDependency($cacheable_metadata);

    return $response;
  }

  /**
   * Returns current cache version.
   *
   * @return string
   *   Cache version.
   */
  public static function pwa_get_cache_version() {
    // Get module configuration.
    $config = \Drupal::config('pwa.config');

    // Look up module release from package info.
    $pwa_module_info = \Drupal::service('extension.list.module')->getExtensionInfo('pwa');
    $pwa_module_version = $pwa_module_info['version'];

    // Packaging script will always provide the published module version. Checking
    // for NULL is only so maintainers have something predictable to test against.
    if ($pwa_module_version == NULL) {
      $pwa_module_version = '8.x-1.x-dev';
    }

    return $pwa_module_version . '-v' . ($config->get('cache_version') ?: 1);
  }

  /**
   * Phone home uninstall.
   *
   * @package Applied from patch
   * https://www.drupal.org/project/pwa/issues/2913023#comment-12819311.
   */
    public function pwa_module_active_page() {
      return [
        '#tag' => 'h1',
        '#value' => 'PWA module is installed.',
        '#attributes' => [
          'data-drupal-pwa-active' => TRUE,
        ],
      ];
    }

  /**
   * Provide a render array for offline pages.
   *
   * @return array
   *   The render array.
   */
  public function pwa_offline_page() {
    return [
      '#theme' => 'offline',
    ];
  }
}
