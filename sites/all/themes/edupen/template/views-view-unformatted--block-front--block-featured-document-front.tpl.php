<div class="doc_tag_item wow fadeInUp">
  <div class="doc_tag_title">
    <h4>TÀI LIỆU NỔI BẬT</h4>
    <div class="line"></div>
  </div>
  <ul class="list-unstyled tag_list">
    <!--    [title]{{}}[field_so_cau_hoi]{{}}[field_thoi_gian_thi]{{}}[path]-->
    <?php foreach ($rows as $id => $row): ?>
      <?php $arr = explode('{{}}',$row) ; ?>
      <li>
        <div class="practice">
          <div class="left-practice">
            <h3><a href="<?=$arr[3]?>"><i class="fad fa-file-alt"></i> <?=$arr[0]?></a></h3>
            <span class="property-pratice"><i class="fal fa-alarm-clock"></i> <?=$arr[2]?> phút</span>
            <span class="property-pratice"><i class="fal fa-question-circle"></i> <?=$arr[1]?> câu hỏi</span>
            <span class="property-pratice"><i class="fal fa-eye"></i> <?=$arr[4]?> lượt xem</span>
            <span class="property-pratice"><i class="fal fa-pen-alt"></i> 0 lượt thi</span>
            <span class="property-pratice"><i class="fal fa-badge-dollar"></i> <?=$arr[5]?></span>
          </div>
          <div class="right-pratice">
            <a href="<?=$arr[3]?>" class="btn btn-primary">Đăng kí thi</a>
          </div>
        </div>

      </li>
    <?php endforeach; ?>
  </ul>
</div>
