<?php declare(strict_types = 1);

namespace Drupal\custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Provides a demo block.
 *
 * @Block(
 *   id = "custom_demo",
 *   admin_label = @Translation("Demo"),
 *   category = @Translation("Custom"),
 * )
 */
final class DemoBlock extends BlockBase  implements ContainerFactoryPluginInterface {

    protected $messenger;

  public function __construct(
    array $configuration, 
    $plugin_id, 
    $plugin_definition, 
    protected AccountInterface $currentUser,
    MessengerInterface $messenger
  ) {
    $this->messenger = $messenger;
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }


   /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('messenger')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build(): array {
   $build = [];
    $this->messenger->addMessage(t("Form Submitted By Login User"));
    $build['drupalist_activate_block']['#markup'] = '<p>Your user id is ' . $uid = $this->currentUser->id() . '</p>';

    return $build;
  }

}
