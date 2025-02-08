<?php require 'static/header.php' ?>

<?php if(isset($action[1])): ?>

    <section id="downloads" class="min-height-500">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Dosyalar
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group">
                                <?php foreach ($downloads as $key => $readDownloads): ?>
                                <a href="oyun/<?=$readDownloads['slug']?>" class="list-group-item list-group-item-action <?=($action[1]==$readDownloads['slug'])?"active disabled":""?>"><?=$readDownloads['heading']?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($readDownload['total'] > 0): ?>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <?=$readDownload['heading']?>
                        </div>
                        <div class="card-body text-center">
                            <?=$readDownload['content']?>
                            <a href="<?=$readDownload['url']?>" target="_blank" class="btn btn-2">
                                <i class="mdi mdi-download mr-1"></i>
                                İndir
                            </a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-lg-9">
                    <?=alert('danger', 'Dosya Bulunamadı')?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php else: ?>

    <section id="downloads" class="min-height-500">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?=alert('danger', 'Henüz dosya eklenmemiş.')?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

<?php require 'static/footer.php' ?>