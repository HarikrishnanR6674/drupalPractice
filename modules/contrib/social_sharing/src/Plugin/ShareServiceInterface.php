<?php

namespace Drupal\social_sharing\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Defines an interface for Share service plugins.
 */
interface ShareServiceInterface extends PluginInspectionInterface {

  /**
   * Gets the id of the share service.
   *
   * Method returns the share service id from the plugin definition.
   *
   * @return string
   *   The id string.
   */
  public function getId();

  /**
   * Gets the name of the share service.
   *
   * Method returns the share service name from the plugin definition.
   *
   * @return string
   *   The name string.
   */
  public function getName();

  /**
   * Gets the description of the share service.
   *
   * Method returns the share service description from the plugin definition.
   *
   * @return string
   *   The description string.
   */
  public function getDescription();

  /**
   * Gets the url for the share service.
   *
   * Method returns the share service url from the plugin definition.
   *
   * @return \Drupal\Core\Url
   *   The full url object.
   */
  public function getUrl();

  /**
   * Gets the share url for the share service.
   *
   * Method returns the share url which can contain the share service default
   * parameters. Source uri string can be passed optionally.
   *
   * @param string $source_uri
   *   Source uri string.
   *
   * @return \Drupal\Core\Url
   *   The full url object.
   */
  public function getDefaultShareUrl($source_uri = '');

  /**
   * Get share url with default tokens for the share service.
   *
   * @return string
   *   Return string URL with default tokens.
   */
  public function getUrlPrefixWithDefaultTokens();

  /**
   * Get the value for the platform.
   *
   * @return string
   *   The value.
   */
  public function getValue();

  /**
   * Set the value for the platform.
   *
   * @param string $value
   *   The value.
   */
  public function setValue($value);

  /**
   * Returns the description for the value field.
   *
   * @return string
   *   The description of the value field.
   */
  public function getFieldDescription();

  /**
   * Return the url prefix of the platform.
   *
   * @return string
   *   The url prefix.
   */
  public function getUrlPrefix();

  /**
   * Return the url suffix of the platform.
   *
   * @return string
   *   The url suffix.
   */
  public function getUrlSuffix();

  /**
   * Generates the final url for the output.
   *
   * @param \Drupal\Core\Url $url
   *   A Url object with the full plattform url.
   *
   * @return string
   *   The url to the platform (with the user value).
   */
  public function generateUrl(Url $url);

  /**
   * Validates the user input of a platform before the value is saved.
   *
   * @return mixed
   *   The result of the validation.
   */
  public static function validateValue(array &$element, FormStateInterface $form_state, array $form);

}
