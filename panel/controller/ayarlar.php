<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Settings.class.php';
require realpath('.') . '/classes/ExtraResources.class.php';

if ($action[1]=="genel"):

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null})');

    if ($_POST):

    	require realpath('.') . '/classes/Upload.class.php';

        $data = array(
            'serverName' => post('serverName'),
            'siteHeading' => post('siteHeading'),
            'serverIP' => post('serverIP'),
            'serverPort' => post('serverPort'),
            'serverVersion' => post('serverVersion'),
            'googleTags' => post('googleTags'),
            'googleDescription' => post('googleDescription'),
            'facebookURL' => post('facebookURL'),
            'twitterURL' => post('twitterURL'),
            'instagramURL' => post('instagramURL'),
            'youtubeURL' => post('youtubeURL'),
            'discordURL' => post('discordURL'),
            'eMail' => post('eMail'),
            'phone' => post('phone'),
            'whatsapp' => post('whatsapp'),
            'aboutUs' => htmlspecialchars_decode(post('aboutUs')),
            'rules' => htmlspecialchars_decode(post('rules')),
            'supportMessageTemplate' => htmlspecialchars_decode(post('supportMessageTemplate'))
        );

        $serverLogo = "0";

        if ($_FILES["serverLogo"] != null):

            $upload = new Upload($_FILES["serverLogo"], "tr_TR");
            $image = md5(uniqid(rand(0, 9999)));
            if ($upload->uploaded):

                $upload->allowed = array("image/*");
                $upload->file_new_name_body = $image;
                $upload->Process($find_read_panel);

                if ($upload->processed):

                    $image = $image.".".$upload->file_dst_name_ext;

                    $data['serverLogo'] = $image;

                    $serverLogo = "1";

                else:

                    $response = alertDanger('Hata! '.$upload->error);

                endif;

            else:

                $response = alertDanger('Hata! '.$upload->error);

            endif;

        endif;

        if ($serverLogo = "0"):

            $settings = settings::getSettingsInfo();

            $data['serverLogo'] = $settings['serverLogo'];

        endif;

        $serverFavicon = "0";

        if ($_FILES["serverFavicon"] != null):

            $upload = new Upload($_FILES["serverFavicon"], "tr_TR");
            $image = md5(uniqid(rand(0, 9999)));
            if ($upload->uploaded):

                $upload->allowed = array("image/*");
                $upload->file_new_name_body = $image;
                $upload->Process($find_read_panel);

                if ($upload->processed):

                    $image = $image.".".$upload->file_dst_name_ext;

                    $data['serverFavicon'] = $image;

                    $serverFavicon = "1";

                else:

                    $response = alertDanger('Hata! '.$upload->error);

                endif;

            else:

                $response = alertDanger('Hata! '.$upload->error);

            endif;

        endif;

        if ($serverFavicon = "0"):

            $settings = settings::getSettingsInfo();

            $data['serverFavicon'] = $settings['serverFavicon'];

        endif;

        $update = settings::settingsUpdate($data);

        if ($update):

            $response = alertSuccess('Genel ayarlar başarıyla güncellendi');

        else:

            $response = alertDanger('HATA! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

elseif ($action[1]=="sistem"):

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/codemirror/codemirror.css');
    $extraResourcesCSS->addResource('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css');

    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/codemirror/codemirror.js');
    $extraResourcesJS->addResource('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js');
    $extraResourcesJS->addResource('assets/js/pages/system-settings.js');

    if ($_POST):

        $data = array(
            'avatarApi' => post('avatarApi'),
            'onlineApi' => post('onlineApi'),
            'onlineJS' => post('onlineJS'),
            'encryptionMethod' => post('encryptionMethod'),
            'sslStatus' => post('sslStatus'),
            'maintenanceMode' => post('maintenanceMode'),
            'sendCreditStatus' => post('sendCreditStatus'),
            'sendGiftStatus' => post('sendGiftStatus'),
            'mostProductsStatus' => post('mostProductsStatus'),
            'preloader' => post('preloader'),
            '2faStatus' => post('2faStatus'),
            'commentsStatus' => post('commentsStatus'),
            'oneSignalStatus' => post('oneSignalStatus'),
            'oneSignalAppID' => post('oneSignalAppID'),
            'oneSignalRestApiKey' => post('oneSignalRestApiKey'),
            'liveChat' => post('liveChat'),
            'liveChatJS' => htmlspecialchars_decode(post('liveChatJS')),
            'bonusCreditStatus' => post('bonusCreditStatus'),
            'bonusCredit' => post('bonusCredit'),
            'analyticsStatus' => post('analyticsStatus'),
            'analyticsID' => post('analyticsID'),
            'recaptchaStatus' => post('recaptchaStatus'),
            'recaptchaSiteKey' => post('recaptchaSiteKey'),
            'recaptchaSecretKey' => post('recaptchaSecretKey'),
            'minimumPayCredit' => post('minimumPayCredit'),
            'maximumPayCredit' => post('maximumPayCredit'),
            'newsLimit' => post('newsLimit'),
            'registerLimit' => post('registerLimit')
        );

        $data['maintenanceData'] = base64_encode(json_encode(array(
            'maintenanceHeading' => post('maintenanceHeading'),
            'maintenanceContent' => post('maintenanceContent'),
            'maintenanceDuration' => post('maintenanceDuration'),
            'maintenanceExpiry' => post('maintenanceExpiry'),
            'maintenanceExpiryTime' => post('maintenanceExpiryTime')
        )));

        $data['recaptchaActive'] = base64_encode(json_encode(array(
            'loginRecaptcha' => post('loginRecaptcha'),
            'registerRecaptcha' => post('registerRecaptcha'),
            'recoveryRecaptcha' => post('recoveryRecaptcha')
        )));

        $update = settings::settingsUpdate($data);

        if ($update):

            $response = alertSuccess('Sistem ayarları başarıyla güncellendi');

        else:

            $response = alertDanger('HATA! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

elseif ($action[1]=="smtp"):

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');
    $extraResourcesJS->addResource('assets/js/pages/smtp.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null})');

    if ($_POST):

        $data = array(
            'smtpType' => post('smtpType'),
            'smtpTemplate' => htmlspecialchars_decode(post('smtpTemplate'))
        );

        if (post('smtpType')==1):

            $data['smtpServer'] = post('smtpServer');
            $data['smtpPort'] = post('smtpPort');
            $data['smtpSecurity'] = post('smtpSecurity');
            $data['smtpMail'] = post('smtpMail');
            $data['smtpPassword'] = post('smtpPassword');

        endif;

        $update = settings::settingsUpdate($data);

        if ($update):

            $response = alertSuccess('SMTP ayarları başarıyla güncellendi');

        else:

            $response = alertDanger('HATA! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

elseif ($action[1]=="webhook"):

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');
    $extraResourcesJS->addResource('assets/js/pages/webhook.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$(\'[data-toggle="color-picker"]\').colorpicker({format:"hex"});');

    if ($_POST):
    
        $data = array();

        if (post('storeWebhook')==1):
            
            if (!empty(post('storeHeading')) && !empty(post('storeColor')) && !empty(post('storeURL')) && !empty(post('storeMessage')) && !empty(post('storeEmbed'))):
                
                $data['storeWebhook'] = 1;

                $storeData = array(
                    'webhook' => post('storeURL'),
                    'title' => post('storeHeading'),
                    'color' => post('storeColor'),
                    'image' => post('storeImage'),
                    'content' => post('storeMessage'),
                    'description' => post('storeEmbed')
                );

                $storeData['footer'] = (isset($_POST['storeFooter']) && $_POST['storeFooter'] == "1")?"1":"0";

                $data['storeWebhookData'] = base64_encode(json_encode($storeData));

            else:

                $response = 1;

            endif;

        else:

            $data['storeWebhook'] = 0;

        endif;

        if (post('creditWebhook')==1):
            
            if (!empty(post('creditHeading')) && !empty(post('creditColor')) && !empty(post('creditURL')) && !empty(post('creditMessage')) && !empty(post('creditEmbed'))):
                
                $data['creditWebhook'] = 1;

                $creditData = array(
                    'webhook' => post('creditURL'),
                    'title' => post('creditHeading'),
                    'color' => post('creditColor'),
                    'image' => post('creditImage'),
                    'content' => post('creditMessage'),
                    'description' => post('creditEmbed')
                );

                $creditData['footer'] = (isset($_POST['creditFooter']) && $_POST['creditFooter'] == "1")?"1":"0";

                $data['creditWebhookData'] = base64_encode(json_encode($creditData));

            else:

                $response = 1;

            endif;

        else:

            $data['creditWebhook'] = 0;

        endif;

        if (post('caseWebhook')==1):
            
            if (!empty(post('caseHeading')) && !empty(post('caseColor')) && !empty(post('caseURL')) && !empty(post('caseMessage')) && !empty(post('caseEmbed'))):
                
                $data['caseWebhook'] = 1;

                $caseData = array(
                    'webhook' => post('caseURL'),
                    'title' => post('caseHeading'),
                    'color' => post('caseColor'),
                    'image' => post('caseImage'),
                    'content' => post('caseMessage'),
                    'description' => post('caseEmbed')
                );

                $caseData['footer'] = (isset($_POST['caseFooter']) && $_POST['caseFooter'] == "1")?"1":"0";

                $data['caseWebhookData'] = base64_encode(json_encode($caseData));

            else:

                $response = 1;

            endif;

        else:

            $data['caseWebhook'] = 0;

        endif;

        if (post('supportWebhook')==1):
            
            if (!empty(post('supportHeading')) && !empty(post('supportColor')) && !empty(post('supportURL')) && !empty(post('supportMessage')) && !empty(post('supportEmbed'))):
                
                $data['supportWebhook'] = 1;

                $supportData = array(
                    'webhook' => post('supportURL'),
                    'title' => post('supportHeading'),
                    'color' => post('supportColor'),
                    'image' => post('supportImage'),
                    'content' => post('supportMessage'),
                    'description' => post('supportEmbed')
                );

                $supportData['footer'] = (isset($_POST['supportFooter']) && $_POST['supportFooter'] == "1")?"1":"0";

                $data['supportWebhookData'] = base64_encode(json_encode($supportData));

            else:

                $response = 1;

            endif;

        else:

            $data['supportWebhook'] = 0;

        endif;

        if (post('commentsWebhook')==1):
            
            if (!empty(post('commentsColor')) && !empty(post('commentsURL')) && !empty(post('commentsMessage')) && !empty(post('commentsEmbed'))):
                
                $data['commentsWebhook'] = 1;

                $commentsData = array(
                    'webhook' => post('commentsURL'),
                    'title' => post('commentsHeading'),
                    'color' => post('commentsColor'),
                    'image' => post('commentsImage'),
                    'content' => post('commentsMessage'),
                    'description' => post('commentsEmbed')
                );

                $commentsData['footer'] = (isset($_POST['commentsFooter']) && $_POST['commentsFooter'] == "1")?"1":"0";

                $data['commentsWebhookData'] = base64_encode(json_encode($commentsData));

            else:

                $response = 1;

            endif;

        else:

            $data['commentsWebhook'] = 0;

        endif;

        if (isset($response) && $response == 1):
            
            $response = alertDanger('Lütfen boş alan bırakmayınız.');

        else:

            $update = settings::settingsUpdate($data);

            if ($update):

                $response = alertSuccess('Webhook ayarları başarıyla güncellendi');

            else:

                $response = alertDanger('HATA! Yetkiliyle iletişime geçiniz.');

            endif;

        endif;

    else:

    endif;

endif;

$settings = settings::getSettingsInfo();

$settings['smtpTemplate'] = str_replace("%logo%", site_url().$find_read_page.$settings['serverLogo'], $settings['smtpTemplate']);

require realpath('.') . '/view/settings.php';