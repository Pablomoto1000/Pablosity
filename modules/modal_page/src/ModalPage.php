<?php

namespace Drupal\modal_page;

use Drupal\Component\Utility\Xss;

/**
 * Modal Page Class.
 */
class ModalPage {

  /**
   * Function to check Modal will show.
   */
  public function checkModalToShow() {

    $modal = FALSE;

    $config = \Drupal::config('modal_page.settings');

    $modals_by_page = $config->get('modals');
    $modals_by_parameter = $config->get('modals_by_parameter');

    if (empty($modals_by_page) && empty($modals_by_parameter)) {
      return FALSE;
    }

    if ($modals_by_page) {
      $modal = $this->getModalByPage($modals_by_page);
    }

    if (empty($modal) && $modals_by_parameter) {
      $modal = $this->getModalByParameter($modals_by_parameter);
    }

    return $modal;
  }

  /**
   * Function to get Modal by Page.
   */
  public function getModalByPage($modals) {

    $modals_settings = explode(PHP_EOL, $modals);

    foreach ($modals_settings as $id => $modal_settings) {

      $id = 'ModalByPage.' . $id;

      $modal = explode('|', $modal_settings);

      $path = $modal[0];

      if ($path != '<front>') {
        $path = Xss::filter($modal[0]);
      }

      $path = trim($path);
      $path = ltrim($path, '/');

      $title = Xss::filter($modal[1]);
      $title = trim($title);

      $text = Xss::filter($modal[2]);
      $text = trim($text);

      $button = Xss::filter($modal[3]);
      $button = trim($button);

      $label_do_not_show_again = FALSE;

      if (isset($modal[4]) && !empty($modal[4])) {
        $label_do_not_show_again = Xss::filter($modal[4]);
        $label_do_not_show_again = trim($label_do_not_show_again);
      }

      $is_front_page = \Drupal::service('path.matcher')->isFrontPage();

      if ($is_front_page) {
        $current_path = '<front>';
      }
      else {
        $current_uri = \Drupal::request()->getRequestUri();
        $current_path = ltrim($current_uri, '/');
      }

      if ($path == $current_path) {

        $modal = array(
          'id' => $id,
          'title' => $title,
          'text' => $text,
          'button' => $button,
          'do_not_show_again' => $label_do_not_show_again,
        );

        return $modal;
      }
    }
  }

  /**
   * Function to get Modal by Parameter.
   */
  public function getModalByParameter($modals) {

    $modals_settings = explode(PHP_EOL, $modals);
    $parameters = \Drupal::request()->query->all();

    foreach ($modals_settings as $id => $modal_settings) {

      $id = 'ModalByParameter.' . $id;

      $modal = explode('|', $modal_settings);

      $parameter_settings = Xss::filter($modal[0]);

      $parameter = trim($parameter_settings);

      $title = Xss::filter($modal[1]);
      $title = trim($title);

      $text = Xss::filter($modal[2]);
      $text = trim($text);

      $button = Xss::filter($modal[3]);
      $button = trim($button);

      $label_do_not_show_again = FALSE;

      if (isset($modal[4]) && !empty($modal[4])) {
        $label_do_not_show_again = Xss::filter($modal[4]);
        $label_do_not_show_again = trim($label_do_not_show_again);
      }

      $parameter_data = explode('=', $parameter);

      $parameter_key = $parameter_data[0];
      $parameter_value = $parameter_data[1];

      if (!empty($parameters[$parameter_key]) && $parameters[$parameter_key] == $parameter_value) {

        $modal = array(
          'id' => $id,
          'title' => $title,
          'text' => $text,
          'button' => $button,
          'do_not_show_again' => $label_do_not_show_again,
        );

        return $modal;
      }
    }
  }

}
