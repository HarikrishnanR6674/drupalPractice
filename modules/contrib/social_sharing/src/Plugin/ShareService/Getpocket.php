<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Getpocket' share service.
 *
 * @ShareService(
 *   id = "getpocket",
 *   name = @Translation("Getpocket"),
 *   urlPrefix = "https://getpocket.com/edit?",
 *   description = @Translation("The default share URL if the field will empty: https://getpocket.com/edit?url=[node:url]"),
 * )
 */
class Getpocket extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]' : '';
  }

}
