<?php

namespace Drupal\social_sharing\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Share service item annotation object.
 *
 * @see \Drupal\social_sharing\Plugin\ShareServiceManager
 * @see plugin_api
 *
 * @Annotation
 */
class ShareService extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The name of the share service.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $name;

  /**
   * The name of the share service.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

  /**
   * The url of the share service.
   *
   * @var string
   */
  public $url;

  /**
   * The description for the share services value field.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $fieldDescription;

  /**
   * The url prefix of the share service.
   *
   * @var string
   */
  public $urlPrefix;

  /**
   * The url suffix of the share service.
   *
   * @var string
   */
  public $urlSuffix;

}
