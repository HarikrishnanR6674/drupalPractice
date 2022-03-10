<?php

namespace Drupal\social_sharing\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'social_sharing' field type.
 *
 * @FieldType(
 *   id = "social_sharing",
 *   label = @Translation("Social sharing"),
 *   description = @Translation("Handle links for social sharing."),
 *   category = @Translation("Social"),
 *   default_widget = "social_sharing_default",
 *   default_formatter = "social_sharing_default"
 * )
 */
class SocialShareItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'share_services' => [],
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['share_services'] = DataDefinition::create('any')
      ->setLabel(t('Share services'));

    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Value'));

    $properties['services_values'] = DataDefinition::create('any')
      ->setLabel(t('Services Values'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = [];

    // Create a table with a list of share services.
    $element['share_services'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Service'),
        $this->t('Description'),
        $this->t('Weight'),
      ],
      '#prefix' => '<h5>' . $this->t('Share services') . '</h5>',
      '#suffix' => '<div class="description">' . $this->t('The share services that are allowed to be used in this field. Select none to allow all services.') . '</div>',
      '#tabledrag' => [[
        'action' => 'order',
        'relationship' => 'sibling',
        'group' => 'service-order-weight',
      ],
      ],
    ];

    // Add an ability to check and reorder of share services.
    $share_service_settings = $this->getSetting('share_services');
    $share_services = \Drupal::service('plugin.manager.social_sharing.share_service')->getShareServicesSortedByWeight($share_service_settings);
    $delta = count($share_services);
    $weight = -$delta;
    foreach ($share_services as $share_service_id => $share_service) {
      $weight_default_value = isset($share_service_settings[$share_service_id]['weight']) ? $share_service_settings[$share_service_id]['weight'] : $weight++;
      $enabled_default_value = isset($share_service_settings[$share_service_id]['enabled']) ? $share_service_settings[$share_service_id]['enabled'] : FALSE;

      $element['share_services'][$share_service_id]['#attributes']['class'][] = 'draggable';
      $element['share_services'][$share_service_id]['#weight'] = $weight_default_value;
      $element['share_services'][$share_service_id]['enabled'] = [
        '#type' => 'checkbox',
        '#default_value' => $enabled_default_value,
        '#title' => $share_service['name']->render(),
        '#title_display' => 'after',
      ];

      $element['share_services'][$share_service_id]['description']['#markup'] = $share_service['description']->render();
      $element['share_services'][$share_service_id]['weight'] = [
        '#type' => 'weight',
        '#title' => $this->t('Weight for type @type', ['@type' => $share_service_id]),
        '#title_display' => 'invisible',
        '#default_value' => $weight_default_value,
        '#attributes' => [
          'class' => ['service-order-weight', 'service-order-weight-' . $share_service_id],
        ],
        '#delta' => $delta,
      ];
    }
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'share_services' => [
          'type' => 'blob',
          'not null' => TRUE,
          'serialize' => TRUE,
        ],
        'value' => [
          'type' => 'varchar',
          'default' => '',
          'length' => '128',
        ],
        'services_values' => [
          'type' => 'blob',
          'not null' => TRUE,
          'serialize' => TRUE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $share_services = $this->get('share_services')->getValue();
    $value = $this->get('value')->getValue();
    $services_values = $this->get('services_values')->getValue();

    if (!empty($services_values)) {
      return FALSE;
    }

    return $value === NULL || $value === '' || $share_services === NULL || $share_services === '';
  }

}
