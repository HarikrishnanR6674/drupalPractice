<?php

namespace Drupal\social_sharing\Plugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;

/**
 * Base class for Share service plugins.
 */
abstract class ShareServiceBase extends PluginBase implements ShareServiceInterface {

  /**
   * The value of the service.
   *
   * @var string
   */
  protected $value;

  /**
   * The description of the service.
   *
   * @var string
   */
  protected $description;

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    $node = \Drupal::routeMatch()->getParameter('node');

    return Html::escape(\Drupal::service('token')->replace($this->value, ['node' => $node], ['clear' => TRUE]));
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value) {
    $this->value = $value;
  }

  /**
   * {@inheritdoc}
   */
  public function getId() {
    return $this->pluginDefinition['id'];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->pluginDefinition['name'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldDescription() {
    return isset($this->pluginDefinition['fieldDescription']) ? $this->pluginDefinition['fieldDescription'] : '';
  }

  /**
   * {@inheritdoc}
   */
  public function getUrlPrefix() {
    return isset($this->pluginDefinition['urlPrefix']) ? $this->pluginDefinition['urlPrefix'] : '';
  }

  /**
   * {@inheritdoc}
   */
  public function getUrlSuffix() {
    return isset($this->pluginDefinition['urlSuffix']) ? $this->pluginDefinition['urlSuffix'] : '';
  }

  /**
   * {@inheritdoc}
   */
  public function getUrl() {
    return Url::fromUri($this->getUrlPrefix() . $this->getValue() . $this->getUrlSuffix());
  }

  /**
   * {@inheritdoc}
   */
  public function generateUrl(Url $url) {
    return $url->toString();
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return Html::escape($this->description);
  }

  /**
   * {@inheritdoc}
   */
  public static function validateValue(array &$element, FormStateInterface $form_state, array $form) {
    // Do not allow a URL when the plugin already provides a URL prefix.
    if (!empty($element['#value']) && !empty($element['#field_prefix'])) {
      if (UrlHelper::isExternal($element['#value'])) {
        $form_state->setError($element, t("The entered value %value is a URL. You should enter only the relative part, the URL prefix is automatically prepended.", ['%value' => $element['#value']]));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultShareUrl($source_uri = '') {
    $share_uri = $this->getUrlPrefixWithDefaultTokens();
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof NodeInterface) {
      $share_uri = \Drupal::service('token')->replace($share_uri, ['node' => $node], ['clear' => TRUE]);
    }

    return Url::fromUri($share_uri);
  }

}
