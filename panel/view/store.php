<?php require 'static/header.php' ?>

<?php if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Ürünler</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ürün Yönetimi</a></li>
                            <li class="breadcrumb-item active">Ürünler</li>
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
                                    <a class="btn btn-sm btn-white" href="magaza/ekle">Ürün Ekle</a>
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
                                        <th>Ürün Adı</th>
                                        <th>Kategori Adı</th>
                                        <th>Sunucu Adı</th>
                                        <th>Fiyat</th>
                                        <th>Stok</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php 
                                        if ($totalProducts > 0):
                                            foreach ($query as $row):
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="magaza/duzenle/<?=$row['id']?>">
                                                #<?=$row['id']?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="magaza/duzenle/<?=$row['id']?>">
                                                <?=$row['heading']?>
                                            </a>
                                        </td>
                                        <td>
                                            <?=$row['CategoryName']?>
                                        </td>
                                        <td><?=$row['serverName']?></td>
                                        <td><?=$row['price']?></td>
                                        <td>
                                            <?=($row['stockStatus'] == "1")?$row['stock']:"Sınırsız"?>
                                        </td>
                                        <td class="text-right">
                                            <a
                                                class="btn btn-sm btn-success text-white"
                                                href="magaza/duzenle/<?=$row['id']?>"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title=""
                                                data-original-title="Düzenle"
                                            >
                                                <i class="bx bxs-edit-alt"></i>
                                            </a>
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-danger" href="magaza/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                <i class="bx bx-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                        <?php 
                                            endforeach;
                                        else: 
                                        ?>
                                    <tr>
                                        <td class="text-center" colspan="7">Kayıt Bulunamadı</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$_POST && $totalProducts > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="magaza/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="magaza/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
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
                    
                    <h4 class="mb-0 font-size-18">Ürün Ekle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ürün Yönetimi</a></li>
                            <li class="breadcrumb-item active">Ürün Ekle</li>
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
                                <label for="heading" class="col-sm-2 col-form-label">Ürün Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="heading" class="form-control" name="heading" placeholder="Ürün adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="servers" class="col-sm-2 col-form-label">Sunucu:</label>
                                <div class="col-sm-10">
                                    <select onchange="getServerCategories(this, '#categoryID', '0', '1')" name="servers" class="form-control custom-select">
                                        <?php if($servers): ?>

                                            <option>Sunucu seçiniz</option>
    
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
                                <label for="categoryID" class="col-sm-2 col-form-label">Kategori:</label>
                                <div class="col-sm-10">
                                    <select name="categoryID" id="categoryID" class="form-control custom-select">
    
                                        <option>Öncelikle Sunucu Seçiniz</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Fiyat:</label>
                                <div class="col-sm-10">
                                    <input type="number" id="price" class="form-control" name="price" placeholder="Ürün fiyatını giriniz.">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">İçerik:</label>
                                <div class="col-sm-10">
                                    <textarea data-toggle="quill" name="content" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="discount" class="col-sm-2 col-form-label">İndirim:</label>
                                <div class="col-sm-10">
                                    <select name="discount" class="form-control custom-select">
                                        <option value="0">Yok</option>
                                        <option value="1">Var</option>
                                    </select>
                                </div>
                            </div>

                            <div id="discountDiv">

                                <div class="form-group row">
                                    <label for="discountPrice" class="col-sm-2 col-form-label">İndirimli Fiyat:</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="discountPrice" class="form-control" name="discountPrice" placeholder="Ürünün indirimli fiyatını giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="discountDuration" class="col-sm-2 col-form-label">İndirim:</label>
                                    <div class="col-sm-10">
                                        <select name="discountDuration" class="form-control custom-select">
                                            <option value="0">Süresiz</option>
                                            <option value="1">Süreli</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="discountDurationDiv">

                                    <div class="form-group row">
                                        <label for="discountExpiry" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <input type="date" id="discountExpiry" class="form-control" name="discountExpiry" placeholder="İndirimin bitiş gününü seçiniz.">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="stockStatus" class="col-sm-2 col-form-label">Stok:</label>
                                <div class="col-sm-10">
                                    <select name="stockStatus" class="form-control custom-select">
                                        <option value="0">Sınırsız</option>
                                        <option value="1">Sınırlı</option>
                                    </select>
                                </div>
                            </div>

                            <div id="stockDiv">

                                <div class="form-group row">
                                    <label for="stock" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="stock" class="form-control" name="stock" placeholder="Ürünün stoğunu giriniz.">
                                    </div>
                                </div>

                            </div>    
    
                            <div class="form-group row">
                                <label for="duration" class="col-sm-2 col-form-label">Ürün Süresi:</label>
                                <div class="col-sm-10">
                                    <select name="duration" class="form-control custom-select">
                                        <option value="0">Süresiz</option>
                                        <option value="1">Süreli</option>
                                    </select>
                                </div>
                            </div>

                            <div id="durationDiv">

                                <div class="form-group row">
                                    <label for="durationDay" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="text" id="durationDay" class="form-control" name="durationDay" placeholder="Ürünün süresini giriniz. (Gün cinsinden)">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="commands" class="col-sm-2 pt-3 col-form-label">Komutlar:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table id="commandsTable" class="table table-nowrap card-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="w-100" style="vertical-align: middle;">Komut</th>
                                                    <th class="text-right">
                                                        <a class="btn btn-sm btn-rounded-circle btn-success w-100" onclick="copyCommands('0', '#commands')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
                                                            <i class="bx bx-plus"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="commands" class="list">
                                                <tr>
                                                    <td class="text-center w-100">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="bx bx-code-alt"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control" name="commands[]" placeholder="Ürün satın aldığında konsola gönderilecek komudu giriniz.">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#commandsTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <small class="text-muted pb-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                </div>
                            </div>

                            <div id="durationCommandsDiv">

                                <div class="form-group row">
                                    <label for="commands" class="col-sm-2 pt-3 col-form-label">Komutlar (Bitiş):</label>
                                    <div class="col-sm-10">
                                        <div class="table-responsive">
                                            <table id="expiryCommandsTable" class="table table-nowrap card-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="w-100" style="vertical-align: middle;">Komut</th>
                                                        <th class="text-right">
                                                            <a class="btn btn-sm btn-rounded-circle btn-success w-100" onclick="copyCommands('1', '#expiryCommands')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
                                                                <i class="bx bx-plus"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="expiryCommands" class="list">
                                                    <tr>
                                                        <td class="text-center w-100">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"><i class="bx bx-code-alt"></i></div>
                                                                </div>
                                                                <input type="text" class="form-control" name="expiryCommands[]" placeholder="Ürün süresi bittiğinde konsola gönderilecek komudu giriniz.">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a onclick="copyCommands('2', this, '#expiryCommandsTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <small class="text-muted pb-2"><strong>Kullanıcı Adı:</strong> %username%</small>
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
                    
                    <h4 class="mb-0 font-size-18">Ürün Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ürün Yönetimi</a></li>
                            <li class="breadcrumb-item active">Ürün Düzenle</li>
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
                                <label for="heading" class="col-sm-2 col-form-label">Ürün Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$query['heading']?>" id="heading" class="form-control" name="heading" placeholder="Ürün adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="servers" class="col-sm-2 col-form-label">Sunucu:</label>
                                <div class="col-sm-10">
                                    <select onchange="getServerCategories(this, '#categoryID', '0', '1')" name="servers" class="form-control custom-select">
                                        <?php if($servers): ?>
    
                                            <?php foreach ($servers as $key => $value): ?>
    
                                            <option <?=($query['serverID']==$value['id'])?"selected":""?> value="<?=$value['id']?>">
                                                
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
                                <label for="categoryID" class="col-sm-2 col-form-label">Kategori:</label>
                                <div class="col-sm-10">
                                    <select name="categoryID" id="categoryID" class="form-control custom-select">
                                        <?php if($categories): ?>
    
                                            <option>Kategori Seçiniz</option>

                                            <?php foreach ($categories as $key => $value): ?>
    
                                            <option <?=($query['categoryID']==$value['id'])?"selected":""?> value="<?=$value['id']?>">
                                                
                                                <?=$value['heading']?>
    
                                            </option>
    
                                            <?php endforeach; ?>
                                        
                                        <?php else: ?>
                                            
                                            <option>
                                                Kategori Ekleyiniz
                                            </option>
                                        
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Fiyat:</label>
                                <div class="col-sm-10">
                                    <input type="number" value="<?=$query['price']?>" id="price" class="form-control" name="price" placeholder="Ürün fiyatını giriniz.">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">İçerik:</label>
                                <div class="col-sm-10">
                                    <textarea data-toggle="quill" name="content" class="form-control" rows="5"><?=$query['content']?></textarea>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="discount" class="col-sm-2 col-form-label">İndirim:</label>
                                <div class="col-sm-10">
                                    <select name="discount" class="form-control custom-select">
                                        <option <?=($query['discount']==0)?"selected":""?> value="0">Yok</option>
                                        <option <?=($query['discount']==1)?"selected":""?> value="1">Var</option>
                                    </select>
                                </div>
                            </div>

                            <div id="discountDiv">

                                <div class="form-group row">
                                    <label for="discountPrice" class="col-sm-2 col-form-label">İndirimli Fiyat:</label>
                                    <div class="col-sm-10">
                                        <input type="number" value="<?=$query['discountPrice']?>" id="discountPrice" class="form-control" name="discountPrice" placeholder="Ürünün indirimli fiyatını giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="discountDuration" class="col-sm-2 col-form-label">İndirim Süresi:</label>
                                    <div class="col-sm-10">
                                        <select name="discountDuration" class="form-control custom-select">
                                            <option <?=($query['discountDuration']==0)?"selected":""?> value="0">Süresiz</option>
                                            <option <?=($query['discountDuration']==1)?"selected":""?> value="1">Süreli</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="discountDurationDiv">

                                    <div class="form-group row">
                                        <label for="discountExpiry" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <input type="date" id="discountExpiry" class="form-control" name="discountExpiry" value="<?=$query['discountExpiry']?>" placeholder="İndirimin bitiş gününü seçiniz.">
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="stockStatus" class="col-sm-2 col-form-label">Stok:</label>
                                <div class="col-sm-10">
                                    <select name="stockStatus" class="form-control custom-select">
                                        <option <?=($query['stockStatus']==0)?"selected":""?> value="0">Sınırsız</option>
                                        <option <?=($query['stockStatus']==1)?"selected":""?> value="1">Sınırlı</option>
                                    </select>
                                </div>
                            </div>

                            <div id="stockDiv">

                                <div class="form-group row">
                                    <label for="stock" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input value="<?=$query['stock']?>" type="text" id="stock" class="form-control" name="stock" placeholder="Ürünün stoğunu giriniz.">
                                    </div>
                                </div>

                            </div> 
    
                            <div class="form-group row">
                                <label for="duration" class="col-sm-2 col-form-label">Ürün Süresi:</label>
                                <div class="col-sm-10">
                                    <select name="duration" class="form-control custom-select">
                                        <option <?=($query['duration']==0)?"selected":""?> value="0">Süresiz</option>
                                        <option <?=($query['duration']==1)?"selected":""?> value="1">Süreli</option>
                                    </select>
                                </div>
                            </div>

                            <div id="durationDiv">

                                <div class="form-group row">
                                    <label for="durationDay" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?=$query['durationDay']?>" id="durationDay" class="form-control" name="durationDay" placeholder="Ürünün süresini giriniz. (Gün cinsinden)">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="commands" class="col-sm-2 pt-3 col-form-label">Komutlar:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table id="commandsTable" class="table table-nowrap card-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="w-100" style="vertical-align: middle;">Komut</th>
                                                    <th class="text-right">
                                                        <a class="btn btn-sm btn-rounded-circle btn-success w-100" onclick="copyCommands('0', '#commands')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
                                                            <i class="bx bx-plus"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="commands" class="list">
                                                <?php 

                                                $commands = json_decode(base64_decode($query['commands']));

                                                if (!empty($commands)):

                                                foreach ($commands as $value):
                                                ?>
                                                <tr>
                                                    <td class="text-center w-100">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="bx bx-code-alt"></i></div>
                                                            </div>
                                                            <input type="text" value="<?=$value?>" class="form-control" name="commands[]" placeholder="Ürün satın aldığında konsola gönderilecek komudu giriniz.">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#commandsTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td class="text-center w-100">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text"><i class="bx bx-code-alt"></i></div>
                                                            </div>
                                                            <input type="text" class="form-control" name="commands[]" placeholder="Ürün satın aldığında konsola gönderilecek komudu giriniz.">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#commandsTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <small class="text-muted pb-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                </div>
                            </div>

                            <div id="durationCommandsDiv">

                                <div class="form-group row">
                                    <label for="commands" class="col-sm-2 pt-3 col-form-label">Komutlar (Bitiş):</label>
                                    <div class="col-sm-10">
                                        <div class="table-responsive">
                                            <table id="expiryCommandsTable" class="table table-nowrap card-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="w-100" style="vertical-align: middle;">Komut</th>
                                                        <th class="text-right">
                                                            <a class="btn btn-sm btn-rounded-circle btn-success w-100" onclick="copyCommands('1', '#expiryCommands')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
                                                                <i class="bx bx-plus"></i>
                                                            </a>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="expiryCommands" class="list">
                                                    <?php 

                                                    $expiryCommands = json_decode(base64_decode($query['expiryCommands']));

                                                    if (!empty($expiryCommands)):

                                                    foreach ($expiryCommands as $value): ?>
                                                    <tr>
                                                        <td class="text-center w-100">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"><i class="bx bx-code-alt"></i></div>
                                                                </div>
                                                                <input type="text" class="form-control" name="expiryCommands[]" value="<?=$value?>" placeholder="Ürün süresi bittiğinde konsola gönderilecek komudu giriniz.">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a onclick="copyCommands('2', this, '#expiryCommandsTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <tr>
                                                        <td class="text-center w-100">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"><i class="bx bx-code-alt"></i></div>
                                                                </div>
                                                                <input type="text" class="form-control" name="expiryCommands[]" placeholder="Ürün süresi bittiğinde konsola gönderilecek komudu giriniz.">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a onclick="copyCommands('2', this, '#expiryCommandsTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                                <i class="bx bx-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <small class="text-muted pb-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    </div>
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

