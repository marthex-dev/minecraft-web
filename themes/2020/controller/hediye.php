<?php

if ($_POST):
	
	if (!empty(post('coupon'))):
		
		$readCoupon = $db->from('Gifts')->where('heading', post('coupon'))->select('count(*) as total, Gifts.*')->first();

		if ($readCoupon['total'] > 0):

			$readHistory = $db->from('GiftHistory')->where('accID', $readUser['id'])->where('giftID', $readCoupon['id'])->select('count(*) as total, GiftHistory.*')->first();

			if ($readHistory['total'] < 1):

				if ($readCoupon['giftTime'] == 1):

					if ($readCoupon['giftExpiry'] > date('Y-m-d')):
						
						$time = true;

					else:

						$time = false;

					endif;

				else:

					$time = true;

				endif;

				if ($time == true):
					
					if ($readCoupon['amountType']==1):
						
						if ($readCoupon['amount'] >= 1):
							
							$amount = true;

						else:

							$amount = false;

						endif;

					else:

						$amount = true;

					endif;

					if ($amount == true):
						
						if ($readCoupon['giftType']==0):
							
							$newCredit = $readUser['credit'] + $readCoupon['credit'];

							$addAward = $db->update('Users')->where('id', $readUser['id'])->set(array('credit' => $newCredit));

							$award = $readCoupon['credit'];

						elseif ($readCoupon['giftType']==1):

							$chestData = array(
				            	'accID' => $readUser['id'],
				            	'productID' => $readCoupon['productID'],
				            	'status' => '1',
				            	'creationDate' => date('Y-m-d H:i:s')
				            );

				            $addAward = $db->insert('Chests')->set($chestData);

				            $award = $readCoupon['productID'];

						endif;

						if ($addAward):
								
							$data = array(
								'accID' => $readUser['id'],
								'giftID' => $readCoupon['id'],
								'type' => $readCoupon['giftType'],
								'award' => $award,
								'creationDate' => date('Y-m-d H:i:s')
							);

							$insertHistory = $db->insert('GiftHistory')->set($data);

							if ($insertHistory):

								if ($readCoupon['amountType']==1):

									$amountCoupon = $readCoupon['amount'] - 1;
									
									$updateCoupon = $db->update('Gifts')->where('id', $readCoupon['id'])->set(array('amount' => $amountCoupon));

								endif;
								
								$response = alert('success', 'Hediye başarıyla eklendi.');

							else:

								$response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

							endif;

						else:

							$response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

						endif;

					else:

						$response = alert('danger', 'Hata! Kullanım limitine ulaşılmış.');

					endif;

				else:

						$response = alert('danger', 'Hata! Kullanım tarihi dolmuş.');

				endif;

			else:

				$response = alert('danger', 'Hata! Kupon daha önce kullanılmış.');

			endif;

		else:

			$response = alert('danger', 'Hata! Kupon kodu bulunamadı.');

		endif;

	else:

		$response = alert('danger', 'Hata! Lütfen boş alan bırakmayınız.');

	endif;

endif;

$totalHistory = $db->from('GiftHistory')->join('Users', 'Users.id = GiftHistory.accID')->join('Gifts', 'Gifts.id = GiftHistory.giftID')->where('accID', $readUser['id'])->select('count(*) as total')->total();

if ($totalHistory > 0):

	$giftHistory = $db->from('GiftHistory')
					  ->join('Users', 'Users.id = GiftHistory.accID')
					  ->join('Gifts', 'Gifts.id = GiftHistory.giftID')
					  ->select('Users.username, Users.realname, Gifts.heading, GiftHistory.creationDate')
					  ->where('Users.id', $readUser['id'])
					  ->all();

endif;

require $realPath . '/view/gift.php';