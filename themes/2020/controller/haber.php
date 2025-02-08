<?php

if (isset($_SESSION['login'])):

    $checkBanned = $db->from('BannedUsers')->where('categoryID', '3')->where('expiryDate', date('Y-m-d'), '>')->where('accID', $readUser['id'])->select('count(*) as total, BannedUsers.*')->first();

    if ($checkBanned['total'] > 0):
        
        if ($checkBanned['expiryDate']=="2099-12-29"):
            
            $remainingTime = "Sınırsız";
    
        else:
    
            $remainingTime = $checkBanned['expiryDate'];
    
        endif;
    
        if ($checkBanned['reason']==1):
            
            $reason = "Spam";
    
        elseif ($checkBanned['reason']==2):
    
            $reason = "Küfür / Hakaret";
    
        elseif ($checkBanned['reason']==3):
    
            $reason = "Hile";
    
        elseif ($checkBanned['reason']==4):
    
            $reason = "Reklam";
    
        elseif ($checkBanned['reason']==5):
    
            $reason = "Oyuncuları Dolandırmak";
    
        else: 
    
            $reason = "Diğer";
    
        endif;
    
    endif;

endif;

$totalNews = $db->from('News')->join('NewsCategory', 'NewsCategory.id = News.category')->join('Users', 'Users.id = News.accID')->where('News.slug', $action[1])->select('count(*) as total')->total();

if ($totalNews > 0):
        
    $news = $db->from('News')
               ->where('News.slug', $action[1])
               ->join('NewsCategory', 'NewsCategory.id = News.category')
               ->join('Users', 'Users.id = News.accID')
               ->select('News.commentsStatus, News.views as NewsView, News.id as NewsID, NewsCategory.heading as CategoryName, NewsCategory.color as CategoryColor, News.image as NewsImage, News.creationDate as NewsDate, News.heading as NewsName, News.slug as slug, News.content as content')
               ->first();
        
    if (!isset($_COOKIE['newsSlug'])):
    
        $view = $news['NewsView'] + 1;
        setcookie("newsSlug", $action[1]);
        $insertView = $db->update('News')
        ->where('slug', $action['1'])
        ->set([
            'views' => $view
        ]);
    
    endif;


    if(isset($_SESSION['login'])):

        if($_POST):
    
            if(!empty($_POST['message'])):
    
                $data = array(
                    'accID' => $readUser['id'],
                    'newsID' => $news['NewsID'],
                    'message' => post('message'),
                    'creationDate' => date('Y-m-d H:i:s'),
                    'updateDate' => date('Y-m-d H:i:s')
                );

                if ($checkBanned['total'] < 1):

                    $insertComments = $db->insert('NewsComments')->set($data);
    
                    if($insertComments):

                        $notificationData = array(
                            'accID' => $readUser['id'],
                            'type' => '2',
                            'data' => $db->lastInsertId(),
                            'status' => '1',
                            'creationDate' => date('Y-m-d H:i:s')
                        );

                        $insertNotification = $db->insert('Notifications')->set($notificationData);

                        if ($readSettings['commentsWebhook']==1):

                            $commentsWebhook = json_decode(base64_decode($readSettings['commentsWebhookData']), true);

                            $panelURL = site_url()."/panel";

                            $newsURL = site_url()."/haber/".$action[1];

                            $commentsWebhook['username'] = $readUser['username'];

                            $commentsWebhook['content'] = str_replace("%username%", $readUser['username'], $commentsWebhook['content']);

                            $commentsWebhook['description'] = str_replace("%username%", $readUser['username'], $commentsWebhook['description']);

                            $commentsWebhook['content'] = str_replace("%newsurl%", $newsURL, $commentsWebhook['content']);

                            $commentsWebhook['description'] = str_replace("%newsurl%", $newsURL, $commentsWebhook['description']);

                            $commentsWebhook['content'] = str_replace("%panelurl%", $panelURL, $commentsWebhook['content']);

                            $commentsWebhook['description'] = str_replace("%panelurl%", $panelURL, $commentsWebhook['description']);

                            webhook($commentsWebhook);

                        endif;
                        
                        $response = alert('success', 'Yorumunuz yönetici onayından sonra görüntülenecektir.');

                    else:

                        $response = alert('danger', 'Hata! Yetkili ile iletişime geçiniz.');

                    endif;

                else:
                
                    $response = alert('danger', 'Hata! Yorum sistemimizden yasaklanmışsınız. <br>Bitiş Tarihi : '.$remainingTime.'<br>Nedeni : '.$reason);
                
                endif;
    
            else:
    
                $response = alert('danger', 'Lütfen boş alan bırakmayınız.');
    
            endif;
    
        endif;

    endif;

    if ($readSettings['commentsStatus']==1):
        
        if($news['commentsStatus']==1):

        	$totalComments = $db->from('NewsComments')->join('Users', 'Users.id = NewsComments.accID')->where('status', '1')->where('newsID', $news['NewsID'])->select('count(*) as total')->total();

        	if ($totalComments > 0):

            	$comments = $db->from('NewsComments')
                    			->where('NewsComments.newsID', $news['NewsID'])
                    			->where('NewsComments.status', 1)
                    			->join('Users', 'Users.id = NewsComments.accID')
                    			->select('NewsComments.id, NewsComments.message, NewsComments.status, NewsComments.creationDate, Users.username, Users.realname')
                    			->all();

            endif;

        endif;

    endif;


endif;

require $realPath . '/view/news.php';