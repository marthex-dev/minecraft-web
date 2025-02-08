<?php require 'static/header.php' ?>

<?php if ($action[1]=="genel"): ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Genel Ayarlar</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                        <li class="breadcrumb-item active">Genel Ayarlar</li>
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
                            <label for="serverName" class="col-sm-2 col-form-label">Sunucu Adı:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input type="text" class="form-control" name="serverName" id="serverName" value="<?=$settings['serverName']?>" placeholder="Sunucu adınızı giriniz.">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="siteHeading" class="col-sm-2 col-form-label">Site Başlığı:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="siteHeading" id="siteHeading" value="<?=$settings['siteHeading']?>" placeholder="Site başlığını giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serverIP" class="col-sm-2 col-form-label">Sunucu IP:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="serverIP" id="serverIP" value="<?=$settings['serverIP']?>" placeholder="Sunucu IP adresini giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serverPort" class="col-sm-2 col-form-label">Sunucu Port:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="serverPort" id="serverPort" value="<?=$settings['serverPort']?>" placeholder="Sunucu Portunu giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serverVersion" class="col-sm-2 col-form-label">Sunucu Sürümü:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="serverVersion" id="serverVersion" value="<?=$settings['serverVersion']?>" placeholder="Sunucu sürümünü giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="googleTags" class="col-sm-2 col-form-label">Google Etiket:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="googleTags" id="googleTags" value="<?=$settings['googleTags']?>" placeholder="Google etiketlerini giriniz." data-toggle="tagsinput" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="googleDescription" class="col-sm-2 col-form-label">Google Açıklama:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <textarea name="googleDescription" id="googleDescription" maxlength="155" placeholder="Google aramasında çıkması istediğiniz açıklamayı giriniz." rows="5" class="form-control"><?=$settings['googleDescription']?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="facebookURL" class="col-sm-2 col-form-label">Facebook URL:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="facebookURL" id="facebookURL" value="<?=$settings['facebookURL']?>" placeholder="Facebook sayfanızın URL adresini giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="twitterURL" class="col-sm-2 col-form-label">Twitter URL:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="twitterURL" id="twitterURL" value="<?=$settings['twitterURL']?>" placeholder="Twitter sayfanızın URL adresini giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="instagramURL" class="col-sm-2 col-form-label">Instagram URL:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="instagramURL" id="instagramURL" value="<?=$settings['instagramURL']?>" placeholder="Instagram sayfanızın URL adresini giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="youtubeURL" class="col-sm-2 col-form-label">Youtube URL:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="youtubeURL" id="youtubeURL" value="<?=$settings['youtubeURL']?>" placeholder="Youtube kanalınızın URL adresini giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="discordURL" class="col-sm-2 col-form-label">Discord URL:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="discordURL" id="discordURL" value="<?=$settings['discordURL']?>" placeholder="Discord kanalınızın URL adresini giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eMail" class="col-sm-2 col-form-label">E-Posta:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="eMail" id="eMail" value="<?=$settings['eMail']?>" placeholder="İletişim alanı için E-Posta adresini giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Telefon Numarası:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="phone" id="phone" value="<?=$settings['phone']?>" placeholder="İletişim alanı için telefon numaranızı giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="whatsapp" class="col-sm-2 col-form-label">WhatsApp:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input name="whatsapp" id="whatsapp" value="<?=$settings['whatsapp']?>" placeholder="İletişim alanı için Whatsapp numaranızı giriniz." type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="aboutUs" class="col-sm-2 col-form-label">Hakkımızda:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <textarea name="aboutUs" id="aboutUs" placeholder="Footerdaki hakkımızda alanı için yazı giriniz." rows="5" class="form-control"><?=$settings['aboutUs']?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rules" class="col-sm-2 col-form-label">Kurallar:</label>
                            <div class="col-sm-10">
                                <textarea name="rules" id="rules" data-toggle="quill" class="form-control"><?=$settings['rules']?></textarea>
                                <small class="form-text text-muted pt-2"><strong>Sunucu Adı:</strong> %servername%</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="supportMessageTemplate" class="col-sm-2 col-form-label">Destek Mesajı Şablonu:</label>
                            <div class="col-sm-10">
                                <textarea name="supportMessageTemplate" id="supportMessageTemplate" data-toggle="quill" class="form-control"><?=$settings['supportMessageTemplate']?></textarea>
                                <small class="form-text text-muted pt-2"><strong>NOT:</strong> %message% olmak zorundadır!</small>
                                <small class="form-text text-muted"><strong>Mesaj:</strong> %message%</small>
                                <small class="form-text text-muted"><strong>Kullanıcı Adı:</strong> %username%</small>
                                <small class="form-text text-muted"><strong>Sunucu Adı:</strong> %servername%</small>
                                <small class="form-text text-muted"><strong>Sunucu IP:</strong> %serverip%</small>
                                <small class="form-text text-muted"><strong>Sunucu Sürümü:</strong> %serverversion%</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sunucu Logo (Header):</label>
                            <div class="col-sm-10">
                                <div id="imageInput1" class="imageInput active">
                                    <div class="img-thumbnail">
                                        <img id="imagePreview1" src="<?=$find_read_panel.$settings['serverLogo']?>" alt="Ön İzleme">
                                    </div>
                                    <div class="img-select">
                                        <label for="serverLogo">Bir Resim Seçiniz</label>
                                        <input onchange="readImageTheme(this, '#imagePreview1', '#imageInput1');" type="file" data-toggle="imageInputTheme" id="serverLogo" name="serverLogo" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sunucu Logo (Favicon):</label>
                            <div class="col-sm-10">
                                <div id="imageInput2" class="imageInput active">
                                    <div class="img-thumbnail">
                                        <img id="imagePreview2" src="<?=$find_read_panel.$settings['serverFavicon']?>" alt="Ön İzleme">
                                    </div>
                                    <div class="img-select">
                                        <label for="serverFavicon">Bir Resim Seçiniz</label>
                                        <input onchange="readImageTheme(this, '#imagePreview2', '#imageInput2');" type="file" data-toggle="imageInputTheme" id="serverFavicon" name="serverFavicon" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-success">Güncelle</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif ($action[1]=="sistem"): ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Sistem Ayarları</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                        <li class="breadcrumb-item active">Sistem Ayarları</li>
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
                    <form action="" method="post">

                        <div class="form-group row">
                            <label for="avatarApi" class="col-sm-2 col-form-label">Avatar API:*</label>
                            <div class="col-sm-10">
                                <select name="avatarApi" id="avatarApi" class="form-control custom-select">
                                    <option <?=($settings['avatarApi']==0)?"selected":""?> value="0">minotar.net (Önerilen)</option>
                                    <option <?=($settings['avatarApi']==1)?"selected":""?> value="1">cravatar.eu</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="onlineApi" class="col-sm-2 col-form-label">Online API:*</label>
                            <div class="col-sm-10">
                                <select name="onlineApi" id="onlineApi" class="form-control custom-select">
                                    <option <?=($settings['onlineApi']==0)?"selected":""?> value="0">mcapi.us (Önerilen)</option>
                                    <option <?=($settings['onlineApi']==1)?"selected":""?> value="1">mc-api.net</option>
                                    <option <?=($settings['onlineApi']==2)?"selected":""?> value="2">mcapi.tc</option>
                                    <option <?=($settings['onlineApi']==3)?"selected":""?> value="3">keyubu.net</option>
                                    <option <?=($settings['onlineApi']==4)?"selected":""?> value="4">mcsrvstat.us</option>
                                    <option <?=($settings['onlineApi']==5)?"selected":""?> value="5">mcsrvstat.us (Pocket Edition)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="onlineJS" class="col-sm-2 col-form-label">Online Sayısı:*</label>
                            <div class="col-sm-10">
                                <select name="onlineJS" id="onlineJS" class="form-control custom-select">
                                    <option <?=($settings['onlineJS']==0)?"selected":""?> value="0">Cron ile çekilsin</option>
                                    <option <?=($settings['onlineJS']==1)?"selected":""?> value="1">Javascript ile çekilsin</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="encryptionMethod" class="col-sm-2 col-form-label">Şifreleme Yöntemi:*</label>
                            <div class="col-sm-10">
                                <select name="encryptionMethod" id="encryptionMethod" class="form-control custom-select">
                                    <option <?=($settings['encryptionMethod']==0)?"selected":""?> value="0">SHA256</option>
                                    <option <?=($settings['encryptionMethod']==1)?"selected":""?> value="1">MD5</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sslStatus" class="col-sm-2 col-form-label">HTTPS Yönlendirme (SSL):*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="sslStatus" id="sslStatus" class="form-control custom-select">
                                    <option <?=($settings['sslStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['sslStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="maintenanceMode" class="col-sm-2 col-form-label">Bakım Modu:*</label>
                            <div class="col-sm-10">
                                <select name="maintenanceMode" id="maintenanceMode" class="form-control custom-select">
                                    <option <?=($settings['maintenanceMode']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['maintenanceMode']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="maintenanceDiv">

                            <?php

                                $maintenanceData = json_decode(base64_decode($settings['maintenanceData']), true);

                            ?>

                            <div class="form-group row">
                                <label for="maintenanceHeading" class="col-sm-2 col-form-label">Bakım Başlık:*</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="text" class="form-control" name="maintenanceHeading" id="maintenanceHeading" value="<?=$maintenanceData['maintenanceHeading']?>" placeholder="Bakım başlığını giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="maintenanceContent" class="col-sm-2 col-form-label">Bakım Alt Başlık:*</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="text" class="form-control" name="maintenanceContent" id="maintenanceContent" value="<?=$maintenanceData['maintenanceContent']?>" placeholder="Bakım içeriği giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="maintenanceDuration" class="col-sm-2 col-form-label">Bakım Süresi:</label>
                                <div class="col-sm-10">
                                    <select id="maintenanceDuration" name="maintenanceDuration" class="form-control custom-select">
                                        <option <?=($maintenanceData['maintenanceDuration']==0)?"selected":""?> value="0">Süresiz</option>
                                        <option <?=($maintenanceData['maintenanceDuration']==1)?"selected":""?> value="1">Süreli</option>
                                    </select>
                                </div>
                            </div>

                            <div id="maintenanceDurationDiv">

                                <div class="form-group row">
                                    <label for="maintenanceExpiry" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="date" value="<?=$maintenanceData['maintenanceExpiry']?>" id="maintenanceExpiry" class="form-control" name="maintenanceExpiry" placeholder="Bakımın bitiş gününü seçiniz.">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="maintenanceExpiryTime" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?=$maintenanceData['maintenanceExpiryTime']?>" id="maintenanceExpiryTime" class="form-control" data-provide="timepicker" name="maintenanceExpiryTime" placeholder="Bakımın bitiş saatini seçiniz.">
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="sendCreditStatus" class="col-sm-2 col-form-label">Oyuncular Arası Kredi Gönderme:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="sendCreditStatus" id="sendCreditStatus" class="form-control custom-select">
                                    <option <?=($settings['sendCreditStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['sendCreditStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sendGiftStatus" class="col-sm-2 col-form-label">Oyuncular Arası Hediye Gönderme:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="sendGiftStatus" id="sendGiftStatus" class="form-control custom-select">
                                    <option <?=($settings['sendGiftStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['sendGiftStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mostProductsStatus" class="col-sm-2 col-form-label">En Çok Satılan Ürünler:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="mostProductsStatus" id="mostProductsStatus" class="form-control custom-select">
                                    <option <?=($settings['mostProductsStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['mostProductsStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="preloader" class="col-sm-2 col-form-label">Preloader:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="preloader" id="preloadera" class="form-control custom-select">
                                    <option <?=($settings['preloader']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['preloader']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>
                        <!--
                        <div class="form-group row">
                            <label for="2faStatus" class="col-sm-2 col-form-label">2FA:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="2faStatus" id="2faStatus" class="form-control custom-select">
                                    <option <?=($settings['2faStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['2faStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>
                        -->
                        <div class="form-group row">
                            <label for="commentsStatus" class="col-sm-2 col-form-label">Yorumlar:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="commentsStatus" id="commentsStatus" class="form-control custom-select">
                                    <option <?=($settings['commentsStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['commentsStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>
                        <!--
                        <div class="form-group row">
                            <label for="oneSignalStatus" class="col-sm-2 col-form-label">One Signal (Bildirimler):*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="oneSignalStatus" id="oneSignalStatus" class="form-control custom-select">
                                    <option <?=($settings['oneSignalStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['oneSignalStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>
                        
                        <div id="oneSignalDiv">

                            <div class="form-group row">
                                <label for="oneSignalAppID" class="col-sm-2 col-form-label">One Signal (Bildirimler):*</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="text" class="form-control" name="oneSignalAppID" id="oneSignalAppID" value="<?=$settings['oneSignalAppID']?>" placeholder="One Signal'den aldığınız App ID'yi giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="oneSignalRestApiKey" class="col-sm-2 col-form-label">One Signal Rest API Key:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="text" class="form-control" name="oneSignalRestApiKey" id="oneSignalRestApiKey" value="<?=$settings['oneSignalRestApiKey']?>" placeholder="One Signal'den aldığınız Rest API Key'i giriniz.">
                                </div>
                            </div>

                        </div>
                        -->
                        <div class="form-group row">
                            <label for="liveChat" class="col-sm-2 col-form-label">Canlı Sohbet:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="liveChat" id="liveChat" class="form-control custom-select">
                                    <option <?=($settings['liveChat']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['liveChat']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="liveChatDiv">

                            <div class="form-group row">
                                <label for="liveChatJS" class="col-sm-2 col-form-label">Canlı Sohbet JS Kodu:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <textarea id="liveChatJS" name="liveChatJS" data-toggle="code-mirror" class="form-control"><?=$settings['liveChatJS']?></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="bonusCreditStatus" class="col-sm-2 col-form-label">Bonus Kredi:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="bonusCreditStatus" id="bonusCreditStatus" class="form-control custom-select">
                                    <option <?=($settings['bonusCreditStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['bonusCreditStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="bonusCreditDiv">

                            <div class="form-group row">
                                <label for="bonusCredit" class="col-sm-2 col-form-label">Bonus Kredi Yüzdesi (%):</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="number" class="form-control" value="<?=$settings['bonusCredit']?>" name="bonusCredit" id="bonusCredit" placeholder="Kullanıcıya ekstra olarak yüzde (%) kaç kredi verileceğini yazınız.">
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="analyticsStatus" class="col-sm-2 col-form-label">Google Analytics:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="analyticsStatus" id="analyticsStatus" class="form-control custom-select">
                                    <option <?=($settings['analyticsStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['analyticsStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="analyticsDiv">

                            <div class="form-group row">
                                <label for="analyticsID" class="col-sm-2 col-form-label">Google Analytics Kimlik:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="text" class="form-control" value="<?=$settings['analyticsID']?>" name="analyticsID" id="analyticsID" placeholder="Google Analytics sitesinden aldığınız mülk kimliğini giriniz. (Örn: UA-000001)">
                                </div>
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="recaptchaStatus" class="col-sm-2 col-form-label">Google reCAPTCHA:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="recaptchaStatus" id="recaptchaStatus" class="form-control custom-select">
                                    <option <?=($settings['recaptchaStatus']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['recaptchaStatus']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="recaptchaDiv">

                            <?php 

                            $recaptchaData = json_decode(base64_decode($settings['recaptchaActive']), true);

                            ?>

                            <div class="form-group row">
                                <label for="recaptchaSiteKey" class="col-sm-2 col-form-label">reCAPTCHA Site Anahtarı:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="text" class="form-control" value="<?=$settings['recaptchaSiteKey']?>" name="recaptchaSiteKey" id="recaptchaSiteKey" placeholder="Google reCAPTCHA sitesinden aldığınız Site Anahtarı'nı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="recaptchaSecretKey" class="col-sm-2 col-form-label">reCAPTCHA Gizli Anahtarı:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="text" class="form-control" value="<?=$settings['recaptchaSecretKey']?>" name="recaptchaSecretKey" id="recaptchaSecretKey" placeholder="Google reCAPTCHA sitesinden aldığınız Gizli Anahtarı'nı giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="recaptchaSiteKey" class="col-sm-2 col-form-label">reCAPTCHA Aktif Formlar:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="checkbox" id="loginRecaptcha" name="loginRecaptcha" class="custom-control-input" <?=($recaptchaData['loginRecaptcha']=="on")?"checked":""?>>
                                        <label class="custom-control-label" for="loginRecaptcha">Giriş</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="checkbox" id="registerRecaptcha" name="registerRecaptcha" class="custom-control-input" <?=($recaptchaData['registerRecaptcha']=="on")?"checked":""?>>
                                        <label class="custom-control-label" for="registerRecaptcha">Kayıt</label>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="checkbox" id="recoveryRecaptcha" name="recoveryRecaptcha" class="custom-control-input" <?=($recaptchaData['recoveryRecaptcha']=="on")?"checked":""?>>
                                        <label class="custom-control-label" for="recoveryRecaptcha">Şifremi Unuttum</label>
                                    </div>
                                
                                </div>
                            </div>

                        </div>
                        
                        <div class="form-group row">
                            <label for="minimumPayCredit" class="col-sm-2 col-form-label">Minimum Ödeme Tutarı:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input type="number" class="form-control" value="<?=$settings['minimumPayCredit']?>" name="minimumPayCredit" id="minimumPayCredit" placeholder="Kredi yükleme ekranında kabul edilen minimum ödeme tutarını yazınız.">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="maximumPayCredit" class="col-sm-2 col-form-label">Maksimum Ödeme Tutarı:</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input type="number" class="form-control" value="<?=$settings['maximumPayCredit']?>" name="maximumPayCredit" id="maximumPayCredit" placeholder="Kredi yükleme ekranında kabul edilen maksimum ödeme tutarını yazınız.">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newsLimit" class="col-sm-2 col-form-label">Haber Yazısı Limit (Her Sayfa):*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="newsLimit" id="newsLimit" class="form-control custom-select">
                                    <option <?=($settings['newsLimit']==3)?"selected":""?> value="3">3</option>
                                    <option <?=($settings['newsLimit']==6)?"selected":""?> value="6">6</option>
                                    <option <?=($settings['newsLimit']==9)?"selected":""?> value="9">9</option>
                                    <option <?=($settings['newsLimit']==12)?"selected":""?> value="12">12</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="registerLimit" class="col-sm-2 col-form-label">Kayıt Limit:*</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <select name="registerLimit" id="registerLimit" class="form-control custom-select">
                                    <option <?=($settings['registerLimit']==1)?"selected":""?> value="1">1</option>
                                    <option <?=($settings['registerLimit']==2)?"selected":""?> value="2">2</option>
                                    <option <?=($settings['registerLimit']==3)?"selected":""?> value="3">3</option>
                                    <option <?=($settings['registerLimit']==999)?"selected":""?> value="999">Sınırsız</option>
                                </select>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-success">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif($action[1]=="smtp"): ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">SMTP Ayarları</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                        <li class="breadcrumb-item active">SMTP Ayarları</li>
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
                            <label for="smtpType" class="col-sm-2 col-form-label">SMTP API:*</label>
                            <div class="col-sm-10">
                                <select name="smtpType" id="smtpType" class="form-control custom-select">
                                    <option <?=($settings['smtpType']==0)?"selected":""?> value="0">Rabiweb SMTP (Önerilen)</option>
                                    <option <?=($settings['smtpType']==1)?"selected":""?> value="1">Kendi SMTP Sunucum</option>
                                </select>
                            </div>
                        </div>

                        <div id="smtpTypeDiv">
                        
                            <div class="form-group row">
                                <label for="smtpServer" class="col-sm-2 col-form-label">SMTP Sunucu:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input type="text" class="form-control" name="smtpServer" id="smtpServer" value="<?=$settings['smtpServer']?>" placeholder="SMTP Sunucu adresini giriniz.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtpPort" class="col-sm-2 col-form-label">SMTP Port:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input name="smtpPort" id="smtpPort" value="<?=$settings['smtpPort']?>" placeholder="SMTP Portunu giriniz." type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtpSecurity" class="col-sm-2 col-form-label">SMTP Güvenlik:</label>
                                <div class="col-sm-10">
                                    <select name="smtpSecurity" id="smtpSecurity" class="form-control custom-select">
                                        <option <?=($settings['smtpSecurity']==0)?"selected":""?> value="0">TLS</option>
                                        <option <?=($settings['smtpSecurity']==1)?"selected":""?> value="1">SSL</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtpMail" class="col-sm-2 col-form-label">SMTP E-Posta Adresi:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input name="smtpMail" id="smtpMail" value="<?=$settings['smtpMail']?>" placeholder="SMTP E-Posta adresini giriniz." type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="smtpPassword" class="col-sm-2 col-form-label">SMTP E-Posta Şifresi:</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input name="smtpPassword" id="smtpPassword" value="<?=$settings['smtpPassword']?>" placeholder="SMTP E-Posta şifresini giriniz." type="password" class="form-control">
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="smtpTemplate" class="col-sm-2 col-form-label">Destek Mesajı Şablonu:</label>
                            <div class="col-sm-10">
                                <textarea name="smtpTemplate" id="smtpTemplate" data-toggle="quill" class="form-control"><?=$settings['smtpTemplate']?></textarea>
                                <small class="form-text text-muted pt-2"><strong>NOT:</strong> %url% olmak zorundadır!</small>
                                <small class="form-text text-muted"><strong>Kullanıcı Adı:</strong> %username%</small>
                                <small class="form-text text-muted"><strong>URL:</strong> %url%</small>
                            </div>
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-success">Güncelle</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php elseif($action[1]=="webhook"): ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Discord Webhook</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ayarlar</a></li>
                        <li class="breadcrumb-item active">Discord Webhook</li>
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
                            <label for="storeWebhook" class="col-sm-2 col-form-label">Mağaza:</label>
                            <div class="col-sm-10">
                                <select name="storeWebhook" id="storeWebhook" class="form-control custom-select">
                                    <option <?=($settings['storeWebhook']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['storeWebhook']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="storeWebhookContent">

                            <?php 

                                $storeWebhook = json_decode(base64_decode($settings['storeWebhookData']), true);

                            ?>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="storeURL">Webhook URL:</label>
                                    <input type="text" value="<?=(!empty($storeWebhook['webhook']))?$storeWebhook['webhook']:""?>" placeholder="Webhook URL giriniz." class="form-control" name="storeURL" id="storeURL" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="storeHeading">Başlık:</label>
                                            <input type="text" value="<?=(!empty($storeWebhook['title']))?$storeWebhook['title']:""?>" class="form-control" name="storeHeading" id="storeHeading" placeholder="Mesaj başlığı giriniz." />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="storeColor">Renk:</label>
                                            <div data-toggle="color-picker" class="input-group">
                                                <input type="text" value="<?=(!empty($storeWebhook['color']))?$storeWebhook['color']:""?>" id="storeColor" class="form-control input-lg" name="storeColor" placeholder="Renk seçiniz.">
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="storeImage">Resim:</label>
                                    <input type="text" value="<?=(!empty($storeWebhook['image']))?$storeWebhook['image']:""?>" placeholder="Bir resim URL'si giriniz. (Boş bırakabilirsiniz)" class="form-control" name="storeImage" id="storeImage" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="storeMessage">Mesaj:</label>
                                    <textarea rows="3" class="form-control" name="storeMessage" id="storeMessage" placeholder="Mesaj içeriğini giriniz."><?=(!empty($storeWebhook['content']))?$storeWebhook['content']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Sunucu Adı:</strong> %server%</small>
                                    <small class="form-text text-muted"><strong>Ürün Adı:</strong> %product%</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="storeEmbed">Embed:</label>
                                    <textarea rows="3" class="form-control" name="storeEmbed" id="storeEmbed" placeholder="Embed içeriğini giriniz."><?=(!empty($storeWebhook['description']))?$storeWebhook['description']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Sunucu Adı:</strong> %server%</small>
                                    <small class="form-text text-muted"><strong>Ürün Adı:</strong> %product%</small>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-sm-4 ml-auto">
                                     <a href="javascript:;">
                                        Test Mesajı Gönder (Bakımda)
                                    </a>
                                </div>

                                <div class="col-sm-6 text-right">

                                    <div class="custom-control custom-checkbox custom-control-right">
                                        <input type="checkbox" name="storeFooter" class="custom-control-input" value="1" id="storeFooter" <?=(isset($storeWebhook['footer']) && $storeWebhook['footer'] == 1)?"checked":""?>>
                                        <label class="custom-control-label" for="storeFooter">Rabiweb Reklamı gözüksün</label>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="creditWebhook" class="col-sm-2 col-form-label">Kredi:</label>
                            <div class="col-sm-10">
                                <select name="creditWebhook" id="creditWebhook" class="form-control custom-select">
                                    <option <?=($settings['creditWebhook']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['creditWebhook']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="creditWebhookContent">

                            <?php 

                                $creditWebhook = json_decode(base64_decode($settings['creditWebhookData']), true);

                            ?>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="creditURL">Webhook URL:</label>
                                    <input type="text" value="<?=(!empty($creditWebhook['webhook']))?$creditWebhook['webhook']:""?>" placeholder="Webhook URL giriniz." class="form-control" name="creditURL" id="creditURL" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="creditHeading">Başlık:</label>
                                            <input type="text" value="<?=(!empty($creditWebhook['title']))?$creditWebhook['title']:""?>" class="form-control" name="creditHeading" id="creditHeading" placeholder="Mesaj başlığı giriniz." />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="creditColor">Renk:</label>
                                            <div data-toggle="color-picker" class="input-group">
                                                <input type="text" value="<?=(!empty($creditWebhook['color']))?$creditWebhook['color']:""?>" id="creditColor" class="form-control input-lg" name="creditColor" placeholder="Renk seçiniz.">
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="creditImage">Resim:</label>
                                    <input type="text" value="<?=(!empty($creditWebhook['image']))?$creditWebhook['image']:""?>" placeholder="Bir resim URL'si giriniz. (Boş bırakabilirsiniz)" class="form-control" name="creditImage" id="creditImage" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="creditMessage">Mesaj:</label>
                                    <textarea rows="3" class="form-control" name="creditMessage" id="creditMessage" placeholder="Mesaj içeriğini giriniz."><?=(!empty($creditWebhook['content']))?$creditWebhook['content']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Yüklenen Kredi (Bonus Kredi Dahil):</strong> %credit%</small>
                                    <small class="form-text text-muted"><strong>Kazanılan Para (Bonus Kredi Dahil Değil):</strong> %money%</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="creditEmbed">Embed:</label>
                                    <textarea rows="3" class="form-control" name="creditEmbed" id="creditEmbed" placeholder="Embed içeriğini giriniz."><?=(!empty($creditWebhook['description']))?$creditWebhook['description']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Yüklenen Kredi (Bonus Kredi Dahil):</strong> %credit%</small>
                                    <small class="form-text text-muted"><strong>Kazanılan Para (Bonus Kredi Dahil Değil):</strong> %money%</small>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-sm-4 ml-auto">
                                     <a href="javascript:;">
                                        Test Mesajı Gönder (Bakımda)
                                    </a>
                                </div>

                                <div class="col-sm-6 text-right">

                                    <div class="custom-control custom-checkbox custom-control-right">
                                        <input type="checkbox" name="creditFooter" class="custom-control-input" value="1" id="creditFooter" <?=(isset($creditWebhook['footer']) && $creditWebhook['footer'] == 1)?"checked":""?>>
                                        <label class="custom-control-label" for="creditFooter">Rabiweb Reklamı gözüksün</label>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="caseWebhook" class="col-sm-2 col-form-label">Kasa Açımı:</label>
                            <div class="col-sm-10">
                                <select name="caseWebhook" id="caseWebhook" class="form-control custom-select">
                                    <option <?=($settings['caseWebhook']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['caseWebhook']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="caseWebhookContent">

                            <?php 

                                $caseWebhook = json_decode(base64_decode($settings['caseWebhookData']), true);

                            ?>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="caseURL">Webhook URL:</label>
                                    <input type="text" value="<?=(!empty($caseWebhook['webhook']))?$caseWebhook['webhook']:""?>" placeholder="Webhook URL giriniz." class="form-control" name="caseURL" id="caseURL" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="creditHeading">Başlık:</label>
                                            <input type="text" value="<?=(!empty($caseWebhook['title']))?$caseWebhook['title']:""?>" class="form-control" name="caseHeading" id="caseHeading" placeholder="Mesaj başlığı giriniz." />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="caseColor">Renk:</label>
                                            <div data-toggle="color-picker" class="input-group">
                                                <input type="text" value="<?=(!empty($caseWebhook['color']))?$caseWebhook['color']:""?>" id="caseColor" class="form-control input-lg" name="caseColor" placeholder="Renk seçiniz.">
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="caseImage">Resim:</label>
                                    <input type="text" value="<?=(!empty($caseWebhook['image']))?$caseWebhook['image']:""?>" placeholder="Bir resim URL'si giriniz. (Boş bırakabilirsiniz)" class="form-control" name="caseImage" id="caseImage" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="caseMessage">Mesaj:</label>
                                    <textarea rows="3" class="form-control" name="caseMessage" id="caseMessage" placeholder="Mesaj içeriğini giriniz."><?=(!empty($caseWebhook['content']))?$caseWebhook['content']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Kasa Adı:</strong> %case%</small>
                                    <small class="form-text text-muted"><strong>Ödül:</strong> %award%</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="caseEmbed">Embed:</label>
                                    <textarea rows="3" class="form-control" name="caseEmbed" id="caseEmbed" placeholder="Embed içeriğini giriniz."><?=(!empty($caseWebhook['description']))?$caseWebhook['description']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Kasa Adı:</strong> %case%</small>
                                    <small class="form-text text-muted"><strong>Ödül:</strong> %award%</small>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-sm-4 ml-auto">
                                     <a href="javascript:;">
                                        Test Mesajı Gönder (Bakımda)
                                    </a>
                                </div>

                                <div class="col-sm-6 text-right">

                                    <div class="custom-control custom-checkbox custom-control-right">
                                        <input type="checkbox" name="caseFooter" class="custom-control-input" value="1" id="caseFooter" <?=(isset($caseWebhook['footer']) && $caseWebhook['footer'] == 1)?"checked":""?>>
                                        <label class="custom-control-label" for="caseFooter">Rabiweb Reklamı gözüksün</label>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="supportWebhook" class="col-sm-2 col-form-label">Destek Mesajları:</label>
                            <div class="col-sm-10">
                                <select name="supportWebhook" id="supportWebhook" class="form-control custom-select">
                                    <option <?=($settings['supportWebhook']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['supportWebhook']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="supportWebhookContent">

                            <?php 

                                $supportWebhook = json_decode(base64_decode($settings['supportWebhookData']), true);

                            ?>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="supportURL">Webhook URL:</label>
                                    <input type="text" value="<?=(!empty($supportWebhook['webhook']))?$supportWebhook['webhook']:""?>" placeholder="Webhook URL giriniz." class="form-control" name="supportURL" id="supportURL" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="supportHeading">Başlık:</label>
                                            <input type="text" value="<?=(!empty($supportWebhook['title']))?$supportWebhook['title']:""?>" class="form-control" name="supportHeading" id="supportHeading" placeholder="Mesaj başlığı giriniz." />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="supportColor">Renk:</label>
                                            <div data-toggle="color-picker" class="input-group">
                                                <input type="text" value="<?=(!empty($supportWebhook['color']))?$supportWebhook['color']:""?>" id="supportColor" class="form-control input-lg" name="supportColor" placeholder="Renk seçiniz.">
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="supportImage">Resim:</label>
                                    <input type="text" value="<?=(!empty($supportWebhook['image']))?$supportWebhook['image']:""?>" placeholder="Bir resim URL'si giriniz. (Boş bırakabilirsiniz)" class="form-control" name="supportImage" id="supportImage" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="supportMessage">Mesaj:</label>
                                    <textarea rows="3" class="form-control" name="supportMessage" id="supportMessage" placeholder="Mesaj içeriğini giriniz."><?=(!empty($supportWebhook['content']))?$supportWebhook['content']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Yönetim Paneli URL:</strong> %panelurl%</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="supportEmbed">Embed:</label>
                                    <textarea rows="3" class="form-control" name="supportEmbed" id="supportEmbed" placeholder="Embed içeriğini giriniz."><?=(!empty($supportWebhook['description']))?$supportWebhook['description']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Yönetim Paneli URL:</strong> %panelurl%</small>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-sm-4 ml-auto">
                                     <a href="javascript:;">
                                        Test Mesajı Gönder (Bakımda)
                                    </a>
                                </div>

                                <div class="col-sm-6 text-right">

                                    <div class="custom-control custom-checkbox custom-control-right">
                                        <input type="checkbox" name="supportFooter" class="custom-control-input" value="1" id="supportFooter" <?=(isset($supportWebhook['footer']) && $supportWebhook['footer'] == 1)?"checked":""?>>
                                        <label class="custom-control-label" for="supportFooter">Rabiweb Reklamı gözüksün</label>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="commentsWebhook" class="col-sm-2 col-form-label">Yorumlar:</label>
                            <div class="col-sm-10">
                                <select name="commentsWebhook" id="commentsWebhook" class="form-control custom-select">
                                    <option <?=($settings['commentsWebhook']==0)?"selected":""?> value="0">Kapalı</option>
                                    <option <?=($settings['commentsWebhook']==1)?"selected":""?> value="1">Açık</option>
                                </select>
                            </div>
                        </div>

                        <div id="commentsWebhookContent">

                            <?php 

                                $commentsWebhook = json_decode(base64_decode($settings['commentsWebhookData']), true);

                            ?>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="commentsURL">Webhook URL:</label>
                                    <input type="text" value="<?=(!empty($commentsWebhook['webhook']))?$commentsWebhook['webhook']:""?>" placeholder="Webhook URL giriniz." class="form-control" name="commentsURL" id="commentsURL" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="commentsHeading">Başlık:</label>
                                            <input type="text" value="<?=(!empty($commentsWebhook['title']))?$commentsWebhook['title']:""?>" class="form-control" name="commentsHeading" id="commentsHeading" placeholder="Mesaj başlığı giriniz." />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="commentsColor">Renk:</label>
                                            <div data-toggle="color-picker" class="input-group">
                                                <input type="text" value="<?=(!empty($commentsWebhook['color']))?$commentsWebhook['color']:""?>" id="supportColor" class="form-control input-lg" name="commentsColor" placeholder="Renk seçiniz.">
                                                <span class="input-group-append">
                                                    <span class="input-group-text colorpicker-input-addon" data-original-title="" title="" tabindex="0"><i style=""></i></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="commentsImage">Resim:</label>
                                    <input type="text" value="<?=(!empty($commentsWebhook['image']))?$commentsWebhook['image']:""?>" placeholder="Bir resim URL'si giriniz. (Boş bırakabilirsiniz)" class="form-control" name="commentsImage" id="commentsImage" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="commentsMessage">Mesaj:</label>
                                    <textarea rows="3" class="form-control" name="commentsMessage" id="commentsMessage" placeholder="Mesaj içeriğini giriniz."><?=(!empty($commentsWebhook['content']))?$commentsWebhook['content']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Yönetim Paneli URL:</strong> %panelurl%</small>
                                    <small class="form-text text-muted"><strong>Haber URL:</strong> %newsurl%</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <label for="commentsEmbed">Embed:</label>
                                    <textarea rows="3" class="form-control" name="commentsEmbed" id="commentsEmbed" placeholder="Embed içeriğini giriniz."><?=(!empty($commentsWebhook['description']))?$commentsWebhook['description']:""?></textarea>
                                    <small class="form-text text-muted pt-2"><strong>Kullanıcı Adı:</strong> %username%</small>
                                    <small class="form-text text-muted"><strong>Yönetim Paneli URL:</strong> %panelurl%</small>
                                    <small class="form-text text-muted"><strong>Haber URL:</strong> %newsurl%</small>
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-sm-4 ml-auto">
                                     <a href="javascript:;">
                                        Test Mesajı Gönder (Bakımda)
                                    </a>
                                </div>

                                <div class="col-sm-6 text-right">

                                    <div class="custom-control custom-checkbox custom-control-right">
                                        <input type="checkbox" name="commentsFooter" class="custom-control-input" id="commentsFooter" <?=(isset($commentsWebhook['footer']) && $commentsWebhook['footer'] == 1)?"checked":""?> value="1">
                                        <label class="custom-control-label" for="commentsFooter">Rabiweb Reklamı gözüksün</label>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="float-right mt-3">
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