<?php
/**
 * @file
 * Contains \Drupal\skeleton\Controller\SkeletonController.
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

    public function sub_menu_contents() {
        $build = array(
            '#type' => 'markup',
            '#markup' => t('Sub menu contents here...'),
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