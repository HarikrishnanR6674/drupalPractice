<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Vk' share service.
 *
 * @ShareService(
 *   id = "vk",
 *   name = @Translation("VK"),
 *   urlPrefix = "http://vk.com/share.php?",
 *   description = @Translation("The default share URL if the field will empty: http://vk.com/share.php?url=[node:url]&title=[node:title]"),
 * )
 */
class Vk extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]&title=[node:title]' : '';
  }

}
