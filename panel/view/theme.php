<?php require 'static/header.php' ?>

<?php if ($action[1]=="genel"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Genel Ayarlar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tema</a></li>
                            <li class="breadcrumb-item active">Genel Ayarlar</li>
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
                                <label for="theme" class="col-sm-2 col-form-label">Tema:</label>
                                <div class="col-sm-10">
                                    <select name="theme" id="theme" class="form-control custom-select">
                                        <option <?=($theme['theme']=="2020")?"selected":""?> value="2020">2020</option>
                                        <option <?=($theme['theme']=="2021")?"selected":""?> value="2021">2021</option>
                                        <option <?=($theme['theme']=="2022")?"selected":""?> value="2022">2022</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="broadcast" class="col-sm-2 col-form-label">Duyuru Bandı:</label>
                                <div class="col-sm-10">
                                    <select name="broadcast" id="broadcast" class="form-control custom-select">
                                        <option <?=($theme['broadcast']==0)?"selected":""?> value="0">Kapalı</option>
                                        <option <?=($theme['broadcast']==1)?"selected":""?> value="1">Açık</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slider" class="col-sm-2 col-form-label">Slider:</label>
                                <div class="col-sm-10">
                                    <select name="slider" id="slider" class="form-control custom-select">
                                        <option  <?=($theme['slider']==0)?"selected":""?> value="0">Kapalı</option>
                                        <option <?=($theme['slider']==1)?"selected":""?> value="1">Açık</option>
                                    </select>
                                </div>
                            </div>

                            <div id="sliderTypeDiv" class="form-group row">
                                <label for="sliderType" class="col-sm-2 col-form-label">Slider Tipi:</label>
                                <div class="col-sm-10">
                                    <select name="sliderType" id="sliderType" class="form-control custom-select">
                                        <option <?=($theme['sliderType']==0)?"selected":""?> value="0">Büyük</option>
                                        <option <?=($theme['sliderType']==1)?"selected":""?> value="1">Küçük</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sidebar" class="col-sm-2 col-form-label">Sidebar:</label>
                                <div class="col-sm-10">
                                    <select name="sidebar" id="sidebar" class="form-control custom-select">
                                        <option <?=($theme['sidebar']==0)?"selected":""?> value="0">Kapalı</option>
                                        <option <?=($theme['sidebar']==1)?"selected":""?> value="1">Açık</option>
                                    </select>
                                </div>
                            </div>

                            <div id="sidebarDiv">

                                <div class="form-group row">
                                    <label for="discord" class="col-sm-2 col-form-label">Discord:</label>
                                    <div class="col-sm-10">
                                        <select name="discord" id="discord" class="form-control custom-select">
                                            <option <?=($theme['discord']==0)?"selected":""?> value="0">Kapalı</option>
                                            <option <?=($theme['discord']==1)?"selected":""?> value="1">Açık</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="discordDiv">

                                    <div class="form-group row">
                                        <label for="discordTheme" class="col-sm-2 col-form-label">Discord Tema:</label>
                                        <div class="col-sm-10">
                                            <select name="discordTheme" id="discordTheme" class="form-control custom-select">
                                                <option <?=($theme['discordTheme']==0)?"selected":""?> value="0">Light</option>
                                                <option <?=($theme['discordTheme']==1)?"selected":""?> value="1">Dark</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="discordServerID" class="col-sm-2 col-form-label">Discord Sunucu ID:</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="<?=$theme['discordServerID']?>" class="form-control" name="discordServerID">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="newsCardType" class="col-sm-2 col-form-label">Haber Kart Tipi:</label>
                                <div class="col-sm-10">
                                    <select name="newsCardType" id="newsCardType" class="form-control custom-select">
                                        <option <?=($theme['newsCardType']==0)?"selected":""?> value="0">Yatay</option>
                                        <option <?=($theme['newsCardType']==1)?"selected":""?> value="1">Dikey</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="headerType" class="col-sm-2 col-form-label">Header Tipi:</label>
                                <div class="col-sm-10">
                                    <select name="headerType" id="headerType" class="form-control custom-select">
                                        <option <?=($theme['headerType']==0)?"selected":""?> value="0">Büyük</option>
                                        <option <?=($theme['headerType']==1)?"selected":""?> value="1">Küçük</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="headerTheme" class="col-sm-2 col-form-label">Header Teması:</label>
                                <div class="col-sm-10">
                                    <select name="headerTheme" id="headerTheme" class="form-control custom-select">
                                        <option <?=($theme['headerTheme']==0)?"selected":""?> value="0">HiveMC</option>
                                        <option <?=($theme['headerTheme']==1)?"selected":""?> value="1">The Archon</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="menuType" class="col-sm-2 col-form-label">Menü Tipi:</label>
                                <div class="col-sm-10">
                                    <select name="menuType" id="menuType" class="form-control custom-select">
                                        <option <?=($theme['menuType']==0)?"selected":""?> value="0">Büyük</option>
                                        <option <?=($theme['menuType']==1)?"selected":""?> value="1">Küçük</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="footerType" class="col-sm-2 col-form-label">Footer Tipi:</label>
                                <div class="col-sm-10">
                                    <select name="footerType" id="footerType" class="form-control custom-select">
                                        <option <?=($theme['footerType']==0)?"selected":""?> value="0">Büyük</option>
                                        <option <?=($theme['footerType']==1)?"selected":""?> value="1">Küçük</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slice" class="col-sm-2 col-form-label">Slice:</label>
                                <div class="col-sm-10">
                                    <select name="slice" id="slice" class="form-control custom-select">
                                        <option <?=($theme['slice']==0)?"selected":""?> value="0">Kapalı</option>
                                        <option <?=($theme['slice']==1)?"selected":""?> value="1">Açık</option>
                                    </select>
                                </div>
                            </div>

                            <div id="sliceDiv">

                                <div class="form-group row">
                                    <label for="sliceHeading" class="col-sm-2 col-form-label">Slice Başlık:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?=$theme['sliceHeading']?>" id="sliceHeading" class="form-control" name="sliceHeading" placeholder="Slice başlığı giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sliceSubHeading" class="col-sm-2 col-form-label">Slice Alt Başlık:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?=$theme['sliceSubHeading']?>" id="sliceSubHeading" class="form-control" name="sliceSubHeading" placeholder="Slice alt başlığı giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sliceType" class="col-sm-2 col-form-label">Slice Tipi:</label>
                                    <div class="col-sm-10">
                                        <select name="sliceType" id="sliceType" class="form-control custom-select">
                                            <option <?=($theme['sliceType']==0)?"selected":""?> value="0">Büyük</option>
                                            <option <?=($theme['sliceType']==1)?"selected":""?> value="1">Küçük</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Slice Arka Plan:</label>
                                    <div class="col-sm-10">
                                        <div id="imageInput" class="imageInput active">
                                            <div class="img-thumbnail">
                                                <img id="imagePreview" src="<?=$find_read_panel.$theme['sliceBg']?>" alt="Ön İzleme">
                                            </div>
                                            <div class="img-select">
                                                <label for="sliceBg">Bir Resim Seçiniz</label>
                                                <input onchange="readImageTheme(this, '#imagePreview', '#imageInput');" type="file" data-toggle="imageInputTheme" id="sliceBg" name="sliceBg" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Header Logo:</label>
                                <div class="col-sm-10">
                                    <div id="imageInput1" class="imageInput active">
                                        <div class="img-thumbnail">
                                            <img id="imagePreview1" src="<?=$find_read_panel.$theme['headerLogo']?>" alt="Ön İzleme">
                                        </div>
                                        <div class="img-select">
                                            <label for="headerLogo">Bir Resim Seçiniz</label>
                                            <input onchange="readImageTheme(this, '#imagePreview1', '#imageInput1');" type="file" data-toggle="imageInputTheme" id="headerLogo" name="headerLogo" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Header Arka Plan:</label>
                                <div class="col-sm-10">
                                    <select name="headerBgStatus" id="headerBgStatus" class="form-control custom-select mb-2">
                                        <option <?=($theme['headerBgStatus']==0)?"selected":""?> value="0">Transparent</option>
                                        <option <?=($theme['headerBgStatus']==1)?"selected":""?> value="1">Resim</option>
                                    </select>

                                    <div id="imageInput2" class="imageInput active">
                                        <div class="img-thumbnail">
                                            <img id="imagePreview2" src="<?=$find_read_panel.$theme['headerBg']?>" alt="Ön İzleme">
                                        </div>
                                        <div class="img-select">
                                            <label for="headerBg">Bir Resim Seçiniz</label>
                                            <input onchange="readImageTheme(this, '#imagePreview2', '#imageInput2');" type="file" data-toggle="imageInputTheme" id="headerBg" name="headerBg" accept="image/*">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Giriş Arka Plan:</label>
                                <div class="col-sm-10">
                                    <select name="loginBgStatus" id="loginBgStatus" class="form-control custom-select mb-2">
                                        <option <?=($theme['loginBgStatus']==0)?"selected":""?> value="0">Video</option>
                                        <option <?=($theme['loginBgStatus']==1)?"selected":""?> value="1">Resim</option>
                                    </select>

                                    <div id="imageInput3" class="imageInput active">
                                        <div class="img-thumbnail">
                                            <img id="imagePreview3" src="<?=$find_read_panel.$theme['loginBg']?>" alt="Ön İzleme">
                                        </div>
                                        <div class="img-select">
                                            <label for="loginBg">Bir Resim Seçiniz</label>
                                            <input onchange="readImageTheme(this, '#imagePreview3', '#imageInput3');" type="file" data-toggle="imageInputTheme" id="loginBg" name="loginBg" accept="image/*">
                                        </div>
                                    </div>

                                    <div id="imageInput4" class="form-group row">
                                        <div class="col-sm-12">
                                            <input value="<?=$theme['youtubeEmbed']?>" type="text" class="form-control" placeholder="Kayıt ol, Giriş ve Bakım ekranındaki Video'nun Youtube Embed Kodunu giriniz" name="youtubeEmbed">
                                            <small class="text-muted pb-2"><strong>Kayıt ol, Giriş ve Bakım ekranındaki Video'nun Youtube Embed Kodunu giriniz.</strong></small>
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

<?php elseif($action[1]=="css"): ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">CSS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tema</a></li>
                        <li class="breadcrumb-item active">CSS</li>
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
                            <label for="css" class="col-sm-12 col-form-label">CSS Kodlarınızı bu alana giriniz:</label>
                            <div class="col-sm-12">
                                <textarea id="css" name="css" data-toggle="code-mirror" class="form-control"><?=$theme['css']?></textarea>
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

<?php elseif ($action[1]=="header"): ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Header</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tema Ayarları</a></li>
                            <li class="breadcrumb-item active">Header</li>
                        </ol>
                    </div>

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

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    <form id="menuform">

                        <div class="form-group d-none">
                            <label for="id">ID : </label>
                            <input type="text" class="form-control" name="id" id="id" placeholder="ID Giriniz." />
                        </div>

                        <div class="form-group">
                            <label for="heading">Başlık : </label>
                            <input type="text" class="form-control" name="heading" id="heading" placeholder="Başlık Giriniz" />
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon : </label>
                            <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon Giriniz" />
                            <small class="form-text text-muted pt-2">İkonları Görüntülemek için <a href="ikon" target="_blank">Tıklayınız</a></small>
                        </div>

                        <div class="form-group">
                            <label for="link">Link : </label>
                            <input name="link" type="text" class="form-control" id="link" placeholder="Link Giriniz" />
                        </div>

                        <div class="form-group">
                            <label for="menu">Sekme : </label>
                            <select name="tab" class="form-control custom-select">
                                <option value="0">Aynı Sekme</option>
                                <option value="1">Yeni Sekme</option>
                            </select>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button id="addButton" onclick="addMenu('#menuform')" type="button" class="btn btn-primary">Ekle</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="nestable" class="dd w-100 mw-100">
                        <ol id="nestable-list" class="dd-list">

                            <?php foreach ($menuList as $readMenu): ?>

                            <?php

                            $totalParent = $db->from('Menu')->where('parent', $readMenu['id'])->select('count(*) as total')->total();

                            if ($totalParent > 0):

                            ?>


                            <li class="dd-item" data-id="<?=$readMenu['id']?>">
                                <div class="dd-handle">
                                    <div class="dd-handle-left">
                                        <i class="mdi <?=$readMenu['icon']?>"></i>
                                        <?=$readMenu['heading']?>
                                    </div>
                                    <div class="dd-handle-right">
                                        <a onclick="editMenu('<?=$readMenu['id']?>')" class="btn btn-sm btn-success text-white" data-id="<?=$readMenu['id']?>" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Düzenle">
                                            <i class="bx bxs-edit-alt"></i>
                                        </a>
                                        <a data-id="<?=$readMenu['id']?>" onclick="deleteMenu('<?=$readMenu['id']?>')" class="btn btn-sm btn-danger" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                            <i class="bx bx-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                                <ol class="dd-list">
                                    <?php 

                                        $parents = $db->from('Menu')->where('parent', $readMenu['id'])->orderby('sort', 'ASC')->all();

                                        foreach ($parents as $readParent): 


                                    ?>
                                    <li class="dd-item" data-id="<?=$readParent['id']?>">
                                        <div class="dd-handle">
                                            <div class="dd-handle-left">
                                                <i class="mdi <?=$readParent['icon']?>"></i>
                                                <?=$readParent['heading']?>
                                            </div>
                                            <div class="dd-handle-right">
                                                <a onclick="editMenu('<?=$readParent['id']?>')" class="btn btn-sm btn-success text-white" data-id="<?=$readParent['id']?>" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Düzenle">
                                                    <i class="bx bxs-edit-alt"></i>
                                                </a>
                                                <a data-id="<?=$readParent['id']?>" onclick="deleteMenu('<?=$readParent['id']?>')" class="btn btn-sm btn-danger" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                    <i class="bx bx-trash-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>

                                    <?php endforeach; ?>

                                </ol>
                            </li>

                            <?php else: ?>

                            <li class="dd-item" data-id="<?=$readMenu['id']?>">
                                <div class="dd-handle">
                                    <div class="dd-handle-left">
                                        <i class="mdi <?=$readMenu['icon']?>"></i>
                                        <?=$readMenu['heading']?>
                                    </div>
                                    <div class="dd-handle-right">
                                        <a onclick="editMenu('<?=$readMenu['id']?>')" class="btn btn-sm btn-success text-white" data-id="<?=$readMenu['id']?>" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Düzenle">
                                            <i class="bx bxs-edit-alt"></i>
                                        </a>
                                        <a onclick="deleteMenu('<?=$readMenu['id']?>')" data-id="<?=$readMenu['id']?>" class="btn btn-sm btn-danger" href="javascript:;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                            <i class="bx bx-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <?php endif; ?>

                            <?php endforeach; ?>
                            
                        </ol>
                    </div>

                    <input type="hidden" id="nestable-output" />

                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ($action[1]=="renk"): ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Renk</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tema Ayarları</a></li>
                            <li class="breadcrumb-item active">Renk</li>
                        </ol>
                    </div>

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
                        <?php if ($theme['theme']=="2020"): ?>

                        <div class="form-group row">
                            <label for="categoryHeading" class="col-sm-2 col-form-label">Body Rengi:</label>
                            <div class="col-sm-10">
                                <div data-toggle="color-picker" class="input-group">
                                    <input type="text" value="<?=$colors['0']?>" id="categoryColor" class="form-control input-lg" name="color[]" placeholder="Body rengi seçiniz.">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                    </span>
                                </div>
                                <small class="form-text text-muted pt-2"><strong>Varsayılan:</strong> #1C1C1C</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoryHeading" class="col-sm-2 col-form-label">Footer Rengi:</label>
                            <div class="col-sm-10">
                                <div data-toggle="color-picker" class="input-group">
                                    <input type="text" value="<?=$colors['1']?>" id="categoryColor" class="form-control input-lg" name="color[]" placeholder="Footer rengi seçiniz.">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                    </span>
                                </div>
                                <small class="form-text text-muted pt-2"><strong>Varsayılan:</strong> #272727</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoryHeading" class="col-sm-2 col-form-label">Birinci Renk:</label>
                            <div class="col-sm-10">
                                <div data-toggle="color-picker" class="input-group">
                                    <input type="text" value="<?=$colors['2']?>" id="categoryColor" class="form-control input-lg" name="color[]" placeholder="Birinci rengi seçiniz.">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                    </span>
                                </div>
                                <small class="form-text text-muted pt-2"><strong>Varsayılan:</strong> #F3755D</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoryHeading" class="col-sm-2 col-form-label">İkinci Renk:</label>
                            <div class="col-sm-10">
                                <div data-toggle="color-picker" class="input-group">
                                    <input type="text" value="<?=$colors['3']?>" id="categoryColor" class="form-control input-lg" name="color[]" placeholder="İkinci rengi seçiniz.">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                    </span>
                                </div>
                                <small class="form-text text-muted pt-2"><strong>Varsayılan:</strong> #FBD7D7</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoryHeading" class="col-sm-2 col-form-label">Üçüncü Renk:</label>
                            <div class="col-sm-10">
                                <div data-toggle="color-picker" class="input-group">
                                    <input type="text" value="<?=$colors['4']?>" id="categoryColor" class="form-control input-lg" name="color[]" placeholder="Üçüncü rengi seçiniz.">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                    </span>
                                </div>
                                <small class="form-text text-muted pt-2"><strong>Varsayılan:</strong> #2A2A2A</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoryHeading" class="col-sm-2 col-form-label">Dördüncü Renk:</label>
                            <div class="col-sm-10">
                                <div data-toggle="color-picker" class="input-group">
                                    <input type="text" value="<?=$colors['5']?>" id="categoryColor" class="form-control input-lg" name="color[]" placeholder="Dördüncü rengi seçiniz.">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                    </span>
                                </div>
                                <small class="form-text text-muted pt-2"><strong>Varsayılan:</strong> #FFFFFF</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoryHeading" class="col-sm-2 col-form-label">Başarılı Renk:</label>
                            <div class="col-sm-10">
                                <div data-toggle="color-picker" class="input-group">
                                    <input type="text" value="<?=$colors['6']?>" id="categoryColor" class="form-control input-lg" name="color[]" placeholder="Başarılı rengi seçiniz.">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                    </span>
                                </div>
                                <small class="form-text text-muted pt-2"><strong>Varsayılan:</strong> #61DF69</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categoryHeading" class="col-sm-2 col-form-label">Discord Rengi:</label>
                            <div class="col-sm-10">
                                <div data-toggle="color-picker" class="input-group">
                                    <input type="text" value="<?=$colors['7']?>" id="categoryColor" class="form-control input-lg" name="color[]" placeholder="Discord rengi seçiniz.">
                                    <span class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                    </span>
                                </div>
                                <small class="form-text text-muted pt-2"><strong>Varsayılan:</strong> #7F9DFF</small>
                            </div>
                        </div>

                        <?php endif; ?>

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

<script type="text/javascript">


</script>