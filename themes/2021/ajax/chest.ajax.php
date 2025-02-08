<?php

session_start();

require '../../../connect.php';

require '../helper.php';

$readSettings = $db->from('Settings')->where('id', '1')->first();

$date = date('Y-m-d');

if ($_SESSION['login']):

	$readUser = $db->from('Users')->where('username', $_SESSION['username'])->select('count(*) as total, Users.*')->first();

	if ($readUser['total'] > 0):

		$username = $readUser['username'];
		$userID = $readUser['id'];
		$type = "1";

		if (isset($_POST['username'])):
			
			if (!empty(post('username'))):

				if (post('username') != $readUser['username']):

					if ($readSettings['sendGiftStatus']==1):
					
						$giftUser = $db->from('Users')->where('username', post('username'))->select('count(*) as total, Users.*')->first();

						if ($giftUser['total'] > 0):
							
							$username = $giftUser['username'];
							$userID = $giftUser['id'];
							$type = "2";
							$giftStatus = "1";

						else:

							echo alert('danger', 'Kullanıcı bulunamadı.');
							exit;

						endif;

					else:

						echo alert('danger', 'Hediye gönderme yönetici tarafından kapatılmış.');
						exit;

					endif;

				else:

					echo alert('danger', 'Hata! Kendinize hediye gönderemezsiniz.');
					exit;
				endif;

			else:

				echo alert('danger', 'Lütfen kullanıcı adı giriniz.');
				exit;

			endif;

		endif;

		$chestControl = $db->from('Chests')->where('status', '1')->where('accID', $readUser['id'])->where('id', post('id'))->select('count(*) as total, Chests.*')->first();

		if ($chestControl['total'] > 0):

			if ($chestControl['type'] == 1): 
			
				$productControl = $db->from('Products')->where('id', $chestControl['productID'])->select('count(*) as total, Products.*')->first();

				if ($productControl['total'] > 0):
					
					$serverControl = $db->from('Servers')->where('id', $productControl['serverID'])->select('count(*) as total, Servers.*')->first();

					if ($serverControl['total'] > 0):
						error_reporting(0);
						if ($serverControl['senderType']==1):
	
							require "../../../classes/websend.class.php";
							$ws = new Websend($serverControl['serverIP'], $serverControl['senderPort']);
							$ws->password = base64_decode($serverControl['senderPassword']);

						elseif ($serverControl['senderType']==2):
						
							require "../../../classes/websender.class.php";
							$ws = new WebsenderAPI($serverControl['serverIP'], base64_decode($serverControl['senderPassword']), $serverControl['senderPort']);
						
						elseif ($serverControl['senderType']==3):

							require "../../../classes/rcon.class.php";
							$ws = new rcon($serverControl['serverIP'], $serverControl['senderPort'], base64_decode($serverControl['senderPassword']), "3");
						
						endif;

						if($ws->connect()):

							$deleteChest = $db->update('Chests')
    									->where('id', $chestControl['id'])
    									->set(array(
       		 							'status' => '0'
       								));

    						if ($deleteChest):

								$commands = json_decode(base64_decode($productControl['commands']));

								if ($serverControl['senderType']==1):

									foreach ($commands as $readCommands):

										$command = str_replace("%username%", $username, $readCommands);
										$ws->doCommandAsConsole($command);

									endforeach;

								else:

									foreach ($commands as $readCommands):

										$command = str_replace("%username%", $username, $readCommands);
										$ws->sendCommand($command);

									endforeach;

								endif;

								$insertHistory = $db->insert('ChestsHistory')
    										->set(array(
    										    'accID' => $readUser['id'],
    										    'chestID' => $chestControl['id'],
    										    'productID' => $productControl['id'],
    										    'type' => $type,
    										    'creationDate' => date('Y-m-d H:i:s')
    										));

    							if (isset($giftStatus) && $giftStatus==1):
    								
    								$insertGiftHistory = $db->insert('ChestsHistory')
    										->set(array(
    										    'accID' => $userID,
    										    'chestID' => $chestControl['id'],
    										    'productID' => $productControl['id'],
    										    'type' => '3',
    										    'creationDate' => date('Y-m-d H:i:s')
    										));

    							endif;

    							if ($productControl['duration']==1):

    								$productExpiryControl = $db->from('ProductExpiryCommands')->where('accID', $userID)->where('productID', $productControl['id'])->select('count(*) as total, ProductExpiryCommands.*')->first();

    								if ($productExpiryControl['total'] > 0):

    									$dateNow = strtotime($productExpiryControl['expiryDate']);

										$expiryDate = date("Y-m-d H:i:s", strtotime($productExpiryControl['expiryDate'] . '+'.$productControl['durationDay'].' days'));

										$updateExpiry = $db->update('ProductExpiryCommands')->where('id', $productExpiryControl['id'])->set(array('expiryDate' => $expiryDate));

										if ($updateExpiry):
    								
    										echo alert('success', 'Ürün süresi başarıyla uzatıldı.');
    										echo "<script>setTimeout(function(){window.location = '/sandik'; }, 1500);</script>";

    									endif;

    								else:
									
										$expiryDate = date("Y-m-d H:i:s", strtotime('+'.$productControl['durationDay'].' days'));

										$insertExpiry = $db->insert('ProductExpiryCommands')
    										->set(array(
    										    'productID' => $productControl['id'],
    										    'accID' => $userID,
    										    'expiryDate' => $expiryDate,
    										    'creationDate' => date('Y-m-d H:i:s')
    										));

    									if ($insertExpiry):
    									
    										echo alert('success', 'Ürün başarıyla gönderildi.');
    										echo "<script>setTimeout(function(){window.location = '/sandik'; }, 1500);</script>";

    									endif;

    								endif;

    							else:

    								echo alert('success', 'Ürün başarıyla gönderildi.');
    								echo "<script>setTimeout(function(){window.location = '/sandik'; }, 1500);</script>";

    							endif;

    						else:

    							echo alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

    						endif;

						else:		

							echo alert('danger', 'Sunucuya bağlanılamadı.');

						endif;
						error_reporting(E_ALL);
						$ws->disconnect();

					else:

						echo alert('danger', 'Sunucu bulunamadı.');

					endif;

				else:

					echo alert('danger', 'Ürün bulunamadı.');

				endif;

			else:

				$productControl = $db->from('Vips')->where('id', $chestControl['productID'])->select('count(*) as total, Vips.*')->first();

				if ($productControl['total'] > 0):
					
					$serverControl = $db->from('Servers')->where('id', $productControl['serverID'])->select('count(*) as total, Servers.*')->first();

					if ($serverControl['total'] > 0):
						error_reporting(0);
						if ($serverControl['senderType']==1):
	
							require "../../../classes/websend.class.php";
							$ws = new Websend($serverControl['serverIP'], $serverControl['senderPort']);
							$ws->password = base64_decode($serverControl['senderPassword']);

						elseif ($serverControl['senderType']==2):
						
							require "../../../classes/websender.class.php";
							$ws = new WebsenderAPI($serverControl['serverIP'], base64_decode($serverControl['senderPassword']), $serverControl['senderPort']);
						
						elseif ($serverControl['senderType']==3):

							require "../../../classes/rcon.class.php";
							$ws = new rcon($serverControl['serverIP'], $serverControl['senderPort'], base64_decode($serverControl['senderPassword']), "3");
						
						endif;

						if($ws->connect()):

							$deleteChest = $db->update('Chests')
    									->where('id', $chestControl['id'])
    									->set(array(
       		 							'status' => '0'
       								));

    						if ($deleteChest):

								$commands = json_decode(base64_decode($productControl['commands']));

								if ($serverControl['senderType']==1):

									foreach ($commands as $readCommands):

										$command = str_replace("%username%", $username, $readCommands);
										$ws->doCommandAsConsole($command);

									endforeach;

								else:

									foreach ($commands as $readCommands):

										$command = str_replace("%username%", $username, $readCommands);
										$ws->sendCommand($command);

									endforeach;

								endif;

								$insertHistory = $db->insert('ChestsHistory')
    										->set(array(
    										    'accID' => $readUser['id'],
    										    'chestID' => $chestControl['id'],
    										    'productID' => $productControl['id'],
    										    'chestType' => '2',
    										    'type' => $type,
    										    'creationDate' => date('Y-m-d H:i:s')
    										));

    							if (isset($giftStatus) && $giftStatus==1):
    								
    								$insertGiftHistory = $db->insert('ChestsHistory')
    										->set(array(
    										    'accID' => $userID,
    										    'chestID' => $chestControl['id'],
    										    'productID' => $productControl['id'],
    										    'chestType' => '2',
    										    'type' => '3',
    										    'creationDate' => date('Y-m-d H:i:s')
    										));

    							endif;

    							if ($productControl['duration']==1):

    								$productExpiryControl = $db->from('VipExpiryCommands')->where('accID', $userID)->where('productID', $productControl['id'])->select('count(*) as total, VipExpiryCommands.*')->first();

    								if ($productExpiryControl['total'] > 0):

    									$dateNow = strtotime($productExpiryControl['expiryDate']);

										$expiryDate = date("Y-m-d H:i:s", strtotime($productExpiryControl['expiryDate'] . '+'.$productControl['durationDay'].' days'));

										$updateExpiry = $db->update('VipExpiryCommands')->where('id', $productExpiryControl['id'])->set(array('expiryDate' => $expiryDate));

										if ($updateExpiry):
    								
    										echo alert('success', 'Ürün süresi başarıyla uzatıldı.');
    										echo "<script>setTimeout(function(){window.location = '/sandik'; }, 1500);</script>";

    									endif;

    								else:
									
										$expiryDate = date("Y-m-d H:i:s", strtotime('+'.$productControl['durationDay'].' days'));

										$insertExpiry = $db->insert('VipExpiryCommands')
    										->set(array(
    										    'productID' => $productControl['id'],
    										    'accID' => $userID,
    										    'expiryDate' => $expiryDate,
    										    'creationDate' => date('Y-m-d H:i:s')
    										));

    									if ($insertExpiry):
    									
    										echo alert('success', 'Ürün başarıyla gönderildi.');
    										echo "<script>setTimeout(function(){window.location = '/sandik'; }, 1500);</script>";

    									endif;

    								endif;

    							else:

    								echo alert('success', 'Ürün başarıyla gönderildi.');
    								echo "<script>setTimeout(function(){window.location = '/sandik'; }, 1500);</script>";

    							endif;

    						else:

    							echo alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

    						endif;

						else:		

							echo alert('danger', 'Sunucuya bağlanılamadı.');

						endif;
						error_reporting(E_ALL);
						$ws->disconnect();

					else:

						echo alert('danger', 'Sunucu bulunamadı.');

					endif;

				else:

					echo alert('danger', 'Ürün bulunamadı.');

				endif;

			endif;

		else:

			echo alert('danger', 'Ürün sandığınızda bulunamadı.');

		endif;

	else:

		echo alert('danger', 'Kullanıcı bulunamadı.');

	endif;

else:

	echo alert('danger', 'Giriş yapmanız gerekiyor.');

endif;

?>