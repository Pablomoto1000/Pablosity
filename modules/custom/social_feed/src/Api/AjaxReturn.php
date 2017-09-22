<?php

namespace Drupal\social_feed\Api;

/**
 * Instagram API service.
 */
class AjaxReturn {

  /**
   * Instagram API.
   */
  public static function return() {

    $client = \Drupal::httpClient();
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // Instagram Settings.
    $request = $client->get($actual_link . '/instagram');
    $response = $request->getBody();
    $jsonData = $response;
    $arrayData = json_decode($jsonData, TRUE);

    // Instagram Arrays.
    foreach ($arrayData as $data) {
      $instagramurl[] = $data['url'];
    }
    foreach ($arrayData as $data) {
      $instagramurlpost[] = $data['urlpost'];
    }

    // Facebook Settings.
    $request = $client->get($actual_link . '/facebook');
    $response = $request->getBody();
    $jsonData = $response;
    $arrayData = json_decode($jsonData, TRUE);
    // Facebook Arrays.
    foreach ($arrayData as $data) {
      $facebookurl[] = $data['url'];
    }
    foreach ($arrayData as $data) {
      $facebooktext[] = $data['text'];
    }
    foreach ($arrayData as $data) {
      $facebookimage[] = $data['image'];
    }

    // Twitter Settings.
    $request = $client->get($actual_link . '/twitter');
    $response = $request->getBody();
    $jsonData = $response;
    $arrayData = json_decode($jsonData, TRUE);
    // Twitter Arrays.
    foreach ($arrayData as $data) {
      $twitteruser[] = $data['user'];
    }
    foreach ($arrayData as $data) {
      $twittertext[] = $data['text'];
    }
    foreach ($arrayData as $data) {
      $twitterurl[] = $data['urltweet'];
    }

    $api = [
      '#theme' => 'social_feed',
      '#instagramurl' => $instagramurl,
      '#instagramurlpost' => $instagramurlpost,
      '#facebookurl' => $facebookurl,
      '#facebooktext' => $facebooktext,
      '#facebookimage' => $facebookimage,
      '#twittertext' => $twittertext,
      '#twitteruser' => $twitteruser,
      '#twitterurl' => $twitterurl,
    ];
    $apiRendered = \Drupal::service('renderer')->renderRoot($api);
    return $apiRendered;
  }

}
