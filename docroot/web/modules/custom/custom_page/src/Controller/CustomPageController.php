<?php
namespace Drupal\custom_page\Controller;
use Drupal\Core\Controller\ControllerBase;
/**
 * Class CustomPageController.
 */
class CustomPageController extends ControllerBase{
  public function customPage(){
    return ['#markup' => $this->custom_page()];
  }
  public function custom_page(){
    return t('TEEEEET');
  }
}
