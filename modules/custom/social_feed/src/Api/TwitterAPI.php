<?php

namespace Drupal\social_feed\Api;

use TwitterAPIExchange;

/**
 * Instagram API service.
 */
class TwitterAPI {

  /**
   * Instagram API.
   */
  public function apiResponse() {

    require_once dirname(__DIR__, 2) . '/vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php';

    $settings = [
      'oauth_access_token' => "908450629227618304-cjiS6Pieak34bVVrp6I44ahGJW5RNYz",
      'oauth_access_token_secret' => "DwnnfI2tzC2lzuVv7UcrpFF9QKgrYJ482i7Mri3lca7pS",
      'consumer_key' => "pfe3Uvf2ky5l3ogI3mQr9PtET",
      'consumer_secret' => "ViOgAbJNEs9hgQCMPFddaeRubVjLWXYG4HxcUGp8yK3VAJ8Q0i",
    ];

    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    $requestMethod = "GET";
    $user = "UnofficialRacc";
    $count = 100;

    if (isset($_GET['user'])) {
      $user = $_GET['user'];
    }
    if (isset($_GET['count'])) {
      $count = $_GET['count'];
    }

    $getfield = "?screen_name=$user&count=$count";
    $twitter = new TwitterAPIExchange($settings);
    $string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(), $assoc = TRUE);

    if (isset($string["errors"][0]["message"])) {
      echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>" . $string[errors][0]["message"] . "</em></p>";
      exit();
    }

    foreach ($string as $items) {
      $twitterMatrix[] = [
        'urltweet' => $items['id_str'],
        'user' => $items['user']['screen_name'],
        'text' => $items['text'],
      ];
    }

    return json_encode($twitterMatrix);

  }

}
