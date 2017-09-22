<?php

namespace Drupal\social_feed\Controller;

/**
 * Social Feed Controller.
 *
 * All the calls and constructors to each API here.
 *
 * Token and clients ID passed as parameters in methods.
*/

// Libraries and services called into Social Feed Controller.
use Drupal\Core\Controller\ControllerBase;
use Drupal\social_feed\Api\InstagramAPI;
use Drupal\social_feed\Api\FacebookAPI;
use Drupal\social_feed\Api\TwitterAPI;
use Drupal\social_feed\Api\AjaxReturn;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Social Feed controller class which extends the ControllerBase class.
 */
class SocialFeedController extends ControllerBase {

  /**
   * Social feed generator private variable.
   *
   * @var socialfeedgenerator
   */
  private $instagramApiGenerator;
  private $facebookApiGenerator;
  private $twitterApiGenerator;
  private $ajaxReturnGenerator;
  private $ajaxReturn;

  /**
   * Constructor for the Social Feed API PHP Class.
   */
  public function __construct(InstagramAPI $instagramApiGenerator, FacebookAPI $facebookApiGenerator, TwitterAPI $twitterApiGenerator, AjaxReturn $ajaxReturnGenerator) {

    // Assign the private variable the instagramApiGenerator object.
    $this->instagramApiGenerator = $instagramApiGenerator;

    // Assign the private variable the instagramApiGenerator object.
    $this->facebookApiGenerator = $facebookApiGenerator;

    // Assign the private variable the instagramApiGenerator object.
    $this->twitterApiGenerator = $twitterApiGenerator;

    // Assign the private variable the instagramApiGenerator object.
    $this->ajaxReturnGenerator = $ajaxReturnGenerator;

  }

  /**
   * Instagram API call.
   */
  public function instagram() {

    // Pass the parameters to the function.
    $instagram = $this->instagramApiGenerator->apiResponse();

    // Return response from Instagram API.
    return new Response($instagram);

  }

  /**
   * Facebook API call.
   */
  public function facebook() {

    // Pass the parameters to the function.
    $facebook = $this->facebookApiGenerator->apiResponse();

    // Return response from Facebook API.
    return new Response($facebook);

  }

  /**
   * Twiiter API call.
   */
  public function twitter() {

    // Pass the parameters to the function.
    $twitter = $this->twitterApiGenerator->apiResponse();

    // Return response from Twitter API.
    return new Response($twitter);

  }

  /**
   * Twiiter API call.
   */
  public function ajaxReturn() {

    // Pass the parameters to the function.
    $ajaxReturn = $this->ajaxReturnGenerator->return();

    // Return response from Twitter API.
    return new Response($ajaxReturn);

  }

  /**
   * Service container called.
   */
  public static function create(ContainerInterface $container) {

    // Get the services from the container and assign it to each variable.
    $instagramApiGenerator = $container->get('instagram_service.api');
    $facebookApiGenerator = $container->get('facebook_service.api');
    $twitterApiGenerator = $container->get('twitter_service.api');
    $ajaxReturnGenerator = $container->get('ajax_return.api');

    // Return the socialfeedgenerator variable with the service into it.
    return new static($instagramApiGenerator, $facebookApiGenerator, $twitterApiGenerator, $ajaxReturnGenerator);

  }

}
