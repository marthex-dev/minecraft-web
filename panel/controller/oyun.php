<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Games.class.php';
require realpath('.') . '/classes/ExtraResources.class.php';

if($_POST && $action[1]=="ekle" OR $_POST && $action[1]=="duzenle"):

	require realpath('.') . '/classes/Upload.class.php';

    if (!empty(post('heading')) && !empty(post('content'))):

        $slug = convertURL(post('heading'));

        $query = $db->from('Games')->where('slug', $slug)->select('count(id) as total')->total();

        if($query > 0):

            $slug = $slug."-".rand(1, 9999);

        endif;

        $data = array(
            'heading' => post('heading'),
            'content' => htmlspecialchars_decode(post('content')),
            'slug' => $slug
        );

        $imageStatus = "0";

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

                    $imageStatus = "1";

                else:

                    $response = alertDanger('Hata! '.$upload->error);

                endif;

            else:

                $response = alertDanger('Hata! '.$upload->error);

            endif;

        endif;

        if ($action[1]=="ekle"):

            $data['creationDate'] = date('Y-m-d H:i:s');
            $data['updateDate'] = date('Y-m-d H:i:s');

            $addGames = games::addGames($data);

            if ($addGames):

                $response = alertSuccess('Oyun başarıyla eklendi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        elseif($action[1]=="duzenle"):

            $data['updateDate'] = date('Y-m-d H:i:s');

            $query = $db->from('Games')->where('id', $action[2])->first();

            if($query['heading'] == post('heading')):

                $data['slug'] = $query['slug'];

            endif;

            $data['id'] = $action[2];

            $editGame = games::editGames($data, $imageStatus);

            if ($editGame):

                $response = alertSuccess('Oyun başarıyla güncellendi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        endif;



    else:

        $response = alertDanger('Lütfen boş alan bırakmayınız');

    endif;

endif;

if ($action[1]=="liste"):

    if (isset($action[2]) && $action[2]=="sil"):

        $deleteGame = games::deleteGame($action[3]);

        if ($deleteGame):

            $response = alertSuccess('Oyun başarıyla silindi.');

        else:

            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    if ($_POST):
        
        $query = $db->from('Games')->like('heading', post('query'))->orderby('id', 'desc')->all();

    else:

        $query = $db->from('Games')->orderBy('id', 'desc')->all();

    endif;

elseif($action[1]=="ekle" OR $action[1]=="duzenle"):

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null});');

    if ($action[1]=="duzenle"):
        
        $query = $db->from('Games')->where('id', $action[2])->first();

    endif;

else:

    header('Location: oyun/liste');

endif;

require realpath('.') . '/view/game.php';