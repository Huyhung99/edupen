<?php foreach ($rows as $row):?>
  <?php
  $arr = explode('{{}}',$row);
  ?>
  <div class="dashboard-header__user">
    <div class="dashboard-header__user-avatar">
      <?= $arr[1]?>
    </div>
    <div class="dashboard-header__user-info">
      <h4 class="dashboard-header__user-name"><span class="welcome-text"> <?= $arr[0]?>
      </h4>
    </div>
  </div>
<?php
endforeach;
?>

