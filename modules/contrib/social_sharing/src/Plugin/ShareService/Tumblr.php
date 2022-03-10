<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Tumblr' share service.
 *
 * @ShareService(
 *   id = "tumblr",
 *   name = @Translation("Tumblr"),
 *   urlPrefix = "https://www.tumblr.com/widgets/share/tool?",
 *   description = @Translation("The default share URL if the field will empty: https://www.tumblr.com/widgets/share/tool?canonicalUrl=[node:url]&title=[node:title]"),
 * )
 */
class Tumblr extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'canonicalUrl=[node:url]&title=[node:title]' : '';
  }

}
