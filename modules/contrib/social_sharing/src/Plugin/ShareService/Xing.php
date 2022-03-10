<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'Xing' share service.
 *
 * @ShareService(
 *   id = "xing",
 *   name = @Translation("Xing"),
 *   urlPrefix = "https://www.xing.com/spi/shares/new?",
 *   description = @Translation("The default share URL if the field will empty: https://www.xing.com/spi/shares/new?url=[node:url]"),
 * )
 */
class Xing extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]' : '';
  }

}
