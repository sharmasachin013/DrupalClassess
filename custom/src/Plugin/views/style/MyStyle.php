<?php
namespace Drupal\custom\plugin\views\style;

use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * my style
 * 
 * @ViewsStyle(
 *   id = "my_style",
 *   title = "My Style",
 *   theme = "views_style_my_style",  
 * )
 */

class MyStyle extends StylePluginBase{
   

  protected $usesRowPlugin = TRUE;


  protected $usesRowClass = TRUE;
  
 }
