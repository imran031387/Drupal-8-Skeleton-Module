<?php
/**
 * @file
 * Contains \Drupal\skeleton\RdfUiBreadcrumbBuilder.
 */

namespace Drupal\skeleton\Breadcrumb;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Link;
use Drupal\system\PathBasedBreadcrumbBuilder;
use Drupal\Component\Utility\Unicode;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

class SkeletonBreadcrumbBuilder extends PathBasedBreadcrumbBuilder {

    /**
     * @param RouteMatchInterface $route_match
     * @return bool
     */
    public function applies(RouteMatchInterface $route_match) {
        $parameters = explode('.', $route_match->getRouteName());
        if ($parameters[2] === 'breadcrumb') {
            return true;
        }
    }

    /**
     * {@inheritdoc}
     */
    function build(RouteMatchInterface $route_match) {
        $request = \Drupal::request();
        $breadcrumbs = parent::build($route_match);
        $path = trim($this->context->getPathInfo(), '/');
        $path_elements = explode('/', $path);
        $route = $request->attributes->get(RouteObjectInterface::ROUTE_OBJECT);
        $title = $this->titleResolver->getTitle($request, $route);
        if(!$title){
            $title = str_replace(array('-', '_'), ' ', Unicode::ucfirst(end($path_elements)));
        }
        $breadcrumbs->addLink(Link::createFromRoute($title, '<none>'));
        return $breadcrumbs;
    }
}