<div class="swiper main-slider">
  <div class="swiper-wrapper">
    <?php foreach ($rows as $row):?>
    <div class="swiper-slide">
      <?=$row?>
    </div>
    <?php endforeach;?>
  </div>
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div>