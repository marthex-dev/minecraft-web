<?php

session_start();

require '../connect.php';

if (isset($_POST["platform_order_id"]) && isset($_POST["status"]) && isset($_POST["installment"]) && isset($_POST["payment_id"]) && isset($_POST["random_nr"]) && isset($_POST["signature"])):

    $signature  = base64_decode($_POST["signature"]);

	$paymentInfo = $db->from('Payments')->where('id', '14')->where('paymentStatus', '1')->select('count(*) as total, Payments.*')->first();

	$paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);

	if ($paymentInfo['total'] > 0):

		$data       = $_POST["random_nr"].$_POST["platform_order_id"];
		$expected   = hash_hmac('SHA256', $data, $paymentData['apiSecretKey'], true);

		if (strcmp($signature, $expected) == 0):

		    if ($_POST["status"] == 'success'):

		    	$checkPaymentHistory = $db->from('CreditHistory')->where('paymentStatus', '0')->where('paymentID', $_POST["platform_order_id"])->select('count(*) as total, CreditHistory.*')->first();

				if ($checkPaymentHistory['total'] > 0):

		    		require '../classes/Pay.class.php';

					$creditData = array(
						'id' => $checkPaymentHistory['id'],
						'price' => $checkPaymentHistory['price'],
						'paymentStatus' => '1',
						'type' => '4'
					);

					$updateCreditHistory = paying::updateHistory($creditData);

					if ($updateCreditHistory):

						$creditUpdateData = array(
							'accID' => $checkPaymentHistory['accID'],
							'price' => $checkPaymentHistory['price']
						);

						$updateCredit = paying::updateCredit($creditUpdateData);

						if ($updateCredit):

							$notificationData = array(
                        	    'accID' => $creditUpdateData['accID'],
                        	    'type' => '4',
                        	    'data' => $creditUpdateData['price'],
                        	    'status' => '1',
		                        'creationDate' => date('Y-m-d H:i:s')
                        	);

                    		$insertNotification = $db->insert('Notifications')->set($notificationData);

							echo "Success";

							header("Location: /kredi/yukle/basarili");

						else:

							header("Location: /kredi/yukle/basarisiz");

						endif;

					endif;

		    	else:
		        
		            header("Location: /kredi/yukle/basarisiz");

		    	endif;

		    else:
		        
		         header("Location: /kredi/yukle/basarisiz");

		    endif;

		else:
		      
		      header("Location: /kredi/yukle/basarisiz");

		endif;

	else:

        header("Location: /kredi/yukle/basarisiz");

	endif;

else:

    header("Location: /kredi/yukle/basarisiz");

endif;
