<?php

if (!$_SESSION['login']) header('Location:' . site_url() . '/giris-yap');

if (!isset($action[1])) header('Location:' . site_url() . '/destek/liste');

$checkBanned = $db->from('BannedUsers')->where('categoryID', '2')->where('expiryDate', date('Y-m-d'), '>')->where('accID', $readUser['id'])->select('count(*) as total, BannedUsers.*')->first();

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

if (isset($action[1]) && $action[1]=="liste"):

	if (isset($action[2]) && $action[2]=="sil"):
	
	    $data = array(
	        'accID' => $readUser['id'],
	        'supportID' => $action[3]
	    );
	
	    $updateTickets = $db->update('SupportTickets')
	                ->where('accID', $data['accID'])
	                ->where('id', $data['supportID'])
	                ->set('status', '5');
	
	    if ($updateTickets):
	
	        $response = alert('success', 'Talep başarıyla silindi.');
	
	    else:
	
	        $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');
	
	    endif;
	
	endif;

	$totalTickets = $db->from('SupportTickets')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->where('SupportTickets.accID', $readUser['id'])->where('SupportTickets.status', '5', '!=')->select('count(*) as total')->total();

	if ($totalTickets > 0):

		$tickets = $db->from('SupportTickets')
						->where('SupportTickets.accID', $readUser['id'])
						->where('SupportTickets.status', '5', '!=')
						->join('Users', 'Users.id = SupportTickets.accID')
						->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
						->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status')
						->orderBy('SupportTickets.updateDate', 'Desc')
						->all();

	endif;

elseif (isset($action[1]) && $action[1]=="goruntule"):

    if ($_POST):

        if (!empty($_POST['message'])):

            $data = array(
                'accID' => $readUser['id'],
                'supportID' => $action['2'],
                'message' => post('message'),
                'creationDate' => date('Y-m-d H:i:s')
            );

            if ($checkBanned['total'] < 1):

				$insertMessage = $db->insert('SupportMessages')
				    ->set($data);

				$updateTicket = $db->update('SupportTickets')
				    ->where('accID', $data['accID'])
				    ->where('id', $data['supportID'])
				    ->set(['updateDate' => date('Y-m-d H:i:s'), 'status' => '1']);

				if ($updateTicket):

					$notificationData = array(
						'accID' => $readUser['id'],
						'type' => '1',
						'data' => $data['supportID'],
						'status' => '1',
                        'creationDate' => date('Y-m-d H:i:s')
					);

					$insertNotification = $db->insert('Notifications')->set($notificationData);

					if ($readSettings['supportWebhook']==1):

                	    $supportWebhook = json_decode(base64_decode($readSettings['supportWebhookData']), true);

                	    $panelURL = site_url()."/panel";

                	    $supportWebhook['username'] = $readUser['username'];

                        $supportWebhook['content'] = str_replace("%username%", $readUser['username'], $supportWebhook['content']);

                        $supportWebhook['description'] = str_replace("%username%", $readUser['username'], $supportWebhook['description']);

                        $supportWebhook['content'] = str_replace("%panelurl%", $panelURL, $supportWebhook['content']);

                        $supportWebhook['description'] = str_replace("%panelurl%", $panelURL, $supportWebhook['description']);

                        webhook($supportWebhook);

                	endif;

				    $response = alert('success', 'Mesajınız başarıyla gönderildi.');

				else:

				    $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			else:

				$response = alert('danger', 'Hata! Destek sistemimizden yasaklanmışsınız. <br>Bitiş Tarihi:'.$remainingTime.'<br>Nedeni : '.$reason);

			endif;

        else:

            $response = alert('danger', 'Lütfen boş alan bırakmayınız');

        endif;

    endif;

	$totalTickets = $db->from('SupportTickets')->join('Users', 'Users.id = SupportTickets.accID')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->join('Servers', 'Servers.id = SupportTickets.serverID')->where('SupportTickets.id', $action[2])->where('accID', $readUser['id'])->select('count(*) as total')->total();

    if($totalTickets > 0):

        $readTicket = $db->from('SupportTickets')
        				->where('SupportTickets.accID', $readUser['id'])
        				->where('SupportTickets.id', $action[2])
        				->where('SupportTickets.status', '5', '!=')
        				->join('Users', 'Users.id = SupportTickets.accID')
        				->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
        				->join('Servers', 'Servers.id = SupportTickets.serverID')
        				->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, SupportTickets.creationDate as creationDate, Servers.heading as serverName')
        				->first();

        $message = $db->from('SupportMessages')
        			->where('supportID', $readTicket['id'])
        			->join('Users', 'Users.id = SupportMessages.accID')
        			->select('Users.username, Users.realname, SupportMessages.message, SupportMessages.creationDate, Users.id')
        			->orderBy('SupportMessages.id', 'ASC')
        			->all();

    endif;

