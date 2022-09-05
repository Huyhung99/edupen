<?php

/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<!doctype html>
<html class="no-js" lang="<?php print $language->language; ?>">

<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <?php print $styles; ?>
</head>

<body class=" <?php print $classes; ?>" <?php print $attributes; ?>>
<?php global $user;?>
<?php
$balance = node_load_multiple(array(),array(
  'uid' => $user->uid,
  'type' => 'vi_tien'
));
?>
<input type="hidden" value="<?=$user->uid?>" class="js-udata">
<?php foreach ($balance as $item):?>
  <input type="hidden" value="<?= $item->field_so_du['und'][0]['value']?>" class="js-balance">
<?php endforeach;?>
<?php
//  if (!empty($user->field_vai_tro) && !empty($user->field_cap_hoc) && !empty($user->field_so_dien_thoai)){
//    drupal_goto("user/".$user->uid."/edit");
//  }
//
//?>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>

<div class="modal fade" id="confirmModal">
  <div class="modal-dialog modal-dialog-centered modal-login">

    <!-- Modal Wrapper Start -->
    <div class="modal-wrapper">
      <button class="modal-close" data-bs-dismiss="modal"><i class="fal fa-times"></i></button>

      <!-- Modal Content Start -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bạn chưa hoàn thành bài thi lần trước</h5>
        </div>
        <div class="modal-body d-flex">
          <a href="#" class="btn btn-danger btn-hover-secondary w-100 js-submit-continue me-4">Tiếp tục thi</a>
          <a href="#" class="btn btn-light btn-hover-secondary w-100 js-submit-giveup">Bỏ qua</a>
        </div>
      </div>
      <!-- Modal Content End -->

    </div>
    <!-- Modal Wrapper End -->

  </div>
</div>
  <?php print $scripts; ?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1136530740595330&autoLogAppEvents=1" nonce="okAaVAM5"></script>
</body>

</html>
