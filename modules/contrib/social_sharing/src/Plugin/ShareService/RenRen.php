<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'RenRen' share service.
 *
 * @ShareService(
 *   id = "renren",
 *   name = @Translation("RenRen"),
 *   urlPrefix = "http://widget.renren.com/dialog/share?",
 *   description = @Translation("The default share URL if the field will empty: http://widget.renren.com/dialog/share?resourceUrl=[node:url]&srcUrl=[node:url]&title=[node:title]"),
 * )
 */
class RenRen extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'resourceUrl=[node:url]&srcUrl=[node:url]&title=[node:title]' : '';
  }

}
