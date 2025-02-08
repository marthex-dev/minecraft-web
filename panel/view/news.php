<?php require 'static/header.php' ?>

<?php if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Haberler</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Haber Yönetimi</a></li>
                            <li class="breadcrumb-item active">Haberler</li>
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
                                    <a class="btn btn-sm btn-white" href="haber/ekle">Haber Ekle</a>
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
                                        <th>Yazar</th>
                                        <th>Kategori</th>
                                        <th class="text-center">Görüntülenme</th>
                                        <th class="text-center">Yorumlar</th>
                                        <th>Tarih</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php 
                                        if ($totalNews > 0):
                                            foreach ($query as $row):
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="haber/duzenle/<?=$row['id']?>">
                                                #<?=$row['id']?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="haber/duzenle/<?=$row['id']?>">
                                                <?=$row['newsHeading']?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="hesap/goruntule/<?=$row['UserID']?>">
                                                <?=$row['username']?>
                                            </a>
                                        </td>
                                        <td><?=$row['categoryHeading']?></td>
                                        <td class="text-center"><?=$row['views']?></td>
                                        <td class="text-center">
                                            <?=($row['commentsStatus']==1)?
                                                "<span class='badge badge-success'>Aktif</span>"
                                                :
                                                "<span class='badge badge-danger'>Pasif</span>"
                                            ?>
                                        </td>
                                        <td><?=convertTime($row['creationDate'], 2, true)?></td>
                                        <td class="text-right">
                                            <a
                                                class="btn btn-sm btn-success text-white"
                                                href="haber/duzenle/<?=$row['id']?>"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title=""
                                                data-original-title="Düzenle"
                                            >
                                                <i class="bx bxs-edit-alt"></i>
                                            </a>
                                            <a class="btn btn-sm btn-primary" href="<?=site_url()?>haber/<?=$row['slug']?>" rel="external" data-toggle="tooltip" data-placement="top" title="" data-original-title="Görüntüle" target="_blank">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-danger" href="haber/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$_POST && $totalNews > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="haber/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="haber/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
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
                    
                    <h4 class="mb-0 font-size-18">Haber Ekle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Haber Yönetimi</a></li>
                            <li class="breadcrumb-item active">Haber Ekle</li>
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
                                <label for="newsHeading" class="col-sm-2 col-form-label">Başlık:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="newsHeading" class="form-control" name="heading" placeholder="Haber başlığı giriniz.">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="newsCategory" class="col-sm-2 col-form-label">Kategori:</label>
                                <div class="col-sm-10">
                                    <select name="newsCategory" class="form-control custom-select">
                                        <?php if($newsCategory): ?>
    
                                            <?php foreach ($newsCategory as $key => $value): ?>
    
                                            <option <?=(post('newsCategory')==$value['id'])?"selected":""?> value="<?=$value['id']?>">
                                                
                                                <?=$value['heading']?>
    
                                            </option>
    
                                            <?php endforeach; ?>
                                        
                                        <?php else: ?>
                                            
                                            <option>
                                                Kategori ekleyiniz.
                                            </option>
                                        
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">İçerik:</label>
                                <div class="col-sm-10">
                                    <textarea data-toggle="quill" name="content" class="form-control" rows="5"><?=post('content')?></textarea>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="newsTags" class="col-sm-2 col-form-label">Etiketler:</label>
                                <div class="col-sm-10">
                                    <input type="text" data-toggle="tagsinput" id="newsTags" class="form-control" name="newsTags" placeholder="Etiketleri giriniz.">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="newsComments" class="col-sm-2 col-form-label">Yorumlar:</label>
                                <div class="col-sm-10">
                                    <select name="newsComments" class="form-control custom-select">
                                        <option <?=(post('newsComments')==1)?"selected":""?> value="1">
                                            Açık
                                        </option>
                                        <option <?=(post('newsComments')==2)?"selected":""?> value="2">
                                            Kapalı
                                        </option>
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

