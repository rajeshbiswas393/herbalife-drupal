<?php

namespace Drupal\Tests\pdf_using_mpdf\Functional;

use Drupal\node\NodeTypeInterface;
use Drupal\Tests\BrowserTestBase;

/**
 * Class PdfUsingMpdfNodeTypePermissionsTest
 * @package Drupal\Tests\pdf_using_mpdf\Functional
 *
 * @group pdf_using_mpdf
 */
class PdfUsingMpdfDynamicPermissionsTest extends PdfUsingMpdfTestBase {

  /**
   * setUp operations
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Test if dynamic permissions get created successfully
   */
  public function testAccessPermissions() {
    // Go to the permissions page
    $this->drupalLogin($this->adminUser);
    $this->drupalGet('admin/people/permissions');

    foreach ($this->nodeTypes as $node_type) {
      $id = str_replace('_', '-', $node_type->id());
      $element = $this->xpath('//table//tr[contains(@data-drupal-selector, "edit-permissions-generate-' . $id . '-pdf")]');

      $this->assertTrue(!empty($element));
    }
  }

}
