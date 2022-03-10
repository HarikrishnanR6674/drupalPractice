<?php

namespace Drupal\social_sharing\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\social_sharing\Plugin\ShareServiceManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'social_sharing_default' widget.
 *
 * @FieldWidget(
 *   id = "social_sharing_default",
 *   module = "social_sharing",
 *   label = @Translation("List with all available social services"),
 *   field_types = {
 *     "social_sharing"
 *   }
 * )
 */
class SocialShareDefaultWidget extends WidgetBase {

  /**
   * Drupal\social_sharing\Plugin\ShareServiceManager definition.
   *
   * @var Drupal\social_sharing\Plugin\ShareServiceManager
   */
  protected $shareServiceManager;

  /**
   * Constructs a SocialSharingSettingsForm object.
   *
   * @param string $plugin_id
   *   The plugin_id for the widget.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the widget is associated.
   * @param array $settings
   *   The widget settings.
   * @param array $third_party_settings
   *   Any third party settings.
   * @param \Drupal\social_sharing\Plugin\ShareServiceManager $share_service_manager
   *   The Share service plugin manager.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings, ShareServiceManager $share_service_manager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);
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
      $configuration['third_party_settings'],
      $container->get('plugin.manager.social_sharing.share_service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $item = $items[$delta];
    $value = $item->getEntity()->isNew() ? [] : $item->toArray();

    $element += [
      '#type' => 'details',
      '#collapsible' => TRUE,
      '#open' => TRUE,
    ];

    $share_service_settings = $this->fieldDefinition->getSetting('share_services');
    $available_share_services = $this->shareServiceManager->getAvailableShareServices($share_service_settings);
    foreach ($available_share_services as $share_service_id => $share_service) {

      $element['services_values'][$share_service_id]['value'] = [
        '#type' => 'textfield',
        '#title' => $share_service['name']->render(),
        '#size' => 40,
        '#default_value' => isset($value['services_values'][$share_service_id]['value']) ? $value['services_values'][$share_service_id]['value'] : '',
        '#field_prefix' => $share_service['instance']->getUrlPrefix(),
        '#field_suffix' => $share_service['instance']->getUrlSuffix(),
        '#element_validate' => [[get_class($share_service['instance']), 'validateValue']],
      ];
      if (!empty($share_service['description'])) {
        $element['services_values'][$share_service_id]['value']['#description'] = $share_service['description']->render();
      }
    }

    return $element;
  }

}
