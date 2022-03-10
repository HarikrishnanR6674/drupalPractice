<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'linkedin' share service.
 *
 * @ShareService(
 *   id = "linkedin",
 *   name = @Translation("LinkedIn"),
 *   urlPrefix = "https://www.linkedin.com/shareArticle?",
 *   description = @Translation("The default share URL if the field will empty: https://www.linkedin.com/shareArticle?mini=true&url=[node:url]&title=[node:title]&source=[node:url]"),
 * )
 */
class Linkedin extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'mini=true&url=[node:url]&title=[node:title]&source=[node:url]' : '';
  }

}
