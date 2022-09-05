<!--[title]{{}}[created]{{}}[field_cau_tra_loi]{{}}[field_dap_an_dung]{{}}[path]-->
<div class="dashboard-my-quiz-attempts">
  <div class="dashboard-table table-responsive">
    <table class="table">
      <thead>
      <tr>
        <th class="course-info">Tiêu đề</th>
        <th class="student">Câu trả lời đúng</th>
        <th class="correct">Câu trả lời sai</th>
        <th class="action"></th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($rows as $row):?>
      <?php  $arr = explode('{{}}',$row); ?>
        <?php $dap_an = json_decode(html_entity_decode(($arr[2])));?>
        <?php $cau_tra_loi = json_decode(html_entity_decode($arr[3]));?>
        <?php for ($index = 0;$index<$arr[5];$index++){
          if ($dap_an->data[$index]->cau === $cau_tra_loi->data[$index]->cau){
            $true_answers[] =  $cau_tra_loi->data[$index]->cau;
          }
        }
        ?>
        <tr>
          <td class="course-info">
            <h3 class="dashboard-table__title"><a href="<?=$arr[4]?>"><?=$arr[0]?></a></h3>
            <div class="dashboard-table__meta">
              <div class="dashboard-table__meta-item"><?= $arr[1]?></div>
              <div class="dashboard-table__meta-item">
                <span class="label">Câu hỏi: </span>
                <span class="value"> <?=$arr[5]?></span>
              </div>
              <div class="dashboard-table__meta-item">
                <span class="label">Tổng điểm: </span>
                <span class="value"> 10</span>
              </div>
            </div>
          </td>
          <td class="correct">
            <div class="dashboard-table__mobile-heading">Câu trả lời đúng</div>
            <div class="dashboard-table__text"> <?=count($true_answers)?></div>
          </td>
          <td class="incorrect">
            <div class="dashboard-table__mobile-heading">Câu trả lời sai</div>
            <div class="dashboard-table__text"> <?= $arr[5] - count($true_answers)?></div>
          </td>
          <td class="action">
            <a class="dashboard-table__link" href="<?=$arr[4]?>">Chi tiết</a>
          </td>
        </tr>
      <?php endforeach;?>

      </tbody>
    </table>
  </div>
</div>
