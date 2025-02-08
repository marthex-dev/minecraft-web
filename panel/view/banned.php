<?php require 'static/header.php' ?>

<?php  if ($action[1]=="liste"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Engellenenler Listesi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcılar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Engel Yönetimi</a></li>
                            <li class="breadcrumb-item active">Engellenenler Listesi</li>
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
                                    <a class="btn btn-sm btn-white" href="engel/ekle">Hesap Engelle</a>
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
                                    <th>Kategori</th>
                                    <th>Nedeni</th>
                                    <th>Kalan Süre</th>                                    
                                    <th class="text-right">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php
                                if (isset($totalBanned) && $totalBanned > 0 OR isset($query) && $query):
                                    foreach ($query as $row):

                                        if ($row['categoryID']=="1"):
                                            $category = "Site";
                                        elseif ($row['categoryID']=="2"):
                                            $category = "Destek";
                                        elseif ($row['categoryID']=="3"):
                                            $category = "Yorum";
                                        else:
                                            $category = "Hata!";
                                        endif;

                                        if ($row['reason']=="1"):
                                            $reason = "Spam";
                                        elseif($row['reason']=="2"):
                                            $reason = "Küfür/Hakaret";
                                        elseif($row['reason']=="3"):
                                            $reason = "Hile";
                                        elseif($row['reason']=="4"):
                                            $reason = "Reklam";
                                        elseif($row['reason']=="5"):
                                            $reason = "Oyuncuları Dolandırmak";
                                        elseif($row['reason']=="6"):
                                            $reason = "Diğer";
                                        else:
                                            $reason = "Hata!";
                                        endif;

                                        $kalan = round((strtotime($row['expiryDate'])-strtotime(date("Y-m-d")))/(60*60*24))." Gün";

                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="engel/duzenle/<?=$row['id']?>">#<?=$row['id']?></a>
                                            </td>
                                            <td>
                                                <a href="hesap/goruntule/<?=$row['accID']?>"><?=$row['username']?></a>
                                            </td>
                                            <td>
                                                <?=$category?>
                                            </td>
                                            <td>
                                                <?=$reason?>
                                            </td>
                                            <?php if ($row['expiry']=="1"): ?>
                                                <td><?=$kalan?></td>   
                                            <?php else: ?>
                                                <td>Süresiz</td>
                                            <?php endif; ?>
                                            <td class="text-right">
                                                <!--<a
                                                        class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                        href="engel/duzenle/<?=$row['id']?>"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title=""
                                                        data-original-title="Düzenle"
                                                >
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>-->
                                                <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-rounded-circle btn-danger" href="engel/liste/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
            <?php if (!$_POST && $totalBanned > 0): ?>
            <div class="col-lg-12">
                <ul class="pagination pagination-rounded justify-content-center mt-4">
                    <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                        <a href="engel/liste?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                    </li>
                    <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                        <a href="engel/liste?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php elseif($action[1]=="ekle"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Hesap Engelle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcılar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Engel Yönetimi</a></li>
                            <li class="breadcrumb-item active">Hesap Engelle</li>
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
                                    <?php if (isset($readUsers)): ?>
                                        <span><?=$readUsers['username']?></span>
                                    <?php else: ?>
                                        <input type="text" id="username" class="form-control" name="username" placeholder="Engellenecek oyuncunun kullanıcı adını giriniz.">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categoryID" class="col-sm-2 col-form-label">Kategori:</label>
                                <div class="col-sm-10">
                                    <select id="categoryID" name="categoryID" class="form-control">
                                        <option value="1">Site</option>
                                        <option value="2">Destek</option>
                                        <option value="3">Yorum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reason" class="col-sm-2 col-form-label">Nedeni:</label>
                                <div class="col-sm-10">
                                    <select id="reason" name="reason" class="form-control">
                                        <option value="1">Spam</option>
                                        <option value="2">Küfür/Hakaret</option>
                                        <option value="3">Hile</option>
                                        <option value="4">Reklam</option>
                                        <option value="5">Oyuncuları Dolandırmak</option>
                                        <option value="6">Diğer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expiry" class="col-sm-2 col-form-label">Süre:</label>
                                <div class="col-sm-10">
                                    <select id="expiry" name="expiry" class="form-control">
                                        <option value="0">Süresiz</option>
                                        <option value="1">Süreli</option>
                                    </select>
                                </div>
                            </div>

                            <div id="expiryDiv">
                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <input type="number" class="form-control" name="expiryDate" placeholder="Engel süresi (Gün)">
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

<?php /* elseif($action[1]=="duzenle"): ?>
<!--
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Dosya Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Site Yönetimi</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dosya Yönetimi</a></li>
                            <li class="breadcrumb-item active">Dosya Düzenle</li>
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
                                    <span><?=$query['username']?></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categoryID" class="col-sm-2 col-form-label">Kategori:</label>
                                <div class="col-sm-10">
                                    <select id="categoryID" name="categoryID" class="form-control">
                                        <option <?=($query['categoryID']==1)?"selected":""?> value="1">Site</option>
                                        <option <?=($query['categoryID']==2)?"selected":""?> value="2">Destek</option>
                                        <option <?=($query['categoryID']==3)?"selected":""?> value="3">Yorum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reason" class="col-sm-2 col-form-label">Nedeni:</label>
                                <div class="col-sm-10">
                                    <select id="reason" name="reason" class="form-control">
                                        <option <?=($query['reason']==1)?"selected":""?> value="1">Spam</option>
                                        <option <?=($query['reason']==2)?"selected":""?> value="2">Küfür/Hakaret</option>
                                        <option <?=($query['reason']==3)?"selected":""?> value="3">Hile</option>
                                        <option <?=($query['reason']==4)?"selected":""?> value="4">Reklam</option>
                                        <option <?=($query['reason']==5)?"selected":""?> value="5">Oyuncuları Dolandırmak</option>
                                        <option <?=($query['reason']==6)?"selected":""?> value="6">Diğer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expiry" class="col-sm-2 col-form-label">Süre:</label>
                                <div class="col-sm-10">
                                    <select id="expiry" name="expiry" class="form-control">
                                        <option <?=($query['expiry']==0)?"selected":""?> value="0">Süresiz</option>
                                        <option <?=($query['expiry']==1)?"selected":""?> value="1">Süreli</option>
                                    </select>
                                </div>
                            </div>

                            <div id="expiryDiv">
                                <div class="form-group row">
                                    <div class="col-sm-10 ml-auto">
                                        <input type="number" class="form-control" name="expiryDate" placeholder="Engel süresi (Gün)">
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
-->
<?php */ endif; ?>

<?php require 'static/footer.php' ?>

<script type="text/javascript">
    $(function() {
        if($('select[name="expiry"]').val() == '1') {
            $('#expiryDiv').fadeIn(600);
        } else {
            $('#expiryDiv').hide();
        }
        $('select[name="expiry"]').change(function(){
            if($('select[name="expiry"]').val() == '1') {
                $('#expiryDiv').fadeIn(600);
            } else {
                $('#expiryDiv').hide();
            }
        });
    });
</script>