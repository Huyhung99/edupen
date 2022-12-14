<?php

/**
 * @file
 * Allows mappings of PDFs to site content.
 */

define('FILLPDF_REPLACEMENTS_DESCRIPTION', t("<p>Tokens, such as those from CCK, sometimes output values that need additional
  processing prior to being sent to the PDF. A common example is when a key within a CCK <em>Allowed values</em>
  configuration does not match the field name or option value in the PDF that you would like to be selected but you
  do not want to change the <em>Allowed values</em> key.</p><p>This field will replace any matching values with the
  replacements you specify. Specify <strong>one replacement per line</strong> in the format
  <em>original value|replacement value</em>. For example, <em>yes|Y</em> will fill the PDF with
  <strong><em>Y</em></strong> anywhere that <strong><em>yes</em></strong> would have originally
  been used. <p>Note that omitting the <em>replacement value</em> will replace <em>original value</em>
  with a blank, essentially erasing it.</p>"));

/* ---------------- Configuration --------------------*/

/**
 * Settings form for user to place API Key.
 */
function fillpdf_settings($form, &$form_state) {
  $fillpdf_service = variable_get('fillpdf_service');

  $scheme_options = fillpdf_scheme_options();
  $form['fillpdf_scheme'] = array(
    '#type' => 'radios',
    '#title' => t('Template download method'),
    '#default_value' => variable_get('fillpdf_scheme', isset($scheme_options['public']) ? 'public' : key($scheme_options)),
    '#options' => $scheme_options,
    '#description' => t('This setting is used as the download method for uploaded templates. The use of public files is more efficient, but does not provide any access control. Changing this setting will require you to migrate associated files and data yourself and is not recommended after you have uploaded a template.'),
  );

  // Assemble service options. Warning messages will be added next as needed.
  $options = array(
    'remote' => t('Use FillPDF Service: Sign up for <a href="https://fillpdf.io">FillPDF Service</a>.'),
    'local_service' => t("Use a network-accessible <strong>FillPDF LocalServer</strong>. You will need a VPS or dedicated server with FillPDF LocalServer. Use FillPDF Service if this isn't possible with your hosting."),
    'pdftk' => t('Use locally-installed pdftk: You will need a VPS or a dedicated server so you can install pdftk: (!see_documentation).', array('!see_documentation' => l(t('see documentation'), 'http://drupal.org/documentation/modules/fillpdf'))),
    'local' => t('LEGACY. USE FILLPDF LOCALSERVER INSTEAD.'),
  );

  $form['fillpdf_service'] = array(
    '#type' => 'radios',
    '#title' => t('PDF-filling service'),
    '#description' => t('This module requires the use of one of several external PDF manipulation tools. Choose the service you would like to use.'),
    '#default_value' => $fillpdf_service,
    '#options' => $options,
  );

  $form['remote'] = array(
    '#type' => 'fieldset',
    '#title' => t('Configure FillPDF Service'),
    '#states' => array(
      'visible' => array(
        ':input[name="fillpdf_service"]' => array('value' => 'remote'),
      ),
    ),
  );
  $form['remote']['fillpdf_remote_endpoint'] = array(
    '#type' => 'textfield',
    '#title' => t('Server endpoint'),
    '#default_value' => variable_get('fillpdf_remote_endpoint', 'fillpdf.io/xmlrpc.php'),
    '#description' => t('The endpoint for the FillPDF Service instance. This does not usually need to be changed, but you may want to if you have, for example, a <a href="https://fillpdf.io/hosting">private server</a>. Do not include the protocol, as this is determined by the <em>Use HTTPS?</em> setting below.'),
  );
  $form['remote']['fillpdf_api_key'] = array(
    '#type' => 'textfield',
    '#title' => t('API Key'),
    '#default_value' => variable_get('fillpdf_api_key', ''),
    '#description' => t('You need to sign up for an API key at <a href="https://fillpdf.io">FillPDF Service</a>'),
  );
  $form['remote']['fillpdf_remote_protocol'] = array(
    '#type' => 'radios',
    '#title' => t('Use HTTPS?'),
    '#description' => t('It is recommended to select <em>Use HTTPS</em> for this option. Doing so will help prevent
      sensitive information in your PDFs from being intercepted in transit between your server and the remote service.'),
    '#default_value' => variable_get('fillpdf_remote_protocol', 'https'),
    '#options' => array(
      'https' => t('Use HTTPS'),
      'http' => t('Do not use HTTPS'),
    ),
  );

  $form['fillpdf_local_service_endpoint'] = array(
    '#type' => 'textfield',
    '#title' => t('Configure FillPDF LocalServer endpoint (address)'),
    '#default_value' => variable_get('fillpdf_local_service_endpoint'),
    '#description' => t("Enter the network address of your FillPDF LocalServer installation. If you are running the Docker container on port 8085 locally, then the address is <em>http://127.0.0.1:8085</em>. Don't worry; the module will check if it can communicate with LocalServer once you fill in this information."),
    '#states' => array(
      'visible' => array(
        ':input[name="fillpdf_service"]' => array('value' => 'local_service'),
      ),
    ),
  );

  $form['fillpdf_pdftk_path'] = array(
    '#type' => 'textfield',
    '#title' => t('Configure path to pdftk'),
    '#description' => t("If FillPDF is not detecting your pdftk installation, you can specify the full path to the program here. Include the program name as well. For example, <em>/usr/bin/pdftk</em> is a valid value. You can almost always leave this field blank. If you should set it, you'll probably know."),
    '#default_value' => variable_get('fillpdf_pdftk_path'),
    '#states' => array(
      'visible' => array(
        ':input[name="fillpdf_service"]' => array('value' => 'pdftk'),
      ),
    ),
  );

  return system_settings_form($form);
}

/**
 *
 */
function fillpdf_settings_validate($form, &$form_state) {
  switch ($form_state['values']['fillpdf_service']) {
    case 'local_service':
      // Check for FillPDF LocalServer.
      $status = fillpdf_localservice_check($form_state['values']['fillpdf_local_service_endpoint']);
      if ($status === FALSE) {
        form_set_error('fillpdf_local_service_endpoint', t('FillPDF LocalService is not properly installed. Was unable to contact %local_server', array('%local_server' => $form_state['values']['fillpdf_local_service_endpoint'])));
      }
      break;

    case 'pdftk':
      // Check for pdftk.
      $status = fillpdf_pdftk_check($form_state['values']['fillpdf_pdftk_path']);
      if ($status === FALSE) {
        form_set_error('fillpdf_pdftk_path', t('The path you have entered for <em>pdftk</em> is invalid. Please enter a valid path.'));
      }
      break;

    case 'local':
      // Check for JavaBridge.
      $status = file_exists(drupal_get_path('module', 'fillpdf') . '/lib/JavaBridge/java/Java.inc');
      if ($status === FALSE) {
        form_set_error('local', t('JavaBridge is not installed locally.'));
      }
      break;
  }
}

/* ---------------- Form Create --------------------*/

/**
 * Manage your existing forms, or upload a new one.
 */
function fillpdf_forms_admin($form, &$form_state) {
  $result = db_query("SELECT admin_title, title, url, fid FROM {fillpdf_forms} ORDER BY admin_title");
  $header = array(
    t('Administrative title'),
    t('Title'),
    t('Location'),
    array(
      'data' => t('Operations'),
      'colspan' => '4',
    ),
  );
  $rows = array();
  foreach ($result as $pdf_form) {
    $pdf_file = file_load($pdf_form->fid);
    $link = file_create_url($pdf_file->uri);
    $row = array(
      check_plain($pdf_form->admin_title),
      check_plain($pdf_form->title),
      l($pdf_file->uri, $link),
      l(t('Edit'), "admin/structure/fillpdf/$pdf_form->fid"),
      l(t('Delete'), "admin/structure/fillpdf/$pdf_form->fid/delete"),
      l(t('Export field mappings'), "admin/structure/fillpdf/$pdf_form->fid/export"),
      l(t('Import field mappings'), "admin/structure/fillpdf/$pdf_form->fid/import"),
    );
    $rows[] = $row;
  }
  if (!$rows) {
    $rows[] = array(array('data' => t('No content available.'), 'colspan' => 7));
  }

  $form['existing_forms'] = array(
    '#markup' => theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('id' => 'fillpdf'))),
  );

  // Only show PDF upload form if fillpdf is configured.
  if (variable_get('fillpdf_service')) {
    $form['#attributes'] = array('enctype' => "multipart/form-data");
    $form['upload_pdf'] = array(
      '#type' => 'file',
      '#title' => 'Upload',
      '#description' => 'Upload a PDF template to create a new form',
      '#attributes' => array('accept' => 'application/pdf'),
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Upload'),
      '#weight' => 15,
    );
  }
  else {
    $form['message'] = array(
      '#markup' => '<p>' . t('Before you can upload PDF files, you must !link.', array('!link' => l(t('configure FillPDF'), 'admin/config/media/fillpdf'))) . '</p>',
    );
    drupal_set_message(t('FillPDF is not configured.'), 'error');
  }

  return $form;
}

/**
 * Makes sure the Upload was provided (want to validate .pdf here too).
 */
function fillpdf_forms_admin_validate($form, &$form_state) {
  // Uploading anything?
  $file = $_FILES['files']['name']['upload_pdf'];
  if (!$file) {
    form_set_error('url', t('A PDF must be provided.'));
  }

  $validate_file = _fillpdf_validate_upload($file);
  if (isset($validate_file['#error'])) {
    form_set_error('url', $validate_file['#message']);
  }
}

/**
 *
 */
function _fillpdf_validate_upload($file) {
  // From includes/file.inc, line 634, but can't use that function because file
  // not an object yet.
  if (!preg_match('/\.pdf$/i', $file)) {
    return array(
      '#error' => TRUE,
      '#message' => t('Only PDF files are allowed'),
    );
  }

  // Directory exist or writeable?
  $dir = fillpdf_build_uri('fillpdf');
  file_prepare_directory($dir, FILE_CREATE_DIRECTORY | FILE_MODIFY_PERMISSIONS);

  return TRUE;
}

/**
 * Creates a new Form from the uploaded PDF, including parsed fields.
 */
function fillpdf_forms_admin_submit($form, &$form_state) {
  $fid = _fillpdf_save_upload('upload_pdf');
  if (is_numeric($fid)) {
    $form_state['redirect'] = "admin/structure/fillpdf/$fid";
  }
}

/**
 *
 */
function _fillpdf_save_upload($form_key, $fid = NULL) {
  if (isset($fid)) {
    $action = FILE_EXISTS_REPLACE;
    $destination = db_select('fillpdf_forms', 'ff')
      ->fields('ff', array('url'))
      ->condition('ff.fid', $fid, '=')
      ->execute()
      ->fetchField();
  }
  else {
    $action = FILE_EXISTS_RENAME;
    $destination = fillpdf_build_uri('fillpdf');
  }

  // $validators not working, so I just checked manually
  // in fillpdf_forms_validate()
  $validators = array('file_validate_extensions' => array('pdf'));
  // $destination in file_save_upload() must be a directory. With file_move(),
  // We can put the file to the exact filename that we want, overwriting the
  // older file when replacing the PDF for an existing form.
  $file = file_save_upload($form_key, $validators);
  $file = file_move($file, $destination, $action);
  if ($file) {
    drupal_set_message(t('<strong>@filename</strong> was successfully uploaded.', array('@filename' => $file->filename)));
    $file->status = FILE_STATUS_PERMANENT;
    $file = file_save($file);
    // Does this file already exist in {fillpdf_forms}?
    // If so, don't re-insert it.
    if (!isset($fid)) {
      db_insert('fillpdf_forms')
        ->fields(array(
          'fid' => $file->fid,
          'title' => $file->filename,
          'url' => $file->uri,
          'scheme' => fillpdf_template_scheme(),
        ))
        ->execute();
      $fid = $file->fid;
      file_usage_add($file, 'fillpdf', 'fillpdf_form', $fid);
    }

    fillpdf_parse_pdf($fid);
    return $fid;
  }
  else {
    // Commented out because even though error if file doesn't upload right, not
    // error if they dont' upload a file (& this is still triggered).
    drupal_set_message(t('Error saving file to @destination', array('@destination' => $destination)), 'error');
  }
}

/* ---------------- Form Edit --------------------*/

/**
 * Edit existing PDF form.
 */
function fillpdf_form_edit($form, &$form_state, $fid) {
  $pdf_form = fillpdf_load($fid, FALSE, FALSE);

  if ($pdf_form === FALSE) {
    drupal_set_message(t('Non-existent FillPDF Form ID.'), 'error');
    drupal_not_found();
    drupal_exit();
  }

  $form['#attributes'] = array('enctype' => "multipart/form-data");

  $form['admin_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Administrative title (optional)'),
    '#maxlenth' => 512,
    '#default_value' => $pdf_form->admin_title,
    '#required' => FALSE,
    '#description' => t('Enter the name of the form here, and it will be shown on the <a href="!form_overview">form
      overview page</a>. It has no effect on functionality, but it can help you identify which form configuration
      you want to edit.',
      array(
        '!form_overview' => url('admin/structure/fillpdf'),
      )),
  );

  $form['title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title (filename pattern)'),
    '#maxlength' => 512,
    '#default_value' => $pdf_form->title,
    '#required' => TRUE,
    '#description' => t('Enter a title for this mapping configuration.
      This will be used for deciding the filename of your PDF. <strong>This
      field supports tokens.</strong>'),
  );

  $form['title_tokens'] = array(
    '#type' => 'item',
    '#title' => 'Tokens',
  ) + _fillpdf_admin_token_form(TRUE);

  $entity_mode = module_exists('entity_token');
  $form['default_nid'] = array(
    '#type' => 'textfield',
    '#title' => $entity_mode ? t('Default Entity ID') : t('Default Node ID'),
    '#description' => $entity_mode ? t('When filling a PDF, use this entity for the data source if none is specified in the FillPDF URL. (When filling from Webform data, this is treated as the Webform Node ID.)') : t('When filling a PDF, use this node for the data source if no node is specified in the FillPDF URL.'),
    '#maxlength' => 10,
    '#default_value' => $pdf_form->default_nid,
  );

  if ($entity_mode) {
    // Compile a list of all entity types that we know provide tokens.
    $entity_type_options = array();
    $entity_types = entity_get_info();
    foreach ($entity_types as $entity_type => $entity_info) {
      if (!empty($entity_info['token type'])) {
        $entity_type_options[$entity_type] = $entity_info['label'];
      }
    }
    $form['default_entity_type'] = array(
      '#type' => 'select',
      '#title' => t('Default Entity Type'),
      '#description' => t('When filling a PDF, treat the entity ID as this type if none is specified in the FillPDF URL. If this is not set, <em>Node</em> is assumed.'),
      '#options' => array('' => t('- None -')) + $entity_type_options,
      '#default_value' => $pdf_form->default_entity_type,
    );
  }
  else {
    // Don't break the submit method. Just supply it blank.
    $form['default_entity_type'] = array(
      '#type' => 'value',
      '#value' => '',
    );
  }

  // @todo They can upload a PDF any time, but fields will only be generated on
  // add. Don't want to purge existing fields, however a user might have
  // accidently uploaded an old template and discover much later (if it's
  // substantially different, just create a new Form.
  $form['pdf_info'] = array(
    '#type' => 'fieldset',
    '#title' => 'PDF Form information',
    '#collapsed' => TRUE,
  );
  $form['pdf_info']['submitted_pdf'] = array(
    '#type' => 'item',
    '#title' => t('Uploaded PDF'),
    '#description' => $pdf_form->url,
  );
  $form['pdf_info']['upload_pdf'] = array(
    '#type' => 'file',
    '#title' => 'Update PDF template',
    '#description' => 'Update the PDF template used by this form',
    '#attributes' => array('accept' => 'application/pdf'),
  );
  $url = fillpdf_pdf_link($fid, NULL, NULL, TRUE);
  // Unless we're redirecting to the PDF file, return to the form edit page.
  if (!empty($pdf_form->destination_path) && !$pdf_form->destination_redirect) {
    $url .= '&destination=admin/structure/fillpdf/' . $fid;
  }
  $form['pdf_info']['sample_populate'] = array(
    '#type' => 'item',
    '#title' => 'Sample PDF',
    '#description' => l(t('See which fields are which in this PDF.'), $url) . '<br />' .
    t('If you have set a custom path on this PDF, the sample will be saved there silently.'),
  );
  if (!empty($pdf_form->default_nid)) {
    $form['pdf_info']['populate_default'] = array(
      '#type' => 'item',
      '#title' => $entity_mode ? t('Fill PDF from default entity') : t('Fill PDF from default node'),
      '#description' => ($entity_mode ? l(t('Download this PDF filled with data from the default entity (@entity).', array('@entity' => $pdf_form->default_nid)), fillpdf_pdf_link($fid)) : l(t('Download this PDF filled with data from the default node (@node).', array('@node' => $pdf_form->default_nid)), fillpdf_pdf_link($fid))) . '<br />' .
      t('If you have set a custom path on this PDF, the sample will be saved there silently.'),
    );
  }
  $form['pdf_info']['form_id'] = array(
    '#type' => 'item',
    '#title' => 'Form Info',
    '#description' => t('Form ID: [@fid]. Populate this form with node IDs, such as @example<br>', array('@fid' => $fid, '@example' => $entity_mode ? "/fillpdf?fid=$fid&nid=10" : "/fillpdf?fid=$fid&entity_id=node:10")),
  );
  $form['extra'] = array(
    '#type' => 'fieldset',
    '#title' => t('Additional PDF settings'),
    '#collapsible' => TRUE,
    '#collapsed' => !($pdf_form->destination_path || $pdf_form->replacements),
  );
  $form['extra']['destination_path'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom path for generated PDFs'),
    '#description' => t("<p>By default, filled PDFs are not saved to disk; they are simply sent
      directly to the browser for download. Enter a path here to change this behavior (tokens allowed). If you are using <em>Private files</em> for storage, this path will be a subdirectory of <em>fillpdf/</em> in the private files directory.
      <strong>Warning! Unless you include the &download=1 flag in the FillPDF URL, PDFs will only
      be saved to disk <em>and won't</em> be sent to the browser as well.</strong></p>
      <p>The path you specify must be in one of the following two formats:<br />
        <ul>
          <li><em>path/to/directory</em> (path will be treated as relative to
          your <em>files</em> directory)</li>
          <li><em>/absolute/path/to/directory</em> (path will be treated as relative to your entire
          filesystem)</li>
        </ul>
      Note that, in both cases, you are responsible for ensuring that the user under which PHP is running can write to this path. Do not include a trailing slash.</p>
      <p>It is also recommended to use the <strong>[random:hash:?]</strong> token to append a random string somewhere
      in the filename. This reduces the chance of a sequential number being appended to the end of the generated PDF.
      This obscures whether PDFs with the same name have been generated before or not and may be particularly useful in
      higher-security environments.</p>"),
    '#maxlength' => 255,
    '#default_value' => $pdf_form->destination_path,
  );
  $form['extra']['scheme'] = array(
    '#type' => 'radios',
    '#title' => t('Storage system for generated PDFs'),
    '#default_value' => !empty($pdf_form->scheme) ? $pdf_form->scheme : fillpdf_default_scheme(),
    '#options' => fillpdf_scheme_options(),
    '#description' => t('This setting is used as the storage/download method for generated PDFs. The use of public files is more efficient, but does not provide any access control. Changing this setting will require you to migrate associated files and data yourself and is not recommended after you have uploaded a template.'),
  );
  $form['extra']['destination_redirect'] = array(
    '#type' => 'checkbox',
    '#title' => t('Redirect directly to PDF'),
    '#description' => t("<strong>This setting is applicable only if a <em>Custom path for generated PDFs</em> is set.</strong> Instead of redirecting your visitors to the front page, it will redirect them directly to the PDF. However, if you pass Drupal's <em>destination</em> query string parameter, that will override this setting."),
    '#default_value' => $pdf_form->destination_redirect,
  );
  $form['extra']['tokens'] = array(
    '#type' => 'item',
    '#title' => 'Tokens',
  ) + _fillpdf_admin_token_form(TRUE);
  $form['extra']['replacements'] = array(
    '#type' => 'textarea',
    '#title' => t('Transform filled PDF field values'),
    '#wysiwyg' => FALSE,
    '#description' => FILLPDF_REPLACEMENTS_DESCRIPTION,
    '#default_value' => $pdf_form->replacements,
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Update'),
  );
  $form['delete'] = array(
    '#type' => 'submit',
    '#value' => t('Delete'),
  );
  $form['cancel'] = array(
    '#type' => 'link',
    '#title' => t('Cancel'),
    '#href' => 'admin/structure/fillpdf',
  );
  $form['#pdf_form'] = $pdf_form;

  // @todo order by weight, and add dragable ala http://www.computerminds.co.uk/quick-guide-using-drupal-add-tabledrag-and-enjoying-jquery-drag-and-drop-loveliness
  $q = db_query('SELECT * FROM {fillpdf_fields} WHERE fid = :fid', array(':fid' => $fid));
  $header = array(
    t('Label'),
    t('PDF-field key'),
    t('Prefix'),
    t('Value'),
    t('Suffix'),
    t('Transformed'),
    array('data' => t('Operations'), 'colspan' => 2),
  );
  $rows = array();
  foreach ($q as $field) {
    $row = array(
      // Editable.
      check_plain($field->label),
      check_plain($field->pdf_key),
      $field->prefix,
      // Editable, expandable.
      $field->value,
      $field->suffix,
      ($field->replacements ? 'Yes' : 'No'),
      // rawurlencode() is needed twice to fully protect "/". Otherwise, "/" is
      // taken as a separator when looking for a match in hook_menu().
      l(t('Edit'), "admin/structure/fillpdf/$fid/edit/" . rawurlencode(rawurlencode($field->pdf_key))),
    );
    $rows[] = $row;
  }

  $form['existing_fields'] = array(
    '#markup' => '<br/><br/>' . theme('table', array('header' => $header, 'rows' => $rows, 'attributes' => array('id' => 'fillpdf_fields'))),
  );

  $form['export_fields'] = array(
    '#prefix' => '<div>',
    '#markup' => l(t('Export these field mappings'), "admin/structure/fillpdf/{$pdf_form->fid}/export"),
    '#suffix' => '</div>',
  );

  $form['import_fields'] = array(
    '#prefix' => '<div>',
    '#markup' => l(t('Import a previous export into this PDF'), "admin/structure/fillpdf/{$pdf_form->fid}/import"),
    '#suffix' => '</div>',
  );

  return $form;
}

/**
 *
 */
function fillpdf_form_edit_validate($form, &$form_state) {
  $file = isset($_FILES['files']['name']['upload_pdf']) ? $_FILES['files']['name']['upload_pdf'] : NULL;
  if ($file) {
    $validate_file = _fillpdf_validate_upload($file);
    if (isset($validate_file['#error'])) {
      form_set_error('url', $validate_file['#message']);
    }
  }

  $scheme = $form_state['values']['scheme'];
  $using_private_files = $scheme === 'private';
  $destination_set = !empty($form_state['values']['destination_path']);
  $private_destination_path_is_absolute = $using_private_files && $destination_set &&
    strpos($form_state['values']['destination_path'], '/') === 0;

  if ($private_destination_path_is_absolute) {
    form_set_error('destination_path', t('You have chosen to use <em>Private files</em> for storage. Your destination
      path must be a subdirectory of the <em>fillpdf</em> directory and cannot be absolute.'));
  }
}

/**
 * Submit Edit or Delete for existing PDF form.
 */
function fillpdf_form_edit_submit($form, &$form_state) {
  if ($form_state['values']['op'] == t('Delete')) {
    $form_state['redirect'] = "admin/structure/fillpdf/{$form['#pdf_form']->fid}/delete";
    return;
  }
  else {
    db_update('fillpdf_forms')
      ->fields(array(
        'title' => $form_state['values']['title'],
        'default_nid' => (int) $form_state['values']['default_nid'] > 0 ? (int) $form_state['values']['default_nid'] : NULL,
        'destination_path' => $form_state['values']['destination_path'],
        'replacements' => $form_state['values']['replacements'],
        'destination_redirect' => $form_state['values']['destination_redirect'],
        'admin_title' => $form_state['values']['admin_title'],
        'scheme' => $form_state['values']['scheme'],
        'default_entity_type' => $form_state['values']['default_entity_type'],
      ))
      ->condition('fid', $form['#pdf_form']->fid)
      ->execute();
    $file = isset($_FILES['files']['name']['upload_pdf']) ? $_FILES['files']['name']['upload_pdf'] : NULL;
    if ($file) {
      // Export the current field mappings to a variable.
      $mappings = fillpdf_generate_mappings($form['#pdf_form'], TRUE);

      // Save the uploaded file; this also re-parses it.
      _fillpdf_save_upload('upload_pdf', $form['#pdf_form']->fid);

      // Import the ones we just saved. This ensures there are
      // orphaned mappings.
      drupal_set_message(t('Your previous field mappings have been transferred to the new PDF template you uploaded. Review the messages below to make sure the results are what you expected.'));
      fillpdf_import_mappings($form['#pdf_form'], $mappings);
    }

    $form_state['redirect'] = "admin/structure/fillpdf/{$form['#pdf_form']->fid}";
    drupal_set_message(t('Successfully updated form.'));
  }
}

/**
 * Delete form confirmation.
 */
function fillpdf_form_delete_confirm($form, &$form_state, $pdf_form) {
  if (is_numeric(arg(3))) {
    $pdf_form = fillpdf_load(arg(3), FALSE, FALSE);
  }
  if (!$pdf_form) {
    drupal_not_found();
    drupal_exit();
  }

  $form['#pdf_form'] = $pdf_form;
  return confirm_form($form,
    t('Are you sure you want to delete the form %title?', array('%title' => $pdf_form->title)),
    'admin/structure/fillpdf',
    t('Deleting a form will delete all the fields you created in it. This action cannot be undone.'),
    t('Delete'), t('Cancel')
  );
}

/**
 * Delete form submit.
 */
function fillpdf_form_delete_confirm_submit($form, &$form_state) {
  $fid = $form['#pdf_form']->fid;
  fillpdf_form_delete_template($fid);
  drupal_set_message(t('Your form has been deleted.'));
  $form_state['redirect'] = 'admin/structure/fillpdf';
}

/**
 * Export an importable array of PDF field key -> Label, Value mappings.
 *
 * The array key is the PDF field key and the value is another array containing
 * the label and the value (properly keyed).
 *
 * @param mixed $pdf_form
 *   The FillPDF form ID.
 */
function fillpdf_form_export($pdf_form) {
  $fillpdf_code = fillpdf_generate_mappings($pdf_form);
  return drupal_get_form('fillpdf_export_form', $fillpdf_code);
}

/**
 *
 */
function fillpdf_generate_mappings($pdf_form, $skip_encoding = FALSE) {
  if (is_numeric($pdf_form)) {
    $fid = fillpdf_load($pdf_form, FALSE, FALSE);
  }
  else {
    $fid = $pdf_form;
  }
  if (!$fid) {
    drupal_not_found();
    drupal_exit();
  }
  $fields = db_query('SELECT * FROM {fillpdf_fields} WHERE fid = :fid', array(':fid' => $fid->fid));
  $export_array = array();
  foreach ($fields as $field) {
    $export_array[$field->pdf_key] = (array) $field;
  }
  return ($skip_encoding === FALSE ? json_encode($export_array) : $export_array);
}

/**
 * Form for exporting FillPDF field mappings.
 */
function fillpdf_export_form($form, $form_state, $code) {
  $form = array();
  $form['export'] = array(
    '#type' => 'textarea',
    '#title' => t('FillPDF Form Mappings'),
    '#default_value' => $code,
    '#rows' => 30,
    '#description' => t('Copy this code and then on the site you want to import to, go to the Edit page for the FillPDF form for which you want to import these mappings, and paste it in there.'),
    '#attributes' => array(
      'style' => 'width: 97%;',
    ),
  );
  return $form;
}

/**
 * Import the code and configure the DB settings.
 *
 * Based loosely on Node Export's import form.
 *
 * @param mixed $form
 * @param mixed $form_state
 * @param mixed $pdf_form
 */
function fillpdf_form_import_form($form, &$form_state, $pdf_form) {
  if (is_numeric($pdf_form)) {
    $fid = fillpdf_load($pdf_form, FALSE, FALSE);
  }
  if (!$fid) {
    drupal_not_found();
    drupal_exit();
  }
  $form['fid'] = array(
    '#type' => 'value',
    '#value' => $fid->fid,
  );
  $form['paste'] = array(
    '#type' => 'fieldset',
    '#title' => t('Paste code'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['paste']['code'] = array(
    '#type' => 'textarea',
    '#default_value' => '',
    '#rows' => 30,
    '#description' => t('Cut and paste the results of a <em>FillPDF Field Mappings export</em> here.'),
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Import'),
    '#suffix' => l(t('Reset the form'), $_GET['q']),
  );
  return $form;
}

/**
 * Check the syntax of the code the user is trying to import.
 */
function fillpdf_form_import_form_validate($form, &$form_state) {
  $mappings = json_decode($form_state['values']['code'], TRUE);
  if (empty($mappings) || !is_array($mappings)) {
    form_set_error('code', t('There was a problem processing your FillPDF Field Mappings code. Please do a fresh export from the source and try pasting it again.'));
  }
  else {
    $form_state['values']['mappings'] = $mappings;
  }
}

/**
 * Perform the import.
 */
function fillpdf_form_import_form_submit($form, &$form_state) {
  $pdf_form = new stdClass();
  $pdf_form->fid = $form_state['values']['fid'];
  $mappings = $form_state['values']['mappings'];

  fillpdf_import_mappings($pdf_form, $mappings);
  $form_state['redirect'] = "admin/structure/fillpdf/{$pdf_form->fid}";
}

/**
 * Import an array of decoded FillPDF mappings.
 *
 * For the format, see fillpdf_generate_mappings().
 */
function fillpdf_import_mappings($pdf_form, $mappings) {
  $fields = fillpdf_get_fields($pdf_form->fid);
  $field_keys = array_keys($fields);
  // Process the mappings.
  foreach ($mappings as $pdf_key => $field_settings) {
    if (in_array($pdf_key, $field_keys)) {
      fillpdf_fields_create_update($pdf_form->fid, $pdf_key, $field_settings, TRUE);
    }
    else {
      drupal_set_message(t('Your code contained field mappings for the PDF field key <em>@pdf_key</em>, but it does not exist on this form. Therefore, it was ignored.', array('@pdf_key' => $pdf_key)), 'warning');
    }
  }
  drupal_set_message(t('Successfully imported matching PDF field keys. If any field mappings failed to import, they are listed above.'));
}

/* ---------------- Fields Edit --------------------*/

/**
 * Retrieve a field from a PDF for use in editing form.
 */
function fillpdf_field($op, $fid, $pdf_key = NULL) {
  if (is_numeric($fid)) {
    $pdf_form = fillpdf_load($fid, FALSE, FALSE);
  }
  if (!$pdf_form) {
    drupal_not_found();
    drupal_exit();
  }

  if ($op == 'add') {
    drupal_set_title($pdf_form->title);
  }
  elseif ($op != 'edit') {
    return fillpdf_form_overview($pdf_form);
  }
  elseif ($pdf_key) {
    $pdf_key = rawurldecode(rawurldecode($pdf_key));
    $field = db_query("SELECT * FROM {fillpdf_fields} WHERE pdf_key = :pdf_key AND fid = :fid", array(':pdf_key' => $pdf_key, ':fid' => $fid))->fetch();
    if (!$field) {
      drupal_not_found();
      drupal_exit();
    }
    if (!empty($field->label)) {
      $title = $field->label;
    }
    else {
      $title = $field->pdf_key;
    }
    drupal_set_title(t('Edit field mapping for %field_title', array('%field_title' => $title)), PASS_THROUGH);
  }

  return drupal_get_form('fillpdf_field_edit', $pdf_form, $field);
}

/**
 * Edit a single field.
 */
function fillpdf_field_edit($form, &$form_state, $pdf_form, $field) {
  $form['pdf_key'] = array(
    '#type' => 'item',
    '#title' => t('PDF Key'),
    '#markup' => $field->pdf_key,
    '#description' => t('The field key contained in the PDF form.'),
    '#weight' => 0,
  );
  $form['label'] = array(
    '#type' => 'textfield',
    '#title' => t('Label'),
    '#maxlength' => 255,
    '#default_value' => $field->label,
    '#description' => t('An optional label to help you identify the field.'),
    '#weight' => 1,
  );
  $form['prefix'] = array(
    '#type' => 'textarea',
    '#title' => t('Prefix'),
    '#default_value' => $field->prefix,
    '#description' => t("<p>If there is some text you always want to appear before the main value if it isn't empty, enter it here. <strong>This value only appears if the token pattern in <em>Value</em> doesn't result in blank text.</strong></p>"),
    '#weight' => 3,
  );
  $form['value'] = array(
    '#type' => 'textarea',
    '#title' => t('Value'),
    '#default_value' => $field->value,
    '#description' => t('<p>The content that will populate this field when the PDF is printed/saved.
      This content pulls data via tokens, see below for available tokens.</p>
      <p>To fill this field with an image, use the special pseudo-token <strong>[stamp:field_name]</strong>.
      If your <em>Image</em> field is named <em>field_image</em>, then you would use
      <strong>[stamp:field_image]</strong>.</p>'),
    '#weight' => 4,
  );
  $form['tokens'] = array(
    '#type' => 'item',
    '#title' => 'Tokens',
    '#weight' => 5,
  ) + _fillpdf_admin_token_form(TRUE);
  $form['suffix'] = array(
    '#type' => 'textarea',
    '#title' => t('Suffix'),
    '#default_value' => $field->suffix,
    '#description' => t("<p>If there is some text you always want to appear after the main value if it isn't empty, enter it here. <strong>This value only appears if the token pattern in <em>Value</em> doesn't result in blank text.</strong></p>"),
    '#weight' => 6,
  );
  $form['extra'] = array(
    '#type' => 'fieldset',
    '#title' => t('Transform values on this field'),
    '#collapsible' => TRUE,
    '#collapsed' => !$field->replacements,
    '#weight' => 7,
  );

  $form['extra']['replacements'] = array(
    '#type' => 'textarea',
    '#wysiwyg' => FALSE,
    '#description' => FILLPDF_REPLACEMENTS_DESCRIPTION,
    '#default_value' => $field->replacements,
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Update'),
    '#weight' => 9,
  );

  $form['cancel'] = array(
    '#type' => 'link',
    '#title' => t('Cancel'),
    '#href' => 'admin/structure/fillpdf/' . $pdf_form->fid,
    '#weight' => 11,
  );

  $form['#pdf_field'] = $field;
  $form['#pdf_form'] = $pdf_form;

  return $form;
}

/**
 * Save changes to the database.
 */
function fillpdf_field_edit_submit($form, &$form_state) {
  fillpdf_fields_create_update($form['#pdf_form']->fid, $form['#pdf_field']->pdf_key, $form_state['values'], (bool) $form['#pdf_field']);
  $form_state['redirect'] = 'admin/structure/fillpdf/' . $form['#pdf_form']->fid;
}

/**
 * Return the render array for the token tree.
 *
 * @param bool $dialog
 *   Controls whether #dialog is set. When TRUE, it will render as a link that
 *   opens a modal dialog token browser.
 *
 * @return array
 *   The render array.
 */
function _fillpdf_admin_token_form($dialog = FALSE) {
  $token_types = array(
    'node',
    'webform-tokens',
    'submission',
    'uc_order',
    'uc_order_product',
    'random',
    'current-date',
    'current-user',
    'site',
  );

  if (module_exists('entity_token')) {
    $entities = entity_get_info();
    foreach ($entities as $entity => $info) {
      $token_types[] = !empty($info['token type']) ? $info['token type'] : $entity;
    }
  }

  // If not using Webform Rules, then show potential Webform Tokens
  // webform:-namespaced tokens.
  if (module_exists('webform_rules') === FALSE) {
    $token_types[] = 'webform';
  }
  return array(
    '#theme' => 'token_tree',
    '#dialog' => $dialog,
    '#token_types' => $token_types,
    '#global_types' => FALSE,
  );
}