<?php elseif ($action[1]=="kategori"): ?>

    <?php if ($action[2]=="liste"): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        
                        <h4 class="mb-0 font-size-18">Kategoriler</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
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
                                        <a class="btn btn-sm btn-white" href="magaza/kategori/ekle">Kategori Ekle</a>
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
                                            <th>Sunucu</th>
                                            <th>Üst Kategori</th>
                                            <th class="text-right">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php 
                                            if ($totalCategories > 0):
                                                foreach ($query as $row):
                                        ?>
                                        <tr>
                                            <td class="text-center"><a href="magaza/kategori/duzenle/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                            <td><a href="magaza/kategori/duzenle/<?=$row['id']?>"><?=$row['heading']?></a></td>
                                            <td><?=$row['serverName']?></td>
                                            <?php 

                                            $categoryName = $db->from('ProductsCategories')->where('id', $row['parent'])->select('ProductsCategories.heading, count(*) as total')->first();

                                            if ($categoryName['total'] > 0):

                                            ?>
                                            <td><?=$categoryName['heading']?></td>
                                            <?php else: ?>
                                            <td>-</td>
                                            <?php endif; ?>
                                            <td class="text-right">
                                                <a
                                                    class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                    href="magaza/kategori/duzenle/<?=$row['id']?>"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Düzenle"
                                                >
                                                    <i class="bx bxs-edit-alt"></i>
                                                </a>
                                                <a class="btn btn-sm btn-rounded-circle btn-primary" href="<?=$baseURL."magaza/".$row['serverSlug']."/".$row['slug']?>" rel="external" data-toggle="tooltip" data-placement="top" title="" data-original-title="Görüntüle" target="_blank">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="magaza/kategori/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!$_POST && $totalCategories > 0): ?>
                <div class="col-lg-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-4">
                        <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                            <a href="magaza/kategori/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active">
                            <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                        </li>
                        <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                            <a href="magaza/kategori/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
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
                            <form action="" enctype="multipart/form-data" method="post">
                                <div class="form-group row">
                                    <label for="heading" class="col-sm-2 col-form-label">Kategori Adı:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="heading" class="form-control" name="heading" placeholder="Kategori adı giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="serverID" class="col-sm-2 col-form-label">Sunucu:</label>
                                    <div class="col-sm-10">
                                        <select onchange="getServerCategories(this, '#parent')" id="serverID" name="serverID" class="form-control custom-select">
                                        <?php if($servers): ?>
                                            <option>Sunucu Seçiniz</option>
                                            <?php foreach ($servers as $readServer): ?>
                                                <option value="<?=$readServer['id']?>"><?=$readServer['heading']?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option>Sunucu eklenmemiş</option>
                                        <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="parent" class="col-sm-2 col-form-label">Üst Kategori:</label>
                                    <div class="col-sm-10">
                                        <select id="parent" name="parent" class="form-control custom-select">
                                            <option value="0">Öncelikle Sunucu Seçiniz</option>
                                        </select>
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

    <?php elseif($action[2]=="duzenle"): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        
                        <h4 class="mb-0 font-size-18">Kategori Düzenle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
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
                            <form action="" enctype="multipart/form-data" method="post">
                                <div class="form-group row">
                                    <label for="heading" class="col-sm-2 col-form-label">Kategori Adı:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?=$query['heading']?>" id="heading" class="form-control" name="heading" placeholder="Kategori adı giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="serverID" class="col-sm-2 col-form-label">Sunucu:</label>
                                    <div class="col-sm-10">
                                        <select onchange="getServerCategories(this, '#parent', '<?=$query["id"]?>')" id="serverID" name="serverID" class="form-control custom-select">
                                        <?php if($servers): ?>
                                            <?php foreach ($servers as $readServer): ?>
                                                <option <?=($query['serverID']==$readServer['id'])?"selected":""?> value="<?=$readServer['id']?>"><?=$readServer['heading']?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option>Sunucu eklenmemiş</option>
                                        <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="parent" class="col-sm-2 col-form-label">Üst Kategori:</label>
                                    <div class="col-sm-10">
                                        <select id="parent" name="parent" class="form-control custom-select">
                                            <option value="0">Kategorisiz</option>
                                        <?php if($category): ?>
                                            <?php foreach ($category as $readCategory): ?>
                                                <option <?=($query['parent']==$readCategory['id'])?"selected":""?> value="<?=$readCategory['id']?>"><?=$readCategory['heading']?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </select>
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
                                    <button type="submit" class="btn btn-success">Düzenle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php elseif ($action[1]=="kredi-gonder"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Kredi Gönder</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item active">Kredi Gönder</li>
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
                                <label for="username" class="col-sm-2 col-form-label">Kullanıcı Adı:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <?php if (isset($readUser) && $readUser['total'] > 0): ?>
                                        <span><?=$readUser['username']?></span>
                                    <?php else: ?>
                                        <input type="text" id="username" class="form-control" name="username" placeholder="Kredi gönderilecek oyuncunun kullanıcı adını giriniz.">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="credit" class="col-sm-2 col-form-label">Miktar:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="credit" placeholder="Oyuncuya gönderilecek kredi miktarını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="paymentApi" class="col-sm-2 col-form-label">Kategori:</label>
                                <div class="col-sm-10">
                                    <select id="paymentApi" name="paymentApi" class="form-control">
                                        <?php foreach ($payments as $readPayments): ?>
                                        <option value="<?=$readPayments['id']?>"><?=$readPayments['heading']?></option>
                                        <?php endforeach; ?>
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

<?php elseif ($action[1]=="esya-gonder"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Eşya Gönder</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item active">Eşya Gönder</li>
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
                                <label for="username" class="col-sm-2 col-form-label">Kullanıcı Adı:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <?php if (isset($readUser) && $readUser['total'] > 0): ?>
                                        <span><?=$readUser['username']?></span>
                                    <?php else: ?>
                                        <input type="text" id="username" class="form-control" name="username" placeholder="Eşya gönderilecek oyuncunun kullanıcı adını giriniz.">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="serverID" class="col-sm-2 col-form-label">Sunucu:</label>
                                <div class="col-sm-10">
                                    <select onchange="getProducts()" id="serverID" name="serverID" class="form-control">
                                    <?php if ($totalServers > 0): ?>
                                        <option>Sunucu Seçiniz</option>
                                        <?php foreach ($servers as $readServers): ?>
                                        <option value="<?=$readServers['id']?>"><?=$readServers['heading']?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="productID" class="col-sm-2 col-form-label">Ürün:</label>
                                <div class="col-sm-10">
                                    <select id="productID" name="productID" class="form-control">
                                        <option>Öncelikle Sunucu Seçiniz</option>
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

<?php elseif ($action[1]=="kredi-yukleme-gecmisi" OR $action[1]=="kredi-kullanim-gecmisi"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <?php if ($action[1]=="kredi-yukleme-gecmisi"): ?>
                    <h4 class="mb-0 font-size-18">Kredi Yükleme Geçmişi</h4>
                    <?php elseif ($action[1]=="kredi-kullanim-gecmisi"): ?>
                    <h4 class="mb-0 font-size-18">Kredi Kullanım Geçmişi</h4>
                    <?php endif; ?>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <?php if ($action[1]=="kredi-yukleme-gecmisi"): ?>
                            <li class="breadcrumb-item active">Kredi Yükleme Geçmişi</li>
                            <?php elseif ($action[1]=="kredi-kullanim-gecmisi"): ?>
                            <li class="breadcrumb-item active">Kredi Kullanım Geçmişi</li>
                            <?php endif; ?>
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
                                            <input onkeyup="" type="search" class="form-control form-control-flush search" name="query" placeholder="Arama Yap (Kullanıcı Adı)" value="">
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
                                    <th class="text-center">Miktar</th>
                                    <?php if ($action[1]=="kredi-yukleme-gecmisi"): ?>
                                    <th class="text-center">Kazanç</th>
                                    <?php endif; ?>
                                    <th class="text-center">Ödeme</th>
                                    <?php if ($action[1]=="kredi-yukleme-gecmisi"): ?>
                                    <th>Ödeme Yöntemi</th>
                                    <?php endif; ?>
                                    <th>Tarih</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php if ($totalCreditHistory > 0): ?>
                                    <?php foreach ($creditHistory as $key => $readCreditHistory): ?>
                                    <tr>
                                        <td class="text-center">#<?=$readCreditHistory['id']?></td>
                                        <td>
                                            <a href="hesap/goruntule/<?=$readCreditHistory['UserID']?>">
                                                <?=$readCreditHistory['username']?>
                                            </a>
                                        </td>
                                        <td class="text-center"><?=$readCreditHistory['price']?></td>
                                        <?php if ($action[1]=="kredi-yukleme-gecmisi"): ?>
                                        <td class="text-center"><?=$readCreditHistory['earnings']?></td>
                                        <?php endif; ?>
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
                                        <?php if ($action[1]=="kredi-yukleme-gecmisi"): ?>
                                        <td><?=$readCreditHistory['PaymentName']?></td>
                                        <?php endif; ?>
                                        <td><?=convertTime($readCreditHistory['creationDate'], 2, true)?></td>
                                        <td class="text-center">
                                            <?php if ($action[1]=="kredi-yukleme-gecmisi"): ?>
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="magaza/kredi-yukleme-gecmisi/sil/<?=$readCreditHistory['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                <i class="bx bx-trash-alt"></i>
                                            </a>
                                            <?php elseif ($action[1]=="kredi-kullanim-gecmisi"): ?>
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="magaza/kredi-kullanim-gecmisi/sil/<?=$readCreditHistory['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                <i class="bx bx-trash-alt"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="8">Kayıt Bulunamadı</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$_POST && $totalCreditHistory > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="magaza/<?=$action[1]?>?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="magaza/<?=$action[1]?>?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php elseif ($action[0]=="magaza" && $action[1]=="gecmis"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Mağaza Geçmişi</h4>
    
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item active">Mağaza Geçmişi</li>
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
                                    <th>Ürün</th>
                                    <th class="text-center">Sunucu</th>
                                    <th class="text-center">Tutar</th>
                                    <th>Tarih</th>
                                    <th class="text-center">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php if ($totalStoreHistory > 0): ?>
                                    <?php foreach ($storeHistory as $key => $readStoreHistory): ?>
                                    <tr>
                                        <td class="text-center">#<?=$readStoreHistory['id']?></td>
                                        <td>
                                            <a href="hesap/goruntule/<?=$readStoreHistory['UserID']?>">
                                                <?=$readStoreHistory['username']?>
                                            </a>
                                        </td>
                                        <td><?=$readStoreHistory['heading']?></td>
                                        <td class="text-center"><?=$readStoreHistory['serverName']?></td>
                                        <td class="text-center">
                                            <?=$readStoreHistory['price']?>
                                        </td>
                                        <td><?=convertTime($readStoreHistory['creationDate'], 2, true)?></td>
                                        <td class="text-center">
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="magaza/gecmis/sil/<?=$readStoreHistory['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                <i class="bx bx-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="8">Kayıt Bulunamadı</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$_POST && $totalStoreHistory > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="magaza/gecmis?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="magaza/gecmis?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>

<?php require 'static/footer.php' ?>