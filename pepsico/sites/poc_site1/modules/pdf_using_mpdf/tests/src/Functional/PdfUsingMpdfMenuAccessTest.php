<?php

namespace Drupal\Tests\pdf_using_mpdf\Functional;

/**
 * Class PdfUsingMpdfMenuAccessTest
 * @package Drupal\Tests\pdf_using_mpdf\Functional
 */
class PdfUsingMpdfMenuAccessTest extends PdfUsingMpdfTestBase {

  /**
   * setUp operations
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Test if user has access to menu item 'Generate PDF' on a node
   */
  public function testMenuAccess() {
    $edit = [];

    // Log in as administrator
    $this->drupalLogin($this->adminUser);

    // Assign permissions to authenticated user only for `type_a`
    foreach ($this->nodeTypes as $nodeType) {
      $edit = [
        'authenticated[generate ' . $nodeType->id() . ' pdf]' => TRUE,
        'anonymous[generate ' . $nodeType->id() . ' pdf]' => TRUE,
      ];
      break;
    }
    $this->drupalPostForm('admin/people/permissions', $edit, 'Save permissions');

    // Create nodes
    $node_type_a = $this->createNode(['type' => 'type_a']);
    $node_type_b = $this->createNode(['type' => 'type_b']);
    $this->drupalLogout();

    // Login as authenticated user
    $this->drupalLogin($this->accessUser);

    // Authenticated user has access to menu item
    $this->drupalGet('node/' . $node_type_a->id() . '/pdf');
    $this->assertSession()->statusCodeEquals(200);

    // Authenticated user does not have access to menu item
    $this->drupalGet('node/' . $node_type_b->id() . '/pdf');
    $this->assertSession()->statusCodeEquals(403);
    $this->drupalLogout();

    // Anonymous user has access to menu item
    $this->drupalGet('node/' . $node_type_a->id() . '/pdf');
    $this->assertSession()->statusCodeEquals(200);

    // Anonymous user does not have access to menu item
    $this->drupalGet('node/' . $node_type_b->id() . '/pdf');
    $this->assertSession()->statusCodeEquals(403);
  }

}
