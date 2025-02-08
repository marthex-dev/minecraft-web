<!DOCTYPE html>
<html lang="tr">
<head>
        
        <meta charset="utf-8" />
        <title>Yönetim Paneli | RabiWeb</title>
        <base href="<?=site_url()?>panel/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Rabiweb Software" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css?v=<?=$RabiwebVersion?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css?v=<?=$RabiwebVersion?>" rel="stylesheet" type="text/css" />
        <?php
          if (isset($extraResourcesCSS)) {
            $extraResourcesCSS->getResources();
          }
        ?>
        <!-- App Css-->
        <link href="assets/css/app.min.css?v=<?=$RabiwebVersion?>" id="app-style" rel="stylesheet" type="text/css" />

</head>

    <body data-layout="horizontal" data-topbar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="#" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?=$find_read_panel.$readSettings['serverLogo']?>" alt="" height="50">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=$find_read_panel.$readSettings['serverLogo']?>" alt="" height="50">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">
                        <?php

                        $totalNotifications = $db->from('Notifications')->where('status', '1')->select('count(*) as total')->total();

                        ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell <?=($totalNotifications > 0)?'bx-tada':''?>"></i>
                                <?php if ($totalNotifications > 0): ?>
                                    <span class="badge badge-danger badge-pill"><?=$totalNotifications?></span>
                                <?php endif; ?>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Bildirimler </h6>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <?php if ($totalNotifications > 0): ?>

                                        <?php

                                        $notifications = $db->from('Notifications')
                                                            ->join('Users', 'Users.id = Notifications.accID')
                                                            ->select('Notifications.*, Users.username')
                                                            ->where('Notifications.status', '1')
                                                            ->orderby('Notifications.id', 'DESC')
                                                            ->all();

                                        ?>
                                        
                                        <?php foreach ($notifications as $readNotifications): ?>

                                        <?php if ($readNotifications['type']==1): ?>

                                        <a href="destek/goruntule/<?=$readNotifications['data']?>" class="text-reset notification-item">

                                        <?php elseif ($readNotifications['type']==2): ?>

                                        <a href="haber/yorumlar" class="text-reset notification-item">

                                        <?php elseif ($readNotifications['type']==3): ?>

                                        <a href="magaza/gecmis" class="text-reset notification-item">

                                        <?php elseif ($readNotifications['type']==4): ?>

                                        <a href="magaza/kredi-yukleme-gecmisi" class="text-reset notification-item">

                                        <?php else: ?>

                                        <a href="#" class="text-reset notification-item">

                                        <?php endif; ?>
                                            <div class="media">
                                                <div class="avatar-xs mr-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <img src="https://minotar.net/avatar/<?=$readNotifications['username']?>/40" class="img-fluid rounded-circle">
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <div class="font-size-12 text-muted">
                                                        <p class="mb-1">
                                                            <?php if ($readNotifications['type']==1): ?>

                                                            <span class="text-primary">
                                                                <?=$readNotifications['username']?>        
                                                            </span> 
                                                            bir destek mesajı gönderdi.

                                                            <?php elseif ($readNotifications['type']==2): ?>

                                                            <span class="text-primary">
                                                                <?=$readNotifications['username']?>        
                                                            </span> 
                                                            bir yorum gönderdi.

                                                            <?php elseif ($readNotifications['type']==3): ?>

                                                            <span class="text-primary">
                                                                <?=$readNotifications['username']?>        
                                                            </span> 
                                                            <?=$readNotifications['data']?> satın aldı.

                                                            <?php elseif ($readNotifications['type']==4): ?>

                                                            <span class="text-primary">
                                                                <?=$readNotifications['username']?>        
                                                            </span> 
                                                            <?=$readNotifications['data']?> kredi yükledi.

                                                            <?php else: ?>

                                                            HATA!

                                                            <?php endif; ?>
                                                        </p>
                                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span><?=convertTime($readNotifications['creationDate'])?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <?php endforeach; ?>

                                    <?php else: ?>

                                    <a href="#" class="text-reset notification-item">
                                        <div class="media">
                                            <div class="media-body text-center">
                                                Kayıt Bulunamadı.
                                            </div>
                                        </div>
                                    </a>

                                    <?php endif; ?>
                                </div>
                                <div class="p-2 border-top">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="bildirimler">
                                        <i class="mdi mdi-arrow-right-circle mr-1"></i> Devamını gör...
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect d-flex justify-content-center align-items-center" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="https://minotar.net/avatar/<?=$readAdmin['username']?>/40"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block mx-2"><b><?=$readAdmin['username']?></b><br>
                                	<span><?=$permission?></span></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href="hesap/goruntule/<?=$readAdmin['id']?>">
                                	<i class="bx bx-user font-size-16 align-middle mr-1"></i> 
                                	<span>Profil</span>
                                </a>
                                <a class="dropdown-item d-block" href="ayarlar/genel">
                                	<i class="bx bx-wrench font-size-16 align-middle mr-1"></i> 
                                	<span>Ayarlar</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?')" href="/cikis-yap"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span>Çıkış Yap</span></a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </header>
    
            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav w-100 justify-content-between">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-settings" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-wrench mr-2"></i><span>Ayarlar</span> <div class="arrow-down"></div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="topnav-settings">
                                        <a href="ayarlar/genel" class="dropdown-item">Genel Ayarlar</a>
                                        <a href="ayarlar/sistem" class="dropdown-item">Sistem Ayarları</a>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-theme"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Tema Ayarları</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-theme">
                                                <a href="tema-ayarlari/genel" class="dropdown-item">Genel</a>
                                                <a href="tema-ayarlari/css" class="dropdown-item">CSS</a>
                                                <a href="tema-ayarlari/renk" class="dropdown-item">Renk</a>
                                                <a href="tema-ayarlari/header" class="dropdown-item">Header</a>
                                            </div>
                                        </div>
                                        <a href="odeme/liste" class="dropdown-item">Ödeme Yöntemleri</a>
                                        <a href="ayarlar/smtp" class="dropdown-item">SMTP Ayarları</a>
                                        <a href="ayarlar/webhook" class="dropdown-item">Discord Webhook</a>                                        
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-store" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-store-alt mr-2"></i><span>Mağaza İşlemleri</span> <div class="arrow-down"></div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="topnav-store">
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-products"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Ürün Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-products">
                                                <a href="magaza/liste" class="dropdown-item">Ürünler</a>
                                                <a href="magaza/ekle" class="dropdown-item">Ürün Ekle</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-store-category"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Kategori Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-store-category">
                                                <a href="magaza/kategori/liste" class="dropdown-item">Kategoriler</a>
                                                <a href="magaza/kategori/ekle" class="dropdown-item">Kategori Ekle</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-store-category"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Sunucu Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-store-category">
                                                <a href="sunucu/liste" class="dropdown-item">Sunucular</a>
                                                <a href="sunucu/ekle" class="dropdown-item">Sunucu Ekle</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-vip"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>VIP Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-vip">
                                                <a href="vip/liste" class="dropdown-item">VIP Listesi</a>
                                                <a href="vip/ekle" class="dropdown-item">VIP Ekle</a>
                                                <a href="vip/ozellik/liste" class="dropdown-item">Özellik Listesi</a>
                                                <a href="vip/ozellik/ekle" class="dropdown-item">Özellik Ekle</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-store-gift"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Hediye Kuponları</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-store-gift">
                                                <a href="hediye/liste" class="dropdown-item">Hediye Kuponları</a>
                                                <a href="hediye/ekle" class="dropdown-item">Kupon Ekle</a>
                                                <a href="hediye/gecmis" class="dropdown-item">Hediye Geçmişi</a>
                                            </div>
                                        </div>
                                        <a href="magaza/kredi-gonder" class="dropdown-item">Kredi Gönder</a>
                                        <a href="magaza/esya-gonder" class="dropdown-item">Eşya Gönder</a>
                                        <a href="magaza/kredi-yukleme-gecmisi" class="dropdown-item">Kredi Yükleme Geçmişi</a>
                                        <a href="magaza/kredi-kullanim-gecmisi" class="dropdown-item">Kredi Kullanım Geçmişi</a>
                                        <a href="magaza/gecmis" class="dropdown-item">Mağaza Geçmişi</a>
                                        <a href="sandik/gecmis" class="dropdown-item">Sandık Geçmişi</a>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-users" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-user mr-2"></i><span>Kullanıcılar</span> <div class="arrow-down"></div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="topnav-users">
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-theme"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Kullanıcı Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-theme">
                                                <a href="hesap/liste" class="dropdown-item">Hesaplar</a>
                                                <a href="hesap/ekle" class="dropdown-item">Hesap Ekle</a>
                                                <a href="hesap/liste/yetkili" class="dropdown-item">Yetkili Hesaplar</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-theme"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Engel Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-theme">
                                                <a href="engel/liste" class="dropdown-item">Engelli Hesaplar</a>
                                                <a href="engel/ekle" class="dropdown-item">Hesap Engelle</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-support" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-support mr-2"></i><span>Destek Sistemi <span class="badge badge-primary support-count"><?=support::getCount("1")?></span></span> <div class="arrow-down"></div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="topnav-support">
                                        <a href="destek/liste/tumu" class="dropdown-item">Tümü</a>
                                        <a href="destek/liste/yanit-bekleyenler" class="dropdown-item">Yanıt Bekleyenler<span class="badge badge-primary ml-1"><?=support::getCount("1")?></span></a>
                                        <a href="destek/liste/islemde" class="dropdown-item">İşlemde Olanlar<span class="badge badge-warning ml-1"><?=support::getCount("3")?></span></a>
                                        <a href="destek/liste/yanitlananlar" class="dropdown-item">Yanıtlananlar</a>
                                        <a href="destek/liste/kapatilanlar" class="dropdown-item">Kapatılanlar</a>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-theme"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Kategori Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-theme">
                                                <a href="destek/kategori/liste" class="dropdown-item">Kategoriler</a>
                                                <a href="destek/kategori/ekle" class="dropdown-item">Kategori Ekle</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-theme"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Hazır Cevap Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-theme">
                                                <a href="destek/hazir-cevap/liste" class="dropdown-item">Hazır Cevaplar</a>
                                                <a href="destek/hazir-cevap/ekle" class="dropdown-item">Hazır Cevap Ekle</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-site" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-layer mr-2"></i><span>Site Yönetimi</span> <div class="arrow-down"></div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="topnav-site">
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-news"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Haber Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-news">
                                                <a href="haber/liste" class="dropdown-item">Haber Listesi</a>
                                                <a href="haber/ekle" class="dropdown-item">Haber Ekle</a>
                                                <a href="haber/kategori/liste" class="dropdown-item">Kategori Listesi</a>
                                                <a href="haber/kategori/ekle" class="dropdown-item">Kategori Ekle</a>
                                                <a href="haber/yorumlar" class="dropdown-item">Yorumlar</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-slider"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Slider Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-slider">
                                                <a href="slider/liste" class="dropdown-item">Slider Listesi</a>
                                                <a href="slider/ekle" class="dropdown-item">Slider Ekle</a>
                                            </div>
                                        </div>

                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-case"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Kasa Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-case">
                                                <a href="kasa/liste" class="dropdown-item">Kasalar</a>
                                                <a href="kasa/ekle" class="dropdown-item">Kasa Ekle</a>
                                                <a href="kasa/gecmis" class="dropdown-item">Kasa Geçmişi</a>
                                            </div>
                                        </div>

                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-broadcast"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Duyuru Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-broadcast">
                                                <a href="duyuru/liste" class="dropdown-item">Duyuru Listesi</a>
                                                <a href="duyuru/ekle" class="dropdown-item">Duyuru Ekle</a>
                                            </div>
                                        </div>

                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-game"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Oyun Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-game">
                                                <a href="oyun/liste" class="dropdown-item">Oyun Listesi</a>
                                                <a href="oyun/ekle" class="dropdown-item">Oyun Ekle</a>
                                            </div>
                                        </div>

                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-file"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Dosya Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-file">
                                                <a href="indir/liste" class="dropdown-item">Dosya Listesi</a>
                                                <a href="indir/ekle" class="dropdown-item">Dosya Ekle</a>
                                            </div>
                                        </div>

                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-file"
                                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span>Sayfa Yönetimi</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-file">
                                                <a href="sayfa/liste" class="dropdown-item">Sayfa Listesi</a>
                                                <a href="sayfa/ekle" class="dropdown-item">Sayfa Ekle</a>
                                            </div>
                                        </div>

                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-settings" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-info-circle mr-2"></i><span>Yardım</span> <div class="arrow-down"></div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="topnav-settings">
                                        <a href="javascript:;" class="dropdown-item">Kullanım Kılavuzu</a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">