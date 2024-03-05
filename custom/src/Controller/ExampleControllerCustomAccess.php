<?php
/**
 * @file
 * Example of extending ControllerBase to create a new controller.
 */

namespace Drupal\custom\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;


class ExampleControllerCustomAccess extends ControllerBase {

  /**
   * Content callback for route.
   *
   * @param int $min_username_length
   *   Minimum username length.
   *
   * @return array
   */
  public function build(int $min_username_length) {
    $name = $this->currentUser()->getDisplayName();

    return [
      '#markup' => $this->t('<p>Welcome @name. You have a user name that is at least @min characters long!</p>', ['@name' => $name, '@min' => $min_username_length]),
    ];
  }

  /**
   * Custom access control callback.
   *
   * This callback is used to check access for the route that shows the content
   * of the build() method above. It is used as the value of the _custom_access
   * configuration for the journey.example-access route.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *  The user trying to access the route.
   * @param int $min_username_length
   *   Minimum username length.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access(AccountInterface $account, int $min_username_length) {
    // When performing access control checks you should always work with the
    // supplied AccountInterface object and not Drupal::currentUser().
    $name = $account->getDisplayName();
    if (strlen($name) >= $min_username_length) {
      return AccessResult::allowed();
    }

    return AccessResult::forbidden('Your username is not long enough. Must be at least 5 characters.');
  }
}