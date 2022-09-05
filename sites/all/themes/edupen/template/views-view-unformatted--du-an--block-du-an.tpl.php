<div class="row">

    <?php foreach ($rows as $id => $row): ?>
        <?php
        $arr = explode('{{}}', $row);
        $title = trim($arr[0]);
        $field_images = explode('{,}',$arr[1]);
        $path = $arr[2];
        $field_muc_gia = $arr[3];
        $tong_tien_dau_tu = $arr[5];
        $field_phong_ngu = $arr[6];
        $field_phong_tam = $arr[7];
        $field_dien_tich = $arr[8];
        ?>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="property-listing property-2">

                <div class="listing-img-wrapper">
                    <div class="list-img-slide">
                        <div class="click">

                            <?php foreach ($field_images as $item):?>
                                <?php if ($item != ' '):?>
                                    <div><a href="<?=$path?>" title="<?=$title?>"><?=$item?></a></div>
                                <?php endif?>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="listing-detail-wrapper">
                    <div class="listing-short-detail-wrap">
                        <div class="_card_list_flex">
                            <div class="_card_flex_01">
                                <h4 class="listing-name verified"><a href="<?=$path?>" class="prt-link-detail"><?=$title?></a></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="price-features-wrapper">
                    <div class="list-fx-features">
                        <?=$field_phong_ngu?>
                        <?=$field_phong_tam?>
                        <?=$field_dien_tich?>
                    </div>
                </div>
                <div class="listing-detail-footer">
                    <div class="footer-flex">
                        <a href="<?=$path?>" class="prt-view">XEM THÊM</a>
                    </div>
                    <div class="footer-first">
                        <h6 class="listing-card-info-price mb-0 p-0"><?=$tong_tien_dau_tu?></h6>
                    </div>

                </div>
            </div>
        </div>

    <?php endforeach;?>
</div>