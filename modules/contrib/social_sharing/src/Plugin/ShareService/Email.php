<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'email' share service.
 *
 * @ShareService(
 *   id = "email",
 *   name = @Translation("Mail"),
 *   urlPrefix = "mailto:",
 *   description = @Translation("The default share URL if the field will empty: mailto:?subject=[node:title]&body=Check out this site [node:url]"),
 * )
 */
class Email extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'subject=[node:title]&body=Check out this site [node:url]' : '';
  }

}
