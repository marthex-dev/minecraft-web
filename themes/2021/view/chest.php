<?php require 'static/header.php' ?>

<?php if (!isset($action[1])): ?>

<div id="storeModal" class="modal" tabindex="-1"></div>

<section id="chest" class="min-height-500">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div id="chestResponse"></div>
                <div class="card mb-3">
                    <div class="card-header">
                        Sandık <?=(isset($totalChest) OR isset($totalVips))?"(".($totalChest + $totalVips).")":""?>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#ID</th>
                                        <th>Ürün</th>
                                        <th>Sunucu</th>
                                        <th>Süre</th>
                                        <th>Tarih</th>
                                        <th class="text-center">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if ($totalVips > 0): ?>

                                        <?php foreach ($vips as $key => $readVips): ?>

                                        <tr>

                                            <td class="text-center">#<?=$readVips['id']?></td>

                                            <td><?=$readVips['ProductName']?></td>

                                            <td><?=$readVips['ServerName']?></td>

                                            <td>

                                                <?php if ($readVips['duration'] == 1): ?>
                                                    <?=$readVips['durationDay']?> Gün
                                                <?php else: ?>
                                                    Süresiz
                                                <?php endif; ?>

                                            </td>

                                            <td><?=ConvertTime($readVips['creationDate'], 2, true)?></td>

                                            <td class="text-center">

                                                <a class="btn btn-3 py-1 px-2 rounded-circle font-size-14" onclick="ajaxChest('<?=$readVips['id']?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Teslim Al">
                                                    <i class="mdi mdi-check"></i>
                                                </a>

                                                <?php if ($readSettings['sendGiftStatus']==1): ?>

                                                <a class="btn btn-primary py-1 px-2 rounded-circle font-size-14" href="sandik/hediye/<?=$readVips['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hediye Et">
                                                    <i class="mdi mdi-gift"></i>
                                                </a>

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                        <?php endforeach; ?>

                                    <?php endif; ?>

                                    <?php if ($totalChest > 0): ?>

                                        <?php foreach ($chest as $key => $readChest): ?>

                                        <tr>

                                            <td class="text-center">#<?=$readChest['id']?></td>

                                            <td><?=$readChest['ProductName']?></td>

                                            <td><?=$readChest['ServerName']?></td>

                                            <td>

                                                <?php if ($readChest['duration'] == 1): ?>
                                                    <?=$readChest['durationDay']?> Gün
                                                <?php else: ?>
                                                    Süresiz
                                                <?php endif; ?>

                                            </td>

                                            <td><?=ConvertTime($readChest['creationDate'], 2, true)?></td>

                                            <td class="text-center">

                                                <a class="btn btn-3 py-1 px-2 rounded-circle font-size-14" onclick="ajaxChest('<?=$readChest['id']?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Teslim Al">
                                                    <i class="mdi mdi-check"></i>
                                                </a>

                                                <?php if ($readSettings['sendGiftStatus']==1): ?>

                                                <a class="btn btn-primary py-1 px-2 rounded-circle font-size-14" href="sandik/hediye/<?=$readChest['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hediye Et">
                                                    <i class="mdi mdi-gift"></i>
                                                </a>

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                        <?php endforeach; ?>

                                    <?php endif; ?>

                                    <?php if ($totalChest == 0 && $totalVips == 0): ?>

                                    <tr>

                                        <td class="text-center" colspan="6">Kayıt Bulunamadı!</td>

                                    </tr>

                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        VIP <?=(isset($vipExpiryHistory) && $vipExpiryHistory > 0)?"(".$vipExpiryHistory.")":""?>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#ID</th>
                                        <th>Ürün</th>
                                        <th>Sunucu</th>
                                        <th>Süre</th>
                                        <th>Tarih</th>
                                        <th class="text-center">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if (isset($vipExpiry) && $vipExpiryHistory > 0): ?>

                                        <?php foreach ($vipExpiry as $key => $readExpiry): ?>

                                            <?php

                                            $tarih1 = new DateTime(date('Y-m-d'));
                                            $tarih2 = new DateTime($readExpiry['expiryDate']);
                                            $interval= $tarih1->diff($tarih2);

                                            ?>

                                        <tr>
                                            <td class="text-center">#<?=$readExpiry['id']?></td>
                                            <td><?=$readExpiry['heading']?></td>
                                            <td><?=$readExpiry['serverName']?></td>
                                            <td><?=$interval->format('%a günü kaldı');?></td>
                                            <td><?=ConvertTime($readExpiry['creationDate'], 2, true)?></td>
                                            <td class="text-center">
                                                <div style="width: 32px;margin-left: auto;margin-right: auto;border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Uzat">
                                                    <a class="btn btn-success py-1 px-2 rounded-circle font-size-14" href="vip/<?=$readExpiry['slug']?>">
                                                        <i class="mdi mdi-alarm-plus"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                    <?php else: ?>

                                    <tr>

                                        <td class="text-center" colspan="6">Kayıt Bulunamadı!</td>

                                    </tr>

                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        Süresi Olan Ürünler <?=(isset($productExpiryHistory) && $productExpiryHistory > 0 && $productExpiry)?"(".$productExpiryHistory.")":""?>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#ID</th>
                                        <th>Ürün</th>
                                        <th>Sunucu</th>
                                        <th>Süre</th>
                                        <th>Tarih</th>
                                        <th class="text-center">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($productExpiryHistory > 0 && isset($productExpiry)): ?>

                                        <?php foreach ($productExpiry as $key => $readExpiry): ?>

                                            <?php

                                            $tarih1 = new DateTime(date('Y-m-d'));
                                            $tarih2 = new DateTime($readExpiry['expiryDate']);
                                            $interval= $tarih1->diff($tarih2);

                                            ?>

                                        <tr>
                                            <td class="text-center">#<?=$readExpiry['id']?></td>
                                            <td><?=$readExpiry['heading']?></td>
                                            <td><?=$readExpiry['serverName']?></td>
                                            <td><?=$interval->format('%a günü kaldı');?></td>
                                            <td><?=ConvertTime($readExpiry['creationDate'], 2, true)?></td>
                                            <td class="text-center">
                                                <div style="width: 32px;margin-left: auto;margin-right: auto;border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Uzat">
                                                    <a class="btn btn-success py-1 px-2 rounded-circle font-size-14" type="button" data-toggle="modal" data-target="#storeModal" onclick="ajaxModal('<?=$readExpiry['pID']?>')">
                                                        <i class="mdi mdi-alarm-plus"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                    <?php else: ?>

                                        <tr>

                                            <td class="text-center" colspan="6">Kayıt Bulunamadı!</td>

                                        </tr>

                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <?php if ($totalChestHistory > 0): ?>
                <div class="card sidebar mb-3">
                    <div class="card-header">
                        Sandık Geçmişi
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Kullanıcı</th>
                                        <th class="text-center">Ürün</th>
                                        <th class="text-center">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($chestHistory as $key => $readChestHistory): ?>
                                    <tr>
                                        <td class="text-center">
                                            <img class="rounded-circle" src="<?=avatar($readChestHistory['username'], '20')?>" alt="Oyuncu - <?=$readChestHistory['username']?>" width="20" height="20" />
                                        </td>
                                        <td>
                                            <a href="oyuncu/<?=$readChestHistory['username']?>">
                                                <?=$readChestHistory['realname']?>
                                            </a>
                                        </td>
                                        <td class="text-center"><?=$readChestHistory['ProductName']?></td>
                                        <td class="text-center">
                                            <?php if ($readChestHistory['type']==1): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Teslim" class="mdi mdi-check"></i>
                                            <?php elseif ($readChestHistory['type']==2): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Hediye (Gönderen)" class="mdi mdi-gift"></i>
                                            <?php elseif ($readChestHistory['type']==3): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Hediye (Alan)" class="mdi mdi-gift"></i>
                                            <?php else: ?>
                                                HATA!
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
                    <?php echo alert('danger', 'Sandık geçmişi bulunamadı.'); ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php elseif (isset($action[1]) && $action[1]=="hediye"): ?>

