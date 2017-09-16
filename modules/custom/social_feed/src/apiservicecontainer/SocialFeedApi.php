<?php

namespace Drupal\social_feed\apiservicecontainer;
use \TwitterAPIExchange;

class SocialFeedApi
{
  // API function
  public function InstagramAPI($clientID, $clientTOKEN)
  {
    // INSTAGRAM API


    // API config to obtain and display media
    $userId = $clientID;
    $accessToken = $clientTOKEN;
    $url = "https://api.instagram.com/v1/users/$userId/media/recent/?access_token=$accessToken";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);
    $i = 0;

    foreach($result->data as $post):
      $instagramMatrix[$i] = array(
        'url' => $post->images->standard_resolution->url,
        'text' => $post->caption->text,
        'image' => $post->images->thumbnail->url,
      );

    // If images == 3 dont show more
    if (++$i == 3){

    break;
    }
    endforeach;
    return json_encode($instagramMatrix);

  }

  public function FacebookAPI($appid, $secretpass)
  {
    require_once dirname(__DIR__,2).'/vendor/autoload.php';
    $fb = new \Facebook\Facebook([
      'app_id' => $appid,
      'app_secret' => $secretpass,
      'default_graph_version' => 'v2.8',
    ]);
    $permissions = ['user_posts'];
    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();

    // Long Live acces token for production site
    $accessToken = 'EAAbt7cZCsBx8BAA1eD5UqXmAmfsscZBVebGGFXkqFTwrZB7LQ1RMCG08GoMxQ8NtGTTs5dznvcHB607ipgOvZB4RtUIXDK7zeDqKXKU5wpxaOogJ3tht6PHlIQzupi5ZA10oUJ1LBTR27WZCfvhEiFp8ZCTZAaV4NGQZD';


    if (isset($accessToken)) {

   		$url = "https://graph.facebook.com/v2.8/me?fields=posts.limit(4){full_picture,message,link}&access_token=$accessToken";
  		$headers = array("Content-type: application/json");


  		 $ch = curl_init();
  		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  		 curl_setopt($ch, CURLOPT_URL, $url);
  	   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  		 curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');
  		 curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');
  		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  		 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3");
  		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  		 $st=curl_exec($ch);
  		 $result=json_decode($st,TRUE);;
  		 $data = $result['posts']['data'];
      //  $i = 0;

       foreach ($data as $item) {
  		 	if (isset($item['full_picture'])) {

          $facebookMatrix[] = array(
            'url' => $item['link'],
            'text' => $item['message'],
            'image' => $item['full_picture'],
          );
  		 	}
        // if (++$i == 3){
          // break;
        // }
  	   }
   } else {
	    $loginUrl = $helper->getLoginUrl('http://dev-pablosity.pantheonsite.io/la/ruta/api/facebook', $permissions);
      header('Location: '. $loginUrl);

      exit;

     }

    return json_encode($facebookMatrix);
  }

  public function TwitterAPI($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret)
  {
    require_once dirname(__DIR__,2).'/vendor/j7mbo/twitter-api-php/TwitterAPIExchange.php';

    $settings = array(
      'oauth_access_token' => "908450629227618304-cjiS6Pieak34bVVrp6I44ahGJW5RNYz",
      'oauth_access_token_secret' => "DwnnfI2tzC2lzuVv7UcrpFF9QKgrYJ482i7Mri3lca7pS",
      'consumer_key' => "pfe3Uvf2ky5l3ogI3mQr9PtET",
      'consumer_secret' => "ViOgAbJNEs9hgQCMPFddaeRubVjLWXYG4HxcUGp8yK3VAJ8Q0i"
    );

    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    $requestMethod = "GET";
    $user = "UnofficialRacc";
    $count = 100;

    if (isset($_GET['user'])) { $user = $_GET['user']; }
    if (isset($_GET['count'])) { $count = $_GET['count'];}

    $getfield = "?screen_name=$user&count=$count";
    $twitter = new TwitterAPIExchange($settings);
    $string = json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),$assoc = TRUE);

    if(isset($string["errors"][0]["message"])) {
        echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";
        exit();
    }
    foreach($string as $items)
      {
        $twitterMatrix[] = array(
          'user' => $items['user']['screen_name'],
          'text' => $items['text'],
        );
      }
    return json_encode($twitterMatrix);
  }

  public function getinstagramapi($user)
  {
    return 'Inst'.str_repeat('a', $user).'gram!';
  }
}
