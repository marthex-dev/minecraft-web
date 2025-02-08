<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

if ($action[1]=="gecmis"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		if (isset($action[3])):
			
			$deleteHistory = $db->delete('ChestsHistory')->where('id', $action[3])->done();

			if ($deleteHistory):
				
				$response = alertSuccess('Geçmiş başarıyla silindi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

	endif;

	if ($_POST):

		$totalHistory = $db->from('ChestsHistory')->join('Products', 'Products.id = ChestsHistory.productID')->join('Users', 'Users.id = ChestsHistory.accID')->join('Servers', 'Servers.id = Products.serverID')->where('Users.username', post('query'), 'LIKE')->select('count(*) as total')->total();

		if ($totalHistory > 0):

			$chestHistory = $db->from('ChestsHistory')
							  ->join('Products', 'Products.id = ChestsHistory.productID')
							  ->join('Users', 'Users.id = ChestsHistory.accID')
							  ->join('Servers', 'Servers.id = Products.serverID')
							  ->where('Users.username', post('query'), 'LIKE')
							  ->select('Users.username, Users.id as accID, Products.heading as productHeading, Products.id as productID, Servers.heading as serverHeading, Servers.id as serverID, ChestsHistory.id, ChestsHistory.creationDate, ChestsHistory.type')
							  ->orderby('ChestsHistory.id', 'DESC')
							  ->all();

		endif;

	else:

		$totalHistory = $db->from('ChestsHistory')->join('Products', 'Products.id = ChestsHistory.productID')->join('Users', 'Users.id = ChestsHistory.accID')->join('Servers', 'Servers.id = Products.serverID')->select('count(*) as total')->total();

		if ($totalHistory > 0):

			$totalPage = ceil($totalHistory / "10");

			$pagination = $db->pagination($totalHistory, "10", "limit");

			$chestHistory = $db->from('ChestsHistory')
							  ->join('Products', 'Products.id = ChestsHistory.productID')
							  ->join('Users', 'Users.id = ChestsHistory.accID')
							  ->join('Servers', 'Servers.id = Products.serverID')
							  ->select('Users.username, Users.id as accID, Products.heading as productHeading, Products.id as productID, Servers.heading as serverHeading, Servers.id as serverID, ChestsHistory.id, ChestsHistory.creationDate, ChestsHistory.type')
							  ->limit($pagination['start'], $pagination['limit'])
							  ->orderby('ChestsHistory.id', 'DESC')
							  ->all();

			if (!isset($_GET['limit'])):
	
			    $_GET['limit'] = "1";
			
			endif;
			
			$prevPage = $_GET['limit'] - 1;
			
			$nextPage = $_GET['limit'] + 1;

		endif;

	endif;

endif;

require realpath('.') . '/view/chest.php';