<?php require 'static/header.php' ?>

<?php if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Hesaplar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcılar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcı Yönetimi</a></li>
                            <li class="breadcrumb-item active">Hesaplar</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php if (isset($response)): ?>
                <div class="col-12">
                    <?=$response?>
                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="card position-relative">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <form method="post" class="d-flex align-items-center w-100">
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-auto d-flex h-100 align-items-center pr-0">
                                            <span class="bx bx-search text-muted"></span>
                                        </div>
                                        <div class="col">
                                            <input onkeyup="" type="search" class="form-control form-control-flush search" name="query" placeholder="Arama Yap" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-success">Ara</button>
                                    <a class="btn btn-sm btn-white" href="hesap/ekle">Hesap Ekle</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-nowrap card-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 40px;">#ID</th>
                                        <th>Kullanıcı Adı</th>
                                        <th>E-Posta</th>
                                        <th class="text-center">Kredi</th>
                                        <th class="text-center">Yetki</th>
                                        <th class="text-center">Kayıt Tarihi</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                <?php
                                if ($query):
                                    foreach ($query as $row):

                                        if ($row['permission']=="0"):
                                            $permission = "<span class='badge badge-pill badge-secondary'>Oyuncu</span>";
                                        elseif ($row['permission']=="1"):
                                            $permission = "<span class='badge badge-pill badge-dark'>Youtuber</span>";
                                        elseif ($row['permission']=="2"):
                                            $permission = "<span class='badge badge-pill badge-info'>Destek</span>";
                                        elseif($row['permission']=="3"):
                                            $permission = "<span class='badge badge-pill badge-warning'>Yazar</span>";
                                        elseif($row['permission']=="4"):
                                            $permission = "<span class='badge badge-pill badge-primary'>Görevli</span>";
                                        elseif($row['permission']=="5"):
                                            $permission = "<span class='badge badge-pill badge-success'>Moderatör</span>";
                                        elseif($row['permission']=="6"):
                                            $permission = "<span class='badge badge-pill badge-danger'>Yönetici</span>";
                                        else:
                                            $permission = "Hata!";
                                        endif;

                                        ?>
                                        <tr>
                                            <td class="text-center"><a href="hesap/duzenle/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                            <td><a href="hesap/duzenle/<?=$row['id']?>"><?=$row['realname']?></a></td>
                                            <td><?=$row['email']?></td>
                                            <td class="text-center"><?=$row['credit']?></td>
                                            <td class="text-center"><?=$permission?></td>
                                            <td class="text-center"><?=convertTime(date("Y-m-d H:i:s", ($row['regdate']/1000)), 2, true)?></td>
                                            <td class="text-right">
                                                <a class="btn btn-sm btn-rounded-circle btn-success" href="hesap/duzenle/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Düzenle">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a class="btn btn-sm btn-rounded-circle btn-primary" href="hesap/goruntule/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Görüntüle">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a class="btn btn-sm btn-rounded-circle btn-warning" href="engel/ekle/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Engelle">
                                                    <i class="bx bx-block"></i>
                                                </a>
                                                <a class="btn btn-sm btn-rounded-circle btn-secondary" href="magaza/esya-gonder/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eşya Gönder">
                                                    <i class="bx bx-store-alt"></i>
                                                </a>
                                                <a class="btn btn-sm btn-rounded-circle btn-info" href="magaza/kredi-gonder/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kredi Gönder">
                                                    <i class="bx bx-dollar"></i>
                                                </a>
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger clickdelete" href="hesap/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                    <i class="bx bx-trash-alt"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    <?php
                                    endforeach;
                                else:
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="8">Kayıt Bulunamadı</td>
                                    </tr>
                                <?php endif;   ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$_POST && isset($totalUsers) && $totalUsers > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="hesap/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="hesap/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>



