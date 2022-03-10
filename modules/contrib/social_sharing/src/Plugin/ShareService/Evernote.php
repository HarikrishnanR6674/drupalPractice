<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Evernote' share service.
 *
 * @ShareService(
 *   id = "evernote",
 *   name = @Translation("Evernote"),
 *   urlPrefix = "https://www.evernote.com/clip.action?",
 *   description = @Translation("The default share URL if the field will empty: https://www.evernote.com/clip.action?title=[node:title]&url=[node:url]"),
 * )
 */
class Evernote extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'title=[node:title]&url=[node:url]' : '';
  }

}
