<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Douban' share service.
 *
 * @ShareService(
 *   id = "douban",
 *   name = @Translation("Douban"),
 *   urlPrefix = "http://www.douban.com/recommend/?",
 *   description = @Translation("The default share URL if the field will empty: http://www.douban.com/recommend/?title=[node:title]&url=[node:url]"),
 * )
 */
class Douban extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'title=[node:title]&url=[node:url]' : '';
  }

}
