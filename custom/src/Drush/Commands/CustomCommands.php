<?php

namespace Drupal\custom\Drush\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drupal\Core\Utility\Token;
use Drush\Attributes as CLI;
use Drush\Commands\DrushCommands;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 */
final class CustomCommands extends DrushCommands {

  /**
   * Constructs a CustomCommands object.
   */
  public function __construct(
    private readonly Token $token,
  ) {
    parent::__construct();
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('token'),
    );
  }

  /**
   * Command description here.
   */
  #[CLI\Command(name: 'custom:cookie-expire', aliases: ['cce'])]
  #[CLI\Usage(name: 'custom:cookie-expire', description: 'Usage description')]
  public function commandName() {
    $this->logger()->success(dt('Achievement unlocked.'));
  }


    /**
   * Command description here.
   */
  #[CLI\Command(name: 'custom:hello', aliases: ['hello'])]
  #[CLI\Usage(name: 'custom:hello', description: 'Usage description')]
  public function hello() {
    $this->logger()->success(dt('hello.'));
  }

  /**
   * An example of the table output format.
   */
  #[CLI\Command(name: 'custom:token', aliases: ['token'])]
  #[CLI\FieldLabels(labels: [
    'group' => 'Group',
    'token' => 'Token',
    'name' => 'Name'
  ])]
  #[CLI\DefaultTableFields(fields: ['group', 'token', 'name'])]
  #[CLI\FilterDefaultField(field: 'name')]
  public function token($options = ['format' => 'table']): RowsOfFields {
    $all = $this->token->getInfo();
    foreach ($all['tokens'] as $group => $tokens) {
      foreach ($tokens as $key => $token) {
        $rows[] = [
          'group' => $group,
          'token' => $key,
          'name' => $token['name'],
        ];
      }
    }
    return new RowsOfFields($rows);
  }

}
