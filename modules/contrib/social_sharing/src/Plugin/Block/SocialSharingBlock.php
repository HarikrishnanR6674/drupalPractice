<?php

namespace Drupal\social_sharing\Plugin\Block;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\social_sharing\Plugin\ShareServiceManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\RendererInterface;

/**
 * Provides the Social Sharing Block.
 *
 * @Block(
 *   id="social_sharing_block",
 *   admin_label = @Translation("Social Sharing"),
 * )
 */
class SocialSharingBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  protected $shareServiceManager;

  /**
   * {@inheritdoc}
   */
  protected $renderer;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ShareServiceManager $share_service_manager, RendererInterface $renderer) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->shareServiceManager = $share_service_manager;
    $this->renderer = $renderer;

  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('plugin.manager.social_sharing.share_service'),
      $container->get('renderer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    // Share services.
    $form['share_services'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Share service'),
        $this->t('Share service URL'),
        $this->t('Description'),
        $this->t('Weight'),
      ],
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'service-order-weight',
        ],
      ],
    ];

    // Keep a note of the highest weight.
    $max_weight = 10;
    $available_share_services = $this->shareServiceManager->getShareServicesSortedByWeight($config);

    foreach ($available_share_services as $share_service_id => $share_service) {
      $form['share_services'][$share_service_id]['#attributes']['class'][] = 'draggable';
      $form['share_services'][$share_service_id]['#weight'] = $share_service['weight'];
      if ($share_service['weight'] > $max_weight) {
        $max_weight = $share_service['weight'];
      }
      $enabled_default_value = isset($config[$share_service_id]['enabled']) ? $config[$share_service_id]['enabled'] : FALSE;
      $form['share_services'][$share_service_id]['enabled'] = [
        '#type' => 'checkbox',
        '#default_value' => $enabled_default_value,
        '#title' => $share_service['name']->render(),
        '#title_display' => 'after',
      ];

      $form['share_services'][$share_service_id]['value'] = [
        '#type' => 'textfield',
        '#title' => $share_service['name']->render(),
        '#title_display' => 'invisible',
        '#size' => 40,
        '#default_value' => isset($config['share_services'][$share_service_id]['value']) ? $config['share_services'][$share_service_id]['value'] : '',
        '#field_prefix' => $share_service['instance']->getUrlPrefix(),
        '#field_suffix' => $share_service['instance']->getUrlSuffix(),
        '#element_validate' => [[get_class($share_service['instance']), 'validateValue']],
      ];

      $form['share_services'][$share_service_id]['description']['#markup'] = $share_service['description']->render();
      $form['share_services'][$share_service_id]['weight'] = [
        '#type' => 'weight',
        '#title' => $this->t('Weight for @title', ['@title' => $share_service['name']->render()]),
        '#title_display' => 'invisible',
        '#default_value' => $share_service['weight'],
        '#attributes' => ['class' => ['share_service-order-weight']],
        '#delta' => $max_weight + count($available_share_services),
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('share_services', $form_state->getValue('share_services'));
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $enabled_share_services = array_filter($config['share_services'], function ($share_service) {
      return ($share_service['enabled'] == '1');
    });
    $share_services = $this->shareServiceManager->getShareServicesWithValue($enabled_share_services);

    if (count($share_services) < 1) {
      return [];
    }

    $output = [
      '#theme' => 'social_sharing_share_services',
      '#share_services' => $share_services,
    ];

    return [$output];
  }

}
