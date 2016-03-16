<?php

namespace Drupal\skeleton\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomFormBuilder extends FormBase
{

    /**
     * @return string
     */
    public function getFormId()
    {
        return 'skeleton_custom_form';
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     * @return array
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['first_name'] = array(
            '#type' => 'textfield',
            '#title' => t('First Name'),
            '#required' => TRUE,
        );

        $form['last_name'] = array(
            '#type' => 'textfield',
            '#title' => t('Last Name'),
        );

        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => t('Submit'),
        );

        return $form;
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        if(empty($form_state->getValues()['last_name'])){
            $form_state->setErrorByName('last_name','Last Name field cannot be empty.');
        }
    }

    /**
     * @param array $form
     * @param FormStateInterface $form_state
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // Display results for now if you want you can do the db related process here.
        foreach ($form_state->getValues() as $key => $value) {
            drupal_set_message($key . ': ' . $value);
        }
    }


}