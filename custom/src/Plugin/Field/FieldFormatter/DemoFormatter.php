<?php declare(strict_types = 1);

namespace Drupal\custom\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'Demo' formatter.
 *
 * @FieldFormatter(
 *   id = "custom_demo",
 *   label = @Translation("Demo"),
 *   field_types = {"string"},
 * )
 */
final class DemoFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode): array {
    $element = [];
    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#markup' => $item->value,
      ];
    }
    return $element;
  }

}
