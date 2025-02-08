<?php

session_start();

require '../../../connect.php';

require '../helper.php';

if ($_SESSION['login']):

	if (!empty(post('id'))):
	
		$readCase = $db->from('Cases')->where('id', post('id'))->select('count(*) as total, Cases.*')->first();

		if ($readCase['total'] > 0):
			
			$userCheck = $db->from('Users')->where('username', $_SESSION['username'])->select('count(*) as total, Users.*')->first();

			if ($userCheck['total'] > 0):

				if ($readCase['priceStatus']==1):
						
					if ($userCheck['credit'] >= $readCase['casePrice']):

						$newCredit = $userCheck['credit'] - $readCase['casePrice'];

						$updateCredit = $db->update('Users')->where('id', $userCheck['id'])->set(array('credit' => $newCredit));

						$historyData = array(
							'accID' => $userCheck['id'],
							'paymentID' => md5(uniqid(rand(0, 999999))),
							'paymentAPI' => '0',
							'paymentStatus' => '1',
							'type' => '7',
							'price' => $readCase['casePrice'],
							'earnings' => '0',
							'creationDate' => date('Y-m-d H:i:s')
						);

						$insertHistory = $db->insert('CreditHistory')->set($historyData);

						if ($updateCredit):
							
							$case = true;

						else:

							echo 8;
							exit;

						endif;

					else:

						$case = false;

						echo 7;
						exit;

					endif;

				elseif ($readCase['priceStatus']==0):

					$caseCheck = $db->from('CasesHistory')->select('count(*) as total, CasesHistory.*')->where('accID', $userCheck['id'])->where('expiryDate', date('Y-m-d H:i:s'), '>')->first();

					if ($caseCheck['total'] < 1):
						
						$case = true;

					else: 

						echo 6;
						exit;

					endif;

				endif;

				if ($case == true):

					$array = json_decode(base64_decode($readCase['caseContent']), true);
					
					$deger = rand(1, 100);
					
					foreach ($array as $key => $readArray):
					
					    if ($key==0):
					
					        $toplamDeger = $readArray['chance'];
					        
					        $oncekiDeger = 0;
					
					    else:
					
					        $toplamDeger = $toplamDeger + $readArray['chance'];
					
					        $oncekiDeger = $toplamDeger - $readArray['chance'];
					
					    endif;
					
					    
					    if($deger <= $toplamDeger && $deger > $oncekiDeger){
					
					        $lotteryKey = $key;
					
					    }
					    
					endforeach;

					$award = $array[$lotteryKey];

					$awardUser = $db->from('Users')->where('username', $_SESSION['username'])->select('count(*) as total, Users.*')->first();

					if ($award['type'] == 0):

						$newCredit = $awardUser['credit'] + $award['award'];

						$updateCredit = $db->update('Users')->where('id', $userCheck['id'])->set(array('credit' => $newCredit));

						if ($updateCredit):

							$awardStatus = true;

							$awardsWon = $award['award']." Kredi";

						?>

						<div class="col-md-6 text-center">
							<div class="card-info position-relative text-center mb-3">
		    					
		    					<a href="javascript:;">
		                            <img src="<?=$find_read_page?>gold.png" class="img-fluid rounded">
		                        </a>
		    					
		                        <hr>

		    					<span class="card-heading"><?=$award['award']?> Kredi</span>
		    					
							</div>

							<button onclick="ajaxCase('<?=$readCase['id']?>')" class="btn btn-1">Tekrar Aç</button>

						</div>

						<?php

						else:

							$awardStatus = false;

						endif;

					elseif ($award['type'] == 1):

						$data = array(
							'accID' => $awardUser['id'],
							'productID' => $award['award'],
							'status' => '1',
							'creationDate' => date('Y-m-d H:i:s')
						);

						$insertChest = $db->insert('Chests')->set($data);

						if ($insertChest):

							$readProducts = $db->from('Products')->where('serverID', $readCase['serverID'])->where('id', $award['award'])->select('count(*) as total, Products.*')->first();

							if ($readProducts['total'] > 0):

							$awardStatus = true;

							$awardsWon = $readProducts['heading'];

						?>

						<div class="col-md-6 text-center">
							<div class="card-info position-relative text-center mb-3">
		    					
		    					<a href="javascript:;">
		                            <img style="max-height: 175px;" src="<?=$find_read_page.$readProducts['image']?>" class="img-fluid rounded">
		                        </a>
		    					
		                        <hr>

		    					<span class="card-heading"><?=$readProducts['heading']?></span>
		    					
							</div>

							<button onclick="ajaxCase('<?=$readCase['id']?>')" class="btn btn-1">Tekrar Aç</button>

						</div>

						<?php

							endif;

						else:

							$awardStatus = false;

						endif;

					elseif ($award['type'] == 2):

						$awardStatus = true;

						$awardsWon = "PAS";

					?>

					<div class="col-md-6 text-center">
						<div class="card-info position-relative text-center mb-3">
		    				
		    				<a href="javascript:;">
		                        <img src="<?=$find_read_page?>pas.png" class="img-fluid rounded">
		                    </a>
		    				
		                    <hr>

		    				<span class="card-heading">Hiçlik (Pas)</span>
		    				
						</div>

						<button onclick="ajaxCase('<?=$readCase['id']?>')" class="btn btn-1">Tekrar Aç</button>

					</div>

					<?php

					endif;

					if ($awardStatus == true):

						$readSettings = $db->from('Settings')->where('id', '1')->first();

						if ($readSettings['caseWebhook']==1):

                		    $caseWebhook = json_decode(base64_decode($readSettings['caseWebhookData']), true);

                		    $caseWebhook['username'] = $userCheck['username'];

                            $caseWebhook['content'] = str_replace("%username%", $caseWebhook['username'], $caseWebhook['content']);

                            $caseWebhook['content'] = str_replace("%case%", $readCase['heading'], $caseWebhook['content']);

                            $caseWebhook['description'] = str_replace("%username%", $userCheck['username'], $caseWebhook['description']);

                            $caseWebhook['description'] = str_replace("%case%", $readCase['heading'], $caseWebhook['description']);

                            $caseWebhook['content'] = str_replace("%award%", $awardsWon, $caseWebhook['content']);

                            $caseWebhook['description'] = str_replace("%award%", $awardsWon, $caseWebhook['description']);

                            webhook($caseWebhook);

                		endif;
						
						$historyData = array(
							'accID' => $userCheck['id'],
							'caseID' => $readCase['id'],
							'award' => $award['award'],
							'type' => $award['type'],
							'creationDate' => date('Y-m-d H:i:s')
						);

						if ($readCase['priceStatus']==0):
							
							$historyData['expiryDate'] = date('Y-m-d H:i:s', strtotime('+'.$readCase['caseDuration'].' hours'));

						endif;

						$insertCaseHistory = $db->insert('CasesHistory')->set($historyData);

					else:

						echo 4;

					endif;

				endif;

			else:

				echo 3;
				exit;

			endif;

		else:

			echo 2;
			exit;

		endif;

	else:

		echo 1;
		exit;

	endif;

endif;