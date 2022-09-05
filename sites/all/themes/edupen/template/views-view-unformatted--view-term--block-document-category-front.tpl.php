
<div class="categories-section section-padding-02">
  <div class="container">
    <div class="section-title aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
      <h2 class="section-title__title">DANH MỤC TÀI LIỆU</h2>
    </div>
    <div class="row g-6">
      <?php foreach ($rows as $id => $row): ?>
        <?php $arr = explode('{{}}',$row); ?>
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="categories-item aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000">
            <a class="categories-item__link" href="<?=$arr[1]?>">
              <div class="categories-item__info">
                <h3 class="categories-item__name"><?=$arr[0]?></h3>
              </div>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
