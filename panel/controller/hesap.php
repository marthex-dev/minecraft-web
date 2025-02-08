<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Users.class.php';

if ($action[1]=="liste"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		if ($readAdmin['permission'] == 6):

			if ($action[3] != $readAdmin['id']):

				$deleteUser = $db->delete('Users')->where('id', $action[3])->done();

				if ($deleteUser):
									
					$response = alertSuccess('Hesap başarıyla silindi.');

				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			else:

				$response = alertDanger('Hata! Kendi hesabınızı silemezsiniz.');

			endif;

		else:

			$response = alertDanger('Hata! Hesap silme yetkiniz bulunmuyor.');

		endif;

	endif;

	if ($_POST):

		$query = users::getUsers(post('query'), '1');

	elseif (isset($action[2]) && $action[2]=="yetkili"):
		
		$query = users::getUsers("yetkili");

	else:

		$totalUsers = $db->from('Users')->select('count(*) as total')->total();

		if ($totalUsers > 0):

			$totalPage = ceil($totalUsers / "50");

			$pagination = $db->pagination($totalUsers, "50", "limit");

			$query = $db->from('Users')->limit($pagination['start'], $pagination['limit'])->orderby('id', 'DESC')->all();

			if (!isset($_GET['limit'])):
	
			    $_GET['limit'] = "1";
			
			endif;
			
			$prevPage = $_GET['limit'] - 1;
			
			$nextPage = $_GET['limit'] + 1;

		endif;

	endif;

elseif ($action[1]=="duzenle" OR $action[1]=="goruntule" OR $action[1]=="ekle"):

	if ($_POST):
	
		if (!empty(post('username')) && !empty(post('email'))):
			
			$data = array(
				'username' => strtolower(post('username')),
				'realname' => post('username'),
				'email' => post('email')
			);

			if ($readAdmin['permission']==6):

				$data['permission'] = post('permission');
					
				$data['credit'] = post('credit');

			endif;

			if (!empty(post('password')) && !empty(post('passwordRe'))):
				
				if (post('password') == post('passwordRe')):
					
					if ($readSettings['encryptionMethod']==0):

                        $data['password'] = createSHA256(post('password'));

                    elseif($readSettings['encryptionMethod']==1):

                        $data['password'] = md5(post('password'));

                    endif;

				else:

					$response = alertDanger('Girilen şifreler eşleşmiyor.');

				endif;

			endif;

			if (!isset($response)):

				if ($action[1]=="duzenle"):

					$query = users::getUsers($action[2]);

					$data['id'] = $action[2];

					if ($query['permission']!=6 OR $readAdmin['permission']==6):
						
						$updateUser = users::updateUsers($data);

						if ($updateUser):
							
							$response = alertSuccess('Hesap ayarları başarıyla güncellendi.');

						else:

							$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

						endif;

					else:

						$response = alertDanger('Yönetici hesabını düzenleyemezsiniz.');

					endif;

				elseif ($action[1]=="ekle"):

					$data['regdate'] = strtotime(date("Y-m-d H:i:s"))*1000;

					if (!empty(post('password')) && !empty(post('passwordRe'))):

						$insertUser = users::addUsers($data);

						if ($insertUser):
								
							$response = alertSuccess('Hesap başarıyla eklendi.');

						else:

							$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

						endif;

					else:

						$response = alertDanger('Lütfen şifreleri boş bırakmayınız.');

					endif;

				endif;

			endif;

		else:

			$response = alertDanger('Lütfen boş alan bırakmayınız.');

		endif;

	endif;

	if (isset($action[2])):

		$query = users::getUsers($action[2]);

		if ($action[1]=="goruntule"):
		
			$tickets = support::getUserTickets($action[2]);
		
			$totalStoreHistory = $db->from('StoreHistory')->join('Users', 'Users.id = StoreHistory.accID')->join('Products', 'Products.id = StoreHistory.productID')->join('Servers', 'Servers.id = StoreHistory.serverID')->where('StoreHistory.accID', $action[2])->select('count(*) as total')->total();

			if ($totalStoreHistory > 0):
			            
			    $storeHistory = $db->from('StoreHistory')
			                    ->join('Users', 'Users.id = StoreHistory.accID')
			                    ->join('Products', 'Products.id = StoreHistory.productID')
			                    ->join('Servers', 'Servers.id = StoreHistory.serverID')
			                    ->select('Users.username, Servers.heading as serverName, Products.heading, Users.id, StoreHistory.price, StoreHistory.creationDate')
			                    ->orderby('StoreHistory.id', 'desc')
			                    ->where('StoreHistory.accID', $action[2])
			                    ->limit(0, 5)
			                    ->all();
			
			endif;
			
			$totalCreditHistory = $db->from('CreditHistory')->join('Users', 'Users.id = CreditHistory.accID')->where('type', '3')->or_where('type', '4')->or_where('type', '5')->where('CreditHistory.accID', $action[2])->select('count(*) as total')->total();
			
			if ($totalCreditHistory > 0):
			    
			    $creditHistory = $db->from('CreditHistory')
			    					->join('Users', 'Users.id = CreditHistory.accID')
			    					->select('Users.username, CreditHistory.price, CreditHistory.type, CreditHistory.creationDate')
			    					->orderby('CreditHistory.id', 'desc')
			    					->where('CreditHistory.accID', $action[2])
			    					->limit(0, 5)
			    					->all();
			
			endif;


		endif;

	endif;

endif;

require realpath('.') . '/view/users.php';