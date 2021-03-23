<?php
namespace Drupal\custom_page\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
/**
 * Configure example settings for this site.
 */
class CustomPageAdminForm extends ConfigFormBase {
  const SETTINGS = 'custom_page.settings';
  /**
  * {@inheritdoc}
  */
  protected function getEditableConfigNames() {
    return [
        'custom_page.settings',
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function getFormId() {
    // Unique ID of the form.
    return 'custom_page_admin_form';
  }
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Create a $form API array.
    $config = $this->config(static::SETTINGS);
    $form['nopar'] = array(
      '#type' => 'number',
      '#title' => $this ->t('Number of paragraphs'),
      '#default_value' => $config->get('nopar'),
    );
    $form['cptitle'] = array(
      '#type' => 'textfield',
      '#title' => $this ->t('Custom Page title'),
      '#default_value' => $config->get('cptitle') ?? '',
    );
    $form['cptext'] = array(
      '#type' => 'textarea',
      '#title' => $this ->t('Custom Page Text Area'),
      '#default_value' => $config->get('cptext') ?? '',
    );
    $form['save'] = array(
      '#type' => 'submit',
      '#value' => $this
        ->t('Save'),
    );
    return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!is_numeric($form_state->getValue('nopar'))) {
      $form_state->setErrorByName('nopar', $this->t("The Numbers type '%nop' is invalid.", array('%nop' => $form_state->getValue('nopar'))));
    }
    if (!is_string ($form_state->getValue('cptitle'))) {
      $form_state->setErrorByName('cptitle', $this->t("The Numbers type '%cptitle' is invalid.", array('%cptitle' => $form_state->getValue('cptitle'))));
    }
    if (!is_string ($form_state->getValue('cptext'))) {
      $form_state->setErrorByName('cptext', $this->t("The Numbers type '%cptext' is invalid.", array('%cptext' => $form_state->getValue('cptext'))));
    }
  }
  public function submitForm(array &$form, FormStateInterface $form_state){
    // Save result in local module settings config
    $this->config('custom_page.settings')
    ->set('nopar', $form_state->getValue('nopar'))
    ->set('cptitle', filter_var ( $form_state->getValue('cptitle'), FILTER_SANITIZE_STRING))
    ->set('cptext', filter_var ( $form_state->getValue('cptext'), FILTER_SANITIZE_STRING))
    ->save();
  }
}