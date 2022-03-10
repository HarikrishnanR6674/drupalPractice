<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'GoogleBookmarks' share service.
 *
 * @ShareService(
 *   id = "google_bookmarks",
 *   name = @Translation("GoogleBookmarks"),
 *   urlPrefix = "https://www.google.com/bookmarks/mark?",
 *   description = @Translation("The default share URL if the field will empty: https://www.google.com/bookmarks/mark?op=edit&bkmk=[node:url]&title=[node:title]"),
 * )
 */
class GoogleBookmarks extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'op=edit&bkmk=[node:url]&title=[node:title]' : '';
  }

}
