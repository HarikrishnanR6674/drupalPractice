<?php

namespace Drupal\social_sharing\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Share service plugin manager.
 */
class ShareServiceManager extends DefaultPluginManager {

  /**
   * Constructs a new ShareServiceManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/ShareService', $namespaces, $module_handler, 'Drupal\social_sharing\Plugin\ShareServiceInterface', 'Drupal\social_sharing\Annotation\ShareService');

    $this->alterInfo('share_service_info');
    $this->setCacheBackend($cache_backend, 'share_service_plugins');
  }

  /**
   * Gets all share service plugins.
   *
   * @return array
   *   The share service plugins.
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginException
   */
  public function getShareServices() {
    $plugins = $this->getDefinitions();

    // Attach the instance object to the plugin definitions.
    foreach ($plugins as $plugin_id => $plugin) {
      $instance = $this->createInstance($plugin_id);

      if ($instance instanceof ShareServiceInterface) {
        $plugins[$plugin_id]['instance'] = $instance;
      }
    }

    return $plugins;
  }

  /**
   * Gets all share service plugins and sort it by weight.
   *
   * @param array $settings
   *   Field settings.
   *
   * @return array
   *   The share service plugins sorted by weight setting.
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginException
   */
  public function getShareServicesSortedByWeight(array $settings) {
    $share_services = $this->getShareServices();
    $default_weight = -count($share_services);
    foreach ($share_services as $share_service_id => $share_service) {
      $weight = isset($settings[$share_service_id]['weight']) ? $settings[$share_service_id]['weight'] : $default_weight++;
      $share_services[$share_service_id]['weight'] = $weight;
    }

    uasort($share_services, ['Drupal\Component\Utility\SortArray', 'sortByWeightElement']);
    return $share_services;
  }

  /**
   * Gets the list of share service plugins that was selected in field settings.
   *
   * Function returns the list of share service plugins that was selected in
   * field settings. By default, this list is sorted by weight of each plugin.
   *
   * @param array $settings
   *   Field settings.
   * @param bool $sort_by_weight
   *   Sort by weight.
   *
   * @return array
   *   The available share service plugins.
   *
   * @throws \Drupal\Component\Plugin\Exception\PluginException
   */
  public function getAvailableShareServices(array $settings, $sort_by_weight = TRUE) {
    $share_services = $sort_by_weight ? $this->getShareServicesSortedByWeight($settings) : $this->getShareServices();
    $available_share_services = [];

    // Get services with the activated "enabled" attribute.
    foreach ($share_services as $share_service_id => $share_service) {
      if (!empty($settings[$share_service_id]['enabled'])) {
        $available_share_services[$share_service_id] = $share_service;
      }
    }

    // If the array is empty no share service was selected which means, that all
    // share services are available.
    $available_share_services = empty($available_share_services) ? $share_services : $available_share_services;

    return $available_share_services;
  }

  /**
   * The the share service plugins that have values.
   *
   * @return array
   *   The share service plugins that have values.
   */
  public function getShareServicesWithValue(array $share_services, $sort = TRUE) {
    $usedShareServices = [];

    foreach ($this->getShareServices() as $share_service_id => $share_service) {
      if (!empty($share_services[$share_service_id]['value'])) {
        $share_service['instance']->setValue($share_services[$share_service_id]['value']);

        $usedShareServices[$share_service_id] = $share_service;
        $usedShareServices[$share_service_id]['weight'] = $share_services[$share_service_id]['weight'];
        $usedShareServices[$share_service_id]['url'] = $share_service['instance']->generateUrl($share_service['instance']->getUrl());
      }
      elseif (isset($share_services[$share_service_id]) && empty($share_services[$share_service_id]['value'])) {
        $usedShareServices[$share_service_id] = $share_service;
        $usedShareServices[$share_service_id]['weight'] = $share_services[$share_service_id]['weight'];
        $usedShareServices[$share_service_id]['url'] = $share_service['instance']->generateUrl($share_service['instance']->getDefaultShareUrl());
      }
    }

    if ($sort) {
      uasort($usedShareServices, ['Drupal\Component\Utility\SortArray', 'sortByWeightElement']);
    }

    return $usedShareServices;
  }

}
