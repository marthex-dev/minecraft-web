<?php require 'static/header.php' ?>

<?php if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Sunucu Listesi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza Yönetimi</a></li>
                            <li class="breadcrumb-item active">Sunucu Listesi</li>
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
                                    <a class="btn btn-sm btn-white" href="sunucu/ekle">Sunucu Ekle</a>
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
                                    <th>Sunucu Adı</th>
                                    <th>Sunucu IP:Port</th>
                                    <th>Konsol Tipi</th>
                                    <th>Konsol Port</th>
                                    <th class="text-right">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php
                                if ($query):
                                    foreach ($query as $row):

                                        if ($row['senderType']=="1"):
                                            
                                            $sender = "Websend";

                                        elseif ($row['senderType']=="2"):

                                            $sender = "Websender";

                                        elseif ($row['senderType']=="3"):

                                            $sender = "RCON";

                                        endif;

                                        ?>
                                        <tr>
                                            <td class="text-center"><a href="sunucu/duzenle/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                            <td><a href="sunucu/duzenle/<?=$row['id']?>"><?=$row['heading']?></a></td>
                                            <td><?=$row['serverIP'].":".$row['serverPort']?></td>
                                            <td><?=$sender?></td>
                                            <td><?=$row['senderPort']?></td>
                                            <td class="text-right">
                                                <a
                                                    class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                    href="sunucu/duzenle/<?=$row['id']?>"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Düzenle"
                                                >
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a
                                                    class="btn btn-sm btn-rounded-circle btn-primary text-white"
                                                    href="sunucu/konsol/<?=$row['id']?>"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Konsol"
                                                >
                                                    <i class="bx bx-code-block"></i>
                                                </a>
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="sunucu/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                    <i class="bx bx-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else:
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="5">Kayıt Bulunamadı</td>
                                    </tr>
                                <?php endif;   ?>
                                </tbody>
                            </table>
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
                    
                    <h4 class="mb-0 font-size-18">Sunucu Ekle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza Yönetimi</a></li>
                            <li class="breadcrumb-item active">Sunucu Ekle</li>
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
                        <form id="serverForm" action="" enctype="multipart/form-data" method="post">

                            <div class="form-group row">
                                <label for="heading" class="col-sm-2 col-form-label">Sunucu Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="heading" class="form-control" name="heading" placeholder="Sunucu adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="serverIP" class="col-sm-2 col-form-label">Sunucu IP:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="serverIP" class="form-control" name="serverIP" placeholder="Sunucu IP adresini giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="serverPort" class="col-sm-2 col-form-label">Sunucu Port:</label>
                                <div class="col-sm-10">
                                    <input type="number" id="serverPort" class="form-control" name="serverPort" placeholder="Sunucu portunu giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="senderType" class="col-sm-2 col-form-label">Konsol Türü:</label>
                                <div class="col-sm-10">
                                    <select name="senderType" class="form-control" id="senderType">
                                        <option value="1">Websend</option>
                                        <option value="2">Websender</option>
                                        <option value="3">RCON</option>    
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="senderPort" class="col-sm-2 col-form-label">Konsol Port:</label>
                                <div class="col-sm-10">
                                    <input type="number" id="senderPort" class="form-control" name="senderPort" placeholder="Konsol portunu giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="senderPassword" class="col-sm-2 col-form-label">Konsol Şifre:</label>
                                <div class="col-sm-10">
                                    <input type="password" id="senderPassword" class="form-control" name="senderPassword" placeholder="Konsol şifresi giriniz.">
                                    <label class="mt-2">
                                        <a href="javascript:;" onclick="serverCheck('#serverForm', this)">
                                            Konsol Bağlantısını Kontrol Et
                                        </a>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Resim:</label>
                                <div class="col-sm-10">
                                    <div class="imageInput">
                                        <div class="img-thumbnail">
                                            <img id="imagePreview" src="" alt="Ön İzleme">
                                        </div>
                                        <div class="img-select">
                                            <label for="image">Bir Resim Seçiniz</label>
                                            <input type="file" data-toggle="imageInput" id="image" name="image" accept="image/*">
                                        </div>
                                    </div>
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
                    
                    <h4 class="mb-0 font-size-18">Sunucu Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza Yönetimi</a></li>
                            <li class="breadcrumb-item active">Sunucu Düzenle</li>
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
                        <form id="serverForm" action="" enctype="multipart/form-data" method="post">

                            <div class="form-group row">
                                <label for="heading" class="col-sm-2 col-form-label">Sunucu Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$query['heading']?>" id="heading" class="form-control" name="heading" placeholder="Sunucu adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="serverIP" class="col-sm-2 col-form-label">Sunucu IP:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$query['serverIP']?>" id="serverIP" class="form-control" name="serverIP" placeholder="Sunucu IP adresini giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="serverPort" class="col-sm-2 col-form-label">Sunucu Port:</label>
                                <div class="col-sm-10">
                                    <input type="number" value="<?=$query['serverPort']?>" id="serverPort" class="form-control" name="serverPort" placeholder="Sunucu portunu giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="senderType" class="col-sm-2 col-form-label">Konsol Türü:</label>
                                <div class="col-sm-10">
                                    <select name="senderType" class="form-control" id="senderType">
                                        <option <?=($query['senderType']==1)?"selected":""?> value="1">Websend</option>
                                        <option <?=($query['senderType']==2)?"selected":""?> value="2">Websender</option>
                                        <option <?=($query['senderType']==3)?"selected":""?> value="3">RCON</option>    
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="senderPort" class="col-sm-2 col-form-label">Konsol Port:</label>
                                <div class="col-sm-10">
                                    <input type="number" value="<?=$query['senderPort']?>" id="senderPort" class="form-control" name="senderPort" placeholder="Konsol portunu giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="senderPassword" class="col-sm-2 col-form-label">Konsol Şifre:</label>
                                <div class="col-sm-10">
                                    <input type="password" id="senderPassword" class="form-control" name="senderPassword" placeholder="Konsol şifresi giriniz. (Değiştirmek istemiyorsanız boş bırakın.)">
                                    <label class="mt-2">
                                        <a href="javascript:;" onclick="serverCheck('#serverForm', this)">
                                            Konsol Bağlantısını Kontrol Et
                                        </a>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Resim:</label>
                                <div class="col-sm-10">
                                    <div class="imageInput active">
                                        <div class="img-thumbnail">
                                            <img id="imagePreview" src="<?=$find_read_panel.$query['image']?>" alt="Ön İzleme">
                                        </div>
                                        <div class="img-select">
                                            <label for="image">Bir Resim Seçiniz</label>
                                            <input type="file" data-toggle="imageInput" id="image" name="image" accept="image/*">
                                        </div>
                                    </div>
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

<?php elseif($action[1]=="konsol"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Sunucu Konsolu</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza Yönetimi</a></li>
                            <li class="breadcrumb-item active">Sunucu Konsolu</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="consoleRow">
                    <div class="card card-default" id="consoleContent">
                        <div class="card-header">
                            <h3 class="card-title float-left mb-0">
                                <?=$query['heading']?>
                            </h3>
                        </div>
                        <div class="card-body" style="height: 250px;overflow: auto;">
                            <ul class="list-group" id="groupConsole"></ul>
                        </div>
                        <div class="card-footer">

                            <div class="input-group" id="consoleCommand">
                                <div id="txtCommandResults"></div>
                                <input type="text" placeholder="Konsola gönderilecek komudu giriniz." class="form-control" id="txtCommand" server-id="<?=$query['id']?>" />
                                <div class="input-group-btn">

                                    <button type="button" class="btn btn-primary ml-1" id="btnSend">
                                        <span>Gönder</span>
                                    </button>
                            
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

<?php endif; ?>

<?php require 'static/footer.php' ?>