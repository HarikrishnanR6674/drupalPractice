<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Flipboard' share service.
 *
 * @ShareService(
 *   id = "flipboard",
 *   name = @Translation("Flipboard"),
 *   urlPrefix = "https://share.flipboard.com/bookmarklet/popout?",
 *   description = @Translation("The default share URL if the field will empty: https://share.flipboard.com/bookmarklet/popout?v=2&title=[node:title]&url=[node:url]"),
 * )
 */
class Flipboard extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'v=2&title=[node:title]&url=[node:url]' : '';
  }

}
