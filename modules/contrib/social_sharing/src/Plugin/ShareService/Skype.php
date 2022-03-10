<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Skype' share service.
 *
 * @ShareService(
 *   id = "skype",
 *   name = @Translation("Skype"),
 *   urlPrefix = "https://web.skype.com/share?",
 *   description = @Translation("The default share URL if the field will empty: https://web.skype.com/share?title=[node:title]&url=[node:url]"),
 * )
 */
class Skype extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'title=[node:title]&url=[node:url]' : '';
  }

}