<section id="chest" class="min-height-500">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <?php if ($chest['total'] > 0): ?>
                    <?php if ($readSettings['sendGiftStatus']==1): ?>

                    <div id="chestResponse"></div>
                    <div class="card mb-3">
                        <div class="card-header">
                            Hediye Gönder
                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="product">Ürün :</label>
                                    <div class="col-md-10">
                                        <input class="form-control border-0" id="product" type="text" disabled="" value="<?=$product['heading']?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="product">Kullanıcı Adı :</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="username" type="text" name="username" placeholder="Hediye göndereceğiniz oyuncunun kullanıcı adını yazınız.">
                                    </div>
                                </div>
                                <div class="form-group row mb-0 text-right">
                                    <div class="col-md-12 mt-3">
                                        <button type="button" class="btn btn-3" onclick="ajaxChest('<?=$action['2']?>', '2', '#username')">Hediye Gönder</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php else: ?>
                        <?php echo alert('danger', 'Hediye gönderme yönetici tarafından kapatılmış.'); ?>
                    <?php endif; ?>

                <?php else: ?>
                    <?php echo alert('danger', 'Sandıkta ürün bulunamadı.'); ?>
                <?php endif; ?>

            </div>

            <div class="col-lg-4">
                <?php if ($totalChestHistory > 0): ?>
                <div class="card sidebar mb-3">
                    <div class="card-header">
                        Sandık Geçmişi
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Kullanıcı</th>
                                        <th class="text-center">Ürün</th>
                                        <th class="text-center">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($chestHistory as $key => $readChestHistory): ?>
                                    <tr>
                                        <td class="text-center">
                                            <img class="rounded-circle" src="<?=avatar($readChestHistory['username'], '20')?>" alt="Oyuncu - <?=$readChestHistory['username']?>" width="20" height="20" />
                                        </td>
                                        <td>
                                            <a href="oyuncu/<?=$readChestHistory['username']?>">
                                                <?=$readChestHistory['realname']?>
                                            </a>
                                        </td>
                                        <td class="text-center"><?=$readChestHistory['ProductName']?></td>
                                        <td class="text-center">
                                            <?php if ($readChestHistory['type']==1): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Teslim" class="mdi mdi-check"></i>
                                            <?php elseif ($readChestHistory['type']==2): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Hediye (Gönderen)" class="mdi mdi-gift"></i>
                                            <?php elseif ($readChestHistory['type']==3): ?>
                                            <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Hediye (Alan)" class="mdi mdi-gift"></i>
                                            <?php else: ?>
                                                HATA!
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
                    <?php echo alert('danger', 'Sandık geçmişi bulunamadı.'); ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php endif; ?>

<?php require 'static/footer.php' ?>