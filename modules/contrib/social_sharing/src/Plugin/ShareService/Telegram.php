<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Telegram' share service.
 *
 * @ShareService(
 *   id = "telegram",
 *   name = @Translation("Telegram"),
 *   urlPrefix = "https://t.me/share/url?",
 *   description = @Translation("The default share URL if the field will empty: https://t.me/share/url?url=[node:url]&text=[node:title]"),
 * )
 */
class Telegram extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]&text=[node:title]' : '';
  }

}
