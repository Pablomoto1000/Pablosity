<?php

namespace Drupal\social_feed\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'socialfeedblock' block.
 *
 * @Block(
 *  id = "socialfeedblock",
 *  admin_label = @Translation("Socialfeedblock"),
 * )
 */
class socialfeedblock extends BlockBase {


  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $client = \Drupal::httpClient();


    // Instagram Settings
    $request = $client->get('http://dev-pablosity.pantheonsite.io/la/ruta/api/instagram');
    $response = $request->getBody();
    $jsonData= $response;
    $arrayData = json_decode($jsonData, true);
    // Instagram Arrays
    foreach ($arrayData as $data) {$instagramurl[] = $data['url'];}


    // Facebook Settings
    $request = $client->get('http://dev-pablosity.pantheonsite.io/la/ruta/api/facebook');
    $response = $request->getBody();
    $jsonData= $response;
    $arrayData = json_decode($jsonData, true);
    // Facebook Arrays
    foreach ($arrayData as $data) {$facebookurl[] = $data['url'];}
    foreach ($arrayData as $data) {$facebooktext[] = $data['text'];}
    foreach ($arrayData as $data) {$facebookimage[] = $data['image'];}


    // Twitter Settings
    $request = $client->get('http://dev-pablosity.pantheonsite.io/la/ruta/api/twitter');
    $response = $request->getBody();
    $jsonData= $response;
    $arrayData = json_decode($jsonData, true);
    // Twitter Arrays
    foreach ($arrayData as $data) {$twitteruser[] = $data['user'];}
    foreach ($arrayData as $data) {$twittertext[] = $data['text'];}


    $build = array(
      '#theme' => 'social_feed',
      '#instagramurl' => $instagramurl,
      '#facebookurl' => $facebookurl,
      '#facebooktext' => $facebooktext,
      '#facebookimage' => $facebookimage,
      '#twittertext' => $twittertext,
      '#twitteruser' => $twitteruser,
    );
    return $build;
  }

}
