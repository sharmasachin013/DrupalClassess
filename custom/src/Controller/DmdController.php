<?php

namespace Drupal\custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Cache\CacheableResponse;
use Drupal\Core\Cache\CacheableJsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Render\HtmlResponse;

/**
 * Returns responses for dmd routes.
 */
class DmdController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $response = new HtmlResponse('<marquee>Nothing but HTML, Only</marquee>', 200);
    return $response;
  }

}