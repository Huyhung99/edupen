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
$avatar = '';
if($user->uid != 0){
  $current_user = user_load($user->uid);
  if(isset($current_user->picture->uri))
  {
    $avatar = file_create_url($current_user->picture->uri);
  }
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
          <?= form_tim_kiem();?>
        </div>

        <!-- Header Inner Start -->
        <div class="header-inner">

          <div class="header-action">
            <a href="#" class="header-action__btn">
              <i class="fal fa-bell"></i>
              <span class="header-action__number">0</span>
            </a>

            <!-- Header Mini Cart Start -->
            <!--              <div class="header-mini-cart">-->
            <!---->
            <!--                 Header Mini Cart Product List Start -->
            <!--                <ul class="header-mini-cart__product-list ">-->
            <!--                  <li class="header-mini-cart__item">-->
            <!--                    <a href="#" class="header-mini-cart__close"></a>-->
            <!--                    <div class="header-mini-cart__thumbnail">-->
            <!--                      <a href="shop-single-list-left-sidebar.html"><img src="assets/images/product/product-1.png" alt="Product" width="80" height="93"></a>-->
            <!--                    </div>-->
            <!--                    <div class="header-mini-cart__caption">-->
            <!--                      <h3 class="header-mini-cart__name"><a href="shop-single-list-left-sidebar.html">Awesome for Websites</a></h3>-->
            <!--                      <span class="header-mini-cart__quantity">1 × <strong class="amount">$49</strong><span class="separator">.00</span></span>-->
            <!--                    </div>-->
            <!--                  </li>-->
            <!--                  <li class="header-mini-cart__item">-->
            <!--                    <a href="#" class="header-mini-cart__close"></a>-->
            <!--                    <div class="header-mini-cart__thumbnail">-->
            <!--                      <a href="shop-single-list-left-sidebar.html"><img src="assets/images/product/product-2.png" alt="Product" width="80" height="93"></a>-->
            <!--                    </div>-->
            <!--                    <div class="header-mini-cart__caption">-->
            <!--                      <h3 class="header-mini-cart__name"> <a href="shop-single-list-left-sidebar.html">Awesome for Websites</a></h3>-->
            <!--                      <span class="header-mini-cart__quantity">1 × <strong class="amount">$49</strong><span class="separator">.00</span></span>-->
            <!--                    </div>-->
            <!--                  </li>-->
            <!--                  <li class="header-mini-cart__item">-->
            <!--                    <a href="#" class="header-mini-cart__close"></a>-->
            <!--                    <div class="header-mini-cart__thumbnail">-->
            <!--                      <a href="shop-single-list-left-sidebar.html"><img src="assets/images/product/product-3.png" alt="Product" width="80" height="93"></a>-->
            <!--                    </div>-->
            <!--                    <div class="header-mini-cart__caption">-->
            <!--                      <h3 class="header-mini-cart__name"> <a href="shop-single-list-left-sidebar.html">Awesome for Websites</a></h3>-->
            <!--                      <span class="header-mini-cart__quantity">1 × <strong class="amount">$49</strong><span class="separator">.00</span></span>-->
            <!--                    </div>-->
            <!--                  </li>-->
            <!--                </ul>-->
            <!--                 Header Mini Cart Product List End -->
            <!---->
            <!--                <div class="header-mini-cart__footer">-->
            <!--                  <div class="header-mini-cart__total">-->
            <!--                    <p class="header-mini-cart__label">Total:</p>-->
            <!--                    <p class="header-mini-cart__value">$445<span class="separator">.99</span></p>-->
            <!--                  </div>-->
            <!--                  <div class="header-mini-cart__btn">-->
            <!--                    <a href="cart.html" class="btn btn-primary btn-hover-secondary">View cart</a>-->
            <!--                    <a href="checkout.html" class="btn btn-primary btn-hover-secondary">Checkout</a>-->
            <!--                  </div>-->
            <!--                </div>-->
            <!---->
            <!--              </div>-->
            <!-- Header Mini Cart End -->

          </div>
          <!-- Header Mini Cart End -->

          <!-- Header User Button Start -->
          <?=strlogin();?><div class="header-user d-none d-lg-flex">
            <?php if ($user->uid == 0):?>
              <div class="header-user__button">
                <a class="header-user__signup btn btn-primary btn-hover-primary"
                   href="/user/login"">ĐĂNG NHẬP</a>
              </div>
            <?php else:?>
              <div class="header-avatar">
                <a href="/user">
                  <img src="<?= $avatar != ''? $avatar: 'https://edupen.vn/sites/default/files/picture-1-1660299320.jpg' ?>" alt="Avatar" title="avatar" class="img-fluid">
                </a>
                <?=node_load(107)->field_mo_ta_slider['und'][0]['value']?>
              </div>
            <?php endif;?>
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
<div class="dashboard-page <?php (ktra_menu()==1) ? print 'menu_user_need' : print '';?>">

  <!-- Dashboard Nav Start -->
  <div class="dashboard-nav offcanvas offcanvas-start" id="offcanvasDashboard">

    <!-- Dashboard Nav Wrapper Start -->
    <div class="dashboard-nav__wrapper">

      <div class=" dashboard-nav__content ">

        <!-- Dashboard Nav Menu Start -->
        <div class="dashboard-nav__menu">

          <?= getMainMenu()?>
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
    <!-- Dashboard Menu Close End -->

    <!-- Dashboard Menu Content Start -->
    <div class="dashboard-menu__content">
      <div class="dashboard-menu__image">
        <img src="assets/images/canvas-menu-image.png" alt="Images" width="984" height="692">
      </div>
      <div class="dashboard-menu__main-menu">
        <ul class="dashboard-menu__menu-link">
          <li><a href="#">Home</a></li>
          <li><a href="#">Courses</a></li>
          <li><a href="#">Events</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <div class="dashboard-menu__search">
          <?= form_tim_kiem();?>
        </div>
      </div>
    </div>
    <!-- Dashboard Menu Content End -->

  </div>
  <!-- Dashboard Menu End -->


  <!-- Dashboard Main Wrapper Start -->
  <main class="dashboard-main-wrapper">
    <!-- Dashboard Header Start -->

    <div class="dashboard-content">
      <div class="container-fluid">
        <?php print $messages?>
        <div class="row gy-10 ">
          <?php $cls = 8;?>
          <?php if ($page['sidebar_right']){
            $cls = 8;
          }?>
          <div class="col-lg-<?=$cls?> mx-auto">
            <h4 class="title"><?=$title?></h4>

            <?php if ($tabs) :
              ?>
              <div class="tabs"><?php print render($tabs); ?></div><?php
            endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links) :
              ?>
              <ul
                class="action-links"><?php print render($action_links); ?></ul><?php
            endif; ?>
            <?php print render($page['content']); ?>
            <div class="d-flex justify-content-between">
              <div>
                <input type="checkbox" id="is-agree" class="me-2">
                <label for="is-agree">Tôi đồng ý</label>
              </div>
              <a href="/thong-bao-khi-dong-y-dieu-khoan" class="js-submit-dk btn btn-primary disabled" data-value="<?=$user->uid?>">Chấp nhập</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-section">

      <!-- Footer Widget Area Start -->
      <div class="footer-widget-area">
        <div class="container-fluid">
          <div class="row gy-6">

            <div class="col-lg-12">
              <!-- Footer Widget Start -->
              <div class="footer-widget">
                <div class="footer-widget__info">
                  <p><i class="fas fa-phone-alt fa-fw"></i> <strong>Hỗ trợ kinh doanh:</strong> <a
                      href="tel:0906044866">0906.044.866</a> (24/24)</p>
                  <p> <i class="fas fa-phone-alt fa-fw"></i><strong> Hỗ trợ kỹ thuật:</strong> <a
                      href="tel:0982563365">0982.563.365</a> (24/24)</p>
                  <p><i class="fas fa-map-marker-alt fa-fw"></i> <strong>VP Hà Nội</strong>: Tầng 9 , tòa nhà Diamond Flower, Số nhà 48, Ðường Lê Văn Lương, Phường Nhân Chính, Quận Thanh Xuân, Thành phố Hà Nội, Việt Nam</p>
                  <p><i class="fas fa-map-marker-alt fa-fw"></i> <strong>VP Hồ Chí Minh</strong>: Lầu 6 tòa nhà Bcons - 4A/167A Nguyễn Văn Thương, Phường 25, quận Bình Thạnh, TP Hồ Chí Minh</p>
                </div>
                <div class="footer-widget__social-02">
                  <a class="facebook" href="https://www.facebook.com/Edupenvn-101337429005052" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a class="youtube" href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                  <a class="linkedin" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
              </div>
              <!-- Footer Widget End -->
            </div>
          </div>
        </div>
      </div>
      <!-- Footer Widget Area End -->

      <!-- Footer Copyright Area End -->
      <div class="footer-copyright">
        <div class="container">
          <div class="copyright-wrapper text-center">
            <p class="footer-widget__copyright mt-0">© Công Ty Cổ Phần Giáo Dục Chuẩn</p>
          </div>
        </div>
      </div>
      <!-- Footer Copyright Area End -->

    </div>

    <!-- Dashboard Content End -->
  </main>
  <!-- Dashboard Main Wrapper End -->


</div>

