
<section class="min">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
        <div class="sec-heading center">
          <h2>BÀI VIẾT</h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <?php foreach ($rows as $id => $row) : ?>
        <?php $arr = explode('{{}}', $row) ?>
        <?php $title = $arr[0] ?>
        <?php $field_image = $arr[1] ?>
        <?php $body = $arr[2] ?>
        <?php $path = $arr[3] ?>
        <?php $created = $arr[4] ?>
        <?php $created_1 = $arr[5] ?>
        <div class="col-lg-3 col-md-6">
          <div class="grid_blog_box">

            <div class="gtid_blog_thumb">
              <a href="<?=$path?>" title="<?=$title?>"><?=$field_image?></a>
            </div>
            <div class="blog-body">
              <h4 class="bl-title"><a href="<?=$path?>" title="<?=$title?>"><?=$title?></a></h4>
              <p><?=$body?><a href="<?=$path?>" class="btn-link">Xem thêm</a></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
