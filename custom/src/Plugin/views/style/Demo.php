<?php 

namespace Drupal\custom\Plugin\views\style;

use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * demo Style Plugin.
 * 
 * @ViewsStyle(
 *   id = "demo",
 *   title = "Demo",
 *   theme = "views_style_demo",
 * )
 */


class Demo extends StylePluginBase {
      
    protected $usesRowPlugin = TRUE;

    protected $usesRowClass = TRUE;
}