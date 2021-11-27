<?php

namespace Drupal\Tests\pwa\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test description.
 *
 * @group pwa
 */
class ManifestTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['pwa'];

  /**
   * Test caching of manifest.json.
   */
  public function testCache() {
    // Create a test user.
    $user = $this->drupalCreateUser([
      'access content',
    ]);
    $this->drupalLogin($user);
    $this->drupalGet('manifest.json');
    $assert = $this->assertSession();
    $assert->statusCodeEquals(200);
    $assert->responseHeaderContains('X-Drupal-Cache-Tags', 'manifestjson');
  }

}
