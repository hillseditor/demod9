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
  
  public function content() {
 
    return [
      '#theme' => 'page--my-page',
      '#test_var' => $this->custom_page(),
      '#loremipsum' => $this->loremipsumbyurl(),
    ];
 
  }

  public function loremipsumbyurl(){
    
    // $xml = simplexml_load_file($url);
    // $url = 'https://loremipsum.io/generator/?n=2&t=p';
    $url = 'http://loripsum.net/api/2/long';
    $content = file_get_contents($url);
    // dump($content);
    $this->content = $content;
    return $this->content;
  }

  public function custom_page(){
    return $this->t('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
  }
}
