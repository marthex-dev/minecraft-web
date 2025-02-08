<?php require 'static/header.php' ?>

<?php if (isset($action[1]) && $action[1]=="liste"): ?>

<section id="supports" class="min-height-500">
    <div class="container">
        <div class="row">
            <div class="col-lg-<?=($readTheme['sidebar']==1)?'8':'12'?> col-md-12">
                <?=(isset($response))?$response:""?>
                <div class="support-add mb-3">
                    <a href="/destek/talep-olustur" class="btn btn-3 text-center w-100">Destek Talebi Oluştur</a>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                         Destek Mesajları
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#ID</th>
                                        <th>Başlık</th>
                                        <th>Kategori</th>
                                        <th>Son Güncelleme</th>                                        
                                        <th class="text-center">Durum</th>
                                        <th class="text-center">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php if($totalTickets > 0): ?>

                                    <?php foreach ($tickets as $readTicket): ?>
                                    <tr>
                                        <td class="text-center"><a href="/destek/goruntule/<?=$readTicket['id']?>"> #<?=$readTicket['id']?> </a></td>
                                        <td><a href="/destek/goruntule/<?=$readTicket['id']?>"> <?=$readTicket['heading']?> </a></td>
                                        <td><?=$readTicket['CategoryHeading']?></td>
                                        <td><?=ConvertTime($readTicket['updateDate'])?></td>
                                        <td class="text-center">
                                            <?php if ($readTicket['status']==1): ?>
                                                <span class="badge badge-pill badge-danger">Cevap Bekliyor</span>
                                            <?php elseif($readTicket['status']==2): ?>
                                                <span class="badge badge-pill badge-success">Cevaplandı</span>
                                            <?php elseif($readTicket['status']==3): ?>
                                                <span class="badge badge-pill badge-info">İşlemde</span>
                                            <?php else: ?>
                                                <span class="badge badge-pill badge-secondary">Kapatıldı</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-3 py-1 px-2 rounded-circle font-size-14" href="/destek/goruntule/<?=$readTicket['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mesajı Oku">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger py-1 px-2 rounded-circle font-size-14" href="/destek/liste/sil/<?=$readTicket['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mesajı Sil">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
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

            <?php if ($readTheme['sidebar']==1): ?>
            <div class="col-lg-4 col-12">
                <?php require 'static/sidebar.php' ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php elseif (isset($action[1]) && $action[1]=="goruntule"): ?>

    <?php if($totalTickets > 0): ?>

    <section id="supports" class="min-height-500">
        <div class="container">
            <div class="row">

                <div class="col-lg-<?=($readTheme['sidebar']==1)?'8':'12'?> col-md-12">
                    <?=(isset($response))?$response:""?>
                    <div class="card sidebar mb-3">
                        <div class="card-header">
                            <div class="row text-center text-md-left">
                                <div class="col-lg col-12">
                                    <?=$readTicket['heading']?>
                                </div>

                                <div class="col-lg-auto col-12">
                                    <span class="badge badge-pill badge-secondary text-capitalize" data-toggle="tooltip" data-placement="top" data-original-title="Sunucu">
                                        <?=$readTicket['serverName']?>
                                    </span>
                                    <span class="badge badge-pill badge-secondary text-capitalize" data-toggle="tooltip" data-placement="top" data-original-title="Kategori">
                                        <?=$readTicket['CategoryHeading']?>
                                    </span>
                                    <span class="badge badge-pill badge-secondary text-capitalize" data-toggle="tooltip" data-placement="top" data-original-title="Tarih">
                                        <?=ConvertTime($readTicket['creationDate'])?>
                                    </span>
                                    <?php if ($readTicket['status']==1): ?>
                                        <span class="badge badge-pill badge-danger text-capitalize" data-toggle="tooltip" data-placement="top" data-original-title="Durum">Cevap Bekliyor</span>
                                    <?php elseif($readTicket['status']==2): ?>
                                        <span class="badge badge-pill badge-success text-capitalize" data-toggle="tooltip" data-placement="top" data-original-title="Durum">Cevaplandı</span>
                                    <?php elseif($readTicket['status']==3): ?>
                                        <span class="badge badge-pill badge-info text-capitalize" data-toggle="tooltip" data-placement="top" data-original-title="Durum">İşlemde</span>
                                    <?php else: ?>
                                        <span class="badge badge-pill badge-secondary text-capitalize" data-toggle="tooltip" data-placement="top" data-original-title="Durum">Kapatıldı</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">

                                <?php foreach ($message as $key => $readMessage): ?>
                                
                                <?php if ($key!=0): ?>
                                
                                <hr />
                                
                                <?php endif; ?>

                                <li class="media">
                                    <img src="<?=avatar($readMessage['username'], '40')?>" class="mr-3 rounded-circle" alt="<?=$readSettings['serverName']?> Oyuncu - <?=$readMessage['username']?>" />
                                    <div class="media-body">
                                        <span class="float-right"><?=ConvertTime($readMessage['creationDate'])?></span>
                                        <h6 class="mt-0 mb-1">
                                            <a style="font-weight: 600;" href="oyuncu/<?=$readMessage['username']?>">
                                                <?=$readMessage['realname']?>
                                            </a>
                                        </h6>
                                        <div class="supports-message">
                                            <?=$readMessage['message'];?>
                                        </div>
                                    </div>
                                </li>

                                <?php endforeach; ?>

                            </ul>
                        </div>
                    </div>

                    <div class="card sidebar mb-3">
                        <div class="card-header">
                            Mesaj Gönder
                        </div>
                        <div class="card-body">
                            <div class="media">
                                <img src="<?=avatar($readUser['username'], '40')?>" class="mr-3 rounded-circle" alt="<?=$readSettings['serverName']?> Oyuncu - <?=$readMessage['username']?>">
                                <div class="comments-body media-body">
                                    <form action="" method="post">
                                        <textarea placeholder="Mesajınızı giriniz." class="form-control" name="message" rows="5"></textarea>
                                        <button class="btn btn-1 float-right mt-3">Mesajı gönder</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php if ($readTheme['sidebar']==1): ?>
                <div class="col-lg-4 col-md-12">
                    <?php require 'static/sidebar.php' ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php else: ?>

    <section id="supports" class="min-height-500">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?=alert('danger', 'Destek talebi bulunamadı.')?>
                </div>
            </div>
        </div>
    </section>
    
    <?php endif; ?>

<?php elseif (isset($action[1]) && $action[1]=="talep-olustur"): ?>

<section id="supports" class="min-height-500">
    <div class="container">
        <div class="row">

            <div class="col-lg-<?=($readTheme['sidebar']==1)?'8':'12'?> col-md-12">
                <?=(isset($response))?$response:""?>
                <div class="card mb-3">
                    <div class="card-header">
                        Destek Talebi Oluştur
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="heading" class="col-sm-2 col-form-label">Başlık:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="heading" class="form-control" name="heading" placeholder="Destek talebi başlığı giriniz." />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="serverID" class="col-sm-2 col-form-label">Sunucu:</label>
                                <div class="col-sm-10">
                                    <select id="serverID" class="form-control" name="serverID">
                                        <?php if ($totalServers > 0): ?>
                                            <?php foreach ($servers as $readServers): ?>
                                            <option value="<?=$readServers['id']?>"><?=$readServers['heading']?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="0">Henüz Sunucu Eklenmemiş</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="categoryID" class="col-sm-2 col-form-label">Kategori:</label>
                                <div class="col-sm-10">
                                    <select id="categoryID" class="form-control" name="categoryID">
                                        <?php if ($totalCategory > 0): ?>
                                            <?php foreach ($category as $readCategory): ?>
                                            <option value="<?=$readCategory['id']?>"><?=$readCategory['heading']?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value="0">Henüz Kategori Eklenmemiş</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message" class="col-sm-2 col-form-label">Mesaj:</label>
                                <div class="col-sm-10">
                                    <textarea id="message" class="form-control" rows="6" name="message" placeholder="Destek ekibimize iletmek istediğiniz mesajı yazın."></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-1">Oluştur</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <?php require 'static/sidebar.php'; ?>
            </div>

        </div>
    </div>
</section>

<?php endif; ?>

<?php require 'static/footer.php' ?>