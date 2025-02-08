<?php

if (!$_SESSION['login']) header('Location:' . site_url() . '/giris-yap');

if (isset($action[2]) && $action[2]=="basarili"):

	$response = alert('success', 'Kredi başarıyla yüklendi.');

elseif (isset($action[2]) && $action[2]=="basarisiz"):

	$response = alert('danger', 'Kredi yüklenirken hata oluştu.');

endif;

if (isset($action[1]) && $action[1]=="yukle"):

	if ($_POST):

		if (!empty($readUser['email']) && !empty($readUser['username']) && $readUser['email'] != "player@email.com"):
	    
			if (!empty(post('credit')) && !empty(post('apiType')) && is_numeric(post('credit'))):

				if ($readSettings['minimumPayCredit'] <= post('credit') && $readSettings['maximumPayCredit'] >= post('credit')):

					$payments = $db->from('Payments')->where('id', post('apiType'))->where('paymentStatus', '1')->select('count(*) as total, Payments.*')->first();
					
					if (post('apiType') == 1 && $payments['total'] > 0):
					    
					    header('Location:' . site_url() . '/odeme/eft');

					elseif (post('apiType') == 2 && $payments['total'] > 0):

						header('Location:' . site_url() . '/odeme/ininal');

					elseif (post('apiType') == 3 && $payments['total'] > 0):

						header('Location:' . site_url() . '/odeme/papara');

					elseif (post('apiType') == 4 && $payments['total'] > 0 OR post('apiType') == 5 && $payments['total'] > 0):

						$merchantOID = md5(uniqid(rand(0, 999999)));

						$fields = array(
							'usrIp' => getIP(),
							'usrName' => $readUser['username'],
							'usrAddress' => 'Mansuroğlu, Ankara Cd. No:81 35030, 35100 Bayraklı/İzmir',
							'usrPhone' => '+90 530 000 00 00',
							'usrEmail' => $readUser['email'],
							'amount' => post('credit'),
							'returnID' => $merchantOID,
							'apiKey' => $payments['paymentData']
						);

			    		if (post('apiType') == 4):

			    			$fields['currency'] = 'TRY';
			    			$fields['pageLang'] = 'TR';
			    			$fields['mailLang'] = 'TR';
			    			$fields['installment'] = '0';

			    		endif;

			    		$data = array(
							'accID' => $readUser['id'],
							'paymentID' => $merchantOID,
							'paymentAPI' => $payments['id'],
							'paymentStatus' => '0',
							'price' => post('credit'),
							'earnings' => '0'
						);

						$data['type'] = ($_POST['apiType']=="4")?"4":"5";

			    		$postvars = http_build_query($fields);
						$ch = curl_init();

						if (post('apiType')==4):

							$cURL = "https://api.shipy.dev/pay/credit_card";

						else:

							$cURL = "https://api.shipy.dev/pay/mobile";

						endif;
						
						curl_setopt_array($ch, array(
						    CURLOPT_URL => $cURL,
						    CURLOPT_RETURNTRANSFER => true,
						    CURLOPT_ENCODING => "",
						    CURLOPT_MAXREDIRS => 10,
						    CURLOPT_TIMEOUT => 30,
						    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						    CURLOPT_CUSTOMREQUEST => "POST",
						    CURLOPT_POSTFIELDS => http_build_query($fields),
						));
						
						$result = curl_exec($ch);

					elseif (post('apiType') == 6 && $payments['total'] > 0):

						$paymentData = json_decode(base64_decode($payments['paymentData']), true);

						$merchantID 	= $paymentData['merchantID'];
						$merchantKey 	= $paymentData['merchantKey'];
						$merchantSalt	= $paymentData['merchantSalt'];
						$merchantOID 	= md5(uniqid(rand(0, 999999)));
						$merchantOK  	= site_url()."/kredi/yukle/basarili";
						$merchantFail 	= site_url()."/kredi/yukle/basarisiz";

						$credit = post('credit')*100;

						$data = array(
							'accID' => $readUser['id'],
							'paymentID' => $merchantOID,
							'paymentAPI' => $payments['id'],
							'type' => "4",
							'paymentStatus' => '0',
							'price' => post('credit'),
							'earnings' => '0'
						);

						$userBasket = base64_encode(json_encode(array(
							array("Müşteri Kredi", post('credit'), 1)
						)));

						$hashStr = $merchantID . getIP() . $merchantOID . $readUser['email'] . $credit .$userBasket . "0" . "0" . "TL" . "0";

						$paytrToken = base64_encode(hash_hmac('sha256', $hashStr.$merchantSalt, $merchantKey, true));

						$postValue = array(
							'merchant_id'		=>	$merchantID,
							'user_ip'			=>	getIP(),
							'merchant_oid'		=>	$merchantOID,
							'email'				=>	$readUser['email'],
							'payment_amount'	=>	$credit,
							'paytr_token'		=>	$paytrToken,
							'user_basket'		=>	$userBasket,
							'debug_on'			=>	'0',
							'no_installment'	=>	'0',
							'max_installment'	=>	'0',
							'user_name'			=>	$readUser['username'],
							'user_address'		=>	'Mansuroğlu, Ankara Cd. No:81 35030, 35100 Bayraklı/İzmir',
							'user_phone'		=>	'+90 530 000 00 00',
							'merchant_ok_url'	=>	$merchantOK,
							'merchant_fail_url'	=>	$merchantFail,
							'timeout_limit'		=>	'30',
							'currency'			=>	'TL',
							'test_mode'			=>	'0'
						);
						
						$ch=curl_init();
						curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, 1) ;
						curl_setopt($ch, CURLOPT_POSTFIELDS, $postValue);
						curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
						curl_setopt($ch, CURLOPT_TIMEOUT, 20);

						$result = @curl_exec($ch);

						if(curl_errno($ch)):
			
							die("PAYTR IFRAME connection error. err:".curl_error($ch));

						endif;

						curl_close($ch);

						$result = json_decode($result, 1);
			
						if($result['status']=='success'):

							$token = $result['token'];
						
						else:
			
							die("PAYTR IFRAME failed. reason:".$result['reason']);

						endif;

					elseif (post('apiType') == 7 && $payments['total'] > 0 OR post('apiType') == 8 && $payments['total'] > 0):

						$paymentData = json_decode(base64_decode($payments['paymentData']), true);
						$callbackURL = site_url()."/callbacks/keyubu.php";
						$merchantOID = md5(uniqid(rand(0, 999999)));

						$data = array(
							'accID' => $readUser['id'],
							'paymentID' => $merchantOID,
							'paymentAPI' => $payments['id'],
							'paymentStatus' => '0',
							'price' => post('credit'),
							'earnings' => '0'
						);

						$data['type'] = ($_POST['apiType']=="7")?"4":"5";

						$postValue = array(
						    'odemeID'   => $paymentData['paymentID'],
						    'user_ip'   => getIP(),
						    'amount'    => post('credit'),
						    'return_id' => $merchantOID,
						    'method'    => (post('apiType')==7)?"1":"2",
						    'callback'  => $callbackURL,
						    'test_mode' => 0,
						);

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, 'https://musteri.keyubu.com/gateway/odeme.php');
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $postValue);
						curl_setopt($ch, CURLOPT_REFERER, (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
						curl_setopt($ch, CURLOPT_TIMEOUT, 10);
						$result = curl_exec($ch);
						$result = json_decode($result,1);
						if ($result === false) { 
						    echo 'Keyubu Bağlantı Hatası: ' . curl_error($ch); 
						    exit;
						}
						curl_close($ch);

					elseif (post('apiType') == 9 && $payments['total'] > 0 OR post('apiType') == 10 && $payments['total'] > 0):

						$paymentData = json_decode(base64_decode($payments['paymentData']), true);
						$merchantOID = md5(uniqid(rand(0, 999999)));
						$merchantURL = site_url().'/callbacks/rabisu.php';
						$merchantOK = site_url().'/kredi/yukle/basarili';
						$merchantFail = site_url().'/kredi/yukle/basarisiz';

						$data = array(
							'accID' => $readUser['id'],
							'paymentID' => $merchantOID,
							'paymentAPI' => $payments['id'],
							'paymentStatus' => '0',
							'price' => post('credit'),
							'earnings' => '0'
						);

						$data['type'] = ($_POST['apiType']=="9")?"4":"5";

						$postValue = array(
							'oyuncu_adi' 	=> $merchantOID,
							'basarili_url' 	=> $merchantOK,
							'basarisiz_url' => $merchantFail,
							'post_url' 		=> $merchantURL,
							'urun_adi' 		=> post('credit') . " Kredi",
							'bayi_id' 		=> $paymentData['paymentID'],
							'fiyat' 		=> post('credit'),
						);

						$postValue['yontem'] = ($_POST['apiType']=="9")?"kart":"mobil";

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, 'https://odeme.rabisu.com/odeme.php');
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $postValue);
						curl_setopt($ch, CURLOPT_REFERER, (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
						curl_setopt($ch, CURLOPT_TIMEOUT, 10);

						$result = curl_exec($ch);

						if ($result === false) { 
						    echo 'Rabisu Bağlantı Hatası: ' . curl_error($ch); 
						    exit;
						}

						curl_close($ch);

					elseif (post('apiType') == 11 && $payments['total'] > 0 OR post('apiType') == 12 && $payments['total'] > 0):

						$paymentData = json_decode(base64_decode($payments['paymentData']), true);
						$callbackURL = site_url()."/callbacks/batihost.php";
						$merchantOID = md5(uniqid(rand(0, 999999)));

						$data = array(
							'accID' => $readUser['id'],
							'paymentID' => $merchantOID,
							'paymentAPI' => $payments['id'],
							'paymentStatus' => '0',
							'price' => post('credit'),
							'earnings' => '0'
						);

						$data['type'] = ($_POST['apiType']=="11")?"4":"5";

						$postValue = array(
							'oyuncu'          => $readUser['username'],
			    			'amount'          => post("credit"),
			    			'vipname'         => post("credit").' TL Kredi',
			    			'batihostid'      => $paymentData["paymentID"],
			    			'raporemail'      => $paymentData["paymentMail"],
			    			'odemeolduurl'    => site_url().'/kredi/yukle/basarili',
			    			'odemeolmadiurl'  => site_url().'/kredi/yukle/basarisiz',
			    			'posturl'         => $callbackURL
						);

						if (post('apiType')==12):

							$cURL = 'https://batigame.com/vipgateway/viprec.php';

						else:

							$cURL = 'https://batigame.com/vipgateway/viprec.php';
							$postValue['odemeturu'] = "kredikarti";

						endif;

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $cURL);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $postValue);
						curl_setopt($ch, CURLOPT_REFERER, (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
						curl_setopt($ch, CURLOPT_TIMEOUT, 10);
						$response2 = curl_exec($ch);

						echo $response2;

					elseif (post('apiType') == 13 && $payments['total'] > 0):

						$paymentData = json_decode(base64_decode($payments['paymentData']), true);
						$merchantOID = md5(uniqid(rand(0, 999999)));

						$paymentHash = base64_encode(hash_hmac('sha256',$merchantOID."|".$readUser['email']."|".$readUser['id'].$paymentData['apiKey'], $paymentData['apiSecretKey'], true));

						$data = array(
							'accID' => $readUser['id'],
							'paymentID' => $merchantOID,
							'paymentAPI' => $payments['id'],
							'paymentStatus' => '0',
							'price' => post('credit'),
							'earnings' => '0'
						);

						$postValue = array(
							'apiKey' => $paymentData['apiKey'],
							'hash' => $paymentHash,
							'returnData'=> $merchantOID,
							'userEmail' => $readUser['email'],
							'userIPAddress' => getIP(),
							'userID' => $readUser['id'],
							'proApi' => true,
							'productData' => array(
								'name' => post('credit')." Kredi Yükleme",
								'amount' => post('credit')*100,
								'extraData' => post('credit'),
								'paymentChannel' => "1,2,3",
								'commissionType' => $paymentData['commissionType']
							)
						);

						$cURL = "http://api.paywant.com/gateway.php";

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $cURL);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postValue));
						curl_setopt($ch, CURLOPT_REFERER, (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
						curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			
						$response2 = curl_exec($ch);
						$error = curl_error($ch);
			
						if ($error):

							$response = "cURL Hata #:" . $err;
			
						else:
							
							$jsonDecode = json_decode($response2, false);
							
							if($jsonDecode->Status == 100):

								header("Location:". $jsonDecode->Message); 

							else:
							
								$response = alert('danger', $jsonDecode->Message);
							
							endif;

						endif;

						curl_close($ch);

					elseif (post('apiType') == 14 && $payments['total'] > 0):

						$paymentData = json_decode(base64_decode($payments['paymentData']), true);

						require "classes/Shopier.class.php";

						$merchantOID = md5(uniqid(rand(0, 999999)));

						$shopier = new Shopier($paymentData['apiKey'], $paymentData['apiSecretKey']);

						$amount = post("credit");

						$shopier->setBuyer([
						    'id' => $readUser['id'],
						    'first_name' => $readUser['username'],
						    'last_name' => "-",
						    'email' => $readUser['email'],
						    'phone' => "+90 535 000 00 00"
						]);
						
						$shopier->setOrderBilling([
						    'billing_address'   => "Mansuroğlu, Ankara Cd. No:81 35030, 35100 Bayraklı/İzmir",
						    'billing_city'      => "İzmir",
						    'billing_country'   => "Türkiye",
						    'billing_postcode'  => "35000"
						]);
						
						$shopier->setOrderShipping([
						    'shipping_address'  => "Mansuroğlu, Ankara Cd. No:81 35030, 35100 Bayraklı/İzmir",
						    'shipping_city'     => "İzmir",
						    'shipping_country'  => "Türkiye",
						    'shipping_postcode' => "35000"
						]);

						$data = array(
							'accID' => $readUser['id'],
							'paymentID' => $merchantOID,
							'paymentAPI' => $payments['id'],
							'paymentStatus' => '0',
							'price' => post('credit'),
							'earnings' => '0'
						);

						$callbackURL = site_url()."/callbacks/shopier.php";

					else:
			
					    $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');
			
					endif;

					if(isset($data)):

						$data['creationDate'] = date('Y-m-d H:i:s');
						$addPaymentHistory = $db->insert('CreditHistory')->set($data);

					endif;

					if(post('apiType') == 4 && $payments['total'] > 0 OR post('apiType') == 5 && $payments['total'] > 0):

						if (post('apiType')==4):

							$result = json_decode($result, true);

							if (isset($result['status']) && $result['status'] == "success"):
							    
							    header("Location: ".$result['link']);

							else: 

								if (isset($result['message']) && !empty($result['message'])):

									print("Ödeme işlemi sırasında bir hata oluştu: " . $result["message"]);

								endif;

							endif;

						else:

							print_r($result);

						endif;
						
						curl_close($ch);

					elseif (post('apiType')==6):
						
						echo '<script src="https://www.paytr.com/js/iframeResizer.min.js"></script><iframe src="https://www.paytr.com/odeme/guvenli/'.$token.'" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe><script>iFrameResize({},\'#paytriframe\');</script>';

						exit;

					elseif (post('apiType') == 7 OR post('apiType') == 8):

						header("Location: https://musteri.keyubu.com/gateway/odeme.php?token=".$result['token']);

					elseif (post('apiType') == 9 OR post('apiType') == 10):

						print_r($result);

					elseif (post('apiType') == 14):

						die($shopier->run($merchantOID, $amount, $callbackURL));

					endif;

				else:
			
			    	$response = alert('danger', 'Minimum ('.$readSettings['minimumPayCredit'].') - Maksimum ('.$readSettings['maximumPayCredit'].') Kredi yükleyebilirsiniz.');
			
			    endif;
			
			else:
			
			    $response = alert('danger', 'Lütfen boş alan bırakmayınız.');
			
			endif;

		else:
			
			$response = alert('danger', 'Lütfen E-Posta adresinizi güncelleyiniz.');
			
		endif;
	
	endif;

	$payments = $db->from('Payments')->where('paymentStatus', '1')->all();

elseif (isset($action[1]) && $action[1]=="gonder"):

	if ($_POST):
        
        if (!empty(post('username')) && !empty(post('credit'))):

        	if (post('credit') > 0):

        		$realname = strtolower($_POST['username']);

        		if ($realname != $readUser['realname']):
            
					$userControl = $db->from('Users')->where('username', $realname)->select('count(*) as total, Users.*')->first();

					if ($userControl['total'] > 0):
					    
					    if ($readUser['credit'] >= post('credit')):
					        
					        $newCredit = $readUser['credit'] - post('credit');

					        $updateUser = $db->update('Users')->where('id', $readUser['id'])->set(['credit' => $newCredit]);

					        $senderData = array(
					            'accID' => $readUser['id'],
					            'paymentID' => md5(uniqid(rand(0, 999999))),
					            'paymentAPI' => '0',
					            'paymentStatus' => '1',
					            'type' => '1',
					            'price' => post('credit'),
					            'earnings' => '0',
					            'creationDate' => date('Y-m-d H:i:s')
					        );

					        $insertCreditHistory = $db->insert('CreditHistory')->set($senderData);

					        if ($updateUser):

					        	$userControl = $db->from('Users')->where('username', $realname)->select('count(*) as total, Users.*')->first();

					            $sendNewCredit = $userControl['credit'] + post('credit');
					            
					            $updateSendUser = $db->update('Users')->where('id', $userControl['id'])->set(['credit' => $sendNewCredit]);

					            $sendData = array(
					                'accID' => $userControl['id'],
					                'paymentID' => md5(uniqid(rand(0, 999999))),
					                'paymentAPI' => '0',
					                'paymentStatus' => '1',
					                'type' => '2',
					                'price' => post('credit'),
					                'earnings' => '0'
					            );

					            $insertSendCreditHistory = $db->insert('CreditHistory')->set($sendData);

					            if ($updateSendUser):
					                
					                $response = alert('success', 'Kredi başarıyla gönderildi.');

					            else:

					                $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

					            endif;

					        else:

					            $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

					        endif;

					    else:

					        $response = alert('danger', 'Yeterli krediniz bulunmuyor.');

					    endif;

					else:

					    $response = alert('danger', 'Oyuncu bulunamadı.');

					endif;

				else:

				    $response = alert('danger', 'Kendinize kredi gönderemezsiniz.');

				endif;

			else:

				$response = alert('danger', "Hata! Göndereceğiniz kredi 1'den küçük olamaz.");

			endif;

        else:

            $response = alert('danger', 'Lütfen boş alan bırakmayınız.');

        endif;

    endif;

endif;

require $realPath . '/view/credit.php';