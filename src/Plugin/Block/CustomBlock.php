<?php

/**
 * @file
 * Contains \Drupal\skeleton\Plugin\Block\CustomBlock.
 */

namespace Drupal\skeleton\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'CustomBlock' block.
 *
 * @Block(
 *  id = "custom_block",
 *  admin_label = @Translation("Custom block"),
 * )
 */
class CustomBlock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function build() {
    return array('#markup'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry
                             \'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                             to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                              remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                              Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'
    );
  }

}