<?php elseif($action[1]=="goruntule"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Hesap Görüntüle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcılar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcı Yönetimi</a></li>
                            <li class="breadcrumb-item active">Hesap Görüntüle</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php if (isset($response)): ?>
            <div class="col-12">
                <?=$response?>
            </div>
            <?php endif; ?>
            <div class="col-xl-4">
                <div class="card overflow-hidden">
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-5 ml-auto align-self-end">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="avatar-md profile-user-wid mb-4 mx-auto">
                                    <img src="https://minotar.net/avatar/<?=$query['username']?>/72" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Kullanıcı Adı:</th>
                                                <td><?=$query['realname']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-Posta:</th>
                                                <td><?=$query['email']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Yetki:</th>
                                                <td>
                                                    <?php
                                                    if ($query['permission']=="0"):
                                                        echo "<span class='badge badge-pill badge-secondary'>Oyuncu</span>";
                                                    elseif ($query['permission']=="1"):
                                                        echo "<span class='badge badge-pill badge-dark'>Youtuber</span>";
                                                    elseif ($query['permission']=="2"):
                                                        echo "<span class='badge badge-pill badge-info'>Destek</span>";
                                                    elseif($query['permission']=="3"):
                                                        echo "<span class='badge badge-pill badge-warning'>Yazar</span>";
                                                    elseif($query['permission']=="4"):
                                                        echo "<span class='badge badge-pill badge-primary'>Görevli</span>";
                                                    elseif($query['permission']=="5"):
                                                        echo "<span class='badge badge-pill badge-success'>Moderatör</span>";
                                                    elseif($query['permission']=="6"):
                                                        echo "<span class='badge badge-pill badge-danger'>Yönetici</span>";
                                                    else:
                                                        echo "Hata!";
                                                    endif;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kredi:</th>
                                                <td><?=$query['credit']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Son Giriş:</th>
                                                <td><?=convertTime(date("Y-m-d H:i:s", ($query['lastlogin']/1000)), 2, true)?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kayıt Tarihi:</th>
                                                <td><?=convertTime(date("Y-m-d H:i:s", ($query['regdate']/1000)), 2, true)?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">IP Adresi:</th>
                                                <td><?=$query['ip']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Skype:</th>
                                                <td><?=$query['skype']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Discord:</th>
                                                <td><?=$query['discord']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="profile-button">
                                    <div class="row">
                                        <div class="col-md-6 my-2">
                                            <a href="#" class="btn btn-primary waves-effect waves-light w-100">Kredi Gönder</a>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <a href="engel/ekle/<?=$query['id']?>" class="btn btn-warning waves-effect waves-light w-100">Engelle</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="hesap/duzenle/<?=$query['id']?>" class="btn btn-success waves-effect waves-light w-100">Düzenle</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz.')" href="hesap/liste/sil/<?=$query['id']?>" class="btn btn-danger waves-effect waves-light w-100">Sil</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" style="border-radius: 0;padding: 15px 0px;" data-toggle="tab" href="#home1" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Destek Mesajları</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="border-radius: 0;padding: 15px 0px;" data-toggle="tab" href="#profile1" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Kredi Geçmişi</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="border-radius: 0;padding: 15px 0px;" data-toggle="tab" href="#messages1" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Mağaza Geçmişi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="home1" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="width: 40px;">#ID</th>
                                            <th>Başlık</th>
                                            <th class="text-center">Sunucu</th>
                                            <th>Kategori</th>
                                            <th class="text-center">Tarih</th>
                                            <th class="text-center">Durum</th>
                                            <th class="text-right">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        <?php
                                        if ($tickets):
                                            foreach ($tickets as $row):
                                                ?>
                                                <tr>
                                                    <td class="text-center"><a href="destek/goruntule/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                                    <td><a href="destek/goruntule/<?=$row['id']?>"><?=substr($row['heading'], 0, 15)?>...</a></td>
                                                    <td class="text-center"><?=$row['serverName']?></td>
                                                    <td><?=$row['CategoryHeading']?></td>
                                                    <td class="text-center"><?=convertTime($row['updateDate'], 2, true)?></td>
                                                    <td class="text-center">
                                                        <?php if ($row['status']==1): ?>
                                                            <span class="badge badge-pill badge-danger">Cevap Bekliyor</span>
                                                        <?php elseif($row['status']==2): ?>
                                                            <span class="badge badge-pill badge-success">Cevaplandı</span>
                                                        <?php elseif($row['status']==3): ?>
                                                            <span class="badge badge-pill badge-info">İşlemde</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-pill badge-secondary">Kapatıldı</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <a
                                                            class="btn btn-sm btn-rounded-circle btn-primary text-white"
                                                            href="destek/goruntule/<?=$row['id']?>"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title=""
                                                            data-original-title="Görüntüle"
                                                        >
                                                            <i class="bx bx-show"></i>
                                                        </a>
                                                        <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="destek/liste/tumu/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            endforeach;
                                        else:
                                            ?>
                                            <tr>
                                                <td class="text-center" colspan="8">Kayıt Bulunamadı</td>
                                            </tr>
                                        <?php endif;   ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Kullanıcı</th>
                                                <th class="text-center">Miktar</th>
                                                <th class="text-center">Tarih</th>
                                                <th class="text-center">Ödeme</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($totalCreditHistory > 0): ?>
                                            <?php foreach ($creditHistory as $key => $readCreditHistory): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <img class="rounded-circle" src="https://minotar.net/avatar/<?=$readCreditHistory['username']?>/20" width="20" height="20" />
                                                    </td>
                                                    <td>
                                                        <a href="oyuncu/<?=$readCreditHistory['username']?>">
                                                            <?=$readCreditHistory['username']?>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($readCreditHistory['type']==1 OR $readCreditHistory['type']==6 OR $readCreditHistory['type']==7): ?>
                                                            <span class="text-danger"> - <?=$readCreditHistory['price']?></span>
                                                        <?php else: ?>
                                                            <span class="text-success"> + <?=$readCreditHistory['price']?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center"><?=convertTime($readCreditHistory['creationDate'], 2, true)?></td>
                                                    <td class="text-center">
                                                        <?php if ($readCreditHistory['type']==1): ?>
                                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Gönderim (Gönderen)" class="mdi mdi-send"></i>
                                                        <?php elseif ($readCreditHistory['type']==2): ?>
                                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Gönderim (Alan)" class="mdi mdi-send"></i>
                                                        <?php elseif ($readCreditHistory['type']==3): ?>
                                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="EFT" class="mdi mdi-send"></i>
                                                        <?php elseif ($readCreditHistory['type']==4): ?>
                                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Kredi Kartı" class="mdi mdi-credit-card-outline"></i>
                                                        <?php elseif ($readCreditHistory['type']==5): ?>
                                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Mobil Ödeme" class="mdi mdi-cellphone"></i>
                                                        <?php elseif ($readCreditHistory['type']==6): ?>
                                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Mağaza Kullanım" class="mdi mdi-cart"></i>
                                                        <?php elseif ($readCreditHistory['type']==7): ?>
                                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Kasa Sistemi Kullanım" class="mdi mdi-briefcase"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    Kayıt Bulunamadı!
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages1" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#ID</th>
                                                <th>Ürün</th>
                                                <th class="text-center">Sunucu</th>
                                                <th class="text-center">Tutar</th>
                                                <th class="text-center">Tarih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($totalStoreHistory > 0): ?>

                                            <?php foreach ($storeHistory as $key => $readStoreHistory): ?>

                                            <tr>
                                                <td class="text-center">
                                                    <?=$readStoreHistory['id']?>
                                                </td>
                                                <td><?=$readStoreHistory['heading']?></td>
                                                <td class="text-center"><?=$readStoreHistory['serverName']?></td>
                                                <td class="text-center"><?=$readStoreHistory['price']?> Kredi</td>
                                                <td class="text-center"><?=convertTime($readStoreHistory['creationDate'], 2, true)?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            
                                        <?php else: ?>
                                            <tr>
                                                <td class="text-center" colspan="5">Kayıt Bulunamadı!</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif($action[1]=="ekle"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Hesap Ekle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcılar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcı Yönetimi</a></li>
                            <li class="breadcrumb-item active">Hesap Ekle</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php if (isset($response)): ?>
                <div class="col-12">
                    <?=$response?>
                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="post">

                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Kullanıcı Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="username" class="form-control" name="username" placeholder="Minecraft kullanıcı adınızı yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">E-Posta:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="email" class="form-control" name="email" placeholder="E-Posta adresinizi yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Şifre:</label>
                                <div class="col-sm-10">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Şifreyi Yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="passwordRe" class="col-sm-2 col-form-label">Şifre (Tekrar):</label>
                                <div class="col-sm-10">
                                    <input type="password" id="passwordRe" class="form-control" name="passwordRe" placeholder="Şifreyi güvenlik amaçlı tekrar yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="credit" class="col-sm-2 col-form-label">Kredi:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input <?=($readAdmin['permission']!=6)?"disabled":""?> type="number" id="credit" class="form-control" name="credit" placeholder="Kredi miktarını yazınız.">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="bx bx-lira"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Yetki:</label>
                                <div class="col-sm-10">
                                    <select <?=($readAdmin['permission']!=6)?"disabled":""?> id="permission" name="permission" class="form-control">
                                        <option value="0">Oyuncu</option>
                                        <option value="1">Youtuber</option>
                                        <option value="2">Destek</option>
                                        <option value="3">Yazar</option>
                                        <option value="4">Görevli</option>
                                        <option value="5">Moderatör</option>
                                        <option value="6">Yönetici</option>
                                    </select>
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="submit" class="btn btn-success">Ekle</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php elseif($action[1]=="duzenle"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Hesap Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcılar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcı Yönetimi</a></li>
                            <li class="breadcrumb-item active">Hesap Düzenle</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <?php if (isset($response)): ?>
                <div class="col-12">
                    <?=$response?>
                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="post">

                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Kullanıcı Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$query['realname']?>" id="username" class="form-control" name="username" placeholder="Minecraft kullanıcı adınızı yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">E-Posta:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$query['email']?>" id="email" class="form-control" name="email" placeholder="E-Posta adresinizi yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Şifre:</label>
                                <div class="col-sm-10">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Şifreyi Yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="passwordRe" class="col-sm-2 col-form-label">Şifre (Tekrar):</label>
                                <div class="col-sm-10">
                                    <input type="password" id="passwordRe" class="form-control" name="passwordRe" placeholder="Şifreyi güvenlik amaçlı tekrar yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="credit" class="col-sm-2 col-form-label">Kredi:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input <?=($readAdmin['permission']!=6)?"disabled":""?> type="number" value="<?=$query['credit']?>" id="credit" class="form-control" name="credit" placeholder="Kredi miktarını yazınız.">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="bx bx-lira"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Yetki:</label>
                                <div class="col-sm-10">
                                    <select <?=($readAdmin['permission']!=6)?"disabled":""?> id="permission" name="permission" class="form-control">
                                        <option <?=($query['permission']==0)?"selected":""?> value="0">Oyuncu</option>
                                        <option <?=($query['permission']==1)?"selected":""?> value="1">Youtuber</option>
                                        <option <?=($query['permission']==2)?"selected":""?> value="2">Destek</option>
                                        <option <?=($query['permission']==3)?"selected":""?> value="3">Yazar</option>
                                        <option <?=($query['permission']==4)?"selected":""?> value="4">Görevli</option>
                                        <option <?=($query['permission']==5)?"selected":""?> value="5">Moderatör</option>
                                        <option <?=($query['permission']==6)?"selected":""?> value="6">Yönetici</option>
                                    </select>
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="submit" class="btn btn-success">Güncelle</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

<?php endif; ?>

<?php require 'static/footer.php' ?>