<?php require 'static/header.php' ?>

<?php if ($action[1] == "gecmis"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Sandık Geçmişi</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mağaza İşlemleri</a></li>
                            <li class="breadcrumb-item active">Sandık Geçmişi</li>
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
                                        <th>Sunucu</th>
                                        <th class="text-center">İşlem</th>
                                        <th>Tarih</th>
                                        <th class="text-right">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php 
                                        if ($totalHistory > 0):
                                            foreach ($chestHistory as $row):
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
                                            <a href="magaza/duzenle/<?=$row['productID']?>">
                                                <?=$row['productHeading']?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="sunucu/duzenle/<?=$row['serverID']?>">
                                                <?=$row['serverHeading']?>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row['type']==1): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Teslim" class="mdi mdi-check"></i>
                                            <?php elseif ($row['type']==2): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Hediye (Gönderen)" class="mdi mdi-gift"></i>
                                            <?php elseif ($row['type']==3): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Hediye (Alan)" class="mdi mdi-gift"></i>
                                            <?php else: ?>
                                                HATA!
                                            <?php endif; ?>
                                        </td>
                                        <td><?=convertTime($row['creationDate'], 2, true)?></td>
                                        <td class="text-right">
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?');" class="btn btn-sm btn-danger" href="sandik/gecmis/sil/<?=$row['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sil">
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
                <?php if (!$_POST && $totalHistory > 0): ?>
                <div class="col-lg-12">
                    <ul class="pagination pagination-rounded justify-content-center mt-4">
                        <li class="page-item <?=($prevPage == 0)?'disabled':''?>">
                            <a href="sandik/gecmis?limit=<?=$prevPage?>" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active">
                            <a href="javascript:;" class="page-link"><?=$_GET['limit']?></a>
                        </li>
                        <li class="page-item <?=($totalPage==$_GET['limit'])?'disabled':''?>">
                            <a href="sandik/gecmis?limit=<?=$nextPage?>" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php require 'static/footer.php' ?>