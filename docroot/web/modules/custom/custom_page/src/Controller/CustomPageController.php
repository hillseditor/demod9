<?php
namespace Drupal\custom_page\Controller;
use Drupal\Core\Controller\ControllerBase;



/**
 * Class CustomPageController.
 */
class CustomPageController extends ControllerBase{
  // public function customPage(){
  //   return [
  //     // '#markup' => $this->custom_page()
  //   ];
  // }
  
  public function content() {
    $config = \Drupal::config('custom_page.settings');
    // dump($config->get('nopar'));
 
    return [
      '#theme' => 'page--my-page',
      // '#test_var' => $this->custom_page(),
      '#loremipsum' => $this->loremipsumbyurl(),
      '#cptext' => $this->cptext(),
    ];
 
  }

  public function loremipsumbyurl(){
    //create array of data to be posted
    $query['n'] = 5;
    $query['t'] = 'p';

    //traverse array and prepare data for posting (key1=value1)
    foreach ( $query as $key => $value) {
      $query_items[] = $key . '=' . $value;
    }
    //create the final string to be posted using implode()
    $post_string = implode ('&', $query_items);

    // $xml = simplexml_load_file($url);
    $url = 'https://loremipsum.io/generator/'; //First Option URL
    
    //------------------------------------------------
    
    // //create cURL connection
    // $curl_connection = curl_init($url);
    // curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    // curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
    // curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
    // curl_setopt($curl_connection,CURLOPT_ENCODING , "");

    // //set data to be posted
    // curl_setopt($curl_connection, CURLOPT_HTTPGET, $post_string);
    // $result = curl_exec($curl_connection);
    // //close the connection
    // curl_close($curl_connection);

    // dump($result);

    //------------------------------------------------
    $config = \Drupal::config('custom_page.settings');
    if(null !== $config->get('nopar') && is_numeric($config->get('nopar'))){
      $no = $config->get('nopar');
      // dump('Yeah set');
      // dump($no);
    }else{$no = 2;}
    
    $url = 'http://loripsum.net/api/'. $no . '/long';
    $urlfinal = $url;
    // dump($urlfinal);
    //----------------------------------------------
    // $content = file_get_contents($url);
    // dump($content);
    $query_fields = [
      'n' => 5,
      't' => 'p',
    ]; //First option URL arguments

    // $urlfinal = sprintf("%s?%s", $url, http_build_query($query_fields)); // First option URL
    // // dump(http_build_query($query_fields));
    
    // dump($urlfinal);
    // // dump($this->curl_download($urlfinal));
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlfinal);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch,CURLOPT_ENCODING , "");
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $output = curl_exec($ch);
    curl_close($ch);

    // dump($output);

    //-----------------------------------------------
    //First option URL
    // $dom = new \DOMDocument;
    // $dom->loadHTML($output);
    // $xml = $dom->saveXml($dom);
    // $xml2 = new \SimpleXMLElement($dom->saveXml($dom));
    // foreach ($xml2->xpath('body/main/section/div') as $xpv) {
    //   if($xpv->xpath('div')){
    //     foreach ($xpv as $xpvv){
    //       if($xpvv->xpath('div')){
    //         foreach ($xpvv as $xpvvv){
    //           if($xpvvv->__toString() != ''){
    //             dump($xpvvv->__toString());
    //           }
    //         }
    //       }
    //     }
    //   }
    // }
    //-----------------------------------------------------

    //Second option URL to XML
    $dom = new \DOMDocument;
    $dom->loadHTML($output);
    $xml = $dom->saveXml($dom);

    $xml2 = new \SimpleXMLElement($dom->saveXml($dom));
    foreach ($xml2->xpath('body/p') as $xpv) {
      $this->content[] = $xpv->__toString();
    }
    return $this->content;
  }
  public function cptext(){
    $config = \Drupal::config('custom_page.settings');
    // dump($config->get('cptext'));
    if(!empty($config->get('cptext'))){
      return $config->get('cptext');
    }else{return '';}
  }
}
