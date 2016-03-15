<?php

/**
 * @file
 * Contains \Drupal\skeleton\Plugin\Block\CustomBlock.
 * https://docs.acquia.com/articles/drupal-8-dependency-injection-and-plugins
 * we need to implement ContainerFactoryPluginInterface interface for getting the services
 * to CustomBlock class.
 */

namespace Drupal\skeleton\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'CustomBlock' block.
 *
 * @Block(
 *  id = "custom_block",
 *  admin_label = @Translation("Custom block"),
 * )
 */
class CustomBlock extends BlockBase implements ContainerFactoryPluginInterface{
    /**
     * @var array|AccountProxyInterface
     */
    private $serviceUser;


    /**
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     * @param AccountProxyInterface $serviceUser
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxyInterface $serviceUser){
        // Call parent construct method.
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->serviceUser = $serviceUser;
    }
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
      $data  = 'This data is retrived from a service </br>';
      $data .= 'logged in user Name:'.$this->serviceUser->getAccountName().'</br>';
      $data .= 'logged in user ID:'.$this->serviceUser->id();
    return array('#markup'=>$data);
  }

    /**
     * @param ContainerInterface $container
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     * @return static
     */
    public static function create(ContainerInterface $container,array $configuration, $plugin_id, $plugin_definition){
        // Getting service out of the container.
        $serviceUser = $container->get('current_user');
        return new static($configuration,$plugin_id,$plugin_definition,$serviceUser);

    }

}
