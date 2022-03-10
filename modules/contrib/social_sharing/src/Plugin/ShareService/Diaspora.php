<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Diaspora' share service.
 *
 * @ShareService(
 *   id = "diaspora",
 *   name = @Translation("Diaspora"),
 *   urlPrefix = "https://share.diasporafoundation.org/?",
 *   description = @Translation("The default share URL if the field will empty: https://share.diasporafoundation.org/?title=[node:title]&url=[node:url]"),
 * )
 */
class Diaspora extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'title=[node:title]&url=[node:url]' : '';
  }

}
