<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

$totalNotifications2 = $db->from('Notifications')->join('Users', 'Users.id = Notifications.accID')->select('count(*) as total')->total();

if ($totalNotifications2 > 0):

	$totalPage = ceil($totalNotifications2 / "50");

	$pagination = $db->pagination($totalNotifications2, "50", "limit");

	$notifications2 = $db->from('Notifications')
                        ->join('Users', 'Users.id = Notifications.accID')
                        ->select('Notifications.*, Users.username')
                        ->limit($pagination['start'], $pagination['limit'])
                        ->orderby('Notifications.id', 'DESC')
                        ->all();
	
	if (!isset($_GET['limit'])):

    	$_GET['limit'] = "1";
    
	endif;

	$prevPage = $_GET['limit'] - 1;
	
	$nextPage = $_GET['limit'] + 1;

endif;

require realpath('.') . '/view/notifications.php';