<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Gmail' share service.
 *
 * @ShareService(
 *   id = "gmail",
 *   name = @Translation("Gmail"),
 *   urlPrefix = "https://mail.google.com/mail/?",
 *   description = @Translation("The default share URL if the field will empty: https://mail.google.com/mail/?view=cm&&su=[node:title]&body=Check out this site [node:url]"),
 * )
 */
class Gmail extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'view=cm&&su=[node:title]&body=Check out this site [node:url]' : '';
  }

}
