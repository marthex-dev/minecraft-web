<?php require 'static/header.php' ?>


	<?php if ($action[1]=="liste"): ?>

	<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Ödeme Yöntemleri</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Finansal Ayarlar</a></li>
                            <li class="breadcrumb-item active">Ödeme Yöntemleri</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php if (isset($response)): ?>
                <div class="col-12">
                    <?=$response?>
                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="card position-relative">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <form class="d-flex align-items-center w-100">
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-auto d-flex h-100 align-items-center pr-0">
                                            <span class="bx bx-search text-muted"></span>
                                        </div>
                                        <div class="col">
                                            <input onkeyup="" type="search" class="form-control form-control-flush search" name="query" placeholder="Arama Yap" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-success">Ara</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-nowrap card-table">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 40px;">#ID</th>
                                    <th>Başlık</th>
                                    <th class="text-center">Durum</th>                                    
                                    <th class="text-right">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <?php
                                if ($payments):
                                    foreach ($payments as $readPayments):

                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="odeme/duzenle/<?=$readPayments['id']?>">#<?=$readPayments['id']?></a>
                                            </td>
                                            <td>
                                                <a href="odeme/duzenle/<?=$readPayments['id']?>"><?=$readPayments['heading']?></a>
                                            </td>
                                            <td class="text-center">
                                            <?php if ($readPayments['paymentStatus']==1): ?>
                                            	<span class="badge badge-success">Aktif</span>
                                            <?php else: ?>
                                            	<span class="badge badge-danger">Pasif</span>
                                            <?php endif; ?>
                                            </td>
                                            <td class="text-right">
                                                <a
                                                    class="btn btn-sm btn-rounded-circle btn-success text-white"
                                                    href="odeme/duzenle/<?=$readPayments['id']?>"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Düzenle"
                                                >
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else:
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="4">Kayıt Bulunamadı</td>
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

    <?php elseif ($action[1]=="duzenle"): ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    
                    <h4 class="mb-0 font-size-18">Ödeme Yöntemi Düzenle</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Finansal Ayarlar</a></li>
                            <li class="breadcrumb-item active">Ödeme Yöntemi Düzenle</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
        	<?php if (isset($response)): ?>
                <div class="col-12">
                    <?=$response?>
                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="post">

                            <div class="form-group row">
                                <label for="heading" class="col-sm-2 col-form-label">Başlık:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="heading" value="<?=$paymentInfo['heading']?>" class="form-control" name="heading" placeholder="Ödeme başlığı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="paymentStatus" class="col-sm-2 col-form-label">Durum:</label>
                                <div class="col-sm-10">
                                	<select name="paymentStatus" id="paymentStatus" class="form-control">
                                		<option <?=($paymentInfo['paymentStatus']==0)?"selected":""?> value="0">Pasif</option>
                                		<option <?=($paymentInfo['paymentStatus']==1)?"selected":""?> value="1">Aktif</option>
                                	</select>
                                </div>
                            </div>

                            <?php if ($paymentInfo['id']==1): ?>

                            <div class="form-group row">
                                <label for="url" class="col-sm-2 col-form-label">Banka Hesapları:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
										<table id="bankAccTable" class="table table-nowrap card-table mb-0">
										    <thead>
										        <tr>
										            <th style="vertical-align: middle;">Ad Soyad</th>
										            <th>Banka Adı</th>
										            <th>IBAN</th>
										            <th class="text-right">
										                <a class="btn btn-sm btn-rounded-circle btn-success w-100" onclick="copyCommands('0', '#bank-accounts')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
										                    <i class="bx bx-plus"></i>
										                </a>
										            </th>
										        </tr>
										    </thead>
										    <tbody id="bank-accounts" class="list">
										    <?php 

										    	$paymentDataList = json_decode(base64_decode($paymentInfo['paymentData']), true);
										    
                                                if (!empty($paymentDataList)):

										    	foreach ($paymentDataList as $key => $readPaymentDataList):
											
										    ?>
										        <tr>
										            <td class="text-center">
										                <input type="text" class="form-control" name="realname[]" value="<?=$readPaymentDataList['realname']?>" placeholder="Hesap sahibinin adını soyadını giriniz.">
										            </td>
										            <td class="text-center">
										                <input type="text" class="form-control" name="bankname[]" value="<?=$readPaymentDataList['bankname']?>" placeholder="Bankanızın adınızı giriniz.">
										            </td>
										            <td class="text-center">
										                <input type="text" class="form-control" name="iban[]" value="<?=$readPaymentDataList['iban']?>" placeholder="IBAN giriniz.">
										            </td>
										            <td>
										                <a onclick="copyCommands('2', this, '#bankAccTable')" class="btn btn-sm btn-rounded-circle btn-danger">
										                    <i class="bx bx-trash-alt"></i>
										                </a>
										            </td>
										        </tr>

										    <?php endforeach;  ?>
                                            <?php else: ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control" name="realname[]" placeholder="Hesap sahibinin adını soyadını giriniz.">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control" name="bankname[]" placeholder="Bankanızın adınızı giriniz.">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control" name="iban[]" placeholder="IBAN giriniz.">
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#bankAccTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            <?php endif; ?>

										    </tbody>
										</table>
									</div>
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==2): ?>

                            <div class="form-group row">
                                <label for="url" class="col-sm-2 col-form-label">Barkod Numaraları:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table id="ininalTable" class="table table-nowrap card-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;">Barkod NO</th>
                                                    <th class="text-right">
                                                        <a class="btn btn-sm btn-rounded-circle btn-success" onclick="copyCommands('1', '#ininalNo')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
                                                            <i class="bx bx-plus"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="ininalNo" class="list">
                                            <?php 

                                                $paymentDataList = json_decode(base64_decode($paymentInfo['paymentData']));
                                            
                                                if (!empty($paymentDataList)):

                                                foreach ($paymentDataList as $key => $readPaymentDataList):
                                            
                                            ?>
                                                <tr>
                                                    <td class="text-center w-100">
                                                        <input type="text" class="form-control" name="paymentData[]" value="<?=$readPaymentDataList?>" placeholder="İninal barkod numaranızı giriniz.">
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#ininalTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php endforeach;  ?>

                                            <?php else: ?>

                                                <tr>
                                                    <td class="text-center w-100">
                                                        <input type="text" class="form-control" name="paymentData[]" placeholder="İninal barkod numaranızı giriniz.">
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#ininalTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==3): ?>

                            <div class="form-group row">
                                <label for="url" class="col-sm-2 col-form-label">Papara Numaraları:</label>
                                <div class="col-sm-10">
                                    <div class="table-responsive">
                                        <table id="paparaTable" class="table table-nowrap card-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: middle;">Papara NO</th>
                                                    <th class="text-right">
                                                        <a class="btn btn-sm btn-rounded-circle btn-success" onclick="copyCommands('3', '#paparaNo')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ekle">
                                                            <i class="bx bx-plus"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="paparaNo" class="list">
                                            <?php 

                                                $paymentDataList = json_decode(base64_decode($paymentInfo['paymentData']));
                                            
                                                if (!empty($paymentDataList)):

                                                foreach ($paymentDataList as $key => $readPaymentDataList):
                                            
                                            ?>
                                                <tr>
                                                    <td class="text-center w-100">
                                                        <input type="text" class="form-control" name="paymentData[]" value="<?=$readPaymentDataList?>" placeholder="Papara numaranızı giriniz.">
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#paparaTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php endforeach;  ?>

                                            <?php else: ?>

                                                <tr>
                                                    <td class="text-center w-100">
                                                        <input type="text" class="form-control" name="paymentData[]" placeholder="Papara numaranızı giriniz.">
                                                    </td>
                                                    <td>
                                                        <a onclick="copyCommands('2', this, '#paparaTable')" class="btn btn-sm btn-rounded-circle btn-danger">
                                                            <i class="bx bx-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                            <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==4 OR $paymentInfo['id']==5): ?>

                            <div class="form-group row">
                                <label for="paymentData" class="col-sm-2 col-form-label">Shipy API Key:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="paymentData" value="<?=$paymentInfo['paymentData']?>" class="form-control" name="paymentData" placeholder="Shipy'den aldığınız API Key'i giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="callbackURL" class="col-sm-2 col-form-label">Callback URL:</label>
                                <div class="col-sm-10">
                                    <input type="text" disabled="" value="<?=$baseURL?>callbacks/shipy.php" class="form-control border-0">
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==6): ?>

                            <?php

                            $paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);

                            ?>

                            <div class="form-group row">
                                <label for="merchantID" class="col-sm-2 col-form-label">PayTR Mağaza No:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="merchantID" value="<?=$paymentData['merchantID']?>" class="form-control" name="merchantID" placeholder="PayTR'den aldığınız Mağaza NO'yu giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="merchantKey" class="col-sm-2 col-form-label">PayTR Mağaza Parola:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="merchantKey" value="<?=$paymentData['merchantKey']?>" class="form-control" name="merchantKey" placeholder="PayTR'den aldığınız Mağaza Parola'yı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="merchantSalt" class="col-sm-2 col-form-label">PayTR Gizli Parola:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="merchantSalt" value="<?=$paymentData['merchantSalt']?>" class="form-control" name="merchantSalt" placeholder="PayTR'den aldığınız Mağaza Gizli Anahtar'ı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="callbackURL" class="col-sm-2 col-form-label">Callback URL:</label>
                                <div class="col-sm-10">
                                    <input type="text" disabled="" value="<?=$baseURL?>callbacks/paytr.php" class="form-control border-0">
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==7 OR $paymentInfo['id']==8): ?>


                            <?php

                            $paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);

                            ?>

                            <div class="form-group row">
                                <label for="token" class="col-sm-2 col-form-label">Keyubu Token:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="token" value="<?=$paymentData['token']?>" class="form-control" name="token" placeholder="Keyubu'dan aldığınız Token'i giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="paymentID" class="col-sm-2 col-form-label">Keyubu Ödeme ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="paymentID" value="<?=$paymentData['paymentID']?>" class="form-control" name="paymentID" placeholder="Keyubu'dan aldığınız Ödeme ID'yi giriniz.">
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==9 OR $paymentInfo['id']==10): ?>


                            <?php

                            $paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);

                            ?>

                            <div class="form-group row">
                                <label for="token" class="col-sm-2 col-form-label">RabPay Token:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="token" value="<?=$paymentData['token']?>" class="form-control" name="token" placeholder="Rabisu'dan aldığınız Token'i giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="paymentID" class="col-sm-2 col-form-label">RabPay ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="paymentID" value="<?=$paymentData['paymentID']?>" class="form-control" name="paymentID" placeholder="Rabisu'dan aldığınız Ödeme ID'yi giriniz.">
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==11 OR $paymentInfo['id']==12): ?>


                            <?php

                            $paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);

                            ?>

                            <div class="form-group row">
                                <label for="token" class="col-sm-2 col-form-label">Batihost Token:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="token" value="<?=$paymentData['token']?>" class="form-control" name="token" placeholder="Batı Host'tan aldığınız Token'i giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="paymentID" class="col-sm-2 col-form-label">Batihost ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="paymentID" value="<?=$paymentData['paymentID']?>" class="form-control" name="paymentID" placeholder="Batı Host'tan aldığınız ID'yi giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="paymentID" class="col-sm-2 col-form-label">Batihost E-Mail:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="paymentMail" value="<?=$paymentData['paymentMail']?>" class="form-control" name="paymentMail" placeholder="Batı Host Mail adresinizi giriniz.">
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==13): ?>


                            <?php

                            $paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);

                            ?>

                            <div class="form-group row">
                                <label for="apiKey" class="col-sm-2 col-form-label">API Anahtarı:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="apiKey" value="<?=$paymentData['apiKey']?>" class="form-control" name="apiKey" placeholder="Paywant'tan aldığınız API Anahtarını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apiSecretKey" class="col-sm-2 col-form-label">API Gizli Anahtarı:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="apiSecretKey" value="<?=$paymentData['apiSecretKey']?>" class="form-control" name="apiSecretKey" placeholder="Paywant'tan aldığınız API Gizli Anahtarını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="commissionType" class="col-sm-2 col-form-label">Komisyon:</label>
                                <div class="col-sm-10">
                                    <select class="form-control custom-select" id="commissionType" name="commissionType">
                                        <option <?=($paymentData['commissionType']==1)?"selected":""?> value="1">Üstlen</option>
                                        <option <?=($paymentData['commissionType']==2)?"selected":""?> value="2">Yansıt</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="callbackURL" class="col-sm-2 col-form-label">Callback URL:</label>
                                <div class="col-sm-10">
                                    <input type="text" disabled="" value="<?=$baseURL?>callbacks/paywant.php" class="form-control border-0">
                                </div>
                            </div>

                            <?php elseif ($paymentInfo['id']==14): ?>


                            <?php

                            $paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);

                            ?>

                            <div class="form-group row">
                                <label for="apiKey" class="col-sm-2 col-form-label">API Kullanıcı Adı:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="apiKey" value="<?=$paymentData['apiKey']?>" class="form-control" name="apiKey" placeholder="Shopier'den aldığınız kullanıcı adını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apiSecretKey" class="col-sm-2 col-form-label">API Key:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="apiSecretKey" value="<?=$paymentData['apiSecretKey']?>" class="form-control" name="apiSecretKey" placeholder="Shopier'den aldığınız anahtarı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="callbackURL" class="col-sm-2 col-form-label">Callback URL:</label>
                                <div class="col-sm-10">
                                    <input type="text" disabled="" value="<?=$baseURL?>callbacks/shopier.php" class="form-control border-0">
                                </div>
                            </div>

                            <?php endif; ?>

                            <div class="float-right">
                                <button type="submit" class="btn btn-success">Güncelle</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php endif; ?>

<?php require 'static/footer.php' ?>