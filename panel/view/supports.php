<?php require 'static/header.php' ?>

<?php  if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18"><?=$title?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Destek Sistemi</a></li>
                            <li class="breadcrumb-item active"><?=$title?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <?php if (isset($response)): ?>
                    <div class="col-12">
                        <?=$response?>
                    </div>
                <?php endif; ?>
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
                                    <th>Başlık</th>
                                    <th>Kullanıcı Adı</th>
                                    <th class="text-center">Sunucu</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Tarih</th>
                                    <th class="text-center">Durum</th>
                                    <th class="text-right">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php
                                if ($query):
                                    foreach ($query as $row):
                                        ?>
                                        <tr>
                                            <td class="text-center"><a href="destek/goruntule/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                            <td><a href="destek/goruntule/<?=$row['id']?>"><?=$row['heading']?></a></td>
                                            <td><?=$row['username']?></td>
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
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="destek/liste/<?=$action[2]?>/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
            <?php if (!$_POST && $total > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="destek/<?=$action[1]?>/<?=$action[2]?>?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="destek/<?=$action[1]?>/<?=$action[2]?>?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php elseif($action[1]=="goruntule"): ?>

    <style type="text/css">
        .card-header.note-toolbar, .note-popover .popover-content{background-color: #222736 !important;}
        .note-editor.note-frame {border: 1px solid #222736 !important;}
    </style>
	<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Talep Görüntüle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Destek Sistemi</a></li>
                            <li class="breadcrumb-item active">Talep Görüntüle</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form method="post">
            <div class="row">
                <?php if (isset($response)): ?>
                    <div class="col-12">
                        <?=$response?>
                    </div>
                <?php endif; ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        	<div class="row d-flex align-items-center">
	                            <div class="col">
	                                <h4 class="card-header-title mb-0">
	                                    <?=$supports['heading']?>
	                                </h4>
	                            </div>
	                            <div class="col-auto">
	                                <span class="badge badge-pill badge-primary" data-toggle="tooltip" data-placement="top" data-original-title="Kategori"> <?=$supports['CategoryHeading']?> </span>
	                                <span class="badge badge-pill badge-primary" data-toggle="tooltip" data-placement="top" data-original-title="Tarih"> <?=convertTime($supports['creationDate'], 2, true)?> </span>
	                                <?php if ($supports['status']==1): ?>

	                                    <span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" data-original-title="Durum">Cevap Bekliyor</span>

	                                <?php elseif($supports['status']==2): ?>

	                                    <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" data-original-title="Durum">Cevaplandı</span>

	                                <?php elseif($supports['status']==3): ?>

	                                    <span class="badge badge-pill badge-info" data-toggle="tooltip" data-placement="top" data-original-title="Durum">İşlemde</span>

	                                <?php else: ?>

	                                    <span class="badge badge-pill badge-secondary" data-toggle="tooltip" data-placement="top" data-original-title="Durum">Kapatıldı</span>

	                                <?php endif; ?>
	                            </div>
	                        </div>
                        </div>
                        <div class="card-body" style="min-height: 300px;">
                            <?php foreach ($supportReplies as $row): ?>
                                <?php if ($row['id'] != 0): ?>
                                <div class="comment mb-4" >
                                    <div class="row">
                                        <div class="col-auto">
                                            <a class="avatar" href="javascript:0;">
                                                <img src="https://minotar.net/avatar/<?=$row['username']?>/40.png" alt="Üye - <?=$row['username']?>" class="avatar-img rounded-circle" />
                                            </a>
                                        </div>
                                        <div class="col ml-n2">
                                            <div class="comment-body w-100">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="comment-title">
                                                            <?=$row['username']?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-auto">
                                                        <time class="comment-time">
                                                            <?=convertTime($row['creationDate'], 2, true)?>
                                                        </time>
                                                    </div>
                                                </div>

                                                <div class="comment-text">
                                                    <?=htmlspecialchars_decode($row['message'])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php else: ?>

                                <div class="comment mb-4" >
                                    <div class="row">
                                        <div class="col ml-n2 text-right">
                                            <div class="comment-body w-100">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <time class="comment-time">
                                                            <?=convertTime($row['creationDate'], 2, true)?>
                                                        </time>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="comment-title">
                                                            <?=$row['username']?>
                                                        </h5>
                                                    </div>
                                                </div>

                                                <div class="comment-text">
                                                    <?=htmlspecialchars_decode($row['message'])?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a class="avatar" href="javascript:0;">
                                                <img src="https://minotar.net/avatar/<?=$row['username']?>/40.png" alt="Üye - <?=$row['username']?>" class="avatar-img rounded-circle" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <?php if($supports['status']!=4): ?>
                                <form method="post" class="mt-1">
                                    <div class="col-auto">
                                        <div class="avatar avatar-sm">
                                            <img src="https://minotar.net/avatar/<?=$readAdmin['username']?>/48.png" alt="<?=$permission?> - <?=$readAdmin['username']?>" class="avatar-img rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="col ml-n2 mb-2">
                                        <select onchange="selectAnswer(this, '.note-editable', '#message')" class="form-control custom-select">
                                            <option value="">Bir Cevap Seçebilirsiniz.</option>
                                            <?php foreach ($answers as $readAnswers): ?>
                                            <option value="<?=$readAnswers['content']?>"><?=$readAnswers['heading']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <textarea id="message" name="message" class="form-control form-control-flush" data-toggle="quill"></textarea>
                                    </div>
                                <?php endif; ?>
                                    <div class="col-md-12 ml-auto">
                                        <div class="submit-button text-right my-2">
                                            <a href="destek/goruntule/<?=$action[2]?>/sil" class="btn btn-outline-danger">
                                                Talebi Sil
                                            </a>
                                            <?php if($supports['status']!=4): ?>
                                            <a href="destek/goruntule/<?=$action[2]?>/kapat" class="btn btn-outline-warning">
                                                Talebi Kapat
                                            </a>
                                            <?php else: ?>
                                            <a href="destek/goruntule/<?=$action[2]?>/aktif-et" class="btn btn-outline-success">
                                                Talebi Aktif Et
                                            </a>
                                            <?php endif; ?>
                                            <a href="destek/goruntule/<?=$action[2]?>/isleme-al" class="btn btn-outline-info">
                                                İşleme Al
                                            </a>
                                            <?php if($supports['status']!=4): ?>
                                            <button type="submit" class="btn btn-success">
                                                Cevabı Gönder
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php if($supports['status']!=4): ?>
                                </form>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php elseif($action[1]=="kategori"): ?>

    <?php if ($action[2]=="liste"): ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Kategoriler</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Destek Sistemi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kategori Yönetimi</a></li>
                                <li class="breadcrumb-item active">Kategoriler</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <?php if (isset($response)): ?>
                        <div class="col-12">
                            <?=$response?>
                        </div>
                    <?php endif; ?>
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
                                        <a class="btn btn-sm btn-white" href="destek/kategori/ekle">Kategori Ekle</a>
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
                                        <th>Kategori Adı</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    <?php
                                    if ($query):
                                        foreach ($query as $row):
                                            ?>
                                            <tr>
                                                <td class="text-center"><a href="destek/kategori/duzenle/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                                <td><a href="destek/kategori/duzenle/<?=$row['id']?>"><?=$row['heading']?></a></td>
                                                <td class="text-right">
                                                    <a
                                                            class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                            href="destek/kategori/duzenle/<?=$row['id']?>"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title=""
                                                            data-original-title="Düzenle"
                                                    >
                                                        <i class="bx bx-edit-alt"></i>
                                                    </a>
                                                    <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="destek/kategori/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                        <i class="bx bx-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="3">Kayıt Bulunamadı</td>
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

    <?php elseif($action[2]=="ekle"): ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Kategori Ekle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Destek Sistemi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kategori Yönetimi</a></li>
                                <li class="breadcrumb-item active">Kategori Ekle</li>
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
                            <form action="" method="post">

                                <div class="form-group row">
                                    <label for="heading" class="col-sm-2 col-form-label">Kategori Adı:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="heading" class="form-control" name="heading" placeholder="Kategori adını giriniz.">
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

    <?php elseif($action[2]=="duzenle"): ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Kategori Düzenle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Destek Sistemi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Kategori Yönetimi</a></li>
                                <li class="breadcrumb-item active">Kategori Düzenle</li>
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
                            <form action="" method="post">

                                <div class="form-group row">
                                    <label for="heading" class="col-sm-2 col-form-label">Kategori Adı:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?=$query['heading']?>" id="heading" class="form-control" name="heading" placeholder="Kategori adını giriniz.">
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

    <?php endif; ?>

<?php elseif($action[1]=="hazir-cevap"): ?>

    <?php if ($action[2]=="liste"): ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Hazır Cevaplar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Destek Sistemi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hazır Cevap Yönetimi</a></li>
                                <li class="breadcrumb-item active">Hazır Cevaplar</li>
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
                                        <a class="btn btn-sm btn-white" href="destek/hazir-cevap/ekle">Hazır Cevap Ekle</a>
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
                                        <th>Başlık</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    <?php
                                    if ($query):
                                        foreach ($query as $row):
                                            ?>
                                            <tr>
                                                <td class="text-center"><a href="destek/hazir-cevap/duzenle/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                                <td><a href="destek/hazir-cevap/duzenle/<?=$row['id']?>"><?=$row['heading']?></a></td>
                                                <td class="text-right">
                                                    <a
                                                            class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                            href="destek/hazir-cevap/duzenle/<?=$row['id']?>"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title=""
                                                            data-original-title="Düzenle"
                                                    >
                                                        <i class="bx bx-edit-alt"></i>
                                                    </a>
                                                    <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="destek/hazir-cevap/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                        <i class="bx bx-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="3">Kayıt Bulunamadı</td>
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

    <?php elseif($action[2]=="ekle"): ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Hazır Cevap Ekle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Destek Sistemi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hazır Cevap Yönetimi</a></li>
                                <li class="breadcrumb-item active">Hazır Cevap Ekle</li>
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
                            <form action="" method="post">

                                <div class="form-group row">
                                    <label for="heading" class="col-sm-2 col-form-label">Başlık:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="heading" class="form-control" name="heading" placeholder="Cevap başlığı giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="content" class="col-sm-2 col-form-label">İçerik:</label>
                                    <div class="col-sm-10">
                                        <textarea data-toggle="quill" name="content" class="form-control" rows="5"></textarea>
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

    <?php elseif($action[2]=="duzenle"): ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Hazır Cevap Düzenle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Destek Sistemi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hazır Cevap Yönetimi</a></li>
                                <li class="breadcrumb-item active">Hazır Cevap Düzenle</li>
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
                            <form action="" method="post">

                                <div class="form-group row">
                                    <label for="heading" class="col-sm-2 col-form-label">Başlık:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?=$query['heading']?>" id="heading" class="form-control" name="heading" placeholder="Cevap başlığı giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="content" class="col-sm-2 col-form-label">İçerik:</label>
                                    <div class="col-sm-10">
                                        <textarea data-toggle="quill" name="content" class="form-control" rows="5"><?=$query['content']?></textarea>
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

    <?php endif; ?>

<?php endif; ?>

<?php require 'static/footer.php' ?>