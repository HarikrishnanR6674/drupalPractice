<?php

namespace Drupal\social_sharing;

/**
 * Defines an interface for Social sharing module.
 */
interface SocialSharingServiceInterface {

  /**
   * Get all available content entities in the environment.
   *
   * @return array
   *   Return available content entities
   */
  public function getContentEntities();

}
