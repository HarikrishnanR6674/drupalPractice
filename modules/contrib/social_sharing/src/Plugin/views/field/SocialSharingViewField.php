<?php

namespace Drupal\social_sharing\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Field handler to flag the node type.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("social_sharing_view_field")
 */
class SocialSharingViewField extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Leave empty to avoid a query on this field.
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $entity = $values->_entity;
    if ($entity->access('view') && $social_sharing_data = social_sharing_create_data()) {
      return [
        '#theme' => 'social_sharing_share_services',
        '#share_services' => $social_sharing_data,
      ];
    }
  }

}
