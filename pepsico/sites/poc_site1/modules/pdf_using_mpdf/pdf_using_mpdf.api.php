<?php

/**
 * Alter html passed to PDF file before conversion
 *
 * Implements hook_mpdf_html_alter()
 *
 * @param string $html
 * @param \Drupal\node\NodeInterface $node
 */
function pdf_using_mpdf_mpdf_html_alter(&$html, $node) {

  // Append custom HTMl to node type `page`
  if ($node->getType() == 'page') {
    $div = '<div>';
    $div .= 'This is super cool way to generate a PDF file!';
    $div .= '</div>';

    $html .= $div;
  }
}

/**
 * Alter PDF settings before conversion
 *
 * Implements hook_mpdf_settings_alter()
 *
 * @param array $settings
 * @param \Drupal\node\NodeInterface $node
 */
function pdf_using_mpdf_mpdf_settings_alter(&$settings, $node) {

  // Add page number to the header for node type `article`
  if ($node->getType() == 'article') {
    $settings['pdf_header'] = "{PAGENO}\n<hr>";
  }
}
