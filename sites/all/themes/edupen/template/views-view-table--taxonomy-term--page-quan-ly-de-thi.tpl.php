<?php $arr=[0=>'5%',1=>'20%',2=>'5%',3=>'5%',4=>'5%',5=>'5%',6=>'5%']?>
<?php
$array_new=get_breadcrumb();
?>
    <div class="table-responsive">
        <table class="views-table cols-4 table table-bordered  table-hover mb-0 mt-3">
          <?php if (!empty($header)) : ?>
              <thead>
              <tr>
                <?php foreach ($header as $field => $label): ?>
                    <th >
                      <?php print $label; ?>
                    </th>
                <?php endforeach; ?>
              </tr>
              </thead>
          <?php endif; ?>
          <?php $ds_nid=array();?>
          <?php foreach ($rows as $row_count => $row): ?>
              <tr <?php if ($row_classes[$row_count]): ?> class="<?php print implode(' ', $row_classes[$row_count]); ?>"<?php endif; ?>>
                <?php foreach ($row as $field => $content): ?>
                    <td <?php if ($field_classes[$field][$row_count]): ?> class="<?php print $field_classes[$field][$row_count]; ?>"<?php endif; ?><?php print drupal_attributes($field_attributes[$field][$row_count]); ?>>
                      <?php if(strlen($content)-strlen(str_replace('{{}}','',$content))!=0):?>
                        <?php $content_str=explode('{{}}',$content);?>
                        <?=$content_str[0];?>
                        <?php array_push($ds_nid,$content_str[1]);?>
                      <?php else:?>
                        <?php if(strlen($content)-strlen(str_replace('{{-}}','',$content))!=0):?>
                            <?php $arr_content=explode('{{-}}',$content)?>
                            <a href="<?=$arr_content[2]?>"><?=$arr_content[0]?></a><p class="breadcrumb_manager_examp"><?=$array_new[$arr_content[1]];?></p>
                        <?php else:?>
                          <?=$content?>
                        <?php endif;?>
                      <?php endif;?>
                    </td>
                <?php endforeach; ?>
              </tr>
          <?php endforeach; ?>
        </table>
    </div>
<?php foreach ($ds_nid as $nid):?>
<div class="modal fade dethi_form" id="exampleModal_<?=$nid?>" tabindex="-1"
     aria-labelledby="exampleModalLabel_<?=$nid?>" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title_white" id="exampleModalLabel_<?=$nid?>">Sửa đề thi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">X
                </button>
            </div>
            <div class="modal-body">
                <?php
                    module_load_include('inc', 'node', 'node.pages');
                    $node=node_load($nid);
                    $node_new=node_page_edit($node);
                    print render($node_new);
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"
                        data-bs-dismiss="modal">Đóng lại
                </button>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>




