<?php

namespace Drupal\pdf_using_mpdf\Conversion;

use Drupal\pdf_using_mpdf\ConvertToPdfInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Utility\Token;
use Drupal\file\Entity\File;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use \Mpdf\Mpdf;
use Mpdf\MpdfException;

class ConvertToPdf implements ConvertToPdfInterface {

  /**
   *
   * @var RendererInterface RendererInterface
   */
  protected $renderer;

  /**
   * The Mpdf object.
   *
   * @var Mpdf $mpdf
   */
  protected $mpdf;

  /**
   * Token object.
   *
   * @var Token $token
   */
  protected $token;

  /**
   * @var array $context
   */
  protected $context;

  /**
   * Configuration object.
   *
   * @var ConfigFactoryInterface $configFactory
   */
  protected $configFactory;

  /**
   * Logger object.
   *
   * @var LoggerChannelFactoryInterface $logger
   */
  protected $logger;

  /**
   * pdf_using_mpdf settings.
   *
   * @var array $settings
   */
  protected $settings;

  /**
   * ConvertToPdf constructor.
   * @param RendererInterface $renderer
   * @param ConfigFactoryInterface $config_factory
   * @param Token $token
   * @param LoggerChannelFactoryInterface $logger
   */
  public function __construct(RendererInterface $renderer, ConfigFactoryInterface $config_factory, Token $token, LoggerChannelFactoryInterface $logger) {
    $this->renderer = $renderer;
    $this->configFactory = $config_factory;
    $this->token = $token;
    $this->logger = $logger;

    // Initialize with settings from db
    $this->settings = $this->getConfig();
  }

  /**
   * {@inheritdoc}
   */
  public function convert($html, $settings = [], $options = []) {
    if (empty($html)) {
      $this->logger
        ->get('pdf_using_mpdf')
        ->error(t('There was an error generating PDF - No HTML content provided.'));

      return;
    }

    // Overwrite settings - altered via hook_mpdf_settings_alter()
    $this->settings = array_merge($this->settings, $this->getDefaultConfig(), $settings);
    $this->context = $options;
    $this->generator($html);
  }

  /**
   * @param $html
   *   contents of the template already with the node data.
   */
  protected function generator($html) {
    $styles = $this->importStyles();
    $this->replaceAllSettingsTokens();

    try {
      $this->mpdf = new Mpdf($this->settings);
      $this->setHeader();
      $this->applyProperties();
      $this->setFooter();

      // Apply custom cascading styles.
      if (!empty($styles)) {
        $this->mpdf->WriteHTML($styles, \Mpdf\HTMLParserMode::HEADER_CSS);
      }
      $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

      $this->output();
    }
    catch (MpdfException $e) {
      $message = $e->getMessage();
      $this->logger->get('pdf_using_mpdf')->critical('Error:' . $message);

      return;
    }
  }

  /**
   * Get configuration from database
   *
   * @return array
   */
  public function getConfig() {
    return $this->configFactory
      ->getEditable('pdf_using_mpdf.settings')
      ->get('pdf_using_mpdf');
  }

  /**
   * Set header for PDF file.
   */
  protected function setHeader() {
    $header = $this->settings['pdf_header'];

    if (isset($header) && $header != NULL) {
      $this->mpdf->SetHTMLHeader($header);
    }
  }

  /**
   * Apply additional properties to PDF file.
   */
  protected function applyProperties() {

    // Set Watermark.
    $watermark_option = $this->settings['watermark_option'];
    $watermark_opacity = $this->settings['watermark_opacity'];

    if ($watermark_option == 0) {
      $text = $this->settings['pdf_watermark_text'];
      if (!empty($text)) {
        $this->mpdf->SetWatermarkText($text, $watermark_opacity);
        $this->mpdf->showWatermarkText = TRUE;
      }
    }
    else {
      $image_id = $this->settings['watermark_image'];
      if (isset($image_id[0])) {
        $file = File::load($image_id[0]);
        $image_path = $file->getFileUri();
        $image_path = file_create_url($image_path);
        $this->mpdf->SetWatermarkImage($image_path, $watermark_opacity);
        $this->mpdf->showWatermarkImage = TRUE;
      }
    }

    // Set Title.
    $title = $this->settings['pdf_set_title'];
    if (!empty($title)) {
      $this->mpdf->SetTitle($title);
    }

    // Set Author.
    $author = $this->settings['pdf_set_author'];
    if (!empty($author)) {
      $this->mpdf->SetAuthor($author);
    }

    // Set Subject.
    $subject = $this->settings['pdf_set_subject'];
    if (isset($subject) && $subject != NULL) {
      $this->mpdf->SetSubject($subject);
    }

    // Set Creator.
    $creator = $this->settings['pdf_set_creator'];
    if (!empty($creator)) {
      $this->mpdf->SetCreator($creator);
    }

    // Set Password.
    $password = $this->settings['pdf_password'];
    if (!empty($password)) {
      $this->mpdf->SetProtection(array('print', 'copy'), $password, $password);
    }
  }

