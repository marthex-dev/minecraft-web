<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/ExtraResources.class.php';

if (isset($action[1]) && $action[1]=="liste"):

    if ($_POST):
        
        $data = post('query');
        $title = post('query');

    elseif (isset($action[2])):

        if($action[2]=="yanit-bekleyenler"):
            $data = "1";
            $title = "Yanıt Bekleyenler";
        elseif($action[2]=="yanitlananlar"):
            $data = "2";
            $title = "Yanıtlananlar";
        elseif($action[2]=="islemde"):
            $data = "3";
            $title = "İşlemde Olanlar";
        elseif ($action[2]=="kapatilanlar"):
            $data = "4";
            $title = "Kapatılanlar";
        elseif ($action[2]=="tumu"):
            $data = "5";
            $title = "Tümü";
        endif;

    else:

        header('Location: /panel/destek/liste/tumu');
    
    endif;

    if (isset($action[3]) && $action[3]=="sil"):

        if (isset($action['4'])):

            $removeTicket = support::removeTickets($action[4]);

            if ($removeTicket):

                $response = alertSuccess('Destek talebi başarıyla silindi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        endif;

    endif;

    $query = support::getTickets($data);

    if ($data == 5):

        $total = $db->from('SupportTickets')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->join('Users', 'Users.id = SupportTickets.accID')->join('Servers', 'SupportTickets.serverID = Servers.id')->where('SupportTickets.status', '5', '!=')->select('count(*) as total')->total();

    elseif ($data == 1 OR $data == 2 OR $data == 3 OR $data == 4):

        $total = $db->from('SupportTickets')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->join('Users', 'Users.id = SupportTickets.accID')->join('Servers', 'SupportTickets.serverID = Servers.id')->where('SupportTickets.status', $data)->select('count(*) as total')->total();

    else:

        $total = $db->from('SupportTickets')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->join('Users', 'Users.id = SupportTickets.accID')->join('Servers', 'SupportTickets.serverID = Servers.id')->where('SupportTickets.heading', $data, 'LIKE')->or_where('Users.username', $data, 'LIKE')->or_where('SupportCategory.heading', $data, 'LIKE')->select('count(*) as total')->total();

    endif;

    if ($total > 0):

        if (!isset($_GET['limit'])):

            $_GET['limit'] = "1";
    
        endif;
    
        $prevPage = $_GET['limit'] - 1;

        $nextPage = $_GET['limit'] + 1;

        $totalPage = ceil($total / "50");

        $pagination = $db->pagination($total, "50", "limit");

        if ($data == 5):

            $query = $db->from('SupportTickets')
                ->join('Users', 'Users.id = SupportTickets.accID')
                ->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
                ->join('Servers', 'SupportTickets.serverID = Servers.id')
                ->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, Users.username, Servers.heading as serverName')
                ->where('SupportTickets.status', '5', '!=')
                ->limit($pagination['start'], $pagination['limit'])
                ->orderby('SupportTickets.updateDate', 'ASC')
                ->all();
            
        elseif ($data == 1 OR $data == 2 OR $data == 3 OR $data == 4):

            $query = $db->from('SupportTickets')
                        ->join('Users', 'Users.id = SupportTickets.accID')
                        ->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
                        ->join('Servers', 'SupportTickets.serverID = Servers.id')
                        ->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, Users.username, Servers.heading as serverName')
                        ->where('SupportTickets.status', $data)
                        ->limit($pagination['start'], $pagination['limit'])
                        ->orderby('SupportTickets.updateDate', 'ASC')
                        ->all();

        else:

            $query = $db->from('SupportTickets')
                        ->join('Users', 'Users.id = SupportTickets.accID')
                        ->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
                        ->join('Servers', 'SupportTickets.serverID = Servers.id')
                        ->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, Users.username, Servers.heading as serverName')
                        ->where('SupportTickets.heading', $data, 'LIKE')
                        ->or_where('Users.username', $data, 'LIKE')
                        ->or_where('SupportCategory.heading', $data, 'LIKE')
                        ->limit($pagination['start'], $pagination['limit'])
                        ->orderby('SupportTickets.updateDate', 'ASC')
                        ->all();

        endif;

    endif;

elseif($action[1]=="goruntule"):

    $extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null})');

    if ($_POST):
        
        require realpath('.') . '/classes/Settings.class.php';

        if (!empty(post('message'))):

            $ticketInfo = support::getTicketInfo($action[2]);

            $readSettings = settings::getSettingsInfo();

            $message = str_replace("%username%", $ticketInfo['Username'], $readSettings['supportMessageTemplate']);
            $message = str_replace("%message%", post('message'), $message);
            $message = str_replace("%servername%", $readSettings['serverName'], $message);
            $message = str_replace("%serverip%", $readSettings['serverIP'], $message);
            $message = str_replace("%serverversion%", $readSettings['serverVersion'], $message);
            
            $data = array(
                'message' => htmlspecialchars_decode($message),
                'supportID' => $action[2],
                'accID' => $readAdmin['id'],
                'creationDate' => date('Y-m-d H:i:s')
            );

            $insertMessage = support::insertMessage($data);

            if ($insertMessage):
                
                $response = alertSuccess('Mesajınız başarıyla gönderildi');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        else:

            $response = alertDanger('Lütfen boş alan bırakmayınız.');

        endif;

    endif;

    if (isset($action[3])):

        $data = array(
            'id' => $action[2] 
        );

        if ($action[3]=="aktif-et"):
            $data['status'] = "1";
        elseif($action[3]=="isleme-al"):
            $data['status'] = "3";
        elseif($action[3]=="kapat"):
            $data['status'] = "4";
        elseif($action[3]=="sil"):
            $data['status'] = "5";
        endif;

        $updateTickets = support::updateTickets($data);

        if ($updateTickets):

            if ($data['status']=="5"):
            
                header('Location: /panel/destek/liste');
            
            else:
                
                $response = alertSuccess('Talep durumu başarıyla güncellendi.');
        
            endif;
        else:

            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    $supports = support::getTicketInfo($action[2]);

    $updateNotifications = $db->update('Notifications')->where('status', '1')->where('type', '1')->where('data', $action['2'])->set(array('status' => '0'));

    if ($supports):

        $supportReplies = support::getMessage($action[2]);
        $answers = support::getAnswers();

    else:

        $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

    endif;

