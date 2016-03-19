<?php

/**
 * @file
 * Contains \Drupal\field_ui\Plugin\Derivative\FieldUiLocalTask.
 */

namespace Drupal\skeleton\Plugin\Derivative;

use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Drupal\Core\Routing\RouteProviderInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides local task definitions for all entity bundles.
 */
class SkeletonDynamicLocalTask extends DeriverBase implements ContainerDeriverInterface {
    use StringTranslationTrait;

    /**
     * The route provider.
     *
     * @var \Drupal\Core\Routing\RouteProviderInterface
     */
    protected $routeProvider;

    /**
     * The entity manager
     *
     * @var \Drupal\Core\Entity\EntityManagerInterface
     */
    protected $entityManager;

    /**
     * Creates an FieldUiLocalTask object.
     *
     * @param \Drupal\Core\Routing\RouteProviderInterface $route_provider
     *   The route provider.
     * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
     *   The entity manager.
     * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
     *   The translation manager.
     */
    public function __construct(RouteProviderInterface $route_provider, EntityManagerInterface $entity_manager, TranslationInterface $string_translation) {
        $this->routeProvider = $route_provider;
        $this->entityManager = $entity_manager;
        $this->stringTranslation = $string_translation;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, $base_plugin_id) {
        return new static(
            $container->get('router.route_provider'),
            $container->get('entity.manager'),
            $container->get('string_translation')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDerivativeDefinitions($base_plugin_definition) {
        $this->derivatives = array();

        foreach ($this->entityManager->getDefinitions() as $entity_type_id => $entity_type) {
            if ($entity_type->get('field_ui_base_route')) {

            }
        }

        foreach ($this->derivatives as &$entry) {
            $entry += $base_plugin_definition;
        }

        return $this->derivatives;
    }

    /**
     * Alters the base_route definition for field_ui local tasks.
     *
     * @param array $local_tasks
     *   An array of local tasks plugin definitions, keyed by plugin ID.
     */
    public function alterLocalTasks(&$local_tasks) {
        foreach ($this->entityManager->getDefinitions() as $entity_type_id => $entity_type) {
            var_dump($entity_type);die('alter');
            if ($route_name = $entity_type->get('field_ui_base_route')) {
                $local_tasks["field_ui.fields:overview_$entity_type_id"]['base_route'] = $route_name;
                $local_tasks["field_ui.fields:form_display_overview_$entity_type_id"]['base_route'] = $route_name;
                $local_tasks["field_ui.fields:display_overview_$entity_type_id"]['base_route'] = $route_name;
                $local_tasks["field_ui.fields:field_form_display_default_$entity_type_id"]['base_route'] = $route_name;
                $local_tasks["field_ui.fields:field_display_default_$entity_type_id"]['base_route'] = $route_name;

                foreach ($this->entityManager->getFormModes($entity_type_id) as $form_mode => $form_mode_info) {
                    $local_tasks['field_ui.fields:field_form_display_' . $form_mode . '_' . $entity_type_id]['base_route'] = $route_name;
                }

                foreach ($this->entityManager->getViewModes($entity_type_id) as $view_mode => $form_mode_info) {
                    $local_tasks['field_ui.fields:field_display_' . $view_mode . '_' . $entity_type_id]['base_route'] = $route_name;
                }
            }
        }
    }
}
