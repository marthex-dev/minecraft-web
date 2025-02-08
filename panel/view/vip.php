<?php require 'static/header.php' ?>

<?php if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">VIP Listesi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">VIP Yönetimi</a></li>
                            <li class="breadcrumb-item active">VIP Listesi</li>
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
                                    <a class="btn btn-sm btn-white" href="vip/ekle">VIP Ekle</a>
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
                                        <th>VIP Adı</th>
                                        <th>Sunucu Adı</th>
                                        <th>Fiyat</th>
                                        <th>Stok</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php 
                                        if ($totalVips > 0):
                                            foreach ($query as $row):
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="vip/duzenle/<?=$row['id']?>">
                                                #<?=$row['id']?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="vip/duzenle/<?=$row['id']?>">
                                                <?=$row['heading']?>
                                            </a>
                                        </td>
                                        <td><?=$row['serverName']?></td>
                                        <td><?=$row['price']?></td>
                                        <td>
                                            <?=($row['stockStatus'] == "1")?$row['stock']:"Sınırsız"?>
                                        </td>
                                        <td class="text-right">
                                            <a
                                                class="btn btn-sm btn-success text-white"
                                                href="vip/duzenle/<?=$row['id']?>"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title=""
                                                data-original-title="Düzenle"
                                            >
                                                <i class="bx bxs-edit-alt"></i>
                                            </a>
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-danger" href="vip/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
            <?php if (!$_POST && $totalVips > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="vip/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="vip/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
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
                    
                    <h4 class="mb-0 font-size-18">VIP Ekle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">VIP Yönetimi</a></li>
                            <li class="breadcrumb-item active">VIP Ekle</li>
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
                                <label for="heading" class="col-sm-2 col-form-label">VIP Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="heading" class="form-control" name="heading" placeholder="VIP adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="heading" class="col-sm-2 col-form-label">VIP Renk:</label>
                        		<div class="col-sm-10">
                        		    <div data-toggle="color-picker" class="input-group">
                        		        <input type="text" id="color" class="form-control input-lg" name="color" placeholder="VIP rengi seçiniz.">
                        		        <span class="input-group-append">
                        		            <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                        		        </span>
                        		    </div>
                        		</div>
                        	</div>

                            <div class="form-group row">
                                <label for="servers" class="col-sm-2 col-form-label">Sunucu:</label>
                                <div class="col-sm-10">
                                    <select onchange="getServerFeatures(this)" name="servers" class="form-control custom-select">
                                        <?php if($servers): ?>

                                        	<option>
                                                Sunucu seçiniz
                                            </option>
    
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
                                <label for="price" class="col-sm-2 col-form-label">Fiyat:</label>
                                <div class="col-sm-10">
                                    <input type="number" id="price" class="form-control" name="price" placeholder="Ürün fiyatını giriniz.">
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
                                <label for="duration" class="col-sm-2 col-form-label">VIP Süresi:</label>
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
                                    <hr class="mt-0">
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
                                        <hr class="mt-0">
                                        <small class="text-muted pb-2"><strong>Kullanıcı Adı:</strong> %username%</small>	
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="features" class="col-sm-2 pt-3 col-form-label">Özellikler:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table id="featuresTable" class="table table-nowrap card-table mb-0">
                                        	<thead>
                                                <tr>
                                                    <th style="vertical-align: middle;">Adı</th>
                                                    <th class="w-100" style="vertical-align: middle;">Değeri</th>
                                                </tr>
                                            </thead>
                                            <tbody id="features" class="list">
                                                <tr>
													<td colspan="2" class="text-center">
														Öncelikle sunucu seçiniz.
													</td>
												</tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr class="mt-0">
                                    <small class="text-muted pb-2">
                                    	
                                    	<strong>Var İşareti : </strong> 
                                    	
                                    	&lt;i class="mdi mdi-check"&gt;&lt;/i&gt;

                                    </small>
                                    <br>
                                    <small class="text-muted pb-2">
                                    	
                                    	<strong>Yok İşareti : </strong> 
                                    	
                                    	&lt;i class="mdi mdi-close"&gt;&lt;/i&gt;

                                    </small>

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
                    
                    <h4 class="mb-0 font-size-18">VIP Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">VIP Yönetimi</a></li>
                            <li class="breadcrumb-item active">VIP Düzenle</li>
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
                                <label for="heading" class="col-sm-2 col-form-label">VIP Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$query['heading']?>" id="heading" class="form-control" name="heading" placeholder="VIP adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="heading" class="col-sm-2 col-form-label">VIP Renk:</label>
                        		<div class="col-sm-10">
                        		    <div data-toggle="color-picker" class="input-group">
                        		        <input type="text" value="<?=$query['color']?>" id="color" class="form-control input-lg" name="color" placeholder="VIP rengi seçiniz.">
                        		        <span class="input-group-append">
                        		            <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                        		        </span>
                        		    </div>
                        		</div>
                        	</div>

                            <div class="form-group row">
                                <label for="servers" class="col-sm-2 col-form-label">Sunucu:</label>
                                <div class="col-sm-10">
                                    <select onchange="getServerFeatures(this)" name="servers" class="form-control custom-select">
                                        <?php if($servers): ?>

                                        	<option>
                                                Sunucu seçiniz
                                            </option>
    
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
                                <label for="price" class="col-sm-2 col-form-label">Fiyat:</label>
                                <div class="col-sm-10">
                                    <input value="<?=$query['price']?>" type="number" id="price" class="form-control" name="price" placeholder="Ürün fiyatını giriniz.">
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
                                    <label for="discountDuration" class="col-sm-2 col-form-label">İndirim:</label>
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
                                            <input type="date" value="<?=$query['discountExpiry']?>" id="discountExpiry" class="form-control" name="discountExpiry" placeholder="İndirimin bitiş gününü seçiniz.">
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
                                <label for="duration" class="col-sm-2 col-form-label">VIP Süresi:</label>
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
                                    <hr class="mt-0">
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

                                                    foreach ($expiryCommands as $value): 
                                                    ?>
                                                    <tr>
                                                        <td class="text-center w-100">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text"><i class="bx bx-code-alt"></i></div>
                                                                </div>
                                                                <input type="text" value="<?=$value?>" class="form-control" name="expiryCommands[]" placeholder="Ürün süresi bittiğinde konsola gönderilecek komudu giriniz.">
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
                                        <hr class="mt-0">
                                        <small class="text-muted pb-2"><strong>Kullanıcı Adı:</strong> %username%</small>	
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="features" class="col-sm-2 pt-3 col-form-label">Özellikler:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table id="featuresTable" class="table table-nowrap card-table mb-0">
                                        	<thead>
                                                <tr>
                                                    <th style="vertical-align: middle;">Adı</th>
                                                    <th class="w-100" style="vertical-align: middle;">Değeri</th>
                                                </tr>
                                            </thead>
                                            <tbody id="features" class="list">
                                            	<?php 

                                                $featuresValue = json_decode(base64_decode($query['content']), true);

                                                if (!empty($featuresValue)):

                                                	if ($features):

                                                		foreach ($features as $readFeatures):
                                                	
                                                ?>

                                                		<tr>
															<td class="text-right">
																<?=$readFeatures['heading']?> :
															</td>
															<td class="text-center w-100">
															    <input type="text" value="<?=htmlspecialchars($featuresValue[$readFeatures['slug']])?>" class="form-control" name="<?=$readFeatures['slug']?>" placeholder="Özellik değerini giriniz.">
															</td>
														</tr>

                                                		<?php endforeach; ?>

                                                	<?php else: ?>

                                            			<tr>
															<td colspan="2" class="text-center">
																Henüz özellik eklenmemiş.
															</td>
														</tr>

                                            		<?php endif; ?>

                                            	<?php else: ?>

                                            		<tr>
														<td colspan="2" class="text-center">
															Öncelikle sunucu seçiniz.
														</td>
													</tr>

                                            	<?php endif; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr class="mt-0">
                                    <small class="text-muted pb-2">
                                    	
                                    	<strong>Var İşareti : </strong> 
                                    	
                                    	&lt;i class="mdi mdi-check"&gt;&lt;/i&gt;

                                    </small>
                                    <br>
                                    <small class="text-muted pb-2">
                                    	
                                    	<strong>Yok İşareti : </strong> 
                                    	
                                    	&lt;i class="mdi mdi-close"&gt;&lt;/i&gt;

                                    </small>

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

<?php elseif ($action[1]=="ozellik"): ?>

    <?php if ($action[2]=="liste"): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        
                        <h4 class="mb-0 font-size-18">VIP Özellikleri</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">VIP İşlemleri</a></li>
                                <li class="breadcrumb-item active">VIP Özellikleri</li>
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
                                        <a class="btn btn-sm btn-white" href="vip/ozellik/ekle">Özellik Ekle</a>
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
                                            <th>Özellik Adı</th>
                                            <th>Sunucu</th>
                                            <th class="text-right">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php 
                                            if ($totalFeatures > 0):
                                                foreach ($query as $row):
                                        ?>
                                        <tr>
                                            <td class="text-center"><a href="vip/ozellik/duzenle/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                            <td><a href="vip/ozellik/duzenle/<?=$row['id']?>"><?=$row['heading']?></a></td>
                                            <td><?=$row['serverName']?></td>
                                            <td class="text-right">
                                                <a
                                                    class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                    href="vip/ozellik/duzenle/<?=$row['id']?>"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Düzenle"
                                                >
                                                    <i class="bx bxs-edit-alt"></i>
                                                </a>
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="vip/ozellik/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
                <?php if (!$_POST && $totalFeatures > 0): ?>
                <div class="col-lg-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-4">
                        <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                            <a href="vip/ozellik/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active">
                            <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                        </li>
                        <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                            <a href="vip/ozellik/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
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
                        
                        <h4 class="mb-0 font-size-18">Özellik Ekle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">VIP İşlemleri</a></li>
                                <li class="breadcrumb-item active">Özellik Ekle</li>
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
                                    <label for="heading" class="col-sm-2 col-form-label">Özellik Adı:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="heading" class="form-control" name="heading" placeholder="Özellik adı giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="serverID" class="col-sm-2 col-form-label">Sunucu:</label>
                                    <div class="col-sm-10">
                                        <select id="serverID" name="serverID" class="form-control custom-select">
                                        <?php if(isset($servers) && $servers): ?>
                                            <?php foreach ($servers as $readServer): ?>
                                                <option value="<?=$readServer['id']?>"><?=$readServer['heading']?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option>Sunucu eklenmemiş</option>
                                        <?php endif; ?>
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

    <?php elseif($action[2]=="duzenle"): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        
                        <h4 class="mb-0 font-size-18">Özellik Düzenle</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">VIP İşlemleri</a></li>
                                <li class="breadcrumb-item active">Özellik Düzenle</li>
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
                                    <label for="heading" class="col-sm-2 col-form-label">Özellik Adı:</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?=$query['heading']?>" id="heading" class="form-control" name="heading" placeholder="Özellik adı giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="serverID" class="col-sm-2 col-form-label">Sunucu:</label>
                                    <div class="col-sm-10">
                                        <select id="serverID" name="serverID" class="form-control custom-select">
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

                                <div class="float-right">
                                    <button type="submit" class="btn btn-success">Ekle</button>
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