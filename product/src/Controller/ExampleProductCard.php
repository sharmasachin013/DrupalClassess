<?php 

namespace Drupal\product\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\product\Services;

/**
 * Returns responses for product routes.
 */
final class ExampleProductCard extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $data = \Drupal::service('product.details')->productDetails(9);
     return [
      '#theme' => 'product_card',
      '#logo' => $data['logo'],
      '#img' => $data['image'],
      '#img_2' => $data['image1']
    ];
  }

}
