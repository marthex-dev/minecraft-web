<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Theme.class.php';
require realpath('.') . '/classes/ExtraResources.class.php';

if ($action[1]=="genel"):

    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/js/pages/theme-settings.js');

    if ($_POST):

        require realpath('.') . '/classes/Upload.class.php';

        $data = array(
            'theme' => post('theme'),
            'youtubeEmbed' => post('youtubeEmbed'),
            'broadcast' => post('broadcast'),
            'slider' => post('slider'),
            'sliderType' => post('sliderType'),
            'sidebar' => post('sidebar'),
            'discord' => post('discord'),
            'discordTheme' => post('discordTheme'),
            'discordServerID' => post('discordServerID'),
            'newsCardType' => post('newsCardType'),
            'slice' => post('slice'),
            'sliceType' => post('sliceType'),
            'sliceHeading' => post('sliceHeading'),
            'sliceSubHeading' => post('sliceSubHeading'),
            'headerType' => post('headerType'),
            'menuType' => post('menuType'),
            'footerType' => post('footerType'),
            'headerTheme' => post('headerTheme'),
            'headerBgStatus' => post('headerBgStatus'),
            'loginBgStatus' => post('loginBgStatus')
        );

        $headerBg = "0";

        if ($_FILES["headerBg"] != null):

            $upload = new Upload($_FILES["headerBg"], "tr_TR");
            $image = md5(uniqid(rand(0, 9999)));
            if ($upload->uploaded):

                $upload->allowed = array("image/*");
                $upload->file_new_name_body = $image;
                $upload->Process($find_read_panel);

                if ($upload->processed):

                    $image = $image.".".$upload->file_dst_name_ext;

                    $data['headerBg'] = $image;

                    $headerBg = "1";

                else:

                    $response = alertDanger('Hata! '.$upload->error);

                endif;

            else:

                $response = alertDanger('Hata! '.$upload->error);

            endif;

        endif;

        if ($_FILES["loginBg"] != null):

            $upload = new Upload($_FILES["loginBg"], "tr_TR");
            $image = md5(uniqid(rand(0, 9999)));
            if ($upload->uploaded):

                $upload->allowed = array("image/*");
                $upload->file_new_name_body = $image;
                $upload->Process($find_read_panel);

                if ($upload->processed):

                    $image = $image.".".$upload->file_dst_name_ext;

                    $data['loginBg'] = $image;

                    $loginBg = "1";

                else:

                    $response = alertDanger('Hata! '.$upload->error);

                endif;

            else:

                $response = alertDanger('Hata! '.$upload->error);

            endif;

        endif;

        if ($headerBg = "0"):

            $header = theme::getThemeInfo();

            $data['headerBg'] = $header['headerBg'];

        endif;

        $headerLogo = "0";

        if ($_FILES["headerLogo"] != null):

            $upload = new Upload($_FILES["headerLogo"], "tr_TR");
            $image = md5(uniqid(rand(0, 9999)));
            if ($upload->uploaded):

                $upload->allowed = array("image/*");
                $upload->file_new_name_body = $image;
                $upload->Process($find_read_panel);

                if ($upload->processed):

                    $image = $image.".".$upload->file_dst_name_ext;

                    $data['headerLogo'] = $image;

                    $headerLogo = "1";

                else:

                    $response = alertDanger('Hata! '.$upload->error);

                endif;

            else:

                $response = alertDanger('Hata! '.$upload->error);

            endif;

        endif;

        if ($headerLogo = "0"):

            $header = theme::getThemeInfo();

            $data['headerLogo'] = $header['headerLogo'];

        endif;

        if ($_FILES["sliceBg"] != null):

            $upload = new Upload($_FILES["sliceBg"], "tr_TR");
            $image = md5(uniqid(rand(0, 9999)));
            if ($upload->uploaded):

                $upload->allowed = array("image/*");
                $upload->file_new_name_body = $image;
                $upload->Process($find_read_panel);

                if ($upload->processed):

                    $image = $image.".".$upload->file_dst_name_ext;

                    $data['sliceBg'] = $image;

                    $sliceBg = "1";

                else:

                    $response = alertDanger('Hata! '.$upload->error);

                endif;

            else:

                $response = alertDanger('Hata! '.$upload->error);

            endif;

        endif;

        if ($sliceBg = "0"):

            $header = theme::getThemeInfo();

            $data['sliceBg'] = $header['sliceBg'];

        endif;

        $update = theme::themeUpdate($data);

        if ($update):

            $response = alertSuccess('Tema ayarları başarıyla güncellendi');

        else:

            $response = alertDanger('HATA! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    $theme = theme::getThemeInfo();

elseif ($action[1]=="css"):

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/codemirror/codemirror.css');

    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/codemirror/codemirror.js');

    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('var editor = CodeMirror.fromTextArea(document.getElementById("css"), {mode: "css", theme: "ambiance", lineNumbers: true});');

    if ($_POST):

        $data = array(
            'css' => post('css')
        );

        $update = theme::themeUpdate($data);

        if ($update):

            $response = alertSuccess('CSS ayarları başarıyla güncellendi');

        else:

            $response = alertDanger('HATA! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    $theme = theme::getThemeInfo();

elseif ($action[1]=="header"):

    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/jquery-nestable/jquery.nestable.js');
    $extraResourcesJS->addResource('assets/js/pages/theme-settings.js');

    $menuList = $db->from('Menu')->where('parent', '0')->orderby('sort', 'ASC')->all();

elseif ($action[1]=="renk"):

    if ($_POST):
        
        $colors = base64_encode(json_encode($_POST));

        $data = array(
            'colors' => $colors
        );

        $update = theme::themeUpdate($data);

        if ($update):

            $response = alertSuccess('Tema ayarları başarıyla güncellendi');

        else:

            $response = alertDanger('HATA! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$(\'[data-toggle="color-picker"]\').colorpicker({format:"hex"});');

    $theme = theme::getThemeInfo();

    $colorsDecode = json_decode(base64_decode($theme['colors']), true);

    $colors = $colorsDecode['color'];

endif;

require realpath('.') . '/view/theme.php';