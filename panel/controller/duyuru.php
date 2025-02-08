<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Broadcast.class.php';

if ($_POST && $action[1] == "duzenle" OR $_POST && $action[1] == "ekle"):
    if (!empty('heading') && !empty('link')):

        $data = array(
            'heading' => post('heading'),
            'content' => post('content'),
            'link' => post('link')
        );

        if($action[1]=="ekle"):

            $data['creationDate'] = date('Y-m-d H:i:s');
            $data['updateDate'] = date('Y-m-d H:i:s');

            $insertBroadcast = broadcast::addBroadcast($data);

            if($insertBroadcast):

                $response = alertSuccess('Duyuru başarıyla eklendi.');

            else:

                $response = alertDanger('Hata! Yetkili ile iletişime geçiniz.');

            endif;

        elseif($action[1]=="duzenle"):

            $data['updateDate'] = date('Y-m-d H:i:s');

            $data['id'] = $action[2];

            $updateBroadcast = broadcast::updateBroadcast($data);

            if($updateBroadcast):

                $response = alertSuccess('Duyuru başarıyla güncellendi.');

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

        $deleteBroadcast = broadcast::deleteBroadcast($action[3]);

        if ($deleteBroadcast):

            $response = alertSuccess('Duyuru başarıyla silindi');

        else:

            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    if ($_POST):
        
        $query = $db->from('Broadcast')->where('heading', post('query'), 'LIKE')->or_where('content', post('query'), 'LIKE')->all();

    else:

        $totalBroadcast = $db->from('Broadcast')->select('count(*) as total')->total();

        if ($totalBroadcast > 0):

            $totalPage = ceil($totalBroadcast / "50");

            $pagination = $db->pagination($totalBroadcast, "50", "limit");

            $query = $db->from('Broadcast')->limit($pagination['start'], $pagination['limit'])->orderby('id', 'DESC')->all();

            if (!isset($_GET['limit'])):
    
                $_GET['limit'] = "1";
            
            endif;
            
            $prevPage = $_GET['limit'] - 1;
            
            $nextPage = $_GET['limit'] + 1;

        endif;

    endif;

elseif($action[1]=="duzenle"):

    $readBroadcast = $db->from('Broadcast')->where('id', $action[2])->first();

endif;

require realpath('.') . '/view/broadcast.php';