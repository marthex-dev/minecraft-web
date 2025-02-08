<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Banned.class.php';

if ($_POST && $action[1] == "duzenle" OR $_POST && $action[1] == "ekle"):
	
	$data = array(
		'reason' => post('reason'),
		'categoryID' => post('categoryID'),
		'expiry' => post('expiry'),
		'regdate' => date('Y-m-d H:i:s')
	);

	if (post('expiry')=="1"):

		$data['expiryDate'] = date("Y-m-d",strtotime('+'.post('expiryDate').' days'));

	else:

		$data['expiryDate'] = "2099-12-29";

	endif;

	if ($action[1]=="ekle"):

		if (!empty(post('username')) OR isset($action[2])):

			if (isset($_POST['username'])):
				
				$readUser = $db->from('Users')->where('username', post('username'))->select('count(*) as total, Users.id')->first();

			elseif (isset($action[2])):

				$readUser = $db->from('Users')->where('id', $action[2])->select('count(*) as total, Users.id')->first();

			endif;

			if ($readUser['total'] > 0):

				$data['accID'] = $readUser['id'];
		
				$insertBanned = banned::addBannedUser($data);

				if ($insertBanned):
					
					$response = alertSuccess('Hesap başarıyla engellendi.');
				
				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			else:

				$response = alertDanger('Kullanıcı bulunamadı!');

			endif;

		else:

			$response = alertDanger('Lütfen boş alan bırakmayınız.');

		endif;

	elseif ($action[1]=="duzenle"):

		$data['id'] = $action[2];
		
		$updateBanned = banned::updateBannedUser($data);

		if ($updateBanned):
			
			$response = alertSuccess('Güncelleme başarıyla yapıldı.');
		
		else:

			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		endif;

	endif;	

endif;

if ($action[1]=="liste"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		$delete = banned::deleteBannedUser($action[3]);

		if ($delete):
		
			$response = alertSuccess('Engel başarıyla kaldırıldı.');
		
		else:
			
			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		endif;

	endif;

	if ($_POST):
		
		$query = banned::getBannedUser(post('query'), '1');

	else:

		$totalBanned = $db->from('BannedUsers')->join('Users', 'Users.id = BannedUsers.accID')->select('count(*) as total')->total();

        if ($totalBanned > 0):

            $totalPage = ceil($totalBanned / "50");

            $pagination = $db->pagination($totalBanned, "50", "limit");

            $query = $db->from('BannedUsers')->join('Users', 'Users.id = BannedUsers.accID')->limit($pagination['start'], $pagination['limit'])->select('BannedUsers.*, Users.username, Users.id as UserID')->orderby('BannedUsers.id', 'DESC')->all();

            if (!isset($_GET['limit'])):
    
                $_GET['limit'] = "1";
            
            endif;
            
            $prevPage = $_GET['limit'] - 1;
            
            $nextPage = $_GET['limit'] + 1;

        endif;

	endif;

elseif ($action[1]=="duzenle"):

	$query = banned::getBannedUser($action[2]);

elseif ($action[1]=="ekle"):

	if (isset($action[2])):
		
		$readUsers = $db->from('Users')->where('id', $action[2])->select('count(*) as total, Users.id, Users.username')->first();

	endif;

endif;

require realpath('.') . '/view/banned.php';