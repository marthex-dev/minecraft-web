<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Servers.class.php';

if ($_POST && $action[1]=="ekle" OR $_POST && $action[1]=="duzenle"):

    require realpath('.') . '/classes/Upload.class.php';
	
    if (!empty('heading') && !empty(post('serverIP')) && !empty(post('serverPort')) && !empty(post('senderType')) && !empty(post('senderPort'))):

        $slug = convertURL(post('heading'));

        $query = $db->from('Servers')->where('slug', $slug)->select('count(id) as total')->total();

        if($query > 0):

            $slug = $slug."-".rand(1, 9999);

        endif;

        $data = array(
            'heading' => post('heading'),
            'slug' => $slug,
            'serverIP' => post('serverIP'),
            'serverPort' => post('serverPort'),
            'senderType' => post('senderType'),
            'senderPort' => post('senderPort'),
            'senderPassword' => base64_encode(post('senderPassword'))
        );

        if ($_FILES["image"] != null):

            $upload = new Upload($_FILES["image"], "tr_TR");
            $image = md5(uniqid(rand(0, 9999)));
            if ($upload->uploaded):

                $upload->allowed = array("image/*");
                $upload->file_new_name_body = $image;
                $upload->Process($find_read_panel);

                if ($upload->processed):

                    $image = $image.".".$upload->file_dst_name_ext;

                    $data['image'] = $image;

                else:

                    $response = alertDanger('Hata! '.$upload->error);

                endif;

            else:

                $response = alertDanger('Hata! '.$upload->error);

            endif;

        endif;

        if($action[1]=="ekle"):

            $insertServer = server::addServer($data);

            if($insertServer):

                $response = alertSuccess('Sunucu başarıyla eklendi.');

            else:

                $response = alertDanger('Hata! Yetkili ile iletişime geçiniz.');

            endif;

        elseif($action[1]=="duzenle"):

            $query = server::getServer($action[2]);

            if (empty(post('senderPassword'))):

                $data['senderPassword'] = $query['senderPassword'];

            endif;

            if($query['heading'] == post('heading')):

                $data['slug'] = $query['slug'];

            endif;

            $data['id'] = $action[2];

            $updateServer = server::updateServer($data);

            if($updateServer):

                $response = alertSuccess('Sunucu başarıyla güncellendi.');

            else:

                $response = alertDanger('Hata! Yetkili ile iletişime geçiniz.');

            endif;

        endif;


    else:

        $response = alertDanger('Lütfen boş alan bırakmayınız.');

    endif;

endif;

if($action[1]=="liste"):

    if (isset($action[2]) && $action['2']=="sil"):

        $deleteServer = server::deleteServer($action[3]);

        if ($deleteServer):

            $response = alertSuccess('Sunucu başarıyla silindi');

        else:

            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    if ($_POST):
        
        $query = server::getServer(post('query'), '1');

    else:

        $query = server::getServer();

    endif;

elseif($action[1]=="duzenle"):

    $query = server::getServer($action[2]);

elseif($action[1]=="konsol"):

    require realpath('.') . '/classes/ExtraResources.class.php';

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/jquery-ui/jquery-ui.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/jquery-ui/jquery-ui.js');
    $extraResourcesJS->addResource('assets/js/pages/console.js');

    $query = server::getServer($action[2]);

endif;

require realpath('.') . '/view/servers.php';