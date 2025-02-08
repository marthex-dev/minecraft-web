<?php

require '../connect.php';

if ($_POST):

	$paymentInfo = $db->from('Payments')->where('id', '6')->where('paymentStatus', '1')->select('count(*) as total, Payments.*')->first();

	if ($paymentInfo['total'] > 0):

		$historyInfo = $db->from('CreditHistory')->where('paymentID', $_POST['merchant_oid'])->where('paymentStatus', '1', '!=')->first();

		if ($historyInfo > 0):

			require '../classes/Pay.class.php';

			$paymentData = json_decode(base64_decode($paymentInfo['paymentData']), true);
			
			$merchantKey 	= $paymentData['merchantKey'];
			$merchantSalt	= $paymentData['merchantSalt'];

			$hash = base64_encode(hash_hmac('sha256', $_POST['merchant_oid'] . $merchantSalt . $_POST['status'] . $_POST['total_amount'], $merchantKey, true));

			if($hash == $_POST['hash']):

				if($_POST['status'] == 'success'):

					$amount = $_POST['payment_amount']/100;

					$creditData = array(
						'id' => $historyInfo['id'],
						'price' => $amount,
						'paymentStatus' => '1'
					);

					$updateCreditHistory = paying::updateHistory($creditData);

					if ($updateCreditHistory):

						$data = array(
							'accID' => $historyInfo['accID'],
							'price' => $amount
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

					$updateCreditHistory = $db->update('CreditHistory')->where('id', $historyInfo['id'])->set('paymentStatus', '2');

					if ($updateCreditHistory):

						echo "OK";

					endif;

				endif;

			else:

				echo "HASH Doğrulanamadı";

			endif;

		else:

			echo "OrderID Hatalı";

		endif;

	else:

		echo "Ödeme Yöntemi Aktif Değil";

	endif;

else:

	echo "POST Bulunamadı";

endif;