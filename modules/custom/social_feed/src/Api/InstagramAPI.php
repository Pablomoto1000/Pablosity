<?php

namespace Drupal\social_feed\Api;

/**
 * Instagram API service.
 */
class InstagramAPI {

  /**
   * Instagram API.
   */
  public function apiResponse() {

    $userId = '6033526250';
    $accessToken = '6033526250.1677ed0.999581e2e3fb439798dccf629d41df6d';
    $url = "https://api.instagram.com/v1/users/$userId/media/recent/?access_token=$accessToken";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);
    $i = 0;

    foreach ($result->data as $post) :
      $instagramMatrix[$i] = [
        'url' => $post->images->standard_resolution->url,
        'urlpost' => $post->link,
        'text' => $post->caption->text,
        'image' => $post->images->thumbnail->url,
      ];

      // If images == 3 dont show more.
      if (++$i == 3) {

        break;
      }
    endforeach;
    return json_encode($instagramMatrix);

  }

}