<?php elseif ($action[1]=="duzenle"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Haber Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Haber Yönetimi</a></li>
                            <li class="breadcrumb-item active">Haber Düzenle</li>
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
                                <label for="newsHeading" class="col-sm-2 col-form-label">Başlık:</label>
                                <div class="col-sm-10">
                                    <input value="<?=$query['heading']?>" type="text" id="newsHeading" class="form-control" name="heading" placeholder="Haber başlığı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newsCategory" class="col-sm-2 col-form-label">Kategori:</label>
                                <div class="col-sm-10">
                                    <select name="newsCategory" class="form-control custom-select">
                                        <?php if($newsCategory): ?>

                                            <?php foreach ($newsCategory as $key => $value): ?>

                                            <option <?=($query['category']==$value['id'])?"selected":""?> value="<?=$value['id']?>">
                                                
                                                <?=$value['heading']?>

                                            </option>

                                            <?php endforeach; ?>
                                        
                                        <?php else: ?>
                                            
                                            <option>
                                                Kategori ekleyiniz.
                                            </option>
                                        
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2 col-form-label">İçerik:</label>
                                <div class="col-sm-10">
                                    <textarea data-toggle="quill" name="content" class="form-control" rows="5"><?=$query['content']?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newsTags" class="col-sm-2 col-form-label">Etiketler:</label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?=$query['tags']?>" data-toggle="tagsinput" id="newsTags" class="form-control" name="newsTags" placeholder="Etiketleri giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newsComments" class="col-sm-2 col-form-label">Yorumlar:</label>
                                <div class="col-sm-10">
                                    <select name="newsComments" class="form-control custom-select">
                                        <option <?=($query['commentsStatus']==1)?"selected":""?> value="1">
                                            Açık
                                        </option>
                                        <option <?=($query['commentsStatus']==2)?"selected":""?> value="2">
                                            Kapalı
                                        </option>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Haber Yönetimi</a></li>
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
                                        <a class="btn btn-sm btn-white" href="haber/kategori/ekle">Kategori Ekle</a>
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
                                            <th class="text-center">Durum</th>
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
                                            <td class="text-center"><a href="haber/kategori/duzenle/<?=$row['id']?>">#<?=$row['id']?></a></td>
                                            <td><a href="haber/kategori/duzenle/<?=$row['id']?>"><?=$row['heading']?></a></td>
                                            <td class="text-center">
                                                <?=($row['status']==1)?
                                                    "<span class='badge badge-success'>Aktif</span>"
                                                    :
                                                    "<span class='badge badge-danger'>Pasif</span>"
                                                ?>
                                            </td>
                                            <td class="text-center"><?=convertTime($row['creationDate'], 2, true)?></td>
                                            <td class="text-right">
                                                <?php if ($row['status']==1): ?>
                                                <a
                                                    class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                    href="haber/kategori/duzenle/<?=$row['id']?>"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Düzenle"
                                                >
                                                    <i class="bx bxs-edit-alt"></i>
                                                </a>
                                                <!--<a class="btn btn-sm btn-rounded-circle btn-primary" href="https://<?=$row['heading']?>" rel="external" data-toggle="tooltip" data-placement="top" title="" data-original-title="Görüntüle" target="_blank">
                                                    <i class="bx bx-show"></i>
                                                </a>-->
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="haber/kategori/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
                                                    <i class="bx bx-trash-alt"></i>
                                                </a>
                                                <?php endif; ?>
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
                            <a href="haber/kategori/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active">
                            <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                        </li>
                        <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                            <a href="haber/kategori/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Haber Yönetimi</a></li>
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
                                    <label for="categoryHeading" class="col-sm-2 col-form-label">Kategori Adı:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="categoryHeading" class="form-control" name="heading" placeholder="Kategori adı giriniz.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="categoryHeading" class="col-sm-2 col-form-label">Kategori Rengi:</label>
                                    <div class="col-sm-10">
                                        <div data-toggle="color-picker" class="input-group">
                                            <input type="text" id="categoryColor" class="form-control input-lg" name="color" placeholder="Kategori rengi seçiniz.">
                                            <span class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                            </span>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Haber Yönetimi</a></li>
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
                                    <label for="categoryHeading" class="col-sm-2 col-form-label">Kategori Adı:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="categoryHeading" class="form-control" name="heading" value="<?=$query['heading']?>" placeholder="Kategori adı giriniz.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="categoryHeading" class="col-sm-2 col-form-label">Kategori Rengi:</label>
                                    <div class="col-sm-10">
                                        <div data-toggle="color-picker" class="input-group">
                                            <input type="text" value="<?=$query['color']?>" id="categoryColor" class="form-control input-lg" name="color" placeholder="Kategori rengi seçiniz.">
                                            <span class="input-group-append">
                                                <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                            </span>
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

    <?php else: ?>

    <?php endif; ?>

<?php elseif ($action[1]=="yorumlar"): ?>

    <?php if ($action[2]=="liste"): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        
                        <h4 class="mb-0 font-size-18">Yorumlar</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Haber Yönetimi</a></li>
                                <li class="breadcrumb-item active">Yorumlar</li>
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
                                <form class="d-flex align-items-center w-100">
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
                                        <th>Mesaj</th>
                                        <th class="text-center">Yazar</th>
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
                                                <td class="text-center">#<?=$row['id']?></td>
                                                <td><?=$row['message']?></td>
                                                <td class="text-center"><?=$row['username']?></td>
                                                <td class="text-center"><?=convertTime($row['creationDate'], 2, true)?></td>
                                                <td class="text-center">
                                                    <?=($row['status']==1)?
                                                        "<span class='badge badge-success'>Aktif</span>"
                                                        :
                                                        "<span class='badge badge-danger'>Pasif</span>"
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php if ($row['status']==1): ?>
                                                        <a
                                                                class="btn btn-sm btn-rounded-circle btn-danger text-white"
                                                                href="haber/yorumlar/liste/durum/<?=$row['id']?>"
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title=""
                                                                data-original-title="Onayı Kaldır"
                                                        >
                                                            <i class="bx bx-x"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <a
                                                                class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                                href="haber/yorumlar/liste/durum/<?=$row['id']?>"
                                                                data-toggle="tooltip"
                                                                data-placement="top"
                                                                title=""
                                                                data-original-title="Onayla"
                                                        >
                                                            <i class="bx bx-check"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                        <a class="btn btn-sm btn-rounded-circle btn-info" href="https://<?=$row['heading']?>" rel="external" data-toggle="tooltip" data-placement="top" title="" data-original-title="Görüntüle" target="_blank">
                                                            <i class="bx bx-show"></i>
                                                        </a>
                                                        <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-primary" href="haber/yorumlar/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
                            <a href="haber/yorumlar/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active">
                            <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                        </li>
                        <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                            <a href="haber/yorumlar/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>

    <?php endif; ?>

<?php endif; ?>


<?php require 'static/footer.php' ?>