<?php 

$storeHistory = $db->from('StoreHistory')
                    ->join('Users', 'Users.id = StoreHistory.accID')
                    ->join('Products', 'Products.id = StoreHistory.productID')
                    ->join('Servers', 'Servers.id = StoreHistory.serverID')
                    ->select('Users.username, Users.realname, Servers.heading as serverName, Products.heading')
                    ->orderby('StoreHistory.id', 'desc')
                    ->limit(0, 5)
                    ->all();

if ($storeHistory):

    
?>

<div class="card sidebar mb-3">
    <div class="card-header">
        <i class="mdi mdi-cart mr-2"></i>
        Son Alışveriş Yapanlar
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover">
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
                            <img class="rounded-circle" src="<?=avatar($readStoreHistory['username'], '20')?>" alt="Oyuncu - <?=$readStoreHistory['username']?>" width="20" height="20">
                        </td>
                        <td>
                            <a href="oyuncu/<?=$readStoreHistory['username']?>">
                                <?=$readStoreHistory['realname']?>
                            </a>
                        </td>
                        <td class="text-center"><?=$readStoreHistory['serverName']?></td>
                        <td class="text-center"><?=$readStoreHistory['heading']?></td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php else: ?>

    <?=alert('danger', 'Henüz alışveriş yapılmamış.')?>

<?php endif; ?>

<?php

$creditHistory = $db->from('CreditHistory')->where('type', '3')->where('paymentStatus', '1')->or_where('type', '4')->where('paymentStatus', '1')->or_where('type', '5')->where('paymentStatus', '1')->join('Users', 'Users.id = CreditHistory.accID')->select('Users.username, Users.realname, CreditHistory.price, CreditHistory.type')->orderby('CreditHistory.id', 'desc')->limit(0, 5)->all();

if ($creditHistory):

?>

<div class="card sidebar mb-3">
    <div class="card-header">
        <i class="mdi mdi-currency-try mr-2"></i>
        Son Kredi Yükleyenler
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover">
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
                            <img class="rounded-circle" src="<?=avatar($readCreditHistory['username'], '20')?>" width="20" height="20" />
                        </td>
                        <td>
                            <a href="oyuncu/<?=$readCreditHistory['username']?>">
                                <?=$readCreditHistory['realname']?>
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
</div>

<?php endif; ?>

<?php

$totalCHistory = $db->from('CreditHistory')
                    ->join('Users', 'CreditHistory.accID = Users.id')
                    ->where('CreditHistory.type', [3,4,5], 'IN')
                    ->where('CreditHistory.paymentStatus', '1')
                    ->where('CreditHistory.creationDate', date("Y-m"), 'LIKE')
                    ->groupBy('CreditHistory.accID')
                    ->select('SUM(CreditHistory.price) as totalPrice, COUNT(CreditHistory.id) as totalProcess, Users.realname')
                    ->having('totalProcess', '0', '>')
                    ->orderby('totalPrice', 'DESC')
                    ->limit('0', '5')
                    ->all();

if ($totalCHistory):

?>

<div class="card sidebar mb-3">
    <div class="card-header">
        <i class="mdi mdi-currency-try mr-2"></i>
        En Çok Kredi Yükleyenler (Bu Ay)
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Kullanıcı</th>
                        <th class="text-center">Miktar</th>
                        <th class="text-center">Toplam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($totalCHistory as $key => $readtotalCHistory): ?>
                    <tr>
                        <td class="text-center">
                            <img class="rounded-circle" src="<?=avatar($readtotalCHistory['realname'], '20')?>" width="20" height="20" />
                        </td>
                        <td>
                            <a href="oyuncu/<?=$readtotalCHistory['realname']?>">
                                <?=$readtotalCHistory['realname']?>
                            </a>
                        </td>
                        <td class="text-center">
                            <?=$readtotalCHistory['totalPrice']?>
                        </td>
                        <td class="text-center">
                            <?=$readtotalCHistory['totalProcess']?> kez
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php endif; ?>

<div class="card sidebar mb-3">
    <div class="card-header">
        <i class="mdi mdi-account-circle mr-2"></i>
        Oyuncu Ara
    </div>
    <div class="card-body">
        <form id="userCheck" name="userCheck" method="post" action="oyuncu">
            <div class="user-form d-flex">
                <input type="text" autocomplete="off" class="form-control" placeholder="Oyuncu adı" name="username" />

                <button type="submit" class="btn btn-1 py-0 ml-2">Sorgula</button>
            </div>
        </form>
    </div>
</div>

<?php if ($readTheme['discord']==1 && !empty($readTheme['discordServerID'])): ?>

<div class="card sidebar">
    <iframe allowtransparency="true" src="https://discordapp.com/widget?id=<?=$readTheme['discordServerID']?>&amp;theme=<?=($readTheme['discordTheme']==0)?'light':'dark'?>" width="100%" height="500" frameborder="0"></iframe>
</div>

<?php endif; ?>