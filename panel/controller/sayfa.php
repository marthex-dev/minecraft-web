<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Pages.class.php';

if($_POST && $action[1]=="duzenle" OR $_POST && $action[1]=="ekle"):

    if (!empty(post('heading')) && !empty(post('content'))):

        $slug = convertURL(post('heading'));

        $query = $db->from('Pages')->where('slug', $slug)->select('count(id) as total')->total();

        if($query > 0):

            $slug = $slug."-".rand(1, 9999);

        endif;

        $data = array(
            'heading' => post('heading'),
            'content' => htmlspecialchars_decode(post('content')),
            'slug' => $slug
        );

        if ($action[1]=="ekle"):

            $addPages = pages::addPages($data);

            if ($addPages):

                $response = alertSuccess('Sayfa başarıyla eklendi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        elseif($action[1]=="duzenle"):

            $query = $db->from('Pages')->where('id', $action[2])->first();

            if($query['heading'] == post('heading')):

                $data['slug'] = $query['slug'];

            endif;

            $data['id'] = $action[2];

            $editPages = pages::editPages($data);

            if ($editPages):

                $response = alertSuccess('Sayfa başarıyla güncellendi.');

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

        $deleteFile = pages::deletePages($action[3]);

        if ($deleteFile):

            $response = alertSuccess('Sayfa başarıyla silindi.');

        else:

            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    if ($_POST):
        
        $query = $db->from('Pages')->like('heading', post('query'))->orderby('id', 'desc')->all();

    else:

        $query = $db->from('Pages')->orderby('id', 'desc')->all();

    endif;

elseif($action[1]=="duzenle" OR $action[1]=="ekle"):

    require realpath('.') . '/classes/ExtraResources.class.php';

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null})');

    if ($action[1]=="duzenle"):
        
        $query = $db->from('Pages')->where('id', $action[2])->first();
        
    endif;

else:

    header('Location: sayfa/liste');

endif;

require realpath('.') . '/view/pages.php';