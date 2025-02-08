<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/ExtraResources.class.php';

if ($action[1]=="liste"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		if (isset($action[3])):
			
			$deleteCoupon = $db->delete('Gifts')->where('id', $action[3])->done();

			if ($deleteCoupon):
				
				$response = alertSuccess('Hediye başarıyla silindi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

	endif;

	if ($_POST):
		
		$totalGifts = $db->from('Gifts')->like('heading', post('query'))->select('count(*) as total')->total();

		if ($totalGifts > 0):
			
			$gifts = $db->from('Gifts')->like('heading', post('query'))->all();
			
		endif;

	else:

		$totalGifts = $db->from('Gifts')->select('count(*) as total')->total();

		if ($totalGifts > 0):

		    $totalPage = ceil($totalGifts / "50");

		    $pagination = $db->pagination($totalGifts, "50", "limit");

		    $gifts = $db->from('Gifts')->limit($pagination['start'], $pagination['limit'])->orderby('id', 'desc')->all();

		    if (!isset($_GET['limit'])):
		
		        $_GET['limit'] = "1";
		    
		    endif;
		    
		    $prevPage = $_GET['limit'] - 1;
		    
		    $nextPage = $_GET['limit'] + 1;

		endif;

	endif;

elseif ($action[1]=="ekle" OR $action[1]=="duzenle"):

	$extraResourcesJS = new ExtraResources('js');
	$extraResourcesJS->addResource('assets/js/pages/gift.js');
	
	if ($_POST):
		
		if (!empty(post('heading'))):
			
			$coupon = convertURL(post('heading'));

			$query = $db->from('Gifts')->where('heading', $coupon)->select('count(*) as total, Gifts.*')->first();

			if($query['total'] > 0):

				$coupon = $coupon."-".rand(1, 9999);

			endif;

			$data['heading'] = $coupon;

			if (post('giftType')==1):
				
				$data['giftType'] = 1;
				$data['productServer'] = post('productServer');
				$data['productID'] = post('productID');

			else:

				$data['giftType'] = 0;
				$data['credit'] = post('credit');

			endif;

			if (post('giftTime')==1):
				
				$data['giftTime'] = 1;
				$data['giftExpiry'] = post('giftExpiry');

			else:

				$data['giftTime'] = 0;

			endif;

			if (post('amountType')==1):
				
				$data['amountType'] = 1;
				$data['amount'] = post('amount');

			else:

				$data['amountType'] = 0;

			endif;

			if ($action[1]=="ekle"):

				$data['creationDate'] = date('Y-m-d H:i:s');

				$insertCoupon = $db->insert('Gifts')->set($data);

				if ($insertCoupon):
					
					$response = alertSuccess('Hediye başarıyla eklendi. Kupon Kodu: '.$coupon);

				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			elseif ($action[1]=="duzenle"):

				if($query['heading'] == post('heading')):

                    $data['heading'] = $query['heading'];

                endif;

                $updateCoupon = $db->update('Gifts')->where('id', $action[2])->set($data);

                if ($updateCoupon):
                	
                	$response = alertSuccess('Hediye başarıyla güncellendi.');

                else:

                	$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

                endif;

			endif;

		else:

			$response = alertDanger('Lütfen boş alan bırakmayınız.');

		endif;
	
	endif;

	$totalServers = $db->from('Servers')->select('count(*) as total')->total();

	if ($totalServers > 0):
	
		$servers = $db->from('Servers')->all();

	endif;

	if ($action[1]=="duzenle"):
		
		$readGift = $db->from('Gifts')->where('id', $action[2])->select('count(*) as total, Gifts.*')->first();

	endif;

elseif ($action[1]=="gecmis"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		if (isset($action[3])):
			
			$deleteHistory = $db->delete('GiftHistory')->where('id', $action[3])->done();

			if ($deleteHistory):
				
				$response = alertSuccess('Hediye geçmişi başarıyla silindi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

	endif;

	if ($_POST):

		$totalHistory = $db->from('GiftHistory')->join('Gifts', 'Gifts.id = GiftHistory.giftID')->join('Users', 'Users.id = GiftHistory.accID')->like('Users.username', post('query'))->select('count(*) as total')->total();

		if ($totalHistory > 0):
		
			$giftHistory = $db->from('GiftHistory')
							  ->join('Users', 'Users.id = GiftHistory.accID')
							  ->join('Gifts', 'Gifts.id = GiftHistory.giftID')
							  ->like('Users.username', post('query'))
							  ->select('GiftHistory.id, Users.id as accID, Gifts.id as cID, Users.username, Gifts.heading, GiftHistory.creationDate')
							  ->all();
		
		endif;

	else:

		$totalHistory = $db->from('GiftHistory')->join('Users', 'Users.id = GiftHistory.accID')->join('Gifts', 'Gifts.id = GiftHistory.giftID')->select('count(*) as total')->total();

		if (!isset($_GET['limit'])):

		    $_GET['limit'] = "1";
		    
		endif;
		
		$totalPage = 1;
		
		$prevPage = 0;
		
		$nextPage = 1;

		if ($totalHistory > 0):

		    $totalPage = ceil($totalHistory / "50");

		    $pagination = $db->pagination($totalHistory, "50", "limit");

		    $giftHistory = $db->from('GiftHistory')
							  ->join('Users', 'Users.id = GiftHistory.accID')
							  ->join('Gifts', 'Gifts.id = GiftHistory.giftID')
							  ->select('GiftHistory.id, Users.id as accID, Gifts.id as cID, Users.username, Gifts.heading, GiftHistory.creationDate')
							  ->limit($pagination['start'], $pagination['limit'])
							  ->orderby('GiftHistory.id', 'desc')
							  ->all();

		    if (!isset($_GET['limit'])):
		
		        $_GET['limit'] = "1";
		    
		    endif;
		    
		    $prevPage = $_GET['limit'] - 1;
		    
		    $nextPage = $_GET['limit'] + 1;

		endif;

	endif;

endif;

require realpath('.') . '/view/gift.php';