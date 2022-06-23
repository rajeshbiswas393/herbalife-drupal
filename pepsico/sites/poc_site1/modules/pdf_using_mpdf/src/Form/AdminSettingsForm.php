<?php
namespace Drupal\pdf_using_mpdf\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\file\Entity\File;

class AdminSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'pdf_using_mpdf_config';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['pdf_using_mpdf.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Get settings for this form.
    $settings = $this->configFactory()
      ->getEditable('pdf_using_mpdf.settings')
      ->get('pdf_using_mpdf');

    // Vertical tab
    $form['tab'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['tab_file_elements'] = [
      '#type' => 'details',
      '#title' => t('File'),
      '#group' => 'tab'
    ];

    $filename = $settings['pdf_filename'];
    $form['tab_file_elements']['pdf_filename'] = [
      '#type' => 'textfield',
      '#title' => $this->t('PDF Filename'),
      '#required' => TRUE,
      '#default_value' => isset($filename) && $filename != NULL ? $filename : '[site:name] - PDF',
    ];

    $form['tab_file_elements']['pdf_save_option'] = [
      '#type' => 'radios',
      '#title' => t('Open PDF File in'),
      '#options' => [
        $this->t('Web Browser'),
        $this->t('Save Dialog Box'),
        $this->t('Save to Server')
      ],
      '#default_value' => $settings['pdf_save_option'],
    ];

    // Document properties.
    $form['tab_document_properties_elements'] = [
      '#type' => 'details',
      '#title' => $this->t('Document Properties'),
      '#description' => $this->t('These optional properties can be seen when inspecting the document properties like in Adobe Reader.'),
      '#group' => 'tab'
    ];
    $form['tab_document_properties_elements']['pdf_set_title'] = [
      '#type' => 'textfield',
      '#size' => 35,
      '#title' => $this->t('Title'),
      '#default_value' => $settings['pdf_set_title'],
      '#description' => $this->t('Set the title for the document.'),
    ];
    $form['tab_document_properties_elements']['pdf_set_author'] = [
      '#type' => 'textfield',
      '#size' => 35,
      '#title' => $this->t('Author'),
      '#default_value' => $settings['pdf_set_author'],
      '#description' => $this->t('Set the Author for the document.'),
    ];
    $form['tab_document_properties_elements']['pdf_set_subject'] = [
      '#type' => 'textfield',
      '#size' => 35,
      '#title' => $this->t('Subject'),
      '#default_value' => $settings['pdf_set_subject'],
      '#description' => $this->t('Set Subject of PDF.'),
    ];
    $form['tab_document_properties_elements']['pdf_set_creator'] = [
      '#type' => 'textfield',
      '#size' => 35,
      '#title' => $this->t('Creator'),
      '#default_value' => $settings['pdf_set_creator'],
      '#description' => $this->t('Set the document Creator.'),
    ];

    // Page settings.
    $form['tab_page_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Page Settings'),
      '#description' => $this->t('All margin values should be specified as LENGTH in millimetres.'),
      '#group' => 'tab'
    ];
    $form['tab_page_settings']['margin_top'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Top Margin'),
      '#default_value' => $settings['margin_top'],
    ];
    $form['tab_page_settings']['margin_right'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Right Margin'),
      '#default_value' => $settings['margin_right'],
    ];
    $form['tab_page_settings']['margin_bottom'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Bottom Margin'),
      '#default_value' => $settings['margin_bottom'],
    ];
    $form['tab_page_settings']['margin_left'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Left Margin'),
      '#default_value' => $settings['margin_left'],
    ];
    $form['tab_page_settings']['margin_header'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Header Margin'),
      '#default_value' => $settings['margin_header'],
    ];
    $form['tab_page_settings']['margin_footer'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Footer Margin'),
      '#default_value' => $settings['margin_footer'],
    ];
    $form['tab_page_settings']['pdf_font_size'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Font Size'),
      '#default_value' => $settings['pdf_font_size'],
    ];
    $form['tab_page_settings']['pdf_default_font'] = [
      '#type' => 'select',
      '#title' => $this->t('Default Font Style'),
      '#description' => $this->t('These are the default fonts provided by mPDF. This may not work for HTML content if your styles already have a <em>font-family</em> property.'),
      '#options' => $this->get_default_fonts(),
      '#default_value' => $settings['pdf_default_font'],
    ];
    $form['tab_page_settings']['pdf_page_size'] = [
      '#type' => 'select',
      '#title' => $this->t('Page Size'),
      '#options' => $this->getPageSizeOptions(),
      '#default_value' => $settings['pdf_page_size'],
    ];
    $form['tab_page_settings']['dpi'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Document DPI'),
      '#default_value' => $settings['dpi'],
    ];
    $form['tab_page_settings']['img_dpi'] = [
      '#type' => 'textfield',
      '#size' => 5,
      '#title' => $this->t('Image DPI'),
      '#default_value' => $settings['img_dpi'],
    ];
    $form['tab_page_settings']['orientation'] = [
      '#type' => 'select',
      '#title' => $this->t('Orientation'),
      '#default_value' => $settings['orientation'],
      '#options' => [
        'P' => $this->t('Portrait'),
        'L' => $this->t('Landscape'),
      ],
    ];

    //TODO: image size options in admin form for watermark

    // Watermark.
    $form['tab_watermark'] = [
      '#type' => 'details',
      '#description' => $this->t('Display watermark on every page.'),
      '#title' => $this->t('Watermark'),
      '#group' => 'tab',
    ];
    $form['tab_watermark']['watermark_opacity'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Watermark Transparency'),
      '#default_value' => $settings['watermark_opacity'],
    ];
    $form['tab_watermark']['watermark_option'] = [
      '#type' => 'radios',
      '#title' => $this->t('Watermark'),
      '#options' => [
        $this->t('Text'),
        $this->t('Image')
      ],
      '#default_value' => $settings['watermark_option'],
    ];
    $form['tab_watermark']['pdf_watermark_text'] = [
      '#type' => 'textfield',
      '#default_value' => $settings['pdf_watermark_text'],
      '#placeholder' => $this->t('Watermark text'),
      '#states' => [
        'visible' => [
          ':input[name="watermark_option"]' => [
            'value' => 0,
          ],
        ],
      ],
    ];
    $form['tab_watermark']['watermark_image'] = [
      '#type' => 'managed_file',
      '#default_value' => !empty($settings['watermark_image']) ? $settings['watermark_image'] : [],
      '#upload_location' => 'public://pdf_using_mpdf',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
        'file_validate_size' => [1024 * 1024],
      ],
      '#states' => [
        'visible' => [
          ':input[name="watermark_option"]' => [
            'value' => 1,
          ],
        ],
      ],
    ];

    // Header.
    $form['tab_head'] = [
      '#type' => 'details',
      '#title' => $this->t('Header'),
      '#description' => $this->t('use {PAGENO} for page numbering or {DATE j-m-Y} for current date.'),
      '#group' => 'tab',
    ];
    $form['tab_head']['pdf_header'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Header content'),
      '#description' => $this->t('Use a valid HTML code to write a custom header content. Example:') . ' &#60;div&#62;&#60;img src="http://www.example.com/sites/default/files/company_logo.png" width="300px" height="50px" &#62;&#60;/div&#62; &#60;hr /&#62;',
      '#default_value' => $settings['pdf_header'],
    ];

    // Footer.
    $form['tab_foot'] = [
      '#type' => 'details',
      '#title' => $this->t('Footer'),
      '#description' => $this->t('use {PAGENO} for page numbering or {DATE j-m-Y} for current date.'),
      '#group' => 'tab',
    ];
    $form['tab_foot']['pdf_footer'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Footer content'),
      '#description' => $this->t('Use a valid HTML code to write a custom footer content. Example:') . ' &#60;hr /&#62; &#60;div style="color:#f00; text-align:center;" &#62; &#60;strong&#62;Your Company&#60;/strong&#62;, web: &#60;a href="http://example.com"&#62;www.example.com&#60;/a&#62;, email : contact@example.com&#60;/div&#62;',
      '#default_value' => $settings['pdf_footer'],
    ];

    // Password.
    $form['tab_password'] = [
      '#type' => 'details',
      '#title' => $this->t('Password Protection'),
      '#group' => 'tab',
    ];

    $pwd = !empty($settings['pdf_password']) ? $settings['pdf_password'] : NULL;
    if (isset($pwd) && $pwd != NULL) {
      $form['tab_password']['msg'] = [
        '#type' => 'markup',
        '#markup' => '<p>' . $this->t('***** Password is already set *****') . '</p>',
      ];
      $form['tab_password']['remove_pwd'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Remove Password'),
      ];
    }
    else {
      $form['tab_password']['pdf_password'] = [
        '#type' => 'password_confirm',
        '#description' => $this->t('If password is not required, leave blank. Do not use space in starting and ending of password.'),
      ];
    }

    // Custom style Sheet.
    $form['tab_style'] = [
      '#type' => 'details',
      '#title' => $this->t('Custom Style Sheet'),
      '#open' => FALSE,
      '#group' => 'tab',
    ];
    $form['tab_style']['pdf_css_file'] = [
      '#type' => 'textfield',
      '#description' => $this->t('Enter path for CSS file. This path should be strictly related to Drupal root. For example: <em>styles/custom.css</em> will have its path validated as <em>DRUPAL_ROOT/styles/custom.css</em>'),
      '#default_value' => $settings['pdf_css_file'],
    ];

    // Support for Token contrib module to provide a Browse UI
    if (\Drupal::service('module_handler')->moduleExists('devel')){
      $form['available_tokens'] = [
        '#theme' => 'token_tree_link',
        '#token_types' => ['node'],
      ];
    }
    else {
      $url = Url::fromUri('https://www.drupal.org/project/token');
      $form['available_tokens'] = [
        '#prefix' => '<em>',
        '#markup' => t('Tip: Install @token_url module to browse more tokens', [
          '@token_url' => Link::fromTextAndUrl('Token', $url)->toString(),
        ]),
        '#suffix' => '</em>',
      ];
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    if (!is_numeric($values['pdf_font_size']) || $values['pdf_font_size'] < 1) {
      $form_state->setErrorByName('pdf_font_size', $this->t('Font size should be numeric and greater than 1.'));
    }
    if (!is_numeric($values['margin_top']) || $values['margin_top'] <= 0) {
      $form_state->setErrorByName('margin_top', $this->t('PDF top margin should be numeric and greater than -1.'));
    }
    if (!is_numeric($values['margin_right']) || $values['margin_right'] <= 0) {
      $form_state->setErrorByName('margin_right', $this->t('PDF right margin should be numeric and greater than -1.'));
    }
    if (!is_numeric($values['margin_bottom']) || $values['margin_bottom'] <= 0) {
      $form_state->setErrorByName('margin_bottom', $this->t('PDF bottom margin should be numeric and greater than -1.'));
    }
    if (!is_numeric($values['margin_left']) || $values['margin_left'] <= 0) {
      $form_state->setErrorByName('margin_left', $this->t('PDF left margin should be numeric and greater than -1.'));
    }
    if (!is_numeric($values['margin_header']) || $values['margin_header'] <= 0) {
      $form_state->setErrorByName('margin_header', $this->t('PDF header margin should be numeric and greater than -1.'));
    }
    if (!is_numeric($values['margin_footer']) || $values['margin_footer'] <= 0) {
      $form_state->setErrorByName('margin_footer', $this->t('PDF footer margin should be numeric and greater than -1.'));
    }
    if (!is_numeric($values['dpi']) || $values['dpi'] < 0) {
      $form_state->setErrorByName('dpi', $this->t('Document DPI should be numeric and greater than 0.'));
    }
    if (!is_numeric($values['img_dpi']) || $values['img_dpi'] < 0) {
      $form_state->setErrorByName('img_dpi', $this->t('Image DPI should be numeric and greater than 0.'));
    }

    // Change watermark image status to permanent.
    if (!empty($values['watermark_image'])) {
      $file = File::load($values['watermark_image'][0]);
      if (!$file->isPermanent()) {
        $file->setPermanent();
        $file->save();
        $file_usage = \Drupal::service('file.usage');
        $file_usage->add($file, 'pdf_using_mpdf', 'user', \Drupal::currentUser()->id());
      }
    }

    // Validate custom stylesheet.
    if (!empty($values['pdf_css_file'])) {
      $path = DRUPAL_ROOT . '/' . $values['pdf_css_file'];
      if (!file_exists($path)) {
        $form_state->setErrorByName('pdf_css_file', $this->t('Stylesheet not found in path: @path', [
          '@path' => $path,
        ]));
      }
      if ($target_path = pathinfo($path)) {
        if ($target_path['extension'] != 'css') {
          $form_state->setErrorByName('pdf_css_file', $this->t('*.css file extension is needed.'));
        }
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $settings = [
      'pdf_filename' => $values['pdf_filename'],
      'pdf_save_option' => $values['pdf_save_option'],
      'pdf_set_title' => $values['pdf_set_title'],
      'pdf_set_author' => $values['pdf_set_author'],
      'pdf_set_subject' => $values['pdf_set_subject'],
      'pdf_set_creator' => $values['pdf_set_creator'],
      'margin_top' => $values['margin_top'],
      'margin_right' => $values['margin_right'],
      'margin_bottom' => $values['margin_bottom'],
      'margin_left' => $values['margin_left'],
      'margin_header' => $values['margin_header'],
      'margin_footer' => $values['margin_footer'],
      'pdf_font_size' => $values['pdf_font_size'],
      'pdf_default_font' => $values['pdf_default_font'],
      'pdf_page_size' => $values['pdf_page_size'],
      'dpi' => $values['dpi'],
      'img_dpi' => $values['img_dpi'],
      'orientation' => $values['orientation'],
      'watermark_option' => $values['watermark_option'],
      'watermark_opacity' => $values['watermark_opacity'],
      'pdf_watermark_text' => $values['pdf_watermark_text'],
      'watermark_image' => !empty($values['watermark_image']) ? $values['watermark_image'] : [],
      'pdf_header' => $values['pdf_header'],
      'pdf_footer' => $values['pdf_footer'],
      'pdf_css_file' => $values['pdf_css_file'],
    ];

    if (isset($values['remove_pwd'])) {
      if ($values['remove_pwd'] == '1') {
        $settings['pdf_password'] = NULL;
      }
    }
    else {
      $settings['pdf_password'] = $values['pdf_password'];
    }

    // Save the configuration into database.
    $this->configFactory()
      ->getEditable('pdf_using_mpdf.settings')
      ->set('pdf_using_mpdf', $settings)
      ->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * Get default font styles provided by mPDF library.
   *
   * @return array
   */
  public function get_default_fonts() {
    return [
      'dejavusanscondensed' => 'DejaVuSansCondensed',
      'dejavusans' => 'DejaVuSans',
      'dejavuserif' => 'DejaVuSerif',
      'dejavuserifcondensed' => 'DejaVuSerifCondensed',
      'dejavusansmono' => 'DejaVuSansMono',
      'freesans' => 'FreeSans',
      'freeserif' => 'FreeSerif',
      'freemono' => 'FreeMono',
      'ocrb' => 'ocrb10',
      'estrangeloedessa' => 'SyrCOMEdessa',
      'kaputaunicode' => 'kaputaunicode',
      'abyssinicasil' => 'Abyssinica_SIL',
      'aboriginalsans' => 'AboriginalSansREGULAR',
      'jomolhari' => 'Jomolhari',
      'sundaneseunicode' => 'SundaneseUnicode-1.0.5',
      'taiheritagepro' => 'TaiHeritagePro',
      'aegean' => 'Aegean',
      'aegyptus' => 'Aegyptus',
      'akkadian' => 'Akkadian',
      'quivira' => 'Quivira',
      'eeyekunicode' => 'Eeyek',
      'lannaalif' => 'lannaalif-v1-03',
      'daibannasilbook' => 'DBSILBR',
      'garuda' => 'Garuda',
      'khmeros' => 'KhmerOS',
      'dhyana' => 'Dhyana',
      'tharlon' => 'Tharlon',
      'padaukbook' => 'Padauk-book',
      'zawgyi-one' => 'ZawgyiOne',
      'ayar' => 'ayar',
      'taameydavidclm' => 'TaameyDavidCLM',
      'mph2bdamase' => 'damase_v.2',
      'lohitkannada' => 'Lohit-Kannada',
      'pothana2000' => 'Pothana2000',
      'xbriyaz' => 'XB Riyaz',
      'lateef' => 'LateefRegOT',
      'kfgqpcuthmantahanaskh' => 'Uthman',
      'sun-exta' => 'Sun-ExtA',
      'sun-extb' => 'Sun-ExtB',
      'unbatang' => 'UnBatang_0613',
    ];
  }

  /**
   * International Paper Sizes.
   *
   * @return array
   */
  public function getPageSizeOptions() {
    return [
      'A0' => 'A0',
      'A1' => 'A1',
      'A2' => 'A2',
      'A3' => 'A3',
      'A4' => 'A4',
      'A5' => 'A5',
      'A6' => 'A6',
      'A7' => 'A7',
      'A8' => 'A8',
      'A9' => 'A9',
      'A10' => 'A10',
      'B0' => 'B0',
      'B1' => 'B1',
      'B2' => 'B2',
      'B3' => 'B3',
      'B4' => 'B4',
      'B5' => 'B5',
      'B6' => 'B6',
      'B7' => 'B7',
      'B8' => 'B8',
      'B9' => 'B9',
      'B10' => 'B10',
      'C0' => 'C0',
      'C1' => 'C1',
      'C2' => 'C2',
      'C3' => 'C3',
      'C4' => 'C4',
      'C5' => 'C5',
      'C6' => 'C6',
      'C7' => 'C7',
      'C8' => 'C8',
      'C9' => 'C9',
      'C10' => 'C10',
      '2A0' => '2A0',
      '4A0' => '4A0',
      'RA0' => 'RA0',
      'RA1' => 'RA1',
      'RA2' => 'RA2',
      'RA3' => 'RA3',
      'SRA0' => 'SRA0',
      'SRA1' => 'SRA1',
      'SRA2' => 'SRA2',
      'SRA3' => 'SRA3',
      'SRA4' => 'SRA4',
      'Letter' => 'Letter',
      'Legal' => 'Legal',
    ];
  }

}
