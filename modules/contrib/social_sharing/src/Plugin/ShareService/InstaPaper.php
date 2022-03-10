<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'InstaPaper' share service.
 *
 * @ShareService(
 *   id = "instapaper",
 *   name = @Translation("InstaPaper"),
 *   urlPrefix = "http://www.instapaper.com/edit?",
 *   description = @Translation("The default share URL if the field will empty: http://www.instapaper.com/edit?url=[node:url]&title=[node:title]"),
 * )
 */
class InstaPaper extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]&title=[node:title]' : '';
  }

}
