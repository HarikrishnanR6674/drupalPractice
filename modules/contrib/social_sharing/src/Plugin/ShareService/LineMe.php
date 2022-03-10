<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'LineMe' share service.
 *
 * @ShareService(
 *   id = "line_me",
 *   name = @Translation("LineMe"),
 *   urlPrefix = "https://lineit.line.me/share/ui?",
 *   description = @Translation("The default share URL if the field will empty: https://lineit.line.me/share/ui?url=[node:url]&text=[node:title]"),
 * )
 */
class LineMe extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]&text=[node:title]' : '';
  }

}
