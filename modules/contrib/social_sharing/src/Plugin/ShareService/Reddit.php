<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Reddit' share service.
 *
 * @ShareService(
 *   id = "reddit",
 *   name = @Translation("Reddit"),
 *   urlPrefix = "https://reddit.com/submit?",
 *   description = @Translation("The default share URL if the field will empty: https://reddit.com/submit?title=[node:title]&url=[node:url]"),
 * )
 */
class Reddit extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'title=[node:title]&url=[node:url]' : '';
  }

}
