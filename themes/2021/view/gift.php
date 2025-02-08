<?php require 'static/header.php' ?>

<section id="gift" class="min-height-500">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-8 col-md-12">

                <?=(isset($response))?$response:""?>
                <div class="card mb-3">
                    <div class="card-header">
                        Hediye Kuponu Bozdur
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="coupon">Kupon Kodu :</label>
                                <div class="col-md-10">
                                    <input class="form-control" name="coupon" id="coupon" type="text" placeholder="Kupon kodunu giriniz.">
                                </div>
                            </div>

                            <div class="form-group row mb-0 text-right">
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-3">Kuponu Bozdur</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <?php if ($totalHistory > 0): ?>
                <div class="card sidebar mb-3">
                    <div class="card-header">
                        Hediye Geçmişi
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Kullanıcı</th>
                                        <th class="text-center">Kod</th>
                                        <th class="text-center">Tarih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($giftHistory as $key => $readGiftHistory): ?>
                                    <tr>
                                        <td class="text-center">
                                            <img class="rounded-circle" src="<?=avatar($readGiftHistory['username'], '20')?>" width="20" height="20" />
                                        </td>
                                        <td>
                                            <a href="oyuncu/<?=$readGiftHistory['username']?>">
                                                <?=$readGiftHistory['realname']?>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?=$readGiftHistory['heading']?>
                                        </td>
                                        <td class="text-center">
                                            <?=convertTime($readGiftHistory['creationDate'], 2, true)?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php else: ?>

                    <?=alert('danger', 'Hediye geçmişi bulunamadı.')?>

                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php require 'static/footer.php' ?>