<?php require 'static/header.php' ?>

<?php if (isset($readUser)): ?>

<section id="profile" class="min-height-500">
    <div class="container">
        <div class="row">

        	<div class="col-lg-4 col-md-12 mb-3">
                <div class="card overflow-hidden">
                    <div class="card-body pt-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="avatar-md text-center profile-user-wid mb-4 mx-auto">
                                    <img src="<?=avatar($readUser['username'], '72')?>" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Kullanıcı Adı:</th>
                                                <td><?=$readUser['realname']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">E-Posta:</th>
                                                <td><?=$readUser['email']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Yetki:</th>
                                                <td>
                                                    <?php
                                                    if ($readUser['permission']=="0"):
                                                        echo "<span class='badge badge-pill badge-secondary'>Oyuncu</span>";
                                                    elseif ($readUser['permission']=="1"):
                                                        echo "<span class='badge badge-pill badge-dark'>Youtuber</span>";
                                                    elseif ($readUser['permission']=="2"):
                                                        echo "<span class='badge badge-pill badge-info'>Destek</span>";
                                                    elseif($readUser['permission']=="3"):
                                                        echo "<span class='badge badge-pill badge-warning'>Yazar</span>";
                                                    elseif($readUser['permission']=="4"):
                                                        echo "<span class='badge badge-pill badge-primary'>Görevli</span>";
                                                    elseif($readUser['permission']=="5"):
                                                        echo "<span class='badge badge-pill badge-success'>Moderatör</span>";
                                                    elseif($readUser['permission']=="6"):
                                                        echo "<span class='badge badge-pill badge-danger'>Yönetici</span>";
                                                    else:
                                                        echo "Hata!";
                                                    endif;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kredi:</th>
                                                <td><?=$readUser['credit']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Son Giriş:</th>
                                                <td><?=convertTime(date("Y-m-d H:i:s", ($readUser['lastlogin']/1000)), 2, true)?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kayıt Tarihi:</th>
                                                <td><?=convertTime(date("Y-m-d H:i:s", ($readUser['regdate']/1000)), 2, true)?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">IP Adresi:</th>
                                                <td><?=$readUser['ip']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Skype:</th>
                                                <td><?=$readUser['skype']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Discord:</th>
                                                <td><?=$readUser['discord']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="profile-button mt-3">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <a href="/profil/duzenle" class="btn btn-3 w-100">Profili Düzenle</a>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="/profil/sifre-degistir" class="btn btn-2 w-100">Şifreyi Değiştir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!isset($action[1])): ?>

            <div class="col-lg-8 col-md-12">
				<div class="card">
				    <div class="card-header border-0 p-0">
				        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
				            <li class="nav-item">
				                <a class="nav-link active" data-toggle="tab" href="#supportHistory" role="tab" aria-selected="true">
				                    <span class="d-block d-sm-none"><i class="mdi mdi-lifebuoy"></i></span>
				                    <span class="d-none d-sm-block">Destek Mesajları</span>
				                </a>
				            </li>
				            <li class="nav-item">
				                <a class="nav-link" data-toggle="tab" href="#profile1" role="tab" aria-selected="false">
				                    <span class="d-block d-sm-none"><i class="mdi mdi-currency-try"></i></span>
				                    <span class="d-none d-sm-block">Kredi Geçmişi</span>
				                </a>
				            </li>
				            <li class="nav-item">
				                <a class="nav-link" data-toggle="tab" href="#storeHistory" role="tab" aria-selected="false">
				                    <span class="d-block d-sm-none"><i class="mdi mdi-cart"></i></span>
				                    <span class="d-none d-sm-block">Mağaza Geçmişi</span>
				                </a>
				            </li>
				        </ul>
				    </div>
				    <div class="card-body p-0">
				        <div class="tab-content text-muted">
				            <div class="tab-pane active" id="supportHistory" role="tabpanel">
				                <div class="table-responsive">
                    			    <table class="table table-hover mb-0">
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
                    			                <td class="text-center"><a href="destek/goruntule/<?=$readTicket['id']?>"> #<?=$readTicket['id']?> </a></td>
                    			                <td><a href="destek/goruntule/<?=$readTicket['id']?>"> <?=$readTicket['heading']?> </a></td>
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
                    			                    <a class="btn btn-3 py-1 px-2 rounded-circle font-size-14" href="destek/goruntule/<?=$readTicket['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mesajı Oku">
                    			                        <i class="mdi mdi-eye"></i>
                    			                    </a>
                    			                    <a onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger py-1 px-2 rounded-circle font-size-14" href="destek/liste/sil/<?=$readTicket['id']?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mesajı Sil">
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
				            <div class="tab-pane" id="profile1" role="tabpanel">
				                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Kullanıcı</th>
                                                <th class="text-center">Miktar</th>
                                                <th class="text-center">Tarih</th>
                                                <th class="text-center">İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($totalCreditHistory > 0): ?>
                                            <?php foreach ($creditHistory as $key => $readCreditHistory): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <img class="rounded-circle" src="<?=avatar($readCreditHistory['username'], '20')?>" width="20" height="20" />
                                                </td>
                                                <td>
                                                    <a href="oyuncu/<?=$readCreditHistory['username']?>">
                                                        <?=$readCreditHistory['username']?>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($readCreditHistory['type']==1 OR $readCreditHistory['type']==6 OR $readCreditHistory['type']==7): ?>
                                                        <span class="text-danger"> - <?=$readCreditHistory['price']?></span>
                                                    <?php else: ?>
                                                        <span class="text-success"> + <?=$readCreditHistory['price']?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center"><?=convertTime($readCreditHistory['creationDate'], 2, true)?></td>
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
                                        <?php else: ?>
                                            <tr>
                                                <td class="text-center" colspan="5">Kayıt Bulunamadı!</td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
				            </div>
				            <div class="tab-pane" id="storeHistory" role="tabpanel">
				                <div class="table-responsive">
    							    <table class="table table-hover mb-0">
    							        <thead>
    							            <tr>
    							                <th class="text-center">#ID</th>
    							                <th>Ürün</th>
    							                <th class="text-center">Sunucu</th>
    							                <th class="text-center">Tutar</th>
    							                <th class="text-center">Tarih</th>
    							            </tr>
    							        </thead>
    							        <tbody>
                                        <?php if ($totalStoreHistory > 0): ?>

    							            <?php foreach ($storeHistory as $key => $readStoreHistory): ?>

    							            <tr>
    							            	<td class="text-center">
    							            		<?=$readStoreHistory['id']?>
    							            	</td>
    							                <td><?=$readStoreHistory['heading']?></td>
    							                <td class="text-center"><?=$readStoreHistory['serverName']?></td>
    							                <td class="text-center"><?=$readStoreHistory['price']?> Kredi</td>
    							                <td class="text-center"><?=convertTime($readStoreHistory['creationDate'], 2, true)?></td>
    							            </tr>
    							            <?php endforeach; ?>
                                            
                                        <?php else: ?>
                                            <tr>
                                                <td class="text-center" colspan="5">Kayıt Bulunamadı!</td>
                                            </tr>
                                        <?php endif; ?>
    							        </tbody>
    							    </table>
    							</div>
				            </div>
				        </div>
				    </div>
				</div>
			</div>

            <?php elseif (isset($action[1]) && $action[1]=="duzenle"): ?>

                <div class="col-lg-8 col-md-12">

                    <?=(isset($response))?$response:""?>

                    <div class="card mb-3">
                        <div class="card-header">
                            Profili Düzenle
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="username">Kullanıcı Adı :</label>
                                    <div class="col-md-10">
                                        <input class="form-control border-0 pl-0" type="text" disabled="" value="<?=$readUser['username']?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="email">E-Posta :</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="email" value="<?=$readUser['email']?>" type="email" name="email" placeholder="E-Posta adresinizi giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="skype">Skype :</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="skype" value="<?=$readUser['skype']?>" type="text" name="skype" placeholder="Skype adresinizi giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="discord">Discord :</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="discord" value="<?=$readUser['discord']?>" type="text" name="discord" placeholder="Discord adresinizi giriniz.">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row mb-0">
                                    <label class="col-md-2 col-form-label" for="password">Şifre :</label>
                                    <div class="col-md-10">
                                        <input class="form-control" id="password" type="password" name="password" placeholder="Düzenleme yapmak için şifrenizi giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row mb-0 text-right">
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-3">Düzenle</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            <?php elseif (isset($action[1]) && $action[1]=="sifre-degistir"): ?>

                <div class="col-lg-8 col-md-12">

                    <?=(isset($response))?$response:""?>

                    <div class="card mb-3">
                        <div class="card-header">
                            Şifre Değiştir
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="username">Kullanıcı Adı :</label>
                                    <div class="col-md-9">
                                        <input class="form-control border-0 pl-0" type="text" disabled="" value="<?=$readUser['username']?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="newPassword">Yeni Şifre :</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="newPassword" type="password" name="newPassword" placeholder="Yeni şifrenizi giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="newPasswordRe">Yeni Şifre (Tekrar) :</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="newPasswordRe" type="password" name="newPasswordRe" placeholder="Yeni şifrenizi tekrar giriniz.">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row mb-0">
                                    <label class="col-md-3 col-form-label" for="password">Şifre :</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="password" type="password" name="password" placeholder="Düzenleme yapmak için şifrenizi giriniz.">
                                    </div>
                                </div>

                                <div class="form-group row mb-0 text-right">
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-3">Düzenle</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            <?php endif; ?>

        </div>
    </div>
</section>

<?php endif; ?>

<?php require 'static/footer.php' ?>