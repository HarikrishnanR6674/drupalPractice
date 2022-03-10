<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'LiveJournal' share service.
 *
 * @ShareService(
 *   id = "livejournal",
 *   name = @Translation("LiveJournal"),
 *   urlPrefix = "http://www.livejournal.com/update.bml?",
 *   description = @Translation("The default share URL if the field will empty: http://www.livejournal.com/update.bml?subject=[node:title]&event=[node:url]"),
 * )
 */
class LiveJournal extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'subject=[node:title]&event=[node:url]' : '';
  }

}
