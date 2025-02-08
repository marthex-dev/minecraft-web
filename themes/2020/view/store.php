<?php require 'static/header.php' ?>

<?php if (!isset($action[1])): ?>

    <?php if ($totalServers > 0): ?>

    <style type="text/css">
        .card-info {transition: all 0.3s ease;}
        .card-info:hover {transform: scale(1.075);}
    </style>

    <section id="store" class="min-height-500">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                            <?php if (isset($servers)): ?>
                                <?php foreach ($servers as $key => $readServers): ?>

                                <div class="col-lg-3 col-md-6 mb-3" style="margin-top: 50px;">
                                    <a href="magaza/<?=$readServers['slug']?>">
                                        <div class="card-info text-center h-100 d-flex align-items-end justify-content-center">
                                            <div>
                                                <img src="<?=$find_read_page.$readServers['image']?>" class="img-fluid rounded" style="margin-top: -50px;">
                                                <span class="card-heading"><?=$readServers['heading']?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php else: ?>

    <section id="store" class="min-height-500">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <?=alert('danger', 'Henüz sunucu eklenmemiş')?>
                
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>

<?php elseif (!isset($action[2])): ?>

    <?php if ($totalServers > 0): ?>

        <?php if ($server['total'] > 0): ?> 

            <?php if ($totalCategories > 0): ?>

            <section id="store" class="min-height-500">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    Sunucular
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group">
                                        <?php foreach ($servers as $key => $readServers): ?>
                                        <a href="magaza/<?=$readServers['slug']?>" class="list-group-item list-group-item-action <?=($action[1]==$readServers['slug'])?"active":""?>"><?=$readServers['heading']?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header">
                                    Kategoriler
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php foreach ($categories as $key => $readCategories): ?>

                                        <div class="col-lg-3 col-md-6 mb-3">
                                            <a href="magaza/<?=$server['slug']?>/<?=$readCategories['slug']?>">
                                                <div class="card-info text-center">
                                                    <img src="<?=$find_read_page.$readCategories['image']?>" class="img-fluid rounded">
                                                    <span class="card-heading"><?=$readCategories['heading']?></span>
                                                </div>
                                            </a>
                                        </div>

                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </section>

            <?php else: ?>

            <section id="store" class="min-height-500">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    Sunucular
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group">
                                        <?php foreach ($servers as $key => $readServers): ?>
                                        <a href="magaza/<?=$readServers['slug']?>" class="list-group-item list-group-item-action <?=($action[1]==$readServers['slug'])?"active":""?>"><?=$readServers['heading']?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">

                            <?=alert('danger', 'Henüz kategori eklenmemiş.')?>
                        
                        </div>
                    </div>
                </div>
            </section>

            <?php endif; ?>

        <?php else: ?>

        <section id="store" class="min-height-500">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <?=alert('danger', 'Sunucu bulunamadı.')?>
                    
                    </div>
                </div>
            </div>
        </section>

        <?php endif; ?>

    <?php else: ?>

    <section id="store" class="min-height-500">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <?=alert('danger', 'Sunucu bulunamadı.')?>
                
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>

