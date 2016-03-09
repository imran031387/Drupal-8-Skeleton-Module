<?php
/**
 * @file
 * Contains \Drupal\example\Controller\SkeletonController.
 */

namespace Drupal\skeleton\Controller;

use Drupal\Core\Controller\ControllerBase;

class SkeletonController extends ControllerBase {

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

    public function tab2_contents() {
        $build = array(
            '#type' => 'markup',
            '#markup' => t('Tab 2 contents here...'),
        );
        return $build;
    }

}
?>