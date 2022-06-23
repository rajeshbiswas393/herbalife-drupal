<?php

namespace Drupal\Tests\pdf_using_mpdf\Functional;

use Drupal\node\NodeTypeInterface;
use Drupal\Tests\BrowserTestBase;

/**
 * Class PdfUsingMpdfTestBase
 * @package Drupal\Tests\pdf_using_mpdf\Functional
 */
class PdfUsingMpdfTestBase extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * Modules to enable
   *
   * @var array
   */
  public static $modules = ['node', 'user', 'pdf_using_mpdf'];

  /**
   * Administrator
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  /**
   * Access user
   *
   * @var \Drupal\user\UserInterface
   */
  protected $accessUser;

  /**
   * Node types
   *
   * @var NodeTypeInterface[]
   */
  protected $nodeTypes;

  /**
   * Content types
   *
   * @var array
   */
  protected $types = [
    [
      'id' =>  'type_a',
      'label' => 'Type A'
    ],
    [
      'id' =>  'type_b',
      'label' => 'Type B'
    ],
    [
      'id' =>  'type_c',
      'label' => 'Type C'
    ],
  ];

  /**
   * setUp operations
   */
  protected function setUp() {
    parent::setUp();

    // Create admin user
    $this->adminUser = $this->drupalCreateUser([
      'administer permissions',
      'access content',
      'administer content types',
      'administer mpdf settings',
    ]);

    // Authenticated user
    $this->accessUser = $this->drupalCreateUser(['access content']);

    // Create content types
    foreach ($this->types as $type) {
      $this->drupalCreateContentType([
        'type' => $type['id'],
        'name' => $type['label'],
      ]);
    }

    // Get node types
    $this->nodeTypes = $this->container
      ->get('entity_type.manager')
      ->getStorage('node_type')
      ->loadMultiple();
  }


  /**
   * {@inheritdoc}
   */
  public function tearDown() {
    parent::tearDown();

    \Drupal::unsetContainer();
  }

}
