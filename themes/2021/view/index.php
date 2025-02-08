<?php require 'static/header.php' ?>
<?php if ($readTheme['slider']==1): ?>

    <?php if ($sliderTotal > 0): ?>

    <section id="slider" class="d-none d-lg-block">
        <div class="container<?=($readTheme['sliderType']==0)?'-fluid':''?>">
            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper-container swiper-main">
                        <div class="swiper-wrapper">
                        <?php foreach ($slider as $readSlider): ?>

                            <?php if ($readSlider['type']!=2): ?>

                                <div class="swiper-slide">
                                    <div class="col-md-6 swiper-img">
                                        <a href="<?=(!empty($readSlider['link']))?$readSlider['link']:'javascript:;'?>">
                                            <img src="<?=$find_read_page.$readSlider['image']?>">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="swiper-content">
                                            <span class="swiper-header"><?=$readSlider['heading']?></span>
                                            <div class="swiper-bar"></div>
                                            <div class="swiper-description">
                                                <?=$readSlider['content']?>
                                            </div>
                                            <?php if (!empty($readSlider['link'])): ?>
                                            <a href="<?=$readSlider['link']?>" class="btn-1 swiper-button">Devamını görüntüle <i class="mdi mdi-arrow-right"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php else: ?>

                                <div class="swiper-slide overflow-hidden">
                                    <div class="col-md-12 p-0 swiper-img">
                                        <a href="<?=(!empty($readSlider['link']))?$readSlider['link']:'javascript:;'?>">
                                            <img src="<?=$find_read_page.$readSlider['image']?>">
                                        </a>
                                    </div>
                                </div>

                            <?php endif; ?>

                        <?php endforeach; ?>
                        </div>

                        <div class="swiper-pagination"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php endif; ?>

<?php endif; ?>

<section id="news-list" class="min-height-500">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
            <?php if ($newsTotal > 0): ?>
                <div class="row">

                    <?php foreach ($news as $readNews): ?>

                        <?php if ($readTheme['newsCardType']==1): ?>

                            <div class="mb-3 col-md-12 col-lg-<?=($readTheme['sidebar']==1)?'6':'4'?>">
                                <div class="card news-card">

                                    <img class="card-img-top" src="<?=$find_read_page.$readNews['image']?>" alt="<?=$readNews['heading']?> - Haber Resim">

                                    <div class="card-body w-100 py-4 px-4">
                                        <h5 class="news-header d-block">
                                            <?=$readNews['heading']?>
                                        </h5>
                                        <small class="news-sub-header">
                                            <?=ConvertTime($readNews['creationDate'])?> 
                                            <span style="color: <?=$readNews['CategoryColor']?>;">
                                                <?=$readNews['CategoryHeading']?>
                                            </span> 
                                            kategorisinde yayınlandı.
                                        </small>
                                        <div class="news-description">
                                            <?php echo mb_substr(strip_tags($readNews["content"]), 0, 209, "utf-8")."..."; ?>   
                                        </div>
                                        <a href="haber/<?=$readNews['slug']?>" class="btn-1 news-button float-right" style="background-color: <?=$readNews['CategoryColor']?>;">
                                            Devamını görüntüle <i class="mdi mdi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>

                            <div class="col-lg-12 mb-3">
                                <div class="news-card">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="news-img">
                                                <img src="<?=$find_read_page.$readNews['image']?>" alt="<?=$readNews['heading']?> - Haber Resim">
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center ">
                                            <div class="news-body w-100 py-4 pl-4 pl-lg-1 pr-4">
                                                <h5 class="news-header d-block"><?=$readNews['heading']?></h5>
                                                <small class="news-sub-header"><?=ConvertTime($readNews['creationDate'])?> <span style="color: <?=$readNews['CategoryColor']?>;"><?=$readNews['CategoryHeading']?></span> kategorisinde yayınlandı.</small>
                                                <div class="news-description"><?php echo mb_substr(strip_tags($readNews["content"]), 0, 209, "utf-8")."..."; ?></div>
                                                <a href="haber/<?=$readNews['slug']?>" class="btn-1 news-button float-right" style="border-radius: 100px;box-shadow: none;background-color: <?=$readNews['CategoryColor']?>;">Devamını görüntüle <i class="mdi mdi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endforeach; ?>

                    <div class="col-12 mb-md-0 mb-3">
                        <div class="card-body pagination-card d-flex align-items-center justify-content-between">
                            <?php if ($prevPage == 0): ?>
                                <a href="javascript:;" class="btn btn-2 disabled">« Önceki</a>
                            <?php else: ?>
                                <a href="?haberler=<?=$prevPage?>" class="btn btn-2">« Önceki</a>
                            <?php endif; ?>
                            
                            <?php if ($totalPage == $_GET[$pageParam]): ?>
                                <a href="javascript:;" class="btn btn-2 disabled">Sonraki »</a>
                            <?php else: ?>
                                <a href="?haberler=<?=$nextPage?>" class="btn btn-2">Sonraki »</a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            <?php else: ?>

                <?=alert('danger', 'Henüz haber eklenmemiş.')?>

            <?php endif; ?>

            </div>

                <div class="col-lg-4 col-md-12">
                
                    <?php require 'static/sidebar.php' ?>
            
                </div>
            
            
            
        </div>
    </div>
</section>
<?php if(!isset($_SESSION['login'])):?>
    <section class="slice">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="slice-bg-div px-4 py-5" style="background: var(--slice-bg);overflow: hidden;border-radius: 6px;position: relative;background-position: center;">
                        <div class="slice-gradient" style="width: 100%;height: 100%;position: absolute;left: 0;top: 0;background: rgba(0, 0, 0, 0.6)"></div>
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-12 pb-3 pb-lg-0 text-center text-lg-left">
                                <div class="slice-content">
                                    <h2 class="text-white" style="font-weight: 800;">Türkiye'nin en iyisini deneyimlemeye ne dersin?</h2>
                                    <h2 class="mb-0" style="font-weight: 800;color: var(--primary);">Hemen ücretsiz kayıt ol ve aramıza katıl!</h2>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 text-center text-lg-right">
                                <div class="slice-bg">
                                    <a href="kayit-ol" class="btn-1 py-3 px-4 mr-2">Kayıt Ol</a>
                                    <a href="destek" class="btn-2 py-3 px-4">Daha Fazla Bilgi Al</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>
<?php require 'static/footer.php' ?>