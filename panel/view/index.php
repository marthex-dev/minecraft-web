<?php require 'static/header.php' ?>

<div class="container-fluid">
    <div class="row">
        <?php if (isset($response)): ?>
        <div class="col-12">
            <?=$response?>
        </div>
        <?php endif; ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Yetkili Sohbet
                    <div class="float-right">
                        <a href="javascript:;">Yenile</a>
                    </div>
                </div>
                <div id="adminChatBox" class="card-body" style="height: 215px !important;overflow: auto;">
                    Yükleniyor...
                </div>
                <div class="card-footer rounded p-2">
                    <form id="adminChat" method="post">
                        <div class="chat-input-section">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="message" class="form-control rounded" placeholder="Mesajınızı Giriniz...">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">Gönder</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>        
            </div>
        </div>

        <div class="col-md-4">
            <?php if ($totalStoreHistory > 0): ?>
            <div class="card">
                <div class="card-header">
                    Mağaza Geçmişi
                    <div class="float-right">
                        <a href="magaza/gecmis">Tümünü Gör</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Kullanıcı</th>
                                    <th class="text-center">Sunucu</th>
                                    <th class="text-center">Ürün</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($storeHistory as $key => $readStoreHistory): ?>

                                <tr>
                                    <td class="text-center">
                                        <img class="rounded-circle" src="https://minotar.net/avatar/<?=$readStoreHistory['username']?>/20" alt="Oyuncu - <?=$readStoreHistory['username']?>" width="20" height="20">
                                    </td>
                                    <td>
                                        <a href="hesap/goruntule/<?=$readStoreHistory['id']?>">
                                            <?=substr($readStoreHistory['username'], 0, 10)?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?=$readStoreHistory['serverName']?></td>
                                    <td class="text-center"><?=substr($readStoreHistory['heading'], 0, 12)?></td>
                                </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php else: ?>

                <?=alertDanger('Henüz alışveriş yapılmamış.')?>
            
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <?php if ($totalCreditHistory > 0): ?>
            <div class="card">
                <div class="card-header">
                    Kredi Geçmişi
                    <div class="float-right">
                        <a href="magaza/kredi-yukleme-gecmisi">Tümünü Gör</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Kullanıcı</th>
                                    <th class="text-center">Miktar</th>
                                    <th class="text-center">Ödeme</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($creditHistory as $key => $readCreditHistory): ?>
                                <?php if ($readCreditHistory['type']==3 OR $readCreditHistory['type']==4 OR $readCreditHistory['type']==5): ?>
                                <tr>
                                    <td class="text-center">
                                        <img class="rounded-circle" src="https://minotar.net/avatar/<?=$readCreditHistory['username']?>/20" width="20" height="20" />
                                    </td>
                                    <td>
                                        <a href="hesap/goruntule/<?=$readCreditHistory['id']?>">
                                            <?=substr($readCreditHistory['username'], 0, 10)?>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-success"> + <?=$readCreditHistory['price']?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($readCreditHistory['type']==3): ?>
                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="EFT" class="mdi mdi-send"></i>
                                        <?php elseif ($readCreditHistory['type']==4): ?>
                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Kredi Kartı" class="mdi mdi-credit-card-outline"></i>
                                        <?php elseif ($readCreditHistory['type']==5): ?>
                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Mobil Ödeme" class="mdi mdi-cellphone"></i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php else: ?>

                <?=alertDanger('Henüz alışveriş yapılmamış.')?>
            
            <?php endif; ?>
        </div>

    </div>
</div>

<?php require 'static/footer.php' ?>