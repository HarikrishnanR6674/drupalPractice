<?php

namespace Drupal\social_sharing\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\social_sharing\Plugin\ShareServiceManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'social_sharing_default' formatter.
 *
 * @FieldFormatter(
 *   id = "social_sharing_default",
 *   label = @Translation("Default"),
 *   field_types = {
 *     "social_sharing"
 *   }
 * )
 */
class SocialShareDefaultFormatter extends FormatterBase {

  /**
   * Drupal\social_sharing\Plugin\ShareServiceManager definition.
   *
   * @var Drupal\social_sharing\Plugin\ShareServiceManager
   */
  protected $shareServiceManager;

  /**
   * Constructs a FormatterBase object.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label display setting.
   * @param string $view_mode
   *   The view mode.
   * @param array $third_party_settings
   *   Any third party settings.
   * @param \Drupal\social_sharing\Plugin\ShareServiceManager $share_service_manager
   *   The Share service plugin manager.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, ShareServiceManager $share_service_manager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->shareServiceManager = $share_service_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('plugin.manager.social_sharing.share_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $services = $this->getServicesWithValues($items);
    if (count($services) < 1) {
      return [];
    }

    $output = [
      '#theme' => 'social_sharing_share_services',
      '#share_services' => $services,
    ];

    return $output;
  }

  /**
   * Get the services that have values.
   *
   * @return array
   *   Return share services.
   */
  protected function getServicesWithValues(FieldItemListInterface $items) {
    $share_service_settings = $items->getSetting('share_services');

    $all_share_services_available = TRUE;
    foreach ($share_service_settings as $share_service) {
      if ($share_service['enabled']) {
        $all_share_services_available = FALSE;
        break;
      }
    }

    $share_services = [];

    foreach ($items as $item) {
      // Default list field handling.
      $services_values = $item->services_values;

      foreach ($services_values as $services_value_id => $services_value) {
        if ($all_share_services_available || (isset($share_service_settings[$services_value_id]['enabled']) && $share_service_settings[$services_value_id]['enabled'])) {
          $share_services[$services_value_id] = [
            'value' => $services_value['value'],
            'weight' => $share_service_settings[$services_value_id]['weight'],
          ];
        }
      }
    }

    return $this->shareServiceManager->getShareServicesWithValue($share_services);
  }

}
