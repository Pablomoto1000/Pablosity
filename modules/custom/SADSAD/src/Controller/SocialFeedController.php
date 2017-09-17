<?php
namespace Drupal\social_feed\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\social_feed\apiservicecontainer\SocialFeedApi;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class SocialFeedController extends ControllerBase
{
  private $instagramapigenerator;

  public function __construct(SocialFeedApi $instagramapigenerator)
  {
    $this->instagramapigenerator = $instagramapigenerator;
  }

  public function instagram($count)
  {
    $instagram = $this->instagramapigenerator->getinstagramapi($count);


    return new Response($instagram);
  }

  // InstagramAPIFunction
  public function instagramApi($clientID='6033526250', $clientTOKEN='6033526250.1677ed0.999581e2e3fb439798dccf629d41df6d')
  {
    $instagramApi = $this->instagramapigenerator->InstagramAPI($clientID, $clientTOKEN);

    return new Response($instagramApi);

  }

  // InstagramAPIFunction
  public function facebookApi($appid='1950455511648031', $secretpass='87930fd16a8c5ca9df7cd9a5d585a8ef')
  {
    $facebookApi = $this->instagramapigenerator->FacebookAPI($appid, $secretpass);

    return new Response($facebookApi);

  }

  // TwitterAPIFunction
  public function twitterApi($oauth_access_token = '908450629227618304-cjiS6Pieak34bVVrp6I44ahGJW5RNYz',
  $oauth_access_token_secret = 'DwnnfI2tzC2lzuVv7UcrpFF9QKgrYJ482i7Mri3lca7pS',
  $consumer_key = 'pfe3Uvf2ky5l3ogI3mQr9PtET',
  $consumer_secret = 'ViOgAbJNEs9hgQCMPFddaeRubVjLWXYG4HxcUGp8yK3VAJ8Q0i')
  {
    $twitterApi = $this->instagramapigenerator->TwitterAPI($oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret);

    return new Response($twitterApi);

  }


  public static function create(ContainerInterface $container)
  {
      $instagramapigenerator = $container->get('social_feed.apiservicecontainer');


      return new static($instagramapigenerator);
  }

}
