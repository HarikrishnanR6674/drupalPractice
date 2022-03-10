<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Weibo' share service.
 *
 * @ShareService(
 *   id = "weibo",
 *   name = @Translation("Weibo"),
 *   urlPrefix = "http://service.weibo.com/share/share.php?",
 *   description = @Translation("The default share URL if the field will empty: http://service.weibo.com/share/share.php?url=[node:url]&title=[node:title]"),
 * )
 */
class Weibo extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]&title=[node:title]' : '';
  }

}
