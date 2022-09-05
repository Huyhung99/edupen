<?php foreach ($rows as $id => $row): ?>
  <?php $arr = explode('{{}}', $row); ?>
  <!-- Tutor Course Top Info Start -->
  <!--  [title]{{}}[add_to_cart_form]{{}}[c
  ommerce_price]-->
  <div class="tutor-course-price-preview">
    <div class="tutor-course-price-preview__price">
      <div class="tutor-course-price">
        <span class="sale-price"><?= $arr[2]?></span>
      </div>
    </div>
    <div class="tutor-course-price-preview__btn">
      <a href="#" class="btn btn-primary btn-hover-secondary w-100 js-submit-add-to-cart-form"> <i class="far fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
      <div class="d-none js-add-to-cart-form">
        <?=$arr[1]?>
      </div>
    </div>
    <div class="tutor-course-price-preview__social">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-linkedin-in"></i></a>
      <a href="#"><i class="fab fa-tumblr"></i></a>
    </div>

  </div>

<?php endforeach; ?>
