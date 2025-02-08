<?php require 'static/header.php' ?>

<?php if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Kasalar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kasa Yönetimi</a></li>
                            <li class="breadcrumb-item active">Kasalar</li>
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
                                    <a class="btn btn-sm btn-white" href="kasa/ekle">Kasa Ekle</a>
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
                                        <th class="text-center">Sunucu</th>
                                        <th class="text-center">Açma Ücreti</th>
                                        <th class="text-center">Tekrar Açma Süresi</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if ($totalCase > 0): ?>
                                        <?php foreach ($cases as $readCase): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <a href="kasa/duzenle/<?=$readCase['id']?>">
                                                        #<?=$readCase['id']?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="kasa/duzenle/<?=$readCase['id']?>">
                                                        <?=$readCase['heading']?>
                                                    </a>
                                                </td>
                                                <td class="text-center"><?=$readCase['serverName']?></td>
                                                <td class="text-center">
                                                    <?=($readCase['priceStatus']==1)?$readCase['casePrice']." Kredi":"Ücretsiz"?>
                                                </td>
                                                <td class="text-center">
                                                    <?=($readCase['priceStatus']==1)?"-":$readCase['caseDuration']?>
                                                </td>
                                                <td class="text-right">
                                                    <a
                                                        class="btn btn-sm btn-success text-white"
                                                        href="kasa/duzenle/<?=$readCase['id']?>"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title=""
                                                        data-original-title="Düzenle"
                                                    >
                                                        <i class="bx bxs-edit-alt"></i>
                                                    </a>
                                                    <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-danger" href="kasa/liste/sil/<?=$readCase['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                        <i class="bx bx-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="6">Kayıt Bulunamadı</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$_POST && $totalCase > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="kasa/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="kasa/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php elseif ($action[1]=="ekle"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Kasa Ekle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kasa Yönetimi</a></li>
                            <li class="breadcrumb-item active">Kasa Ekle</li>
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
                                <label for="heading" class="col-sm-2 col-form-label">Kasa Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="heading" class="form-control" name="heading" placeholder="Kasa adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="servers" class="col-sm-2 col-form-label">Sunucu:</label>
                                <div class="col-sm-10">
                                    <select name="servers" class="form-control custom-select">
                                        <?php if($servers): ?>
    
                                            <?php foreach ($servers as $key => $value): ?>
    
                                            <option value="<?=$value['id']?>">
                                                
                                                <?=$value['heading']?>
    
                                            </option>
    
                                            <?php endforeach; ?>
                                        
                                        <?php else: ?>
                                            
                                            <option>
                                                Sunucu ekleyiniz.
                                            </option>
                                        
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="casePriceStatus" class="col-sm-2 col-form-label">Kasa Ücreti:</label>
                                <div class="col-sm-10">
                                    <select name="casePriceStatus" class="form-control custom-select">
                                        <option value="0">Ücretsiz</option>
                                        <option value="1">Ücretli</option>
                                    </select>
                                </div>
                            </div>

                            <div id="casePrice" class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <input type="number" id="price" class="form-control" name="price" placeholder="Kasayı açmak için gereken ücreti giriniz.">
                                </div>
                            </div>

                            <div id="caseDuration" class="form-group row">
                                <label for="duration" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <input type="number" id="duration" class="form-control" name="duration" placeholder="Kasanın kaç saatte bir açılabileceğini giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="caseContent" class="col-sm-2 pt-3 col-form-label">Kasa İçeriği:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table id="caseTable" class="table table-nowrap card-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;">
                                                        Ödül Tipi
                                                    </th>
                                                    <th style="vertical-align: middle;">
                                                        Ödül
                                                    </th>
                                                    <th style="vertical-align: middle;">
                                                        Kazanma Şansı (%)
                                                    </th>
                                                    <th style="vertical-align: middle;">
                                                        Arkaplan Rengi
                                                    </th>
                                                    <th class="text-right">
                                                        <a class="btn btn-sm btn-rounded-circle btn-success w-100" onclick="copyCommands('1', '#caseContent')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
                                                            <i class="bx bx-plus"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody id="caseContent" class="list">

                                                <tr>
                                                    <td class="text-center">
                                                        <select name="type[]" onchange="getProducts(this)" class="form-control custom-select">
                                                            <option value="0">Kredi</option>
                                                            <option value="1">Ürün</option>
                                                            <option value="2">Pas</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="awardCredit">
                                                            <input type="number" class="form-control" name="award[]" placeholder="Kredi miktarını giriniz.">
                                                        </div>
                                                        <div class="awardProduct" style="display: none;">
                                                            <select name="award[]" class="form-control custom-select">
                                                                
                                                            </select>
                                                        </div>
                                                        <div class="awardPas" style="display: none;">
                                                            <select name="award[]" class="form-control border-0 custom-select" disabled="">
                                                                <option value="0">Ödül Yok</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control" name="chance[]" placeholder="Yüzdelik olarak giriniz.">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" data-toggle="color-picker" class="form-control" placeholder="#000000" name="color[]">
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#caseTable')" class="btn btn-sm btn-rounded-circle btn-danger w-100">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
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

<?php elseif ($action[1]=="duzenle"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Kasa Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kasa Yönetimi</a></li>
                            <li class="breadcrumb-item active">Kasa Düzenle</li>
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
                                <label for="heading" class="col-sm-2 col-form-label">Kasa Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$readCase['heading']?>" id="heading" class="form-control" name="heading" placeholder="Kasa adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="servers" class="col-sm-2 col-form-label">Sunucu:</label>
                                <div class="col-sm-10">
                                    <select name="servers" class="form-control custom-select">
                                        <?php if($servers): ?>
    
                                            <?php foreach ($servers as $key => $value): ?>
    
                                            <option <?=($readCase['serverID']==$value['id'])?"selected":""?> value="<?=$value['id']?>">
                                                
                                                <?=$value['heading']?>
    
                                            </option>
    
                                            <?php endforeach; ?>
                                        
                                        <?php else: ?>
                                            
                                            <option>
                                                Sunucu ekleyiniz.
                                            </option>
                                        
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="casePriceStatus" class="col-sm-2 col-form-label">Kasa Ücreti:</label>
                                <div class="col-sm-10">
                                    <select name="casePriceStatus" class="form-control custom-select">
                                        <option <?=($readCase['priceStatus']==0)?"selected":""?> value="0">Ücretsiz</option>
                                        <option <?=($readCase['priceStatus']==1)?"selected":""?> value="1">Ücretli</option>
                                    </select>
                                </div>
                            </div>

                            <div id="casePrice" class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <input value="<?=$readCase['casePrice']?>" type="number" id="price" class="form-control" name="price" placeholder="Kasayı açmak için gereken ücreti giriniz.">
                                </div>
                            </div>

                            <div id="caseDuration" class="form-group row">
                                <label for="duration" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <input value="<?=$readCase['caseDuration']?>" type="number" id="duration" class="form-control" name="duration" placeholder="Kasanın kaç saatte bir açılabileceğini giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="caseContent" class="col-sm-2 pt-3 col-form-label">Kasa İçeriği:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table id="caseTable" class="table table-nowrap card-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;">
                                                        Ödül Tipi
                                                    </th>
                                                    <th style="vertical-align: middle;">
                                                        Ödül
                                                    </th>
                                                    <th style="vertical-align: middle;">
                                                        Kazanma Şansı (%)
                                                    </th>
                                                    <th style="vertical-align: middle;">
                                                        Arkaplan Rengi
                                                    </th>
                                                    <th class="text-right">
                                                        <a class="btn btn-sm btn-rounded-circle btn-success w-100" onclick="copyCommands('1', '#caseContent')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
                                                            <i class="bx bx-plus"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody id="caseContent" class="list">
                                                <?php 

                                                $caseContent = json_decode(base64_decode($readCase['caseContent']), true);

                                                foreach ($caseContent as $key => $readCaseContent):

                                                ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <select name="type[]" onchange="getProducts(this)" class="form-control custom-select">
                                                            <option <?=($readCaseContent['type']==0)?"selected":""?> value="0">Kredi</option>
                                                            <option <?=($readCaseContent['type']==1)?"selected":""?> value="1">Ürün</option>
                                                            <option <?=($readCaseContent['type']==2)?"selected":""?> value="2">Pas</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="awardCredit" style="display: <?=($readCaseContent['type']==0)?"block":"none"?>;">
                                                            <input type="number" <?=($readCaseContent['type']!=0)?"disabled":""?> class="form-control" name="award[]" value="<?=($readCaseContent['type']==0)?$readCaseContent['award']:''?>" placeholder="Kredi miktarını giriniz.">
                                                        </div>
                                                        <div class="awardProduct" style="display: <?=($readCaseContent['type']==1)?"block":"none"?>;">
                                                            <select name="award[]" class="form-control custom-select" <?=($readCaseContent['type']!=1)?"disabled":""?>>
                                                                <?php
                                                                if ($readCaseContent['type']==1):
                                                                    
                                                                    $totalCategories = $db->from('ProductsCategories')->where('serverID', $readCase['serverID'])->select('count(*) as total')->total();

                                                                    if ($totalCategories > 0):
                                                                        
                                                                        $totalProducts = $db->from('Products')->where('serverID', $readCase['serverID'])->select('count(*) as total')->total();

                                                                        if ($totalProducts > 0):
                                                                            
                                                                            $categories = $db->from('ProductsCategories')->where('serverID', $readCase['serverID'])->all();

                                                                            foreach ($categories as $readCategories):
                                                                                
                                                                                echo "<optgroup label=" . $readCategories['heading'] . "></optgroup>";

                                                                                $products = $db->from('Products')->where('serverID', $readCase['serverID'])->where('categoryID', $readCategories['id'])->all();

                                                                                foreach ($products as $readProducts):
                                                                                    
                                                                                    if ($readCaseContent['type']==1 && $readCaseContent['award']==$readProducts['id']):
                                                                                        
                                                                                        echo '<option selected value="' . $readProducts["id"] . '">'. $readProducts["heading"] . '</option>';

                                                                                    else:

                                                                                        echo '<option value="' . $readProducts["id"] . '">'. $readProducts["heading"] . '</option>';

                                                                                    endif;

                                                                                endforeach;

                                                                            endforeach;

                                                                        else:

                                                                            echo "<option> Henüz Ürün Eklenmemiş </option>";

                                                                        endif;

                                                                    else:

                                                                        echo "<option> Henüz Kategori Eklenmemiş </option>";

                                                                    endif;

                                                                endif;

                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="awardPas" style="display: <?=($readCaseContent['type']==2)?"block":"none"?>;">
                                                            <select name="award[]" class="form-control border-0 custom-select" <?=($readCaseContent['type']!=2)?"disabled":""?>>
                                                                <option value="0">Ödül Yok</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <input value="<?=$readCaseContent['chance']?>" type="text" class="form-control" name="chance[]" placeholder="Yüzdelik olarak giriniz.">
                                                    </td>
                                                    <td class="text-center">
                                                        <input value="<?=$readCaseContent['color']?>" type="text" data-toggle="color-picker" class="form-control" placeholder="#000000" name="color[]">
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#caseTable')" class="btn btn-sm btn-rounded-circle btn-danger w-100">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Resim:</label>
                                <div class="col-sm-10">
                                    <div class="imageInput active">
                                        <div class="img-thumbnail">
                                            <img id="imagePreview" src="<?=$find_read_panel.$readCase['image']?>" alt="Ön İzleme">
                                        </div>
                                        <div class="img-select">
                                            <label for="image">Bir Resim Seçiniz</label>
                                            <input type="file" data-toggle="imageInput" id="image" name="image" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="float-right">
                                <button type="submit" class="btn btn-success">Düzenle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php elseif ($action[1] == "gecmis"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Kasa Geçmişi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kasa Yönetimi</a></li>
                            <li class="breadcrumb-item active">Kasa Geçmişi</li>
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
                                        <th>Kasa Adı</th>
                                        <th>Ödül</th>
                                        <th>Tarih</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php 
                                        if ($totalHistory > 0):
                                            foreach ($caseHistory as $row):
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            #<?=$row['id']?>
                                        </td>
                                        <td>
                                            <a href="hesap/goruntule/<?=$row['accID']?>">
                                                <?=$row['username']?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="kasa/duzenle/<?=$row['cID']?>">
                                                <?=$row['heading']?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($row['type']==0): ?>

                                                <span> <?=$row['award']?> Kredi </span>

                                            <?php elseif ($row['type']==1): ?>

                                                <?php $products = $db->from('Products')->where('id', $row['award'])->first(); ?>

                                                <span><?=$products['heading']?></span>

                                            <?php elseif ($row['type']==2): ?>
                                                
                                                <span> Hiçlik (Pas) </span>
                                            
                                            <?php endif; ?>
                                        </td>
                                        <td><?=convertTime($row['creationDate'], 2, true)?></td>
                                        <td class="text-right">
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-danger" href="kasa/gecmis/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                <i class="bx bx-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                        <?php 
                                            endforeach;
                                        else: 
                                        ?>
                                    <tr>
                                        <td class="text-center" colspan="6">Kayıt Bulunamadı</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$_POST): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="kasa/gecmis?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="kasa/gecmis?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>

<?php require 'static/footer.php' ?>