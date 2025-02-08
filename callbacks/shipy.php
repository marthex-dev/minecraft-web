<?php

require '../connect.php';

if(isset($_SERVER["HTTP_CLIENT_IP"])):

	$ip = $_SERVER["HTTP_CLIENT_IP"];

elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])):
	
	$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];

elseif (isset($_SERVER["HTTP_CF_CONNECTING_IP"])):

	$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];

else:

	$ip = $_SERVER["REMOTE_ADDR"];

endif;

if ($ip == "144.91.111.2"):
	
	if (!empty($_POST['returnID']) && !empty($_POST['paymentType']) && !empty($_POST['paymentAmount']) && !empty($_POST['paymentHash']) && !empty($_POST['paymentID']) && !empty($_POST['paymentCurrency'])):
			
		$paymentID = ($_POST['paymentType']=="credit_card")?"4":"5";
		
		$paymentInfo = $db->from('Payments')->where('id', $paymentID)->where('paymentStatus', '1')->select('count(*) as total, Payments.*')->first();

		if ($paymentInfo['total'] > 0):
			
			$hashtr = $_POST["paymentID"] . $_POST["returnID"] . $_POST["paymentType"] . $_POST["paymentAmount"] . $_POST["paymentCurrency"] . $paymentInfo['paymentData'];

			$hashbytes = mb_convert_encoding($hashtr, "ISO-8859-9");

			$hash = base64_encode(sha1($hashbytes, true));

			if ($hash == $_POST['paymentHash']):

				$checkPaymentHistory = $db->from('CreditHistory')->where('paymentStatus', '0')->where('paymentID', $_POST["returnID"])->select('count(*) as total, CreditHistory.*')->first();

				if ($checkPaymentHistory['total'] > 0):

					require '../classes/Pay.class.php';

					$creditData = array(
						'id' => $checkPaymentHistory['id'],
						'price' =>  $_POST["paymentAmount"],
						'paymentStatus' => '1'
					);

					$updateCreditHistory = paying::updateHistory($creditData);

					if ($updateCreditHistory):

						$data = array(
							'accID' => $checkPaymentHistory['accID'],
							'price' => $_POST["paymentAmount"]
						);

						$updateCredit = paying::updateCredit($data);

						if ($updateCredit):

							$notificationData = array(
                        	    'accID' => $data['accID'],
                        	    'type' => '4',
                        	    'data' => $data['price'],
                        	    'status' => '1',
		                        'creationDate' => date('Y-m-d H:i:s')
                        	);

                    		$insertNotification = $db->insert('Notifications')->set($notificationData);

							echo "OK";

						endif;

					endif;

				else:

					exit("Hata!.");

				endif;

			else:

				http_response_code(403);

    			exit(json_encode(array("status"=>"error","message"=>"paymentHash is not vaild.")));

			endif;
		
		else:

			exit("Ödeme Yöntemi Bulunamadı.");

		endif;
		
	else:

		exit("SHIPY: Missing value sent.");

	endif;

else:

	exit("SHIPY: Request sent by wrong IP: " . $ip);

endif;

?>