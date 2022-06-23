<?php

namespace Drupal\Tests\pdf_using_mpdf\Functional;

/**
 * Class PdfUsingMpdfOutputTest
 * @package Drupal\Tests\pdf_using_mpdf\Functional
 */
class PdfUsingMpdfOutputTest extends PdfUsingMpdfTestBase {

  /**
   * setUp operations
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Tests if output is a PDF file
   *
   * Only for the case when PDF is generated and displayed on the browser
   */
  public function testOutput() {
    $this->drupalLogin($this->adminUser);
    $this->drupalPostForm('admin/people/permissions', ['authenticated[generate type_a pdf]' => TRUE], 'Save permissions');

    $node_type_a = $this->createNode(['type' => 'type_a']);
    $this->drupalGet('node/' . $node_type_a->id() . '/pdf');
    $this->assertResponse(200);
    $this->assertSession()->responseHeaderContains('Content-Type', 'application/pdf');
  }

}
