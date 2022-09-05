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
<main class="main-wrapper">

  <!-- Header start -->
  <div class="header-section header-sticky">

    <!-- Header Top Start -->
    <div class="header-top d-none d-sm-block">
      <div class="container">

        <!-- Header Top Bar Wrapper Start -->
        <div class="header-top-bar-wrap">
          <div class="header-top-bar-wrap__text text-center">
          </div>
        </div>
        <!-- Header Top Bar Wrapper End -->

      </div>
    </div>
    <!-- Header Top End -->

    <!-- Header Main Start -->
    <div class="header-main">
      <div class="container">
        <!-- Header Main Wrapper Start -->
        <div class="header-main-wrapper">

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
          <div class="header-category-menu d-none d-xl-block">
            <a href="#" class="header-category-toggle">
              <div class="header-category-toggle__icon">
                <svg width="18px" height="18px" viewBox="0 0 18 18"
                     version="1.1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink">
                  <g stroke="none" stroke-width="1" fill-rule="evenodd">
                    <path
                      d="M2,14 C3.1045695,14 4,14.8954305 4,16 C4,17.1045695 3.1045695,18 2,18 C0.8954305,18 0,17.1045695 0,16 C0,14.8954305 0.8954305,14 2,14 Z M9,14 C10.1045695,14 11,14.8954305 11,16 C11,17.1045695 10.1045695,18 9,18 C7.8954305,18 7,17.1045695 7,16 C7,14.8954305 7.8954305,14 9,14 Z M16,14 C17.1045695,14 18,14.8954305 18,16 C18,17.1045695 17.1045695,18 16,18 C14.8954305,18 14,17.1045695 14,16 C14,14.8954305 14.8954305,14 16,14 Z M2,7 C3.1045695,7 4,7.8954305 4,9 C4,10.1045695 3.1045695,11 2,11 C0.8954305,11 0,10.1045695 0,9 C0,7.8954305 0.8954305,7 2,7 Z M9,7 C10.1045695,7 11,7.8954305 11,9 C11,10.1045695 10.1045695,11 9,11 C7.8954305,11 7,10.1045695 7,9 C7,7.8954305 7.8954305,7 9,7 Z M16,7 C17.1045695,7 18,7.8954305 18,9 C18,10.1045695 17.1045695,11 16,11 C14.8954305,11 14,10.1045695 14,9 C14,7.8954305 14.8954305,7 16,7 Z M2,0 C3.1045695,0 4,0.8954305 4,2 C4,3.1045695 3.1045695,4 2,4 C0.8954305,4 0,3.1045695 0,2 C0,0.8954305 0.8954305,0 2,0 Z M9,0 C10.1045695,0 11,0.8954305 11,2 C11,3.1045695 10.1045695,4 9,4 C7.8954305,4 7,3.1045695 7,2 C7,0.8954305 7.8954305,0 9,0 Z M16,0 C17.1045695,0 18,0.8954305 18,2 C18,3.1045695 17.1045695,4 16,4 C14.8954305,4 14,3.1045695 14,2 C14,0.8954305 14.8954305,0 16,0 Z"></path>
                  </g>
                </svg>
              </div>
              <div class="header-category-toggle__text">Danh mục tài liệu</div>
            </a>

            <div class="header-category-dropdown-wrap">
              <?= getMainMenuDocument() ?>
            </div>
          </div>
          <!-- Header Category Menu End -->

          <!-- Header Inner Start -->
          <div class="header-inner">

            <!-- Header Search Start -->
            <div class="header-serach">
              <?= form_tim_kiem();?>
            </div>
            <!-- Header Search End -->

            <!-- Header Navigation Start -->
            <div class="header-navigation d-none d-xl-block">
              <nav class="menu-primary">
                <ul class="menu-primary__container">
                  <li><a href="/"><span>Trở thành giáo viên</span></a></li>
                </ul>
              </nav>
            </div>
            <!-- Header Navigation End -->

            <!-- Header Mini Cart Start -->
            <div class="header-action">
              <a href="#" class="header-action__btn">
                <i class="far fa-shopping-cart"></i>
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

              <div class="header-user__button">
                <a class="header-user__signup btn btn-primary btn-hover-primary"
                   href="/user/login"">ĐĂNG NHẬP</a>
              </div>
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
  <!-- Header End -->
  <!-- Page Banner Section Start -->
  <div class="page-banner bg-color-11">
    <div class="page-banner__wrapper">
      <div class="container">

        <!-- Page Breadcrumb Start -->
        <div class="page-breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active"><?= $title?></li>
          </ul>
        </div>
        <!-- Page Breadcrumb End -->

      </div>
    </div>
  </div>
  <!-- Page Banner Section End -->

  <!-- Offcanvas Start -->
  <div class="offcanvas offcanvas-end offcanvas-mobile" id="offcanvasMobileMenu" style="background-image: url(assets/images/mobile-bg.jpg);">
    <div class="offcanvas-header bg-white">
      <div class="offcanvas-logo">
        <a class="offcanvas-logo__logo" href="#"><img src="assets/images/dark-logo.png" alt="Logo"></a>
      </div>
      <button type="button" class="offcanvas-close" data-bs-dismiss="offcanvas"><i class="fal fa-times"></i></button>
    </div>

    <div class="offcanvas-body">
      <nav class="canvas-menu">
        <ul class="offcanvas-menu">
          <li><a class="active" href="#"><span>Home</span></a>

            <ul class="mega-menu">
              <li>
                <!-- Mega Menu Content Start -->
                <div class="mega-menu-content">
                  <div class="row">
                    <div class="col-xl-3">
                      <div class="menu-content-list">
                        <a href="index-main.html" class="menu-content-list__link">Main Demo <span class="badge hot">Hot</span></a>
                        <a href="index-course-hub.html" class="menu-content-list__link">Course Hub</a>
                        <a href="index-online-academy.html" class="menu-content-list__link">Online Academy <span class="badge hot">Hot</span></a>
                        <a href="index-university.html" class="menu-content-list__link">University</a>
                        <a href="index-education-center.html" class="menu-content-list__link">Education Center <span class="badge hot">Hot</span></a>
                      </div>
                    </div>
                    <div class="col-xl-3">
                      <div class="menu-content-list">
                        <a href="index-language-academic.html" class="menu-content-list__link">Language Academic</a>
                        <a href="index-single-instructor.html" class="menu-content-list__link">Single Instructor</a>
                        <a href="index-dev.html" class="menu-content-list__link">Dev <span class="badge new">New</span></a>
                        <a href="index-online-art.html" class="menu-content-list__link">Online Art <span class="badge new">New</span></a>
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="menu-content-banner" style="background-image: url(assets/images/home-megamenu-bg.jpg);">
                        <h4 class="menu-content-banner__title">Achieve Your Goals With EduMall</h4>
                        <a href="#" class="menu-content-banner__btn btn btn-primary btn-hover-secondary">Purchase now</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Mega Menu Content Start -->
              </li>
            </ul>




          </li>
          <li>
            <a href="#"><span>Courses</span></a>
            <ul class="sub-menu">
              <li><a href="course-grid-01.html"><span>Grid Basic Layout</span></a></li>
              <li><a href="course-grid-02.html"><span>Grid Modern Layout</span></a></li>
              <li><a href="course-grid-left-sidebar.html"><span>Grid Left Sidebar</span></a></li>
              <li><a href="course-grid-right-sidebar.html"><span>Grid Right Sidebar</span></a></li>
              <li><a href="course-list.html"><span>List Basic Layout</span></a></li>
              <li><a href="course-list-left-sidebar.html"><span>List Left Sidebar</span></a></li>
              <li><a href="course-list-right-sidebar.html"><span>List Right Sidebar</span></a></li>
              <li><a href="course-category.html"><span>Category Page</span></a></li>
              <li>
                <a href="#"><span>Single Layout</span></a>
                <ul class="sub-menu">
                  <li><a href="course-single-layout-01.html"><span>Layout 01</span></a></li>
                  <li><a href="course-single-layout-02.html"><span>Layout 02</span></a></li>
                  <li><a href="course-single-layout-03.html"><span>Layout 03</span></a></li>
                  <li><a href="course-single-layout-04.html"><span>Layout 04</span></a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Blog</span></a>
            <ul class="sub-menu">
              <li><a href="blog-grid-01.html"><span>Grid Basic Layout</span></a></li>
              <li><a href="blog-grid-02.html"><span>Grid Wide</span></a></li>
              <li><a href="blog-grid-left-sidebar.html"><span>Grid Left Sidebar</span></a></li>
              <li><a href="blog-grid-right-sidebar.html"><span>Grid Right Sidebar</span></a></li>
              <li><a href="blog-list-style-01.html"><span>List Layout 01</span></a></li>
              <li><a href="blog-list-style-02.html"><span>List Layout 02</span></a></li>
              <li>
                <a href="#"><span>Single Layouts</span></a>
                <ul class="sub-menu">
                  <li><a href="blog-details-left-sidebar.html"><span>Left Sidebar</span></a></li>
                  <li><a href="blog-details-right-sidebar.html"><span>Right Sidebar</span></a></li>
                  <li><a href="blog-details.html"><span>No Sidebar</span></a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Pages</span></a>
            <ul class="sub-menu">
              <li><a href="become-an-instructor.html"><span>Become an Instructor</span></a></li>
              <li>
                <a href="instructors.html"><span>Instructor</span></a>
                <ul class="sub-menu">
                  <li><a href="dashboard-my-courses.html"><span>My Courses</span></a></li>
                  <li><a href="dashboard-announcement.html"><span>Announcements</span></a></li>
                  <li><a href="dashboard-withdraw.html"><span>Withdrawals</span></a></li>
                  <li><a href="dashboard-quiz-attempts.html"><span>Quiz Attempts</span></a></li>
                  <li><a href="dashboard-question-answer.html"><span>Question & Answer</span></a></li>
                  <li><a href="dashboard-assignments.html"><span>Assignments</span></a></li>
                  <li><a href="dashboard-students.html"><span>My Students</span></a></li>
                </ul>
              </li>
              <li><a href="about.html"><span>About us</span></a></li>
              <li><a href="about-02.html"><span>About us 02</span></a></li>
              <li><a href="contact-us.html"><span>Contact us</span></a></li>
              <li><a href="contact-us-02.html"><span>Contact us 02</span></a></li>
              <li><a href="membership-plans.html"><span>Membership plans</span></a></li>
              <li><a href="faqs.html"><span>FAQs</span></a></li>
              <li><a href="404-page.html"><span>404 Page</span></a></li>
              <li>
                <a href="#"><span>Dashboard</span></a>
                <ul class="sub-menu">
                  <li><a href="dashboard-index.html"><span>Dashboard</span></a></li>
                  <li><a href="dashboard-student-index.html"><span>Dashboard Student</span></a></li>
                  <li><a href="dashboard-profile.html"><span>My Profile</span></a></li>
                  <li><a href="dashboard-all-course.html"><span>Enrolled Courses</span></a></li>
                  <li><a href="dashboard-wishlist.html"><span>Wishlist</span></a></li>
                  <li><a href="dashboard-reviews.html"><span>Reviews</span></a></li>
                  <li><a href="dashboard-my-quiz-attempts.html"><span>My Quiz Attempts</span></a></li>
                  <li><a href="dashboard-purchase-history.html"><span>Purchase History</span></a></li>
                  <li><a href="dashboard-settings.html"><span>Settings</span></a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Features</span></a>
            <ul class="sub-menu">
              <li><a href="#"><span>Events</span></a>
                <ul class="sub-menu">
                  <li><a href="event-grid-sidebar.html"><span>Event Listing 01</span></a></li>
                  <li><a href="event-grid.html"><span>Event Listing 02</span></a></li>
                  <li><a href="event-list.html"><span>Event Listing 03</span></a></li>
                  <li><a href="event-list-sidebar.html"><span>Event Listing 04</span></a></li>
                  <li>
                    <a href="#"><span>Single Layouts</span></a>
                    <ul class="sub-menu">
                      <li><a href="event-details-layout-01.html"><span>Layout 01</span></a></li>
                      <li><a href="event-details-layout-02.html"><span>Layout 02</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#"><span>Shop</span></a>
                <ul class="sub-menu">
                  <li><a href="shop-default.html"><span>Shop – Default</span></a></li>
                  <li><a href="shop-left-sidebar.html"><span>Shop – Left Sidebar</span></a></li>
                  <li><a href="shop-right-sidebar.html"><span>Shop – Right Sidebar</span></a></li>
                  <li><a href="my-account.html"><span>My account</span></a></li>
                  <li><a href="wishlist.html"><span>Wishlist</span></a></li>
                  <li><a href="cart.html"><span>Cart</span></a></li>
                  <li><a href="cart-empty.html"><span>Cart Empty</span></a></li>
                  <li><a href="checkout.html"><span>Checkout</span></a></li>
                  <li>
                    <a href="#"><span>Single Layouts</span></a>
                    <ul class="sub-menu">
                      <li><a href="shop-single-list-left-sidebar.html"><span>List – Left Sidebar</span></a></li>
                      <li><a href="shop-single-list-right-sidebar.html"><span>List – Right Sidebar</span></a></li>
                      <li><a href="shop-single-list-no-sidebar.html"><span>List – No Sidebar</span></a></li>
                      <li><a href="shop-single-tab-left-sidebar.html"><span>Tabs – Left Sidebar</span></a></li>
                      <li><a href="shop-single-tab-right-sidebar.html"><span>Tabs – Right Sidebar</span></a></li>
                      <li><a href="shop-single-tab-no-sidebar.html"><span>Tabs – No Sidebar</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="zoom-meetings.html"><span>Zoom Meetings</span></a></li>
              <li><a href="zoom-meetings-single.html"><span>Zoom Meeting Single</span></a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Header User Button Start -->
    <div class="offcanvas-user d-lg-none">
      <div class="offcanvas-user__button">
        <a class="offcanvas-user__login btn btn-secondary btn-hover-secondarys" href="/user/login">Đăng nhập</a>
      </div>
    </div>
    <!-- Header User Button End -->

  </div>
  <!-- Offcanvas End -->

  <!-- Tutor Course Main content Start -->
  <div class="tutor-course-main-content section-padding-01 sticky-parent">
    <div class="container custom-container">

      <div class="row gy-10">
        <?php
        $cls = 12;
        if ($page['sidebar_right']) {
          $cls = 8;
        }?>
        <div class="col-xl-<?=$cls?> col-lg-<?=$cls?>">
          <?php print $messages; ?>
          <?php if ($tabs): ?>
            <div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
          <?php print render($page['help']); ?>
          <?php if ($action_links): ?>
            <ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

          <?= render($page['content']);?>
          <?php if ($page['assginment_detail']) print render($page['assginment_detail'])?>
        </div>
        <?php
        if ($page['sidebar_right']):
        ?>
        <div class="col-lg-4">

          <!-- Tutor Course Sidebar Start -->
          <div class="tutor-course-sidebar sidebar-label">
            <?= render($page['sidebar_right'])?>

            <!-- Sidebar Widget End -->

          </div>
          <!-- Tutor Course Sidebar End -->

        </div>
      <?php endif;?>
      </div>


    </div>
  </div>
  <!-- Tutor Course Main content End -->

  <!-- Footer Start -->
  <div class="footer-section footer-bg-1">

    <!-- Footer Widget Area Start -->
    <div class="footer-widget-area section-padding-01">
      <div class="container">
        <div class="row gy-6">
          <div class="col-lg-8">
            <div class="row gy-6">

              <div class="col-sm-4">
                <!-- Footer Widget Start -->
                <div class="footer-widget">
                  <h4 class="footer-widget__title">About</h4>

                  <ul class="footer-widget__link">
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="course-grid-left-sidebar.html">Courses</a></li>
                    <li><a href="instructors.html">Instructor</a></li>
                    <li><a href="event-grid-sidebar.html">Events</a></li>
                    <li><a href="become-an-instructor.html">Become A Teacher</a>
                    </li>
                  </ul>
                </div>
                <!-- Footer Widget End -->
              </div>
              <div class="col-sm-4">
                <!-- Footer Widget Start -->
                <div class="footer-widget">
                  <h4 class="footer-widget__title">Links</h4>

                  <ul class="footer-widget__link">
                    <li><a href="blog-grid-left-sidebar.html">News & Blogs</a>
                    </li>
                    <li><a href="#">Library</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Partners</a></li>
                    <li><a href="#">Career</a></li>
                  </ul>
                </div>
                <!-- Footer Widget End -->
              </div>
              <div class="col-sm-4">
                <!-- Footer Widget Start -->
                <div class="footer-widget">
                  <h4 class="footer-widget__title">Support</h4>

                  <ul class="footer-widget__link">
                    <li><a href="#">Documentation</a></li>
                    <li><a href="faqs.html">FAQs</a></li>
                    <li><a href="#">Forum</a></li>
                    <li><a href="#">Sitemap</a></li>
                  </ul>
                </div>
                <!-- Footer Widget End -->
              </div>

            </div>
          </div>
          <div class="col-lg-4">
            <!-- Footer Widget Start -->
            <div class="footer-widget text-center">
              <?php if ($logo): ?>
                <a href="<?php print $front_page; ?>"
                   title="<?php print t('Edupen'); ?>" rel="home" id="logo"
                   class="footer-widget__logo">
                  <img src="<?php print $logo; ?>"
                       alt="<?php print t('Home'); ?>"
                       width="150" height="32"/>
                </a>
              <?php endif; ?>
              <div class="footer-widget__social">
                <a href="https://twitter.com/" target="_blank"><i
                    class="fab fa-twitter"></i></a>
                <a href="https://www.facebook.com/" target="_blank"><i
                    class="fab fa-facebook-f"></i></a>
                <a href="https://www.linkedin.com/" target="_blank"><i
                    class="fab fa-linkedin-in"></i></a>
                <a href="https://www.youtube.com/" target="_blank"><i
                    class="fab fa-youtube"></i></a>
              </div>
              <p class="footer-widget__copyright">&copy; 2022
                <span> Edupen </span></p>
              <ul
                class="footer-widget__link flex-row gap-8 justify-content-center">
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Privacy Policy</a></li>
              </ul>
            </div>
            <!-- Footer Widget End -->
          </div>
        </div>
      </div>
    </div>
    <!-- Footer Widget Area End -->

  </div>
  <!-- Footer End -->

  <!--Back To Start-->
  <button id="backBtn" class="back-to-top backBtn">
    <i class="arrow-top fal fa-long-arrow-up"></i>
    <i class="arrow-bottom fal fa-long-arrow-up"></i>
  </button>
  <!--Back To End-->


</main>
