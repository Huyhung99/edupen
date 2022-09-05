
<div id="main-wrapper">
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <?= getNodeContent(18)?>
                </div>
            </div>
        </div>
    </div>
    <div class="header header-light">
        <div class="container">
            <nav id="navigation" class="navigation navigation-landscape">
                <div class="nav-header">
                    <?php if ($logo) : ?>
                        <a href="<?php print $front_page; ?>" title="<?php print t('RecoLand'); ?>" rel="home" id="logo" class="nav-brand">
                            <img src="<?php print $logo; ?>" alt="<?php print t('RecoLand'); ?>" />
                        </a>
                    <?php endif; ?>
                    <div class="nav-toggle"></div>

                </div>
                <div class="nav-menus-wrapper" style="transition-property: none;">
                    <?=getMainMenu()?>

                    <!--          <ul class="nav-menu nav-menu-social align-to-right">-->
                    <!---->
                    <!--            <li>-->
                    <!--              <a href="#" class="alio_green" data-toggle="modal" data-target="#login">-->
                    <!--                <i class="fas fa-sign-in-alt mr-1"></i><span class="dn-lg">Sign In</span>-->
                    <!--              </a>-->
                    <!--            </li>-->
                    <!--            <li class="add-listing">-->
                    <!--              <a href="submit-property.html"  class="theme-cl">-->
                    <!--                <i class="fas fa-plus-circle mr-1"></i>Add Property-->
                    <!--              </a>-->
                    <!--            </li>-->
                    <!--          </ul>-->
                </div>
            </nav>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="page-title" style="background:#f4f4f4 url(/sites/all/themes/recoland/assets/img/slider-3.jpg);" data-overlay="3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1 class="breadcrumb-title"><?=$title?></h1>
                    <div class="breadcrumbs-wrap">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item " aria-current="page"><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?=$title?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="gray pt-4">

        <div class="container">

            <div class="row m-0">
            </div>

            <div class="row">
                <?php
                $cls = 12;
                if ($page['sidebar_right']){
                    $cls = '8';
                }?>
                <div class="col-lg-<?=$cls?> col-md-<?=$cls?> col-sm-<?=$cls?>">
                    <?= $messages ?>
                    <?php if ($tabs) :
                        ?><div class="tabs"><?php print render($tabs); ?></div><?php
                    endif; ?>
                    <?php print render($page['help']); ?>
                    <?php if ($action_links) :
                        ?><ul class="action-links"><?php print render($action_links); ?></ul><?php
                    endif; ?>
                    <?php print render($page['content']); ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="property-sidebar">
                        <div class="agency_gridio_wrap">
                            <div class="agency_gridio_header" style="background:#d2382d url(<?php isset($node->field_image['und'][0]['uri']) ? print str_replace('public://','/sites/default/files/',$node->field_image['und'][0]['uri']) : print '';?>)no-repeat">
                                <span class="agents_count">DỰ ÁN</span>
                            </div>
                            <div class="agency_gridio_caption">
                                <div class="agency_gridio_thumb">
                                    <?php if ($logo) : ?>
                                        <a href="<?php print $front_page; ?>" title="<?php print t('logo bất động sản'); ?>" rel="home">
                                            <img src="<?php print $logo; ?>" alt="<?php print t('logo bất động sản'); ?>" title="logo bất động sản"/>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="agency_gridio_txt pl-10 pr-10">
                                    <h4><a href="<?=check_plain(url('node/'.$node->nid, array()))?>"><?=$node->title;?></a></h4>
                                    <a href="tel:0966867186" class="vew_agency_btn mt-15">Liên hệ</a>
                                </div>
                            </div>
                        </div>
                        <?php if($page['sidebar_right']):?>
                            <?php
                            print str_replace('<p>form-tim-kiem</p>' ,form_search(),  render($page['sidebar_right']));
                            ?>
                        <?php endif;?>
                        <?=views_embed_view('sidebar_right','block_du_an_lien_quan');?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="dark-footer skin-dark-footer style-2">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <?= html_entity_decode(getNodeContent(20))?>
                    </div>

                    <div class="col-lg-6 col-md-6 ml-auto">
                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-4">
                                <?= getNodeContent(21)?>
                            </div>

                            <div class="col-lg-8 col-md-4 col-8">
                                <?=getNodeContent(22)?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 text-center">
                        <p class="mb-0">© <?=date('Y')?> RECOLAND. Thiết kế bởi <a href="//andin.io">ANDIN JSC</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
</div>