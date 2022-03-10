<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'facebook' share service.
 *
 * @ShareService(
 *   id = "facebook",
 *   name = @Translation("Facebook"),
 *   urlPrefix = "https://www.facebook.com/share.php?",
 *   description = @Translation("The default share URL if the field will empty: https://www.facebook.com/share.php?u=[node:url]&title=[node:title]"),
 * )
 */
class Facebook extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'u=[node:url]&title=[node:title]' : '';
  }

}
