<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Yahoo' share service.
 *
 * @ShareService(
 *   id = "yahoo",
 *   name = @Translation("Yahoo"),
 *   urlPrefix = "http://compose.mail.yahoo.com/?",
 *   description = @Translation("The default share URL if the field will empty: http://compose.mail.yahoo.com/?subject=[node:title]&body=Check out this site [node:url]"),
 * )
 */
class Yahoo extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'subject=[node:title]&body=Check out this site [node:url]' : '';
  }

}
