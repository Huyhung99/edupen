<!--[title]{{}}[field_image]{{}}[path]{{}}[field_muc_gia]{{}}[field_muc_gia]-->
<div class="sidebar-widgets">

    <h4><?=$view->get_title()?></h4>

    <div class="sidebar_featured_property">

        <?php foreach ($rows as $id => $row) : ?>
            <?php $arr = explode('{{}}', $row) ?>
            <?php $title = $arr[0] ?>
            <?php $field_image = $arr[1] ?>
            <?php $path = $arr[2] ?>
            <?php $price = $arr[4] ?>
            <div class="sides_list_property">
                <div class="sides_list_property_thumb">
                    <?=$field_image?>
                </div>
                <div class="sides_list_property_detail">
                    <h4 class="pb-0"><a href="<?=$path?>"><?=$title?></a></h4>
                    <div class="lists_property_price">
                        <div class="lists_property_price_value">
                            <?=$price?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
