<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'WhatsApp' share service.
 *
 * @ShareService(
 *   id = "whatsapp",
 *   name = @Translation("WhatsApp"),
 *   urlPrefix = "https://api.whatsapp.com/send?",
 *   description = @Translation("The default share URL if the field will empty: https://api.whatsapp.com/send?text=[node:title]%20[node:url]"),
 * )
 */
class WhatsApp extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'text=[node:title]%20[node:url]' : '';
  }

}
