<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Blogger' share service.
 *
 * @ShareService(
 *   id = "blogger",
 *   name = @Translation("Blogger"),
 *   urlPrefix = "https://www.blogger.com/blog-this.g?",
 *   description = @Translation("The default share URL if the field will empty: https://www.blogger.com/blog-this.g?u=[node:url]&n=[node:title]"),
 * )
 */
class Blogger extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'u=[node:url]&n=[node:title]' : '';
  }

}
