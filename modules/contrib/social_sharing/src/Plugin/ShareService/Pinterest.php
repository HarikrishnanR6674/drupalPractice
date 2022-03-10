<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Pinterest' share service.
 *
 * @ShareService(
 *   id = "pinterest",
 *   name = @Translation("Pinterest"),
 *   urlPrefix = "http://pinterest.com/pin/create/button/?",
 *   description = @Translation("The default share URL if the field will empty: http://pinterest.com/pin/create/button/?url=[node:url]"),
 * )
 */
class Pinterest extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]' : '';
  }

}
