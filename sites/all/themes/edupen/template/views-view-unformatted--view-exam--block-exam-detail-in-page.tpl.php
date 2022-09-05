<?php foreach ($rows as $id => $row): ?>
  <?php $arr = explode('{{}}', $row); ?>
  <div class="tutor-course-main-segment">
    <?= $arr[1] ?>
    <div class="tutor-course-segment">
      <?= $arr[2] ?>
    </div>
  </div>
<?= $arr[3]?>
<?php endforeach; ?>