elseif (isset($action[1]) && $action[1]=="talep-olustur"):

	if ($_POST):
	
	    if (!empty($_POST['heading']) && !empty($_POST['serverID']) && !empty($_POST['categoryID']) && !empty($_POST['message'])):

			$data = array(
			    'accID' => $readUser['id'],
			    'heading' => post('heading'),
			    'serverID' => post('serverID'),
			    'categoryID' => post('categoryID'),
			    'creationDate' => date('Y-m-d H:i:s'),
			    'updateDate' => date('Y-m-d H:i:s')
			);

			if ($checkBanned['total'] < 1):

				$insertTickets = $db->insert('SupportTickets')
			    ->set($data);

				$ticketID = $db->lastInsertId();

				if ($insertTickets):

				    $messageData = array(
				        'accID' => $readUser['id'],
				        'supportID' => $ticketID,
				        'message' => post('message'),
                		'creationDate' => date('Y-m-d H:i:s')
				    );

				    $insertMessage = $db->insert('SupportMessages')
				    ->set($messageData);

				    if ($insertMessage):

						$notificationData = array(
							'accID' => $readUser['id'],
							'type' => '1',
							'data' => $messageData['supportID'],
							'status' => '1',
                            'creationDate' => date('Y-m-d H:i:s')
						);

						$insertNotification = $db->insert('Notifications')->set($notificationData);

						if ($readSettings['supportWebhook']==1):

                		    $supportWebhook = json_decode(base64_decode($readSettings['supportWebhookData']), true);

                		    $panelURL = site_url()."/panel";

                		    $supportWebhook['username'] = $readUser['username'];

                		    $supportWebhook['content'] = str_replace("%username%", $readUser['username'], $supportWebhook['content']);

                		    $supportWebhook['description'] = str_replace("%username%", $readUser['username'], $supportWebhook['description']);

                		    $supportWebhook['content'] = str_replace("%panelurl%", $panelURL, $supportWebhook['content']);

                		    $supportWebhook['description'] = str_replace("%panelurl%", $panelURL, $supportWebhook['description']);

                		    webhook($supportWebhook);

                		endif;

				        $response = alert('success', 'Mesajınız başarıyla gönderilmiştir en kısa sürede yanıtlanacaktır.');

				    else:

				        $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

				    endif;

				else:

				    $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			else:
			
				$response = alert('danger', 'Hata! Destek sistemimizden yasaklanmışsınız. Bitiş Tarihi:'.$remainingTime);
			
			endif;

    	else:

        	$response = alert('danger', 'Lütfen boş alan bırakmayınız');

    	endif;

	endif;

	$totalCategory = $db->from('SupportCategory')->select('count(*) as total')->total();
	
	    if ($totalCategory > 0):
	    
	        $category = $db->from('SupportCategory')->all();
	
	    endif;

	$totalServers = $db->from('Servers')->select('count(*) as total')->total();
	
	    if ($totalServers > 0):
	
	        $servers = $db->from('Servers')->all();
	
	    endif;

endif;

require $realPath . '/view/supports.php';