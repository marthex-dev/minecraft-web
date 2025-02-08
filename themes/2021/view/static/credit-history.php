<?php 

$totalCreditHistory = $db->from('CreditHistory')->join('Users', 'Users.id = CreditHistory.accID')->where('Users.id', $readUser['id'])->where('CreditHistory.paymentStatus', '1')->select('count(*) as total')->total();

if ($totalCreditHistory > 0):
    
    $creditHistory = $db->from('CreditHistory')->where('CreditHistory.accID', $readUser['id'])->join('Users', 'Users.id = CreditHistory.accID')->select('Users.username, Users.realname, CreditHistory.price, CreditHistory.type')->where('CreditHistory.paymentStatus', '1')->orderby('CreditHistory.id', 'desc')->limit(0, 5)->all();

?>
<div class="card sidebar mb-3">
    <div class="card-header">
        Kredi Geçmişi
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Kullanıcı</th>
                        <th class="text-center">Miktar</th>
                        <th class="text-center">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($creditHistory as $key => $readCreditHistory): ?>
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
                            <?php if ($readCreditHistory['type']==1 OR $readCreditHistory['type']==6 OR $readCreditHistory['type']==7): ?>
                                <span class="text-danger"> - <?=$readCreditHistory['price']?></span>
                            <?php else: ?>
                                <span class="text-success"> + <?=$readCreditHistory['price']?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($readCreditHistory['type']==1): ?>
                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Gönderim (Gönderen)" class="mdi mdi-send"></i>
                            <?php elseif ($readCreditHistory['type']==2): ?>
                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Gönderim (Alan)" class="mdi mdi-send"></i>
                            <?php elseif ($readCreditHistory['type']==3): ?>
                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="EFT" class="mdi mdi-send"></i>
                            <?php elseif ($readCreditHistory['type']==4): ?>
                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Kredi Kartı" class="mdi mdi-credit-card-outline"></i>
                            <?php elseif ($readCreditHistory['type']==5): ?>
                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Mobil Ödeme" class="mdi mdi-cellphone"></i>
                            <?php elseif ($readCreditHistory['type']==6): ?>
                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Mağaza Kullanım" class="mdi mdi-cart"></i>
                            <?php elseif ($readCreditHistory['type']==7): ?>
                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Kasa Sistemi Kullanım" class="mdi mdi-briefcase"></i>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php else: ?>
    <?php echo alert('danger', 'Kredi geçmişi bulunamadı.'); ?>
<?php endif; ?>