<?php
/**
 * @file
 * Contains \Drupal\skeleton\Controller\SkeletonController.
 */

namespace Drupal\skeleton\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\skeleton\Services\CustomBuildServices;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class SkeletonController extends ControllerBase {

    /**
     * @var CustomBuildServices
     */
    private $serviceString;

    /**
     * @param CustomBuildServices $serviceString
     */
    public function __construct(CustomBuildServices $serviceString){

        $this->stringgenerator = $serviceString;
    }

    /**
     * {@inheritdoc}
     */
    public function default_contents() {
        $build = array(
            '#type' => 'markup',
            '#markup' => t('Hello World!'),
        );
        return $build;
    }

    /**
     * @return array
     */
    public function dynamic_route_contents() {
        $build = array(
            '#type' => 'markup',
            '#markup' => t('Dynamic route contents here...'),
        );
        return $build;
    }

    /**
     * @return array
     */
    public function sub_menu_contents() {
        $build = array(
            '#type' => 'markup',
            '#markup' => t('Sub menu contents here...'),
        );
        return $build;
    }

    /**
     * @return array
     */
    public function tab2_contents() {
        $build = array(
            '#type' => 'markup',
            '#markup' => t('Tab 2 contents here...'),
        );
        return $build;
    }

    /**
     * @return array
     */
    public function service_contents(){
        // This is the typical OOP code for create objects out of class.
        //$customBuildServices = new CustomBuildServices();
        //$stringGenarator = $customBuildServices->page_arguments();

        // Drupal 8 services way to obtain objects.
        $stringGenarator = $this->stringgenerator->service_example();
        return array(
            '#markup' => $stringGenarator,
        );
        // we can use response as well.
        //return new response($stringGenarator);

    }

    /**
     * @return array
     */
    public function breadcrumb_contents() {
        $build = array(
            '#type' => 'markup',
            '#markup' => t('Breadcrumb contents here...'),
        );
        return $build;
    }

    /**
     * @param ContainerInterface $container
     * @return static
     */
    public static function create(ContainerInterface $container)
    {
        // Getting service out of the container.
        $serviceString = $container->get('skeleton.stringgenerator');
        return new static($serviceString);
    }

    /**
     * @return array
     */
    public function event_subscriber_contents(){
        return array(
            '#markup' => 'Event subscriber contents...',
        );
    }


}
?>