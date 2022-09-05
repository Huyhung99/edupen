<!--[title]{{}}[field_dap_an_dung]{{}}[field_cau_tra_loi]{{}}[field_so_cau_hoi]{{}}[field_thoi_gian_con_lai]-->
<?php
function compare($param1,$param2,$resultString){
  $result = '';
  if ($param1 == $param2){
    $result = $resultString;
  }
  return $result;
}

?>
<?php foreach ($rows as $id => $row): ?>
  <?php $arr = explode('{{}}', $row); ?>
  <?php $dap_an = json_decode(html_entity_decode(($arr[1])));?>
  <?php $cau_tra_loi = json_decode(html_entity_decode($arr[2]));?>
  <?php for ($index = 0;$index<$arr[3]-1;$index++){
    if ($dap_an->data[$index]->cau === $cau_tra_loi->data[$index]->cau){
      $true_answers[] =  $cau_tra_loi->data[$index]->cau;
    }
  }
  ?>

  <div class="side-anwsers">
    <h1 class="title-bai-lam"><?=$arr[0]; ?></h1>
    <div class="countdown"><span class="text-black">Thời gian còn lại: </span><?=$arr[4];?></div>
    <span class="label">Đáp án đúng</span>:
    <span class="title-answer"><span
        class="js-answer-check"><?=count($true_answers)?></span>/<span><?=$arr[3]?></span></span>
    <div class="fb-share-button" data-href="https://edupen.vn/bai-lam-de-minh-hoa-tn-thpt-mon-vat-ly17082022" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ bài làm</a></div>
    <div class="answers">
      <?php $i = 1?>
      <?php for ($index = 0;$index<$arr[3];$index++):?>
        <div class="item-question" data-value="cau"><?= $index +1?>.
          <a class="selection <?=compare($dap_an->data[$index]->cau,$i.'-A','answer')?> <?=compare($cau_tra_loi->data[$index]->cau,$i.'-A','assignment')?> "  href="#" >A</a>
          <a class="selection <?=compare($dap_an->data[$index]->cau,$i.'-B','answer')?> <?=compare($cau_tra_loi->data[$index]->cau,$i.'-B','assignment')?>"  href="#" >B</a>
          <a class="selection <?=compare($dap_an->data[$index]->cau,$i.'-C','answer')?> <?=compare($cau_tra_loi->data[$index]->cau,$i.'-C','assignment')?>"  href="#" >C</a>
          <a class="selection <?=compare($dap_an->data[$index]->cau,$i.'-D','answer')?> <?=compare($cau_tra_loi->data[$index]->cau,$i.'-D','assignment')?>"  href="#" >D</a>
        </div>
      <?php $i++?>
      <?php endfor;?>
    </div>
  </div>
<?php endforeach; ?>


