<?php
/**
 * @file
 * Contains \Drupal\skeleton\Plugin\Derivative\DynamicLocalTasks.
 */

namespace Drupal\skeleton\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

/**
 * Defines dynamic local tasks.
 */
class DynamicLocalTasks extends DeriverBase {

    /**
     * {@inheritdoc}
     */
    public function getDerivativeDefinitions($base_plugin_definition) {
        // Implement dynamic logic to provide values for the same keys as in example.links.task.yml.
        $this->derivatives['example.task_id'] = $base_plugin_definition;
        $this->derivatives['example.task_id']['title'] = "I'm a tab";
        $this->derivatives['example.task_id']['route_name'] = 'skeleton.content.tab2';
        return $this->derivatives;
    }

}
?>