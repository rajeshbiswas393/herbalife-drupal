<?php

namespace Drupal\Tests\pdf_using_mpdf\Functional;

use Drupal\Core\Config\ConfigFactory;

/**
 * Class PdfUsingMpdfConfigurationFormTest
 * @package Drupal\Tests\pdf_using_mpdf\Functional
 */
class PdfUsingMpdfConfigurationFormTest extends PdfUsingMpdfTestBase {

  /**
   * Actual config
   *
   * @var array
   */
  protected $mPdfConfig = [
    'pdf_using_mpdf' => [
      'pdf_filename' => 'pdf-test-file',
      'pdf_save_option' => 1,
      'pdf_set_title' => 'pdf-test-title',
      'pdf_set_author' => 'pdf-test-author',
      'pdf_set_subject' => 'pdf-test-subject',
      'pdf_set_creator' => 'pdf-test-creator',
      'margin_top' => 24,
      'margin_right' => 22,
      'margin_bottom' => 24,
      'margin_left' => 22,
      'margin_header' => 11,
      'margin_footer' => 11,
      'pdf_font_size' => 16,
      'pdf_default_font' => 'dejavusanscondensed',
      'pdf_page_size' => 'A1',
      'dpi' => 101,
      'img_dpi' => 105,
      'orientation' => 'L',
      'watermark_option' => 0,
      'watermark_opacity' => 0.5,
      'pdf_watermark_text' => 'pdf-watermark-test-text',
      'pdf_header' => 'pdf-test-header',
      'pdf_footer' => 'pdf-test-footer',
      'pdf_css_file' => '/path/to/css/file.css'
    ],
  ];

  /**
   * Drupal ConfigFactory
   *
   * @var ConfigFactory
   */
  protected $configFactory;

  protected $active;

  /**
   * setUp operations
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Tests if the configuration saved to Drupal is correct
   */
  public function testConfiguration() {
    $this->drupalLogin($this->adminUser);

    // Set Drupal config
    $active = $this->container->get('config.storage');
    $sync = $this->container->get('config.storage.sync');
    $this->copyConfig($active, $sync);
    $sync->write('pdf_using_mpdf.settings', $this->mPdfConfig);
    $this->configImporter()->import();

    $this->drupalGet('admin/config/user-interface/mpdf');

    // Assert form values
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-filename')->getValue(), 'pdf-test-file');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-save-option-1')->getValue(), '1');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-set-author')->getValue(), 'pdf-test-author');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-set-subject')->getValue(), 'pdf-test-subject');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-set-creator')->getValue(), 'pdf-test-creator');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-margin-top')->getValue(), '24');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-margin-right')->getValue(), '22');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-margin-bottom')->getValue(), '24');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-margin-left')->getValue(), '22');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-margin-header')->getValue(), '11');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-margin-footer')->getValue(), '11');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-font-size')->getValue(), '16');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-default-font')->getValue(), 'dejavusanscondensed');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-page-size')->getValue(), 'A1');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-dpi')->getValue(), '101');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-img-dpi')->getValue(), '105');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-orientation')->getValue(), 'L');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-watermark-opacity')->getValue(), '0.5');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-watermark-option-0')->getValue(), '0');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-watermark-text')->getValue(), 'pdf-watermark-test-text');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-header')->getValue(), 'pdf-test-header');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-footer')->getValue(), 'pdf-test-footer');
    $this->assertEqual($this->getSession()->getPage()->findById('edit-pdf-css-file')->getValue(), '/path/to/css/file.css');

    $this->drupalLogout();
  }

}
