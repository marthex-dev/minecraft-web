<?php

if (isset($_SESSION['login']) && $_SESSION['login']) header('Location:' . site_url());

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require realpath('.').'/classes/Exception.class.php';
require realpath('.').'/classes/PHPMailer.class.php';
require realpath('.').'/classes/SMTP.class.php';

if ($readSettings['recaptchaStatus']=="1"):

    $recaptchaData = json_decode(base64_decode($readSettings['recaptchaActive']), true);

    if ($recaptchaData['recoveryRecaptcha']=="on"):

        $externalJS = array('https://www.google.com/recaptcha/api.js');

    endif;

endif;

if ($_POST && !isset($action[1])):

	if (!empty(post('username')) && !empty(post('email'))):

		if ($readSettings['recaptchaStatus']=="1"):

            if ($recaptchaData['recoveryRecaptcha']=="on"):
                
                $secretKey = $readSettings['recaptchaSecretKey'];
                $responseKey = post('g-recaptcha-response');
                $reCaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$responseKey;
                $reCaptchaResponse = file_get_contents($reCaptchaUrl);
                $reCaptchaResponse = json_decode($reCaptchaResponse);
                if ($reCaptchaResponse->success):

                    $reCaptcha = true;

                else:

                    $reCaptcha = false;

                endif;

            else:

                $reCaptcha = true;

            endif;

        else:

            $reCaptcha = true;

        endif;

        if ($reCaptcha == true):

			$userCheck = $db->from('Users')->where('username', post('username'))->where('email', post('email'))->select('count(*) as total, Users.*')->first();

			if ($userCheck['total'] > 0):

				$recoveryKey = md5(uniqid(rand(0, 999999)));

				$cancelKeys = $db->update('PasswordRecovery')->where('accID', $userCheck['id'])->where('status', '1')->set(array('status' => '0'));

				$data = array(
					'accID' => $userCheck['id'],
					'recoveryKey' => $recoveryKey,
					'status' => '1',
					'creationDate' => date('Y-m-d H:i:s')
				);

				$addKey = $db->insert('PasswordRecovery')->set($data);

				if ($addKey):

					$recoveryUrl = site_url().'/sifremi-unuttum/'.$recoveryKey;
				
					$message = str_replace("%username%", $userCheck['username'], $readSettings['smtpTemplate']);

					$message = str_replace("%url%", $recoveryUrl, $message);

					$mailData = array(
					     'serverName' => $readSettings['serverName'],
					     'subject' => $readSettings['serverName'].' | Şifre Yenileme İsteği',
					     'body' => htmlspecialchars_decode($message), 
					 );

					$mailData['address'][0] = array(
					    'username' => $userCheck['username'],
					    'email' => $userCheck['email']
					);
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, 'https://license.ionix.web.tr/insert-mail.php');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($mailData));
					curl_setopt($ch, CURLOPT_REFERER, (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? "https" : "http")."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					curl_exec($ch);
					curl_close($ch);
						
					$response = alert('success', "Şifre yenileme isteği başarıyla gönderildi.");

				else:

					$response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			else:

				$response = alert('danger', 'Kullanıcı Bulunamadı!');

			endif;

		else:

			$response = alert('danger', 'reCaptcha onaylamanız gerekmekte.');

		endif;

	else:

		$response = alert('danger', 'Lütfen boş alan bırakmayınız!');

	endif;

endif;

if (isset($action[1])):
	
	$checkKey = $db->from('PasswordRecovery')->where('recoveryKey', $action[1])->where('status', '1')->select('count(*) as total, PasswordRecovery.*')->first();

	if ($checkKey['total'] > 0):
		
		if ($_POST):
			
			if (!empty(post('password')) && !empty(post('passwordRe'))):
				
				if (post('password') == post('passwordRe')):
					
					if ($readSettings['encryptionMethod']==0):

                        $data['password'] = createSHA256(post('password'));

                    elseif($readSettings['encryptionMethod']==1):

                        $data['password'] = md5(post('password'));

                    endif;

                    $updatePassword = $db->update('Users')->where('id', $checkKey['accID'])->set($data);

                    if ($updatePassword):
                    	
                    	$updateKey = $db->update('PasswordRecovery')->where('id', $checkKey['id'])->set(array('status' => '0'));

                    	if ($updateKey):

                    		$deleteSessions = $db->delete('Sessions')->where('accID', $checkKey['accID'])->done();
                    		
                    		$response = alert('success', 'Başarılı! Şifreniz başarıyla güncellendi.');

                    		header('Location:' . site_url() . '/giris-yap');

                    	else:

                    		$response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

                    	endif;

                    else:

                    	$response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

                    endif;

				else:

					$response = alert('danger', 'Girilen şifreler uyuşmuyor!');

				endif;

			else:

				$response = alert('danger', 'Lütfen boş alan bırakmayınız!');

			endif;

		endif;

	else:

		header('Location:' . site_url() . '/giris-yap');

	endif;

endif;

require $realPath . '/view/recovery.php';