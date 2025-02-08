<?php require 'static/header.php' ?>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Bildirimler</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Bildirimler</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

</div>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" scope="col" style="width: 70px;">#</th>
                                    <th scope="col">Bildirim</th>
                                    <th class="text-center" scope="col">Tarih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($totalNotifications2 > 0): ?>

                                <?php foreach ($notifications2 as $readNotifications): ?>

                                <?php 

                                    if ($readNotifications['type']==1):

                                        $href = "destek/goruntule/".$readNotifications['data'];

                                    elseif ($readNotifications['type']==2):

                                        $href = "haber/yorumlar";

                                    elseif ($readNotifications['type']==3):

                                        $href = "magaza/gecmis";

                                    elseif ($readNotifications['type']==4):

                                        $href = "magaza/kredi-yukleme-gecmisi";

                                    else:

                                        $href = "javascript:;";

                                    endif;

                                ?>

                                    <tr>
                                        <td class="text-center">
                                            <div>
                                                <img class="rounded-circle avatar-xs" src="https://minotar.net/avatar/<?=$readNotifications['username']?>/40" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h5 class="font-size-14 mb-1">
                                                    <a href="hesap/goruntule/<?=$readNotifications['accID']?>" class="text-dark"><?=$readNotifications['username']?></a>
                                                </h5>
                                            </div>
                                            <p class="text-muted mb-0 d-block">
                                                <a href="<?=$href?>">
                                                    
                                                    <?php if ($readNotifications['type']==1): ?>

                                                    bir destek mesajı gönderdi.

                                                    <?php elseif ($readNotifications['type']==2): ?>

                                                    bir yorum gönderdi.

                                                    <?php elseif ($readNotifications['type']==3): ?>

                                                    <?=$readNotifications['data']?> satın aldı.

                                                    <?php elseif ($readNotifications['type']==4): ?>

                                                    <?=$readNotifications['data']?> kredi yükledi.

                                                    <?php else: ?>

                                                    HATA!

                                                    <?php endif; ?>

                                                </a>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <?=convertTime($readNotifications['creationDate'])?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                                    
                                <?php else: ?>
                            
                                <tr>
                                    <td colspan="3" class="text-center">Kayıt Bulunamadı</td>
                                </tr>

                                <?php endif; ?>
                            
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <?php if (!$_POST && $totalNotifications2 > 0): ?>
        <div class="col-lg-12">
            <ul class="pagination pagination-rounded justify-content-center mt-4">
                <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                    <a href="bildirimler?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                </li>
                <li class="page-item active">
                    <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                </li>
                <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                    <a href="bildirimler?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>



<?php require 'static/footer.php' ?>