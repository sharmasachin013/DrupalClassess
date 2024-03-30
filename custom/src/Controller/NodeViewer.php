<?php 

namespace Drupal\custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;

class NodeViewer extends ControllerBase {
  public function view(NodeInterface $node, string $view_mode) {
    // Get the render array of $node using the $view_mode view mode.
    $output = $this->entityTypeManager()
      ->getViewBuilder('node')
      ->view($node, $view_mode);

    return [
      'header' => [
        '#type' => 'markup',
        '#markup' => $this->t('<div class="messages messages--status">Displaying node using the @view_mode view mode</div>', ['@view_mode' => $view_mode]),
      ],
      'node' => $output,
    ];
  }

   public function titleCallback(NodeInterface $node, string $view_mode) {
    return $this->t('Viewing %node using view mode %view_mode', ['%node' => $node->label(), '%view_mode' => $view_mode]);
  }
  
}