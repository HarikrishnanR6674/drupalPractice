<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'twitter' share service.
 *
 * @ShareService(
 *   id = "twitter",
 *   name = @Translation("Twitter"),
 *   urlPrefix = "https://twitter.com/intent/tweet?",
 *   description = @Translation("The default share URL if the field will empty: https://twitter.com/intent/tweet?text=[node:title]&url=[node:url]&status=[node:title]+[node:url]"),
 * )
 */
class Twitter extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'text=[node:title]&url=[node:url]&status=[node:title]+[node:url]' : '';
  }

}
