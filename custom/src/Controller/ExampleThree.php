<?php declare(strict_types = 1);

namespace Drupal\custom\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for custom routes.
 */
final class ExampleThree extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
