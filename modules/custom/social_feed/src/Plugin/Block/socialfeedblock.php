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
    $build = [
      '#markup' => '<div id="socialfeedblock">
        <img id="ajax-loader" src="https://i.imgur.com/8YsAmq3.gif" alt="Smiley face" height="200" width="200"></img>
      </div>',
    ];

    return $build;

  }

}
