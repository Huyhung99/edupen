<div class="home-slider margin-bottom-0">
  <?php foreach ($rows as $id => $row): ?>
    <?php
    $arr = explode('{{}}', $row);
    $title = $arr[0];
    $field_caption = $arr[1];
    $field_image = $arr[2];
    $field_link = $arr[3];
    $description = $arr[4];
    ?>
    <div data-background-image="<?= trim($field_image) ?>" class="item">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="home-slider-container">
              <!-- Slide Title -->
              <div class="home-slider-desc">
                <div class="home-slider-title">
                  <h2><?= $field_caption ?></h2>
                </div>
                <div class="row">
                  <div class="col-md-8 mx-auto">
                    <p class="text-white"><?= $description ?></p>
                  </div>
                </div>
                <a href="tel:0966867186" class="read-more theme-bg">LIÊN HỆ <i class="fa fa-arrow-right ml-2"></i></a>
              </div>
              <!-- Slide Title / End -->
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

