<?php declare(strict_types = 1);

namespace Drupal\custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block block.
 *
 * @Block(
 *   id = "custom_example_block",
 *   admin_label = @Translation("Example Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class ExampleBlockBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
