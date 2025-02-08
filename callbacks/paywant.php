<?php

require '../connect.php';

if ($_POST):

	$SiparisID 		= $_POST["SiparisID"];
	$ExtraData		= $_POST["ExtraData"];
	$UserID			= $_POST["UserID"];
	$ReturnData		= $_POST["ReturnData"];
	$Status			= $_POST["Status"];
	$OdemeKanali	= $_POST["OdemeKanali"];
	$OdemeTutari	= $_POST["OdemeTutari"];
	$NetKazanc		= $_POST["NetKazanc"];
	$Hash 			= $_POST["Hash"];

	if (!empty($SiparisID) || !empty($ExtraData) || !empty($UserID) || !empty($ReturnData) || !empty($Status) || !empty($OdemeKanali) || !empty($OdemeTutari) || !empty($NetKazanc) || !empty($Hash)):

		$checkPaymentHistory = $db->from('CreditHistory')->where('paymentStatus', '0')->where('paymentID', $ReturnData)->select('count(*) as total, CreditHistory.*')->first();

		if ($checkPaymentHistory['total'] > 0):
		    
		    $paymentInfo = $db->from('Payments')->where('id', $checkPaymentHistory['paymentAPI'])->where('paymentStatus', '1')->select('count(*) as total, Payments.*')->first();

			if ($paymentInfo['total'] > 0):
				
				$paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);
				
				$hashKontrol = base64_encode(hash_hmac('sha256',"$SiparisID|$ExtraData|$UserID|$ReturnData|$Status|$OdemeKanali|$OdemeTutari|$NetKazanc".$paymentData['apiKey'], $paymentData['apiSecretKey'], true));

				if ($Hash == $hashKontrol):
					
					require '../classes/Pay.class.php';

					if ($OdemeKanali == 1):

						$paymentType = "5";

					elseif ($OdemeKanali == 2):

						$paymentType = "4";

					elseif ($OdemeKanali == 3):

						$paymentType = "3";

					endif;

					$creditData = array(
						'id' => $checkPaymentHistory['id'],
						'price' => $checkPaymentHistory['price'],
						'type' => $paymentType,
						'paymentStatus' => '1'
					);

					$updateCreditHistory = paying::updateHistory($creditData);

					if ($updateCreditHistory):

						$data = array(
							'accID' => $checkPaymentHistory['accID'],
							'price' => $checkPaymentHistory['price']
						);

						$updateCredit = paying::updateCredit($data);

						if ($updateCredit):

							$notificationData = array(
		     	                'accID' => $checkPaymentHistory['accID'],
		     	                'type' => '4',
		     	                'data' => $checkPaymentHistory['price'],
		     	                'status' => '1',
		                        'creationDate' => date('Y-m-d H:i:s')
		     	            );

		     	            $insertNotification = $db->insert('Notifications')->set($notificationData);

							echo "OK";
							exit;

						endif;

					endif;

				else:

					exit("Eksik veri var! Lütfen sitemizi kurcalamayı bırakın...");

				endif;

			else:

				exit("Eksik veri var! Lütfen sitemizi kurcalamayı bırakın...");

			endif;

		else:

			exit("Eksik veri var! Lütfen sitemizi kurcalamayı bırakın...");

		endif;

	else:

		exit("Eksik veri var! Lütfen sitemizi kurcalamayı bırakın...");

	endif;

endif;