<?php

namespace Drupal\social_sharing\Plugin\ShareService;

use Drupal\social_sharing\Plugin\ShareServiceBase;

/**
 * Provides '' share service.
 *
 * @ShareService(
 *   id = "qzone",
 *   name = @Translation("QZone"),
 *   urlPrefix = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?",
 *   description = @Translation("The default share URL if the field will empty: http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=[node:url]"),
 * )
 */
class QZone extends ShareServiceBase {

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefixWithDefaultTokens() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] . 'url=[node:url]' : '';
  }

}
