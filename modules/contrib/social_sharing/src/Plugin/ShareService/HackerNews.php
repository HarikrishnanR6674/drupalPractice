<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'HackerNews' share service.
 *
 * @ShareService(
 *   id = "hacker_news",
 *   name = @Translation("HackerNews"),
 *   urlPrefix = "https://news.ycombinator.com/submitlink?",
 *   description = @Translation("The default share URL if the field will empty: https://news.ycombinator.com/submitlink?u=[node:url]&t=[node:title]"),
 * )
 */
class HackerNews extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'u=[node:url]&t=[node:title]' : '';
  }

}