elseif ($action[1]=="kategori"):

    if ($_POST && $action['2']=="duzenle" OR $_POST && $action['2']=="ekle"):

        if (!empty($_POST['heading'])):

            $data = array(
                'heading' => post('heading')
            );

            if ($action['2']=="ekle"):

                $insertCategory = support::insertCategory($data);

                if ($insertCategory):

                    $response = alertSuccess('Kategori başarıyla eklendi.');

                else:

                    $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

                endif;

            elseif ($action['2']=="duzenle"):

                $data['id'] = $action['3'];

                $updateCategory = support::updateCategory($data);

                if ($updateCategory):

                    $response = alertSuccess('Kategori başarıyla güncellendi.');

                else:

                    $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

                endif;

            endif;

        else:

            $response = alertDanger('Lütfen boş alan bırakmayınız.');

        endif;

    endif;

    if ($action['2']=="liste"):

        if (isset($action[3]) && $action[3]=="sil"):

            $removeCategory = support::removeCategory($action[4]);

            if ($removeCategory):

                $response = alertSuccess('Kategori başarıyla silindi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;


        endif;

        if ($_POST):
            
            $query = support::getCategory(post('query'));

        else:

            $query = support::getCategory();

        endif;

    elseif ($action['2']=="duzenle"):

        $query = support::getCategoryInfo($action['3']);

    endif;

elseif ($action[1]=="hazir-cevap"):

    if ($action[2]=="liste"):

        if (isset($action[3]) && $action[3]=="sil"):

            if (isset($action['4'])):

                $removeAnswers = support::removeAnswers($action[4]);

                if ($removeAnswers):

                    $response = alertSuccess('Cevap başarıyla silindi.');

                else:

                    $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

                endif;

            endif;

        endif;

        if ($_POST):
            
            $query = support::getAnswers(post('query'));

        else:

            $query = support::getAnswers();

        endif;

    endif;

    if ($action[2]=="duzenle" OR $action[2]=="ekle"):
    
        $extraResourcesCSS = new ExtraResources('css');
        $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
        
        $extraResourcesJS = new ExtraResources('js');
        $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');
        
        $extraResourcesScript = new ExtraResources('script');
        $extraResourcesScript->addResource('$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null})');

        if ($_POST):

            if (!empty(post('heading'))):
            
                $data = array(
                    'heading' => post('heading'),
                    'content' => htmlspecialchars_decode(post('content'))
                );

                if ($action[2]=="ekle"):
                    
                    $insertAnswers = support::insertAnswers($data);

                    if ($insertAnswers):
                        
                        $response = alertSuccess("Cevap başarıyla eklendi.");

                    else:

                        $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

                    endif;

                elseif ($action[2]=="duzenle"):

                    $data['id'] = $action[3];

                    $updateAnswers = support::updateAnswers($data);

                    if ($updateAnswers):
                        
                        $response = alertSuccess("Cevap başarıyla düzenlendi.");

                    else:

                        $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

                    endif;

                endif;

            else:

                $response = alertDanger('Lütfen boş alan bırakmayınız');

            endif;

        endif;

        if ($action[2]=="duzenle"):
            
            $query = support::getAnswerInfo($action[3]);

        endif;

    endif;

else:

    header('Location: destek/liste');

endif;

require realpath('.') . '/view/supports.php';