<?php require 'head.php'; ?>

<?php if ($readTheme['broadcast']==1 && $readTheme['headerTheme']=="0"): ?>

    <?php 

        $broadcastTotal = $db->from('Broadcast')->select('count(*) as total')->total();

        if ($broadcastTotal > 0):

            $broadcast = $db->from('Broadcast')->all();

    ?>

<marquee class="marquee">

    <?php foreach ($broadcast as $readBroadcast): ?>
    <a href="<?=(!empty($readBroadcast['link']))?$readBroadcast['link']:"javascript:;"?>"> <?=$readBroadcast['content']?> </a>
    <?php endforeach; ?>

</marquee>

    <?php endif; ?>

<?php endif; ?>


<section id="header">
    <div class="container<?=($readTheme['headerType']==0)?'-fluid':''?>">
        <div class="row">

            <div class="col-lg-4 mx-auto col-12">
                <div class="header-logo text-center">
                    <a href="./">
                        <img src="<?=$find_read_page.$readSettings['serverLogo']?>" class="img-fluid">
                    </a>
                </div>
                <div class="header-ip" onclick="copy('<?=$readSettings['serverIP']?>', '#serverIP')">
                    <span id="serverIP" class="text-uppercase">OYNA</span>
                </div>
                
            </div>


            <?php 

            if ($readTheme['broadcast']==1 && $readTheme['headerTheme']=="1"):

                $broadcastTotal = $db->from('Broadcast')->select('count(*) as total')->total();

                if ($broadcastTotal > 0):

                $broadcast = $db->from('Broadcast')->all();
            
            ?>
            <div class="col-lg-7 col-12 ml-auto swiper-broadcast-end align-items-end d-none d-lg-flex">
                <div class="swiper-container swiper-broadcast">
                    <div class="swiper-wrapper">
                        <?php foreach ($broadcast as $readBroadcast): ?>
                        <div class="swiper-slide">
                            <a href="<?=$readBroadcast['link']?>">
                                <div class="swiper-content">
                                    <span class="swiper-header"><?=$readBroadcast['heading']?></span>
                                    <p class="swiper-description"><?=$readBroadcast['content']?></p>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-line-left"></div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-line-right"></div>
            </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="navbar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <div class="navbar-brand d-block d-lg-none">
                        <img src="<?=$find_read_page.$readSettings['serverLogo']?>" class="img-fluid">
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mdi mdi-menu"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarMenu">
                        <ul class="navbar-nav mr-auto navbar-left">

                            <?php

                            $totalMenu = $db->from('Menu')->where('parent', '0')->select('count(*) as total')->total();

                            if ($totalMenu > 0):

                                $menu = $db->from('Menu')->where('parent', '0')->orderby('sort', 'ASC')->all();

                                foreach ($menu as $readMenu):

                                    $totalChild = $db->from('Menu')->where('parent', $readMenu['id'])->select('count(*) as total')->total();

                                    if ($totalChild > 0):

                                        $childs = $db->from('Menu')->where('parent', $readMenu['id'])->orderby('sort', 'ASC')->all();

                            ?>

                                        <li class="nav-item <?=($action[0]==$readMenu['link'])?'active':''?>">
                                            <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="item-icon">
                                                        <i class="mdi <?=$readMenu['icon']?>"></i>
                                                        <?=$readMenu['heading']?>
                                                    </span>
                                                    <span class="item-name"></span>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                
                                                <?php foreach ($childs as $readChild): ?>
                                                <a class="dropdown-item" href="/<?=$readChild['link']?>">
                                                    <?=$readChild['heading']?>
                                                </a>
                                                <?php endforeach; ?>
                                                
                                            </div>
                                        </li>

                                    <?php else: ?>
                                        <?php if($readMenu["heading"] == "Mağaza"):?>
                                            
                                        <li class="nav-item <?=($action[0]==$readMenu['link'])?'active':''?>">

                                            <a class="nav-link" href="/<?=$readMenu['link']?>">

                                                    <span class="item-icon">
                                                        <i class="mdi <?=$readMenu['icon']?>"></i>
                                                    </span>
                                                    <span class="item-name"><?=$readMenu['heading']?></span>
                                                    <?php if($productsdiscounted > 0):?>
                                                    <h4 class="text-danger text-bold text-small discount" style="padding: 5px;font-size:12px;margin: auto;background: #ffdbdb; border-radius: 5px; !important; margin-top:0; margin-bottom:0;position:relative; top:-25px;">İndirim!</h4>
                                                    <?php endif;?>
                                            </a>
                                        </li>
                                        <?php else:?>

                                        <li class="nav-item <?=($action[0]==$readMenu['link'])?'active':''?>">
                                            <a class="nav-link" href="/<?=$readMenu['link']?>">
                                                    <span class="item-icon">
                                                        <i class="mdi <?=$readMenu['icon']?>"></i> <?=$readMenu['heading']?>
                                                    </span>
                                            </a>
                                        </li>
                                        <?php endif;?>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </ul>
                        <div class="navbar-right ml-auto">
                            <?php if (isset($_SESSION['login'])): ?>
                            <div class="user-model">
                                <img src="<?=avatar($readUser['username'], '100', '1')?>">
                            </div>
                            <div class="user-info dropdown">
                                <a href="#" class="login-button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="mr-2 mb-1" src="<?=avatar($readUser['username'], '20')?>">
                                    <?=$readUser['realname']?>     
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/profil">
                                        <i class="mdi mdi-account-circle-outline"></i>
                                        Profil
                                    </a>
                                    <a class="dropdown-item" href="/kredi/yukle">
                                        <i class="mdi mdi-credit-card-outline"></i>
                                        Kredi : <b>&nbsp;<?=$readUser['credit']?></b>
                                    </a>
                                    <a class="dropdown-item" href="/sandik">
                                        <i class="mdi mdi-safe-square-outline"></i>
                                        Sandık <?=(isset($chestCount))?$chestCount:""?>
                                    </a>
                                    <a class="dropdown-item" href="/hediye">
                                        <i class="mdi mdi-gift-outline"></i>
                                        Hediye Kuponu
                                    </a>
                                    <?php if($readUser['permission'] != 0 AND $readUser['permission'] != 1): ?>
                                    <a class="dropdown-item" href="/panel/" target="_blank">
                                        <i class="mdi mdi-view-dashboard-outline"></i>
                                        Yönetim Paneli
                                    </a>
                                    <?php endif; ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/cikis-yap" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?')">
                                        <i class="mdi mdi-logout"></i>
                                        Çıkış Yap
                                    </a>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="login-buttons">
                                <a href="/giris-yap" class="login-button-item-log">
                                    <i class="mdi mdi-login-variant mr-2"></i> 
                                    Giriş Yap
                                </a>
                                <a href="/kayit-ol" class="login-button-item-reg">
                                    Kayıt Ol <i class="mdi mdi-account-multiple-plus ml-2"></i>
                                </a>
                            </div>


                            

                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>



