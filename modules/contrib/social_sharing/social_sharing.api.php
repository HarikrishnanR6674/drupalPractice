<?php

/**
 * @file
 * Hooks specific to the social_sharing module.
 */

/**
 * Alter the entity types that the social sharing pseudo-field is available for.
 *
 * @param array $types
 *   The entity types.
 */
function hook_social_sharing_entity_types_alter(array &$types) {
  // Add the "custom_entity_type" entity type.
  $types[] = 'custom_entity_type';
}
