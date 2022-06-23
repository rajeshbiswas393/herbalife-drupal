<?php

namespace Drupal\pdf_using_mpdf;

/**
 * Provides an interface defining methods needed for PDF generation.
 */
interface ConvertToPdfInterface {

  /**
   * Point of call to instantiate the mPDF library
   * and call the generator functions for creating a
   * PDF file.
   *
   * @param string $html
   *   The html that will be converted into PDF content.
   *
   * @param array $settings
   *   Optional. Additional mPDF settings to add and overwrite existing ones
   *   Overwriting mPDF settings is useful when a different PDF settings are
   *   desired for different files per use case
   *
   * @param array $options
   *   An optional array containing usually the context variables used for
   *   token replacement
   */
  function convert($html, $settings = [], $options = []);
}
