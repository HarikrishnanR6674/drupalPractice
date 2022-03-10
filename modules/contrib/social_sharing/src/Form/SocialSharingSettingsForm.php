<?php

namespace Drupal\social_sharing\Form;

use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Extension\ModuleHandler;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\social_sharing\Plugin\ShareServiceManager;
use Drupal\social_sharing\SocialSharingService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Link;

/**
 * Configure Social sharing settings.
 */
class SocialSharingSettingsForm extends ConfigFormBase {

  /**
   * Drupal\Core\Extension\ModuleHandler definition.
   *
   * @var \Drupal\Core\Extension\ModuleHandler
   */
  protected $moduleHandler;

  /**
   * Drupal\social_sharing\SocialSharingService definition.
   *
   * @var \Drupal\social_sharing\SocialSharingService
   */
  protected $socialSharing;

  /**
   * Drupal\social_sharing\Plugin\ShareServiceManager definition.
   *
   * @var \Drupal\social_sharing\Plugin\ShareServiceManager
   */
  protected $shareServiceManager;

  /**
   * The entity type bundle info.
   *
   * @var \Drupal\Core\Entity\EntityTypeBundleInfoInterface
   */
  protected $entityTypeBundleInfo;

  /**
   * Constructs a SocialSharingSettingsForm object.
   *
   * @param \Drupal\Core\Extension\ModuleHandler $module_handler
   *   The factory for configuration objects.
   * @param \Drupal\social_sharing\SocialSharingService $social_sharing
   *   The Social sharing service.
   * @param \Drupal\social_sharing\Plugin\ShareServiceManager $share_service_manager
   *   The Share service plugin manager.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface $entity_type_bundle_info
   *   The entity type bundle info.
   */
  public function __construct(ModuleHandler $module_handler, SocialSharingService $social_sharing, ShareServiceManager $share_service_manager, EntityTypeBundleInfoInterface $entity_type_bundle_info) {
    $this->moduleHandler = $module_handler;
    $this->socialSharing = $social_sharing;
    $this->shareServiceManager = $share_service_manager;
    $this->entityTypeBundleInfo = $entity_type_bundle_info;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('module_handler'),
      $container->get('social_sharing.social_sharing_service'),
      $container->get('plugin.manager.social_sharing.share_service'),
      $container->get('entity_type.bundle.info')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'social_sharing_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'social_sharing.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $social_sharing_settings = $this->config('social_sharing.settings');

    $form['social_sharing_available_services'] = [
      '#type'         => 'details',
      '#title'        => $this->t('Share Services'),
    ];

    // Create a table with a list of share services.
    $form['social_sharing_available_services']['share_services'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Service'),
        $this->t('Value'),
        $this->t('Weight'),
      ],
      '#prefix' => '<h5>' . $this->t('Share services') . '</h5>',
      '#suffix' => '<div class="description">' . $this->t('The share services that are allowed to be used in the extra field.') . '</div>',
      '#tabledrag' => [[
        'action' => 'order',
        'relationship' => 'sibling',
        'group' => 'service-order-weight',
      ],
      ],
    ];

    // Add an ability to check and reorder of share services.
    $available_share_services = $social_sharing_settings->get('share_services');
    $share_services = $this->shareServiceManager->getShareServicesSortedByWeight($social_sharing_settings->get('share_services'));
    $delta = count($share_services);
    $weight = -$delta;
    foreach ($share_services as $share_service_id => $share_service) {
      $weight_default_value = isset($available_share_services[$share_service_id]['weight']) ? $available_share_services[$share_service_id]['weight'] : $weight++;
      $enabled_default_value = isset($available_share_services[$share_service_id]['enabled']) ? $available_share_services[$share_service_id]['enabled'] : FALSE;

      $form['social_sharing_available_services']['share_services'][$share_service_id]['#attributes']['class'][] = 'draggable';
      $form['social_sharing_available_services']['share_services'][$share_service_id]['#weight'] = $weight_default_value;
      $form['social_sharing_available_services']['share_services'][$share_service_id]['enabled'] = [
        '#type' => 'checkbox',
        '#default_value' => $enabled_default_value,
        '#title' => $share_service['name']->render(),
        '#title_display' => 'after',
      ];

      $form['social_sharing_available_services']['share_services'][$share_service_id]['value'] = [
        '#type' => 'textfield',
        '#size' => 40,
        '#default_value' => isset($available_share_services[$share_service_id]['value']) ? $available_share_services[$share_service_id]['value'] : '',
        '#field_prefix' => $share_service['instance']->getUrlPrefix(),
        '#field_suffix' => $share_service['instance']->getUrlSuffix(),
        '#element_validate' => [[get_class($share_service['instance']), 'validateValue']],
        '#description' => $share_service['description']->render(),
      ];

      $form['social_sharing_available_services']['share_services'][$share_service_id]['weight'] = [
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

    $form['social_sharing_available_entities'] = [
      '#type'         => 'details',
      '#title'        => $this->t('Entities'),
    ];

    $entities = $this->socialSharing->getContentEntities();

    // Allow modules to alter the entity types.
    $this->moduleHandler->alter('social_sharing_entity_types', $entities);

    // Whitelist the entity IDs that let us link
    // to each bundle's Manage Display page.
    $linkableEntities = [
      'block_content', 'comment', 'commerce_product', 'commerce_store',
      'contact_message', 'media', 'node', 'paragraph', 'taxonomy_term', 'user',
    ];

    foreach ($entities as $entity) {
      $entityId = $entity->id();
      $entityType = $entity->getBundleEntityType();
      // Get all available bundles for the current entity.
      $bundles = $this->entityTypeBundleInfo->getBundleInfo($entityId);
      $links = [];

      foreach ($bundles as $machine_name => $bundle) {
        $label = $bundle['label'];

        // Some labels are TranslatableMarkup objects (such as the File entity).
        if ($label instanceof TranslatableMarkup) {
          $label = $label->render();
        }

        // Check if Field UI module enabled.
        if ($this->moduleHandler->moduleExists('field_ui')) {
          // Link to the bundle's Manage Display page
          // if the entity ID supports the route pattern.
          if (in_array($entityId, $linkableEntities) && $entityType) {
            $links[] = Link::createFromRoute($label, "entity.entity_view_display.{$entityId}.default", [
              $entityType => $machine_name,
            ])->toString();
          }
        }
      }

      $form['social_sharing_available_entities'][$entityId] = [
        '#type' => 'checkbox',
        '#title' => $this->t('@entity', ['@entity' => $entity->getLabel()]),
        '#default_value' => $social_sharing_settings->get("entities.{$entityId}"),
        '#description' => empty($links) ? '' : '( ' . implode(' | ', $links) . ' )',
      ];
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    foreach ($this->socialSharing->getContentEntities() as $entity) {
      $entityId = $entity->id();
      $this->config('social_sharing.settings')->set("entities.{$entityId}", $values[$entityId]);
    }
    $this->config('social_sharing.settings')->set('share_services', $values['share_services']);
    $this->config('social_sharing.settings')->save();

    parent::submitForm($form, $form_state);
  }

}
