<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Downloads.class.php';

if($_POST && $action[1]=="duzenle" OR $_POST && $action[1]=="ekle"):

    if (!empty(post('heading')) && !empty(post('content'))):

        $slug = convertURL(post('heading'));

        $query = $db->from('Downloads')->where('slug', $slug)->select('count(id) as total')->total();

        if($query > 0):

            $slug = $slug."-".rand(1, 9999);

        endif;

        $data = array(
            'heading' => post('heading'),
            'url' => post('url'),
            'content' => htmlspecialchars_decode(post('content')),
            'slug' => $slug
        );

        if ($action[1]=="ekle"):

            $addFiles = download::addFiles($data);

            if ($addFiles):

                $response = alertSuccess('Dosya başarıyla eklendi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        elseif($action[1]=="duzenle"):

            $query = $db->from('Downloads')->where('id', $action[2])->first();

            if($query['heading'] == post('heading')):

                $data['slug'] = $query['slug'];

            endif;

            $data['id'] = $action[2];

            $editFiles = download::editFiles($data);

            if ($editFiles):

                $response = alertSuccess('Dosya başarıyla güncellendi.');

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

        $deleteFile = download::deleteFiles($action[3]);

        if ($deleteFile):

            $response = alertSuccess('Dosya başarıyla silindi.');

        else:

            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    if ($_POST):
        
        $query = $db->from('Downloads')->like('heading', post('query'))->orderby('id', 'desc')->all();

    else:

        $totalDownloads = $query = $db->from('Downloads')->select('count(*) as total')->total();

        if ($totalDownloads > 0):

            $totalPage = ceil($totalDownloads / "50");

            $pagination = $db->pagination($totalDownloads, "50", "limit");

            $query = $db->from('Downloads')->limit($pagination['start'], $pagination['limit'])->orderby('id', 'desc')->all();

            if (!isset($_GET['limit'])):
        
                $_GET['limit'] = "1";
            
            endif;
            
            $prevPage = $_GET['limit'] - 1;
            
            $nextPage = $_GET['limit'] + 1;

        endif;

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
        
        $query = $db->from('Downloads')->where('id', $action[2])->first();
        
    endif;

else:

    header('Location: indir/liste');

endif;

require realpath('.') . '/view/downloads.php';