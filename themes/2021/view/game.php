<?php require 'static/header.php' ?>

<?php if (!isset($action[1])): ?>

<?php if ($totalGames > 0): ?>

    <style type="text/css">
        .card-info {transition: all 0.3s ease;}
        .card-info:hover {transform: scale(1.075);}
    </style>

    <section id="games" class="min-height-500">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($games as $key => $readGames): ?>
    
                                <div class="col-lg-3 col-md-6" style="margin-top: 50px;">
                                    <a href="oyun/<?=$readGames['slug']?>">
                                        <div class="card-info text-center">
                                           <img src="<?=$find_read_page.$readGames['image']?>" class="img-fluid rounded" style="margin-top: -50px;">
                                            <span class="card-heading"><?=$readGames['heading']?></span>
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
                <div class="col-lg-12">
                    <?=alert('danger', 'Henüz oyun eklenmemiş.')?>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>

<?php elseif(isset($action[1])): ?>

    <?php if ($totalGames > 0): ?>

    <section id="games" class="min-height-500">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Oyunlar
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group">
                                <?php foreach ($games as $key => $readGames): ?>
                                <a href="oyun/<?=$readGames['slug']?>" class="list-group-item list-group-item-action <?=($action[1]==$readGames['slug'])?"active disabled":""?>"><?=$readGames['heading']?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($readGame['total'] > 0): ?>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <?=$readGame['heading']?>
                        </div>
                        <div class="card-body">
                            <?=$readGame['content']?>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-lg-9">
                    <?=alert('danger', 'Oyun Bulunamadı')?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php endif; ?>

<?php endif; ?>

<?php require 'static/footer.php' ?>