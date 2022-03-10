<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides 'OkRu' share service.
 *
 * @ShareService(
 *   id = "ok_ru",
 *   name = @Translation("OK.ru"),
 *   urlPrefix = "https://connect.ok.ru/dk?",
 *   description = @Translation("The default share URL if the field will empty: https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=[node:url]"),
 * )
 */
class OkRu extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'st.cmd=WidgetSharePreview&st.shareUrl=[node:url]' : '';
  }

}
