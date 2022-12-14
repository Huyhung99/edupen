<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<?php
global $user;
if ($user->uid > 0) {
  $current_user = user_load($user->uid);
  $avatar = file_create_url($current_user->picture->uri);
}
?>
<div class="header-section header-sticky">
  <div class="header-main">
    <div class="container-fluid">
      <!-- Header Main Wrapper Start -->
      <div class="header-main-wrapper">
        <div class="header-category-menu d-none d-xl-block">
          <a href="#" class="header-category-toggle">
            <span class="header-category-toggle__icon">
                              <i class="fal fa-bars"></i>
            </span>
          </a>
        </div>
        <!-- Header Logo Start -->
        <div class="header-logo">
          <?php if ($logo): ?>
            <a href="<?php print $front_page; ?>"
               title="<?php print t('Home'); ?>" rel="home" id="logo">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"
                   class="header-logo__logo" width="296" height="64"/>

            </a>
          <?php endif; ?>
        </div>
        <!-- Header Logo End -->

        <!-- Header Category Menu Start -->

        <!-- Header Category Menu End -->
        <div class="header-serach">
          <?= form_tim_kiem(); ?>
        </div>

        <!-- Header Inner Start -->
        <div class="header-inner">

          <!-- Header Search Start -->
          <!-- Header Search End -->
          <!-- Header Navigation Start -->
          <?php
          if ($user->uid != 0):
            ?>
            <?php
            foreach ($current_user->roles as $item) {
              $role[] = trim($item);
            } ?>
            <?php if (in_array('Gi??o vi??n', $role) || in_array('administrator', $role) || in_array('Sales', $role)): ?>

          <?php else: ?>
            <div class="header-navigation d-none d-xl-block">
              <nav class="menu-primary">
                <ul class="menu-primary__container">
                  <li><a href="/dieu-khoan-tro-thanh-giao-vien"
                         class="btn btn-primary"><span>Tr??? th??nh gi??o vi??n</span></a>
                  </li>
                </ul>
              </nav>
            </div>
          <?php endif; ?>
          <?php endif; ?>
          <!-- Header Navigation End -->

          <!-- Header Mini Cart Start -->
          <div class="header-action">
            <a href="#" class="header-action__btn">
              <i class="fal fa-bell"></i>
              <span class="header-action__number">0</span>
            </a>
          </div>
          <!-- Header Mini Cart End -->

          <!-- Header User Button Start -->
          <?= strlogin(); ?>
          <div class="header-user d-none d-lg-flex">
            <?php if ($user->uid == 0): ?>
              <div class="header-user__button">
                <a class="header-user__signup btn btn-primary btn-hover-primary"
                   href="/user/login"">????NG NH???P</a>
              </div>
            <?php else: ?>
              <div class="header-avatar">
                <a href="/user">
                  <img
                    src="<?= $avatar != '' ? $avatar : 'https://edupen.vn/sites/default/files/picture-1-1660299320.jpg' ?>"
                    alt="Avatar" title="avatar" class="img-fluid">
                </a>
                <ul class="box-management">
                  <li class="item">
                    <i class="fal fa-money-check-alt fa-fw me-2"></i> S??? d??:
                    <span class="text-red">0 ??</span>
                  </li>
                  <li class="item">
                    <i class="fal fa-file-certificate fa-fw me-2"></i>
                    <a href="#">T??i li???u ???? mua</a>
                  </li>
                  <li class="item">
                    <i class="fal fa-file-check fa-fw me-2"></i> <a href="#">T??i
                      li???u ???? xem</a>
                  </li>
                  <li class="item">
                    <i class="fal fa-university fa-fw me-2"></i> <a href="#">Qu???n
                      l?? hoa h???ng</a>
                  </li>
                  <li class="item">
                    <i class="fal fa-wallet fa-fw me-2"></i> <a href="#">Qu???n l??
                      thu nh???p - r??t ti???n</a>
                  </li>
                  <li class="item">
                    <i class="fal fa-history fa-fw me-2"></i> <a href="#">L???ch
                      s??? giao d???ch</a>
                  </li>
                  <li class="item">
                    <i class="fal fa-user fa-fw me-2"></i> <a href="#">Th??ng tin
                      c?? nh??n</a>
                  </li>
                  <li class="item">
                    <i class="fal fa-sign-out fa-fw me-2"></i> <a
                      href="/user/logout">????ng xu???t</a>
                  </li>
                </ul>
              </div>
            <?php endif; ?>

          </div>
          <!-- Header User Button End -->

          <!-- Header Mobile Toggle Start -->
          <div class="header-toggle">
            <button class="header-toggle__btn d-xl-none"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasMobileMenu">
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
            </button>
            <button class="header-toggle__btn search-open d-flex d-md-none">
              <span class="dots"></span>
              <span class="dots"></span>
              <span class="dots"></span>
            </button>
          </div>
          <!-- Header Mobile Toggle End -->


        </div>
        <!-- Header Inner End -->

      </div>
      <!-- Header Main Wrapper End -->
    </div>
  </div>
  <!-- Header Main End -->

