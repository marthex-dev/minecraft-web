<?php require 'static/header.php' ?>

<?php if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Hediye Kuponları</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hediye Kuponları</a></li>
                            <li class="breadcrumb-item active">Hediye Kuponları</li>
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
                                    <a class="btn btn-sm btn-white" href="hediye/ekle">Hediye Ekle</a>
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
                                    <th>Kupon Kodu</th>
                                    <th class="text-center">Hediye</th>
                                    <th class="text-center">Kalan Kullanım</th>
                                    <th>Tarih</th>
                                    <th class="text-right">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if ($totalGifts > 0): ?>

                                    <?php foreach ($gifts as $readGift): ?>
                                        
                                        <tr>
                                            <td class="text-center">
                                                <a href="hediye/duzenle/<?=$readGift['id']?>">
                                                    #<?=$readGift['id']?>   
                                                </a>
                                            </td>

                                            <td>
                                                <a href="hediye/duzenle/<?=$readGift['id']?>">
                                                    <?=$readGift['heading']?>
                                                </a>
                                            </td>

                                            <td class="text-center">
                                                <?php if ($readGift['giftType']==0): ?>
                                                    
                                                    Kredi

                                                <?php else: ?>

                                                    Ürün

                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <?php if ($readGift['amountType']==1): ?>
                                                    
                                                    <?=$readGift['amount']?> Adet

                                                <?php else: ?>

                                                    Sınırsız

                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?=convertTime($readGift['creationDate'], 2, true)?>
                                            </td>

                                            <td class="text-right">
                                                <a
                                                        class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                        href="hediye/duzenle/<?=$readGift['id']?>"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title=""
                                                        data-original-title="Düzenle"
                                                >
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="hediye/liste/sil/<?=$readGift['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
            <?php if (!$_POST && $totalGifts > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="hediye/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="hediye/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
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
                    
                    <h4 class="mb-0 font-size-18">Hediye Kuponu Ekle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hediye Kuponları</a></li>
                            <li class="breadcrumb-item active">Hediye Kuponu Ekle</li>
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
                                <label for="heading" class="col-sm-2 col-form-label">Kupon Kodu:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="heading" class="form-control" name="heading" placeholder="Kupon kodu giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="giftType" class="col-sm-2 col-form-label">Hediye Tipi:</label>
                                <div class="col-sm-10">
                                    <select id="giftType" name="giftType" class="form-control custom-select">
                                        <option value="0">Kredi</option>
                                        <option value="1">Ürün</option>
                                    </select>
                                </div>
                            </div>

                            <div id="creditDiv">

                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <input type="number" id="credit" class="form-control" name="credit" placeholder="Hediye edilecek kredi miktarını giriniz.">
                                    </div>
                                </div>

                            </div>

                            <div id="productDiv">

                                <div class="form-group row">
                                    <label for="productServer" class="col-sm-2 col-form-label">Sunucu:</label>
                                    <div class="col-sm-10">
                                        <select onchange="getProducts()" id="productServer" name="productServer" class="form-control custom-select">
                                            <?php if ($totalServers > 0): ?>

                                                <option>Sunucu Seçiniz</option>
                                                
                                                <?php foreach ($servers as $key => $readServers): ?>

                                                <option value="<?=$readServers['id']?>"><?=$readServers['heading']?></option>

                                                <?php endforeach; ?>

                                            <?php else: ?>
                                                
                                                <option>Henüz Sunucu Eklenmemiş</option>

                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productID" class="col-sm-2 col-form-label">Ürün:</label>
                                    <div class="col-sm-10">
                                        <select id="productID" name="productID" class="form-control custom-select">
                                            <option>Öncelikle Sunucu Seçiniz</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="giftTime" class="col-sm-2 col-form-label">Süre:</label>
                                <div class="col-sm-10">
                                    <select id="giftTime" name="giftTime" class="form-control custom-select">
                                        <option value="0">Süresiz</option>
                                        <option value="1">Sınırlı</option>
                                    </select>
                                </div>
                            </div>

                            <div id="timeDiv">

                                <div class="form-group row">
                                    <label for="giftExpiry" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="date" id="giftExpiry" class="form-control" name="giftExpiry" placeholder="Hediyenin son kullanım tarihini seçiniz.">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="amountType" class="col-sm-2 col-form-label">Adet:</label>
                                <div class="col-sm-10">
                                    <select id="amountType" name="amountType" class="form-control custom-select">
                                        <option value="0">Sınırsız</option>
                                        <option value="1">Sınırlı</option>
                                    </select>
                                </div>
                            </div>

                            <div id="amountDiv">

                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <input type="number" id="amount" class="form-control" name="amount" placeholder="Kuponun kaç adet kullanılacağını giriniz.">
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
                    
                    <h4 class="mb-0 font-size-18">Hediye Kuponu Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hediye Kuponları</a></li>
                            <li class="breadcrumb-item active">Hediye Kuponu Düzenle</li>
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
                                <label for="heading" class="col-sm-2 col-form-label">Kupon Kodu:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$readGift['heading']?>" id="heading" class="form-control" name="heading" placeholder="Kupon kodu giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="giftType" class="col-sm-2 col-form-label">Hediye Tipi:</label>
                                <div class="col-sm-10">
                                    <select id="giftType" name="giftType" class="form-control custom-select">
                                        <option <?=(isset($readGift['giftType'])&&$readGift['giftType']==0)?"selected":""?> value="0">Kredi</option>
                                        <option <?=(isset($readGift['giftType'])&&$readGift['giftType']==1)?"selected":""?> value="1">Ürün</option>
                                    </select>
                                </div>
                            </div>

                            <div id="creditDiv">

                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <input type="number" value="<?=(isset($readGift['credit']))?$readGift['credit']:""?>" id="credit" class="form-control" name="credit" placeholder="Hediye edilecek kredi miktarını giriniz.">
                                    </div>
                                </div>

                            </div>

                            <div id="productDiv">

                                <div class="form-group row">
                                    <label for="productServer" class="col-sm-2 col-form-label">Sunucu:</label>
                                    <div class="col-sm-10">
                                        <select onload="getProducts()" onchange="getProducts()" id="productServer" name="productServer" class="form-control custom-select">
                                            <?php if ($totalServers > 0): ?>

                                                <option>Sunucu Seçiniz</option>
                                                
                                                <?php foreach ($servers as $key => $readServers): ?>

                                                <option <?=($readServers['id']==$readGift['productServer'])?"selected":""?> value="<?=$readServers['id']?>"><?=$readServers['heading']?></option>

                                                <?php endforeach; ?>

                                            <?php else: ?>
                                                
                                                <option>Henüz Sunucu Eklenmemiş</option>

                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="productID" class="col-sm-2 col-form-label">Ürün:</label>
                                    <div class="col-sm-10">
                                        <select id="productID" name="productID" class="form-control custom-select">
                                            <option>Öncelikle Sunucu Seçiniz</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="giftTime" class="col-sm-2 col-form-label">Süre:</label>
                                <div class="col-sm-10">
                                    <select id="giftTime" name="giftTime" class="form-control custom-select">
                                        <option <?=(isset($readGift['giftTime'])&&$readGift['giftTime']==0)?"selected":""?> value="0">Süresiz</option>
                                        <option <?=(isset($readGift['giftTime'])&&$readGift['giftTime']==1)?"selected":""?> value="1">Sınırlı</option>
                                    </select>
                                </div>
                            </div>

                            <div id="timeDiv">

                                <div class="form-group row">
                                    <label for="giftExpiry" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="date" value="<?=(isset($readGift['giftExpiry']))?$readGift['giftExpiry']:""?>" id="giftExpiry" class="form-control" name="giftExpiry" placeholder="Hediyenin son kullanım tarihini seçiniz.">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="amountType" class="col-sm-2 col-form-label">Adet:</label>
                                <div class="col-sm-10">
                                    <select id="amountType" name="amountType" class="form-control custom-select">
                                        <option <?=(isset($readGift['amountType'])&&$readGift['amountType']==0)?"selected":""?> value="0">Sınırsız</option>
                                        <option <?=(isset($readGift['amountType'])&&$readGift['amountType']==1)?"selected":""?> value="1">Sınırlı</option>
                                    </select>
                                </div>
                            </div>

                            <div id="amountDiv">

                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <input type="number" value="<?=(isset($readGift['amount']))?$readGift['amount']:""?>" id="amount" class="form-control" name="amount" placeholder="Kuponun kaç adet kullanılacağını giriniz.">
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

<?php elseif ($action[1] == "gecmis"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Hediye Geçmişi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hediye Kuponları</a></li>
                            <li class="breadcrumb-item active">Hediye Geçmişi</li>
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
                                        <th>Kupon</th>
                                        <th>Tarih</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php 
                                        if ($totalHistory > 0):
                                            foreach ($giftHistory as $row):
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
                                            <a href="hediye/duzenle/<?=$row['cID']?>">
                                                <?=$row['heading']?>
                                            </a>
                                        </td>
                                        <td><?=convertTime($row['creationDate'], 2, true)?></td>
                                        <td class="text-right">
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-danger" href="hediye/gecmis/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
            <?php if (!$_POST): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="hediye/gecmis?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="hediye/gecmis?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>

<?php require 'static/footer.php' ?>