<?php

namespace Drupal\social_feed\Api;

/**
 * Instagram API service.
 */
class FacebookAPI {

  /**
   * Instagram API.
   */
  public function apiResponse() {

    require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
    $fb = new \Facebook\Facebook([
      'app_id' => '1950455511648031',
      'app_secret' => '87930fd16a8c5ca9df7cd9a5d585a8ef',
      'default_graph_version' => 'v2.8',
    ]);
    $permissions = ['user_posts'];
    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();

    // Long Live acces token for production site.
    $accessToken = 'EAAbt7cZCsBx8BAA1eD5UqXmAmfsscZBVebGGFXkqFTwrZB7LQ1RMCG08GoMxQ8NtGTTs5dznvcHB607ipgOvZB4RtUIXDK7zeDqKXKU5wpxaOogJ3tht6PHlIQzupi5ZA10oUJ1LBTR27WZCfvhEiFp8ZCTZAaV4NGQZD';

    if (isset($accessToken)) {

      $url = "https://graph.facebook.com/v2.8/me?fields=posts.limit(4){full_picture,message,link}&access_token=$accessToken";
      $headers = ["Content-type: application/json"];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
      curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

      $st = curl_exec($ch);
      $result = json_decode($st, TRUE);;
      $data = $result['posts']['data'];

      foreach ($data as $item) {
        if (isset($item['full_picture'])) {

          $facebookMatrix[] = [
            'url' => $item['link'],
            'text' => $item['message'],
            'image' => $item['full_picture'],
          ];

        }
      }
    }

    else {

      $loginUrl = $helper->getLoginUrl('http://localhost/la/ruta/api/facebook', $permissions);
      header('Location: ' . $loginUrl);
      exit;

    }

    return json_encode($facebookMatrix);

  }

}