<?php elseif (!isset($action[3])): ?>

    <?php if ($totalServers > 0): ?>

        <?php if ($server['total'] > 0):  ?>

            <?php if ($categories['total'] > 0): ?>

            <div id="storeModal" class="modal" tabindex="-1"></div>

            <section id="store" class="min-height-500">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    Sunucular
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group">
                                        <?php foreach ($servers as $key => $readServers): ?>
                                        <a href="magaza/<?=$readServers['slug']?>" class="list-group-item list-group-item-action <?=($action[1]==$readServers['slug'])?"active":""?>"><?=$readServers['heading']?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ($readSettings['mostProductsStatus']==1): ?>
                            <div class="card sidebar mb-3">
                                <div class="card-header">
                                    En Çok Satan Ürünler
                                </div>
                                <div class="card-body p-0">
                                    <?php foreach ($totalSales as $readTotalSales):?>

                                    <div type="button" data-toggle="modal" data-target="#storeModal" class="topProducts" onclick="ajaxModal('<?=$readTotalSales['id']?>')">
                                        <div class="topProductImage">
                                            <img src="<?=$find_read_page.$readTotalSales['image']?>" class="img-fluid">
                                        </div>
                                        <div class="topProductInfo">
                                            <div class="topProductServer">
                                                <?=$readTotalSales['serverName']?>
                                            </div>
                                            <div class="topProductName">
                                                <?=$readTotalSales['heading']?>
                                            </div>
                                            <div class="topProductPrice">
                                                <?php if ($readTotalSales['discount']=="1"): ?>
                                                    <?php if ($readTotalSales['discountExpiry'] > $date): ?>
                                                        <span class="price-discount"><?=$readTotalSales['price']?> Kredi</span>
                                                        <span class="price-actual"><?=$readTotalSales['discountPrice']?> Kredi</span>
                                                    <?php else: ?>
                                                        <span class="price-actual"><?=$readTotalSales['price']?> Kredi</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="price-actual"><?=$readTotalSales['price']?> Kredi</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <?php if ($totalSubCategory > 0): ?>
                                <div class="col-lg-12 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Kategoriler
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                            <?php foreach ($subCategory as $key => $readSubCategory): ?>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <a href="magaza/<?=$server['slug']?>/<?=$readSubCategory['slug']?>">
                                                        <div class="card-info text-center">
                                                            <img src="<?=$find_read_page.$readSubCategory['image']?>" class="img-fluid rounded">
                                                            <span class="card-heading"><?=$readSubCategory['heading']?></span>
                                                        </div>
                                                    </a>
                                                </div>

                                                <?php endforeach; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($totalProducts > 0): ?>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Ürünler
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                            <?php foreach ($products as $key => $readProducts): ?>

                                                <div class="col-lg-3 col-md-6 mb-3">
                                                    <div class="card-info position-relative text-center">
                                                        <a href="javascript:;" onclick="ajaxModal('<?=$readProducts['id']?>')" type="button" data-toggle="modal" data-target="#storeModal">
                                                            <img data-toggle="tooltip" data-placement="top" title="" data-original-title="Detayları Görüntüle" src="<?=$find_read_page.$readProducts['image']?>" class="img-fluid rounded">
                                                        </a>
                                                        <span class="card-heading"><?=$readProducts['heading']?></span>
                                                        <div class="card-price">
                                                            <?php if ($readProducts['discount']=="1"): ?>
                                                                <?php if ($readProducts['discountDuration']=="1"): ?>
                                                                    <?php if ($readProducts['discountExpiry'] > $date): ?>
                                                                    <div class="store-discount">
                                                                        <i class="mdi mdi-timer-outline"></i>
                                                                        <span data-toggle="count-down"  data-countdown="<?=$readProducts['discountExpiry']?>">Yükleniyor...</span>
                                                                    </div>
                                                                    <span class="price-discount"><?=$readProducts['price']?> Kredi</span>
                                                                    <span class="price-actual"><?=$readProducts['discountPrice']?> Kredi</span>
                                                                    <?php else: ?>
                                                                    <span class="price-actual"><?=$readProducts['price']?> Kredi</span>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                <span class="price-discount"><?=$readProducts['price']?> Kredi</span>
                                                                <span class="price-actual"><?=$readProducts['discountPrice']?> Kredi</span>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="price-actual"><?=$readProducts['price']?> Kredi</span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if ($readProducts['stockStatus']==1): ?>
                                                            <?php if ($readProducts['stock'] > 0): ?>
                                                            <button onclick="ajaxModal('<?=$readProducts['id']?>')" type="button" class="btn btn-success" data-toggle="modal" data-target="#storeModal">
                                                                <i class="mdi mdi-plus"></i>
                                                                Satın Al
                                                            </button>
                                                            <?php else: ?>
                                                            <button class="btn btn-danger disabled">
                                                                Stokta Yok!
                                                            </button>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                        <button onclick="ajaxModal('<?=$readProducts['id']?>')" type="button" class="btn btn-success" data-toggle="modal" data-target="#storeModal">
                                                            <i class="mdi mdi-plus"></i>
                                                            Satın Al
                                                        </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <?php endforeach; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php endif; ?>

                                <?php if ($totalSubCategory < 1 AND $totalProducts < 1): ?>

                                <div class="col-lg-12">
                                    <?=alert('danger', 'Henüz ürün veya kategori eklenmemiş.')?>
                                </div>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <?php else: ?>

            <section id="store" class="min-height-500">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    Sunucular
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group">
                                        <?php foreach ($servers as $key => $readServers): ?>
                                        <a href="magaza/<?=$readServers['slug']?>" class="list-group-item list-group-item-action <?=($action[1]==$readServers['slug'])?"active":""?>"><?=$readServers['heading']?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">

                            <?=alert('danger', 'Kategori Bulunamadı.')?>
                        
                        </div>
                    </div>
                </div>
            </section>

            <?php endif; ?>

        <?php else: ?>

        <section id="store" class="min-height-500">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <?=alert('danger', 'Sunucu bulunamadı.')?>
                    
                    </div>
                </div>
            </div>
        </section>

        <?php endif; ?>

    <?php else: ?>

    <section id="store" class="min-height-500">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <?=alert('danger', 'Henüz sunucu eklenmemiş.')?>
                
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>

<?php endif; ?>

<?php require 'static/footer.php' ?>