</div>
<div
  class="dashboard-page <?php (ktra_menu() == 1) ? print 'menu_user_need' : print ''; ?>">

  <!-- Dashboard Nav Start -->
  <div class="dashboard-nav offcanvas offcanvas-start" id="offcanvasDashboard">

    <!-- Dashboard Nav Wrapper Start -->
    <div class="dashboard-nav__wrapper">

      <div class=" dashboard-nav__content ">

        <!-- Dashboard Nav Menu Start -->
        <div class="dashboard-nav__menu">
          <?php
            print getMainMenu();
          ?>
        </div>
        <!-- Dashboard Nav Menu End -->

      </div>

      <!-- Dashboard Nav Content End -->

      <div class="offcanvas-footer"></div>

    </div>
    <!-- Dashboard Nav Wrapper End -->

  </div>
  <!-- Dashboard Nav End -->

  <!-- Dashboard Menu Start -->
  <div class="dashboard-menu">

    <!-- Dashboard Menu Close Start -->
    <div class="dashboard-menu__close">
      <button class="close-btn"><i class="fal fa-times"></i></button>
    </div>

  </div>
  <!-- Dashboard Menu End -->


  <!-- Dashboard Main Wrapper Start -->
  <main class="dashboard-main-wrapper">
    <!-- Dashboard Header Start -->

    <div class="dashboard-content">
      <div class="container-fluid">
        <?php print $messages ?>
        <?php
        $uid_user = $user->uid;
        ?>
        <?php if (isset($user->uid) && ($user->uid != 0) && (arg(2) != 'edit')): ?>
          <div class="dashboard-profile mt-40">
            <div class="row">
              <div class="col-md-6">
                <div class="dashboard-header__user">
                  <div class="dashboard-header__user-avatar">
                    <?php
                    $loaded_user = user_load($user->uid); ?>
                    <img
                      src="<?php isset($loaded_user->picture->uri) ? print str_replace('public://', '/sites/default/files/', $loaded_user->picture->uri) : print '/sites/default/files/picture-1-1660299320.jpg'; ?>"
                      alt="Avatar" title="Avatar" width="90" height="90">
                  </div>
                  <div class="dashboard-header__user-info">
                    <h4
                      class="dashboard-header__user-name"><?= $user->name ?></h4>
                    <div class="dashboard-header__user-rating">
                      <p>M?? t???: ??ang c???p nh???t</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="can_deu">
                  <a href="/user/<?= $user->uid ?>/edit"
                     class="btn btn-primary"><span>Ch???nh s???a th??ng tin <i
                        class="fas fa-edit"></i></span></a>
                </div>
              </div>
            </div>
            <div class="back_ground_user">
              <div class="row">
                <div class="col-md-6">
                  <div class="dashboard-profile__item">
                    <div class="dashboard-profile__heading"><h4>H??? v?? t??n:</h4>
                    </div>
                    <div class="dashboard-profile__content">
                      <p><?= $user->name; ?></p>
                    </div>
                  </div>
                  <div class="dashboard-profile__item">
                    <div class="dashboard-profile__heading">
                      <h4>
                        <?php
                        $ds_vai_tro = $user->roles;
                        $vai_tro = '';
                        foreach ($ds_vai_tro as $id_role => $vaitro) {
                          if ($id_role != '2') {
                            if ($vai_tro == '') {
                              $vai_tro = $vaitro;
                            } else {
                              $vai_tro = $vai_tro . ', ' . $vaitro;
                            }
                          }
                        }
                        ?>
                        <p>Vai tr??:</p></h4>
                    </div>
                    <div class="dashboard-profile__content">
                      <p><?= $vai_tro ?></p>
                    </div>
                  </div>
                  <div class="dashboard-profile__item">
                    <div class="dashboard-profile__heading"><h4>S??? ??i???n tho???i:</h4></div>
                    <div class="dashboard-profile__content">
                      <p><?php isset($user->field_so_dien_thoai['und'][0]['value']) ? print $user->field_so_dien_thoai['und'][0]['value'] : print '??ang c???p nh???t' ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="dashboard-profile__item">
                    <div class="dashboard-profile__heading"><h4>C???p h???c:</h4>
                    </div>
                    <div class="dashboard-profile__content">
                      <p><?php isset($user->field_cap_hoc['und'][0]['value']) ? print $user->field_cap_hoc['und'][0]['value'] : print '??ang c???p nh???t'; ?></p>
                    </div>
                  </div>
                  <div class="dashboard-profile__item">
                    <div class="dashboard-profile__heading"><h4>Ng??y ????ng
                        k??:</h4></div>
                    <div class="dashboard-profile__content">
                      <p><?= date('d-m-Y', $user->created) ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
          <?php if ($page['content']) print render($page['content']); ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="container-fluid">

      <div class="footer-section px-4">

        <!-- Footer Widget Area Start -->
        <div class="footer-widget-area">
          <div class="row gy-6">

            <div class="col-lg-12">
              <!-- Footer Widget Start -->
              <div class="footer-widget">
                <div class="footer-widget__info">
                  <p><i class="fas fa-phone-alt fa-fw"></i> <strong>H??? tr??? kinh
                      doanh:</strong> <a
                      href="tel:0906044866">0906.044.866</a> (24/24)</p>
                  <p><i class="fas fa-phone-alt fa-fw"></i><strong> H??? tr??? k???
                      thu???t:</strong> <a
                      href="tel:0982563365">0982.563.365</a> (24/24)</p>
                  <p><i class="fas fa-map-marker-alt fa-fw"></i> <strong>VP H??
                      N???i</strong>: T???ng 9 , t??a nh?? Diamond Flower, S??? nh?? 48,
                    ???????ng L?? V??n L????ng, Ph?????ng Nh??n Ch??nh, Qu???n Thanh Xu??n,
                    Th??nh ph??? H?? N???i, Vi???t Nam</p>
                  <p><i class="fas fa-map-marker-alt fa-fw"></i> <strong>VP H???
                      Ch?? Minh</strong>: L???u 6 t??a nh?? Bcons - 4A/167A Nguy???n
                    V??n Th????ng, Ph?????ng 25, qu???n B??nh Th???nh, TP H??? Ch?? Minh</p>
                </div>
                <div class="footer-widget__social-02">
                  <a class="facebook"
                     href="https://www.facebook.com/Edupenvn-101337429005052"
                     target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a class="youtube" href="https://www.youtube.com/"
                     target="_blank"><i class="fab fa-youtube"></i></a>
                  <a class="linkedin" href="https://www.linkedin.com/"
                     target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
              </div>
              <!-- Footer Widget End -->
            </div>
          </div>
        </div>
        <!-- Footer Widget Area End -->

        <!-- Footer Copyright Area End -->
        <div class="footer-copyright">
          <div class="copyright-wrapper text-center">
            <p class="footer-widget__copyright mt-0">?? C??ng Ty C??? Ph???n Gi??o D???c
              Chu???n</p>
          </div>
        </div>
        <!-- Footer Copyright Area End -->

      </div>
    </div>

    <!-- Dashboard Content End -->
  </main>
  <!-- Dashboard Main Wrapper End -->

</div>

