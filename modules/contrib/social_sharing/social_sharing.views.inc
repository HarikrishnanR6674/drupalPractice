<?php

/**
 * @file
 * Views integration for social_sharing.
 */

/**
 * Implements hook_views_data_alter().
 */
function social_sharing_views_data_alter(array &$data) {
  // Add the social_sharing links to the node fields.
  $data['node']['social_sharing'] = [
    'title' => t('Social sharing buttons'),
    'field' => [
      'title' => t('Social sharing buttons'),
      'help' => t('Provide buttons for sharing the content.'),
      'id' => 'social_sharing_view_field',
    ],
  ];
}