  /**
   * Set footer for PDF file.
   */
  protected function setFooter() {
    $footer = $this->settings['pdf_footer'];
    if (isset($footer) && $footer != NULL) {
      $this->mpdf->SetHTMLFooter($footer);
    }
  }

  /**
   * Output PDF file
   */
  public function output() {
    $filename = $this->settings['pdf_filename'];
    switch($this->settings['pdf_save_option']) {
      case 0:
        // Web browser
        try {
          // Set (if not already) title to show on the browser as file name
          if (empty($this->settings['pdf_set_title'])) {
            $this->mpdf->SetTitle($filename . '.pdf');
          }

          $this->mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
        } catch (MpdfException $e) {
          $message = 'Web browser: PDF file generation error. ' . $e->getMessage();
          $this->logger->get('pdf_using_mpdf')->critical($message);
        }
        break;

      case 1:
        // Save Dialog box
        try {
          $this->mpdf->Output($filename . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
        } catch (MpdfException $e) {
          $message = 'Download: PDF file generation error. ' . $e->getMessage();
          $this->logger->get('pdf_using_mpdf')->critical($message);
        }
        break;

      case 2:
        // Save to server
        try {
          $scheme = \Drupal::config('system.file')->get('default_scheme');
          $folder = \Drupal::service('file_system')->realpath($scheme . "://");
          $path = $folder . '/pdf_using_mpdf/' . $filename . '.pdf';

          $this->mpdf->Output($path, \Mpdf\Output\Destination::FILE);
          \Drupal::messenger()->addStatus(t('PDF file %filename saved to %path', [
            '%filename' => $filename . '.pdf',
            '%path' => $folder,
          ]));
        } catch (MpdfException $e) {
          $message = 'Save to server: PDF file generation error. ' . $e->getMessage();
          $this->logger->get('pdf_using_mpdf')->critical($message);
        }
        break;
    }
  }

  /**
   * Configuration values to instantiate Mpdf constructor.
   *
   * @return array
   */
  public function getDefaultConfig() {
    $orientation = $this->settings['orientation'] == 'L' ? '-L' : '';

    return [
      'tempDir' => \Drupal::service('file_system')->getTempDirectory(),
      'useActiveForms' => TRUE,
      'format' => $this->settings['pdf_page_size'] . $orientation,
      'default_font_size' => $this->settings['pdf_font_size'],
      'default_font' => $this->settings['pdf_default_font'],
      'margin_left' => $this->settings['margin_left'],
      'margin_right' => $this->settings['margin_right'],
      'margin_top' => $this->settings['margin_top'],
      'margin_bottom' => $this->settings['margin_bottom'],
      'margin_header' => $this->settings['margin_header'],
      'margin_footer' => $this->settings['margin_footer'],
      'dpi' => $this->settings['dpi'],
      'img_dpi' => $this->settings['img_dpi'],
    ];
  }

  /**
   * Check if the custom stylesheet exists.
   *
   * @return bool|string
   */
  protected function importStyles() {
    $file = '';

    if (isset($this->settings['pdf_css_file']) && !empty($this->settings['pdf_css_file'])) {
      $path = DRUPAL_ROOT . '/' . $this->settings['pdf_css_file'];
      if (file_exists($path)) {
        $file = file_get_contents($path);
      }
    }

    return $file;
  }

  /**
   * Replace all tokens
   */
  public function replaceAllSettingsTokens() {
    $settings = [];
    foreach ($this->settings as $key => $value) {
      $settings[$key] = !is_array($value) ? $this->token->replace($value, $this->context) : $value;
    }

    $this->settings = $settings;
  }

}
