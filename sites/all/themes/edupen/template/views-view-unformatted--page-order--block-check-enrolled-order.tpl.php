<?php $nid = arg(1);
foreach ($rows as $row){
  $arr_trim[] = trim($row);
}
?>

<?php $arr_unique = array_unique($arr_trim);?>
<?php
if (in_array($nid,$arr_unique)):?>
  <?php
  $node = node_load($nid);
  ?>
<h3>Chọn đáp án đúng</h3>
  <div class="js-de-thi" data-question="<?=$node->field_so_cau_hoi['und'][0]['value']?>" data-value="<?=$node->nid?>" data-time="<?=$node->field_thoi_gian_thi['und'][0]['value']?>"></div>
<?php else:?>
<?php print views_embed_view('view_sidebar_node','block_form_mua_tai_lieu_detail');?>
<?php endif;?>

