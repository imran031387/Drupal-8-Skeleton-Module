<?php
/**
 * @file
 * Contains \Drupal\example\Routing\ExampleRoutes.
 */

namespace Drupal\skeleton\Routing;
use Drupal\Core\Entity\EntityManagerInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;

/**
 * Defines dynamic routes.
 */
class DynamicRouteSubscriber extends RouteSubscriberBase {

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @param EntityManagerInterface $manager
     */
    function __construct(EntityManagerInterface $manager)
    {

        $this->manager = $manager;
    }


    /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {

    $route = new Route(
    // Path to attach this route to:
        '/skeleton-dynamic-menu',
        // Route defaults:
        array(
            '_controller' => '\Drupal\skeleton\Controller\SkeletonController::dynamic_route_contents',
            '_title' => 'Hello'
        ),
        // Route requirements:
        array(
            '_permission'  => 'access content',
        )
    );
    // Add the route under the name 'dynamic.route.content'(this is the dynamic routing name).
      $collection->add('dynamic.route.content', $route);
    return $collection;
  }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        $events = parent::getSubscribedEvents();
        $events[RoutingEvents::ALTER] = array('onAlterRoutes', -100);
        return $events;
    }
}
?>