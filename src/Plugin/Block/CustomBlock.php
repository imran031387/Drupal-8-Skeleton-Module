<?php

/**
 * @file
 * Contains \Drupal\skeleton\Plugin\Block\CustomBlock.
 */

namespace Drupal\skeleton\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

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
     * @param array $form
     * @param FormStateInterface $form_state
     * @return array
     */
    public function blockForm($form, FormStateInterface $form_state)
    {
        // getting the saved configuration data through blockSubmit().
        $block_data = $this->getConfiguration();
        // Add a form field to the existing block configuration form.
        $form['first_name'] = array(
            '#type' => 'textfield',
            '#title' => t('First Name'),
            '#default_value' => $block_data['first_name'],
        );

        $form['last_name'] = array(
            '#type' => 'textfield',
            '#title' => t('Last Name'),
            '#default_value' => $block_data['last_name'],
        );
        return $form;
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function blockValidate($form, FormStateInterface $form_state)
    {
        if(!$form_state->getValue('first_name')){
            // Not showing the error message on drupal because of the bug
            // https://www.drupal.org/node/2537732
            $form_state->setErrorByName('first_name', $this->t('This Field cannot be empty.'));
            // for now setting up the error message manually :-)
            drupal_set_message(t('First name field cannot be empty..'), 'error');
        }
    }


    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function blockSubmit($form, FormStateInterface $form_state)
    {
        $this->setConfigurationValue('first_name', $form_state->getValue('first_name'));
        $this->setConfigurationValue('last_name', $form_state->getValue('last_name'));
    }


    /**
   * {@inheritdoc}
   */
  public function build() {
      $config = $this->getConfiguration();
      var_dump($config);
    return array('#markup'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry
                             \'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                             to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                              remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem
                              Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'
    );
  }

}
