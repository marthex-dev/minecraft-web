<?php require 'static/header.php' ?>

<?php if ($action[1]=="liste"): ?>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Slider Listesi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Slider Yönetimi</a></li>
                            <li class="breadcrumb-item active">Slider Listesi</li>
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
                                    <a class="btn btn-sm btn-white" href="slider/ekle">Slider Ekle</a>
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
                                    <th>Bağlantı</th>
                                    <th class="text-center">Tarih</th>
                                    <th class="text-right">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php
                                if ($query):
                                    foreach ($query as $row):
                                         ?>
                                        <tr>
                                            <td class="text-center"><a href="slider/duzenle/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                            <td><a href="slider/duzenle/<?=$row['id']?>"><?=$row['heading']?></a></td>
                                            <td><?=$row['link']?></td>
                                            <td class="text-center"><?=convertTime($row['creationDate'], 2, true)?></td>
                                            <td class="text-right">
                                                <a
                                                    class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                    href="slider/duzenle/<?=$row['id']?>"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Düzenle"
                                                >
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="slider/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
                    
                    <h4 class="mb-0 font-size-18">Slider Ekle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Slider Yönetimi</a></li>
                            <li class="breadcrumb-item active">Slider Ekle</li>
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
                                <label for="type" class="col-sm-2 col-form-label">Slider Tipi:</label>
                                <div class="col-sm-10">
                                    <select id="sliderType" name="type" class="form-control custom-select">

                                        <option value="1">Yarım Resim</option>
                                        <option value="2">Full Resim</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="heading" class="col-sm-2 col-form-label">Başlık:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="heading" class="form-control" name="heading" placeholder="Slider başlığı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link" class="col-sm-2 col-form-label">Bağlantı (Link):</label>
                                <div class="col-sm-10">
                                    <input type="text" id="link" class="form-control" name="link" placeholder="Tıklayınca gidilecek bağlantıyı (link) yazınız.">
                                </div>
                            </div>

                            <div id="sliderContent" class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">İçerik:</label>
                                <div class="col-sm-10">
                                    <textarea data-toggle="quill" name="content" class="form-control" rows="5"></textarea>
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
                    
                    <h4 class="mb-0 font-size-18">Slider Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Slider Yönetimi</a></li>
                            <li class="breadcrumb-item active">Slider Düzenle</li>
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
                                <label for="type" class="col-sm-2 col-form-label">Slider Tipi:</label>
                                <div class="col-sm-10">
                                    <select id="sliderType" name="type" class="form-control custom-select">

                                        <option <?=($readSlider['type'] ==1)?"selected":""?> value="1">Yarım Resim</option>
                                        <option <?=($readSlider['type'] ==2)?"selected":""?> value="2">Full Resim</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="heading" class="col-sm-2 col-form-label">Başlık:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$readSlider['heading']?>" id="heading" class="form-control" name="heading" placeholder="Slider başlığı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link" class="col-sm-2 col-form-label">Bağlantı (Link):</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$readSlider['link']?>" id="link" class="form-control" name="link" placeholder="Tıklayınca gidilecek bağlantıyı (link) yazınız.">
                                </div>
                            </div>

                            <div id="sliderContent" class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">İçerik:</label>
                                <div class="col-sm-10">
                                    <textarea data-toggle="quill" name="content" class="form-control" rows="5"><?=$readSlider['content']?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Resim:</label>
                                <div class="col-sm-10">
                                    <div class="imageInput active">
                                        <div class="img-thumbnail">
                                            <img id="imagePreview" src="<?=$find_read_panel.$readSlider['image']?>" alt="Ön İzleme">
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

<?php endif; ?>

<?php require 'static/footer.php' ?>