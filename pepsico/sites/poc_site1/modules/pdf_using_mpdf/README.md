Introduction
------------
* Use this module to convert HTML to PDF using the mPDF PHP Library
* Use this module to create editable PDF files


Requirements
------------
* mPDF(>=7.0.0). Use composer to install the mPDF library
 ```
  composer require 'mpdf/mpdf:^8.0'
 ```
* When the module is installed, mPDF library is not installed automatically.
  Use the above `composer` command to install the library from the directory where your `composer.json` is!


Configuration
-------------
* Go to this URL and set your PDF preferences : **/admin/config/user-interface/mpdf**
* Set permissions for what roles can generate PDF : **/admin/people/permissions**


Usage
-----
* This module provides PDF generation for nodes out-of-the-box
* After permissions have been set for node types, use `Generate PDF` URL on node view to generate a valid PDF
* For any other entity, or an HTML, refer below


For Developers
--------------
* Use a custom Drupal service `pdf_using_mpdf.conversion` for PDF generation
* This service primarily needs `$html`
* To generate a PDF programmatically from anywhere in your project, use the following:

 ```php
   /** @var \Drupal\pdf_using_mpdf\ConvertToPdfInterface $pdf */
   $pdfService = \Drupal::service('pdf_using_mpdf.conversion');
   $pdfService->convert($html, $settings, $context);
 ```
    Parameters used above :
    -----------------------
    $html                 > Rendered HTML of an entity or regular HTML tags
    $settings (optional)  > Use this parameter to overwrite settings from the configuration page
    $context  (optional)  > Useful to replace tokens set in the mPDF configuration

* For even better control, checkout `pdf_using_mpdf.api.php` file to look at the hooks provided by this module
* With these hooks, you can use a separate set of mPDF settings for every use case
