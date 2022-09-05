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
<main class="main-wrapper">

  <?php
  global $user;
  $avatar = '';
  if($user->uid == 0){
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

  <!-- Header End -->


  <!-- Page Banner Section Start -->
  <div class="page-banner bg-color-11">
    <div class="page-banner__wrapper">
      <div class="container">

        <!-- Page Breadcrumb Start -->
        <div class="page-breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active"><?= $node->title ?></li>
          </ul>
        </div>
        <!-- Page Breadcrumb End -->

      </div>
    </div>
  </div>
  <!-- Page Banner Section End -->

  <!-- Offcanvas Start -->
  <div class="offcanvas offcanvas-end offcanvas-mobile" id="offcanvasMobileMenu"
       style="background-image: url(assets/images/mobile-bg.jpg);">
    <div class="offcanvas-header bg-white">
      <div class="offcanvas-logo">
        <a class="offcanvas-logo__logo" href="#"><img
            src="assets/images/dark-logo.png" alt="Logo"></a>
      </div>
      <button type="button" class="offcanvas-close" data-bs-dismiss="offcanvas">
        <i class="fal fa-times"></i></button>
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
                        <a href="index-main.html"
                           class="menu-content-list__link">Main Demo <span
                            class="badge hot">Hot</span></a>
                        <a href="index-course-hub.html"
                           class="menu-content-list__link">Course Hub</a>
                        <a href="index-online-academy.html"
                           class="menu-content-list__link">Online Academy <span
                            class="badge hot">Hot</span></a>
                        <a href="index-university.html"
                           class="menu-content-list__link">University</a>
                        <a href="index-education-center.html"
                           class="menu-content-list__link">Education Center
                          <span class="badge hot">Hot</span></a>
                      </div>
                    </div>
                    <div class="col-xl-3">
                      <div class="menu-content-list">
                        <a href="index-language-academic.html"
                           class="menu-content-list__link">Language Academic</a>
                        <a href="index-single-instructor.html"
                           class="menu-content-list__link">Single Instructor</a>
                        <a href="index-dev.html"
                           class="menu-content-list__link">Dev <span
                            class="badge new">New</span></a>
                        <a href="index-online-art.html"
                           class="menu-content-list__link">Online Art <span
                            class="badge new">New</span></a>
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="menu-content-banner"
                           style="background-image: url(assets/images/home-megamenu-bg.jpg);">
                        <h4 class="menu-content-banner__title">Achieve Your
                          Goals With EduMall</h4>
                        <a href="#"
                           class="menu-content-banner__btn btn btn-primary btn-hover-secondary">Purchase
                          now</a>
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
              <li><a
                  href="course-grid-01.html"><span>Grid Basic Layout</span></a>
              </li>
              <li><a href="course-grid-02.html"><span>Grid Modern Layout</span></a>
              </li>
              <li><a href="course-grid-left-sidebar.html"><span>Grid Left Sidebar</span></a>
              </li>
              <li><a href="course-grid-right-sidebar.html"><span>Grid Right Sidebar</span></a>
              </li>
              <li><a href="course-list.html"><span>List Basic Layout</span></a>
              </li>
              <li><a href="course-list-left-sidebar.html"><span>List Left Sidebar</span></a>
              </li>
              <li><a href="course-list-right-sidebar.html"><span>List Right Sidebar</span></a>
              </li>
              <li><a href="course-category.html"><span>Category Page</span></a>
              </li>
              <li>
                <a href="#"><span>Single Layout</span></a>
                <ul class="sub-menu">
                  <li><a
                      href="course-single-layout-01.html"><span>Layout 01</span></a>
                  </li>
                  <li><a
                      href="course-single-layout-02.html"><span>Layout 02</span></a>
                  </li>
                  <li><a
                      href="course-single-layout-03.html"><span>Layout 03</span></a>
                  </li>
                  <li><a
                      href="course-single-layout-04.html"><span>Layout 04</span></a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Blog</span></a>
            <ul class="sub-menu">
              <li><a href="blog-grid-01.html"><span>Grid Basic Layout</span></a>
              </li>
              <li><a href="blog-grid-02.html"><span>Grid Wide</span></a></li>
              <li><a
                  href="blog-grid-left-sidebar.html"><span>Grid Left Sidebar</span></a>
              </li>
              <li><a href="blog-grid-right-sidebar.html"><span>Grid Right Sidebar</span></a>
              </li>
              <li><a href="blog-list-style-01.html"><span>List Layout 01</span></a>
              </li>
              <li><a href="blog-list-style-02.html"><span>List Layout 02</span></a>
              </li>
              <li>
                <a href="#"><span>Single Layouts</span></a>
                <ul class="sub-menu">
                  <li><a href="blog-details-left-sidebar.html"><span>Left Sidebar</span></a>
                  </li>
                  <li><a href="blog-details-right-sidebar.html"><span>Right Sidebar</span></a>
                  </li>
                  <li><a href="blog-details.html"><span>No Sidebar</span></a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Pages</span></a>
            <ul class="sub-menu">
              <li><a
                  href="become-an-instructor.html"><span>Become an Instructor</span></a>
              </li>
              <li>
                <a href="instructors.html"><span>Instructor</span></a>
                <ul class="sub-menu">
                  <li><a
                      href="dashboard-my-courses.html"><span>My Courses</span></a>
                  </li>
                  <li><a
                      href="dashboard-announcement.html"><span>Announcements</span></a>
                  </li>
                  <li><a href="dashboard-withdraw.html"><span>Withdrawals</span></a>
                  </li>
                  <li><a
                      href="dashboard-quiz-attempts.html"><span>Quiz Attempts</span></a>
                  </li>
                  <li><a href="dashboard-question-answer.html"><span>Question & Answer</span></a>
                  </li>
                  <li><a
                      href="dashboard-assignments.html"><span>Assignments</span></a>
                  </li>
                  <li><a href="dashboard-students.html"><span>My Students</span></a>
                  </li>
                </ul>
              </li>
              <li><a href="about.html"><span>About us</span></a></li>
              <li><a href="about-02.html"><span>About us 02</span></a></li>
              <li><a href="contact-us.html"><span>Contact us</span></a></li>
              <li><a href="contact-us-02.html"><span>Contact us 02</span></a>
              </li>
              <li><a href="membership-plans.html"><span>Membership plans</span></a>
              </li>
              <li><a href="faqs.html"><span>FAQs</span></a></li>
              <li><a href="404-page.html"><span>404 Page</span></a></li>
              <li>
                <a href="#"><span>Dashboard</span></a>
                <ul class="sub-menu">
                  <li><a href="dashboard-index.html"><span>Dashboard</span></a>
                  </li>
                  <li><a href="dashboard-student-index.html"><span>Dashboard Student</span></a>
                  </li>
                  <li><a
                      href="dashboard-profile.html"><span>My Profile</span></a>
                  </li>
                  <li><a
                      href="dashboard-all-course.html"><span>Enrolled Courses</span></a>
                  </li>
                  <li><a
                      href="dashboard-wishlist.html"><span>Wishlist</span></a>
                  </li>
                  <li><a href="dashboard-reviews.html"><span>Reviews</span></a>
                  </li>
                  <li><a href="dashboard-my-quiz-attempts.html"><span>My Quiz Attempts</span></a>
                  </li>
                  <li><a href="dashboard-purchase-history.html"><span>Purchase History</span></a>
                  </li>
                  <li><a
                      href="dashboard-settings.html"><span>Settings</span></a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><span>Features</span></a>
            <ul class="sub-menu">
              <li><a href="#"><span>Events</span></a>
                <ul class="sub-menu">
                  <li><a
                      href="event-grid-sidebar.html"><span>Event Listing 01</span></a>
                  </li>
                  <li><a
                      href="event-grid.html"><span>Event Listing 02</span></a>
                  </li>
                  <li><a
                      href="event-list.html"><span>Event Listing 03</span></a>
                  </li>
                  <li><a
                      href="event-list-sidebar.html"><span>Event Listing 04</span></a>
                  </li>
                  <li>
                    <a href="#"><span>Single Layouts</span></a>
                    <ul class="sub-menu">
                      <li><a
                          href="event-details-layout-01.html"><span>Layout 01</span></a>
                      </li>
                      <li><a
                          href="event-details-layout-02.html"><span>Layout 02</span></a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#"><span>Shop</span></a>
                <ul class="sub-menu">
                  <li><a
                      href="shop-default.html"><span>Shop – Default</span></a>
                  </li>
                  <li><a
                      href="shop-left-sidebar.html"><span>Shop – Left Sidebar</span></a>
                  </li>
                  <li><a href="shop-right-sidebar.html"><span>Shop – Right Sidebar</span></a>
                  </li>
                  <li><a href="my-account.html"><span>My account</span></a></li>
                  <li><a href="wishlist.html"><span>Wishlist</span></a></li>
                  <li><a href="cart.html"><span>Cart</span></a></li>
                  <li><a href="cart-empty.html"><span>Cart Empty</span></a></li>
                  <li><a href="checkout.html"><span>Checkout</span></a></li>
                  <li>
                    <a href="#"><span>Single Layouts</span></a>
                    <ul class="sub-menu">
                      <li><a href="shop-single-list-left-sidebar.html"><span>List – Left Sidebar</span></a>
                      </li>
                      <li><a href="shop-single-list-right-sidebar.html"><span>List – Right Sidebar</span></a>
                      </li>
                      <li><a href="shop-single-list-no-sidebar.html"><span>List – No Sidebar</span></a>
                      </li>
                      <li><a href="shop-single-tab-left-sidebar.html"><span>Tabs – Left Sidebar</span></a>
                      </li>
                      <li><a href="shop-single-tab-right-sidebar.html"><span>Tabs – Right Sidebar</span></a>
                      </li>
                      <li><a href="shop-single-tab-no-sidebar.html"><span>Tabs – No Sidebar</span></a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="zoom-meetings.html"><span>Zoom Meetings</span></a>
              </li>
              <li><a
                  href="zoom-meetings-single.html"><span>Zoom Meeting Single</span></a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Header User Button Start -->
    <div class="offcanvas-user d-lg-none">
      <div class="offcanvas-user__button">
        <a class="offcanvas-user__login btn btn-secondary btn-hover-secondarys"
           href="/user/login">Đăng nhập</a>
      </div>
    </div>
    <!-- Header User Button End -->

  </div>
  <!-- Offcanvas End -->

  <!-- Tutor Course Main content Start -->
  <div class="tutor-course-main-content sticky-parent">
    <div class="container">
      <?php print $messages; ?>
      <div class="row gy-10">
        <?php $cls = 12;?>
        <?php if ($page['sidebar_right']){
          $cls = 8;
        }?>

        <div class="col-lg-<?=$cls?>">
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
          <h4 class="title"><?=$title?></h4>

          <?php print render($page['exam_detail']); ?>
          <?php print render($page['content']); ?>
          <div class="tutor-course-segment">
            <div class="tutor-course-segment__reviews">
              <button class="tutor-course-segment__btn btn btn-primary btn-hover-secondary" data-bs-toggle="collapse" data-bs-target="#collapseForm">Feedback</button>
              <div class="collapse" id="collapseForm">
                <!-- Comment Form Start -->
                <div class="comment-form">
                  <?php
                  $node = node_load(80);
                  webform_node_view($node,'full');
                  print theme_webform_view($node->content);
                  ?>
                </div>
                <!-- Comment Form End -->
              </div>
            </div>
          </div>
        </div>
        <?php if ($page['sidebar_right']):?>
          <div class="col-lg-4">

            <!-- Tutor Course Sidebar Start -->
            <div class="tutor-course-sidebar sidebar-label">

              <!-- Tutor Course Price Preview Start -->
              <?php print render($page['sidebar_right']); ?>

            </div>

          </div>
        <?php endif;?>
      </div>



    </div>
  </div>
  <!-- Tutor Course Main content End -->

  <!-- Footer Start -->
  <div class="footer-section bg-color-10">

    <!-- Footer Widget Area Start -->
    <div class="footer-widget-area">
      <div class="container">
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

  <!-- Footer End -->

  <!--Back To Start-->
  <button id="backBtn" class="back-to-top backBtn">
    <i class="arrow-top fal fa-long-arrow-up"></i>
    <i class="arrow-bottom fal fa-long-arrow-up"></i>
  </button>
  <!--Back To End-->
</main>
<div class="modal fade" id="answersModal">
  <div class="modal-dialog modal-dialog-centered modal-login">

    <!-- Modal Wrapper Start -->
    <div class="modal-wrapper">
      <button class="modal-close" data-bs-dismiss="modal"><i
          class="fal fa-times"></i></button>

      <!-- Modal Content Start -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Chúc mừng bạn đã hoàn thành đề thi</h5>
        </div>
        <div class="modal-body">
          <a href="#" class="btn btn-primary btn-hover-secondary w-100">Xem chi
            tiết bài làm</a>
        </div>
      </div>
      <!-- Modal Content End -->

    </div>
    <!-- Modal Wrapper End -->

  </div>
</div>

