<?php

	session_start();

    require '../../../connect.php';
    
    require '../helper.php';

    $settings = $db->from('Settings')->where('id', '1')->first();

    $date = date('Y-m-d');

    if ($_SESSION['login']):

    	$user = $db->from('Users')->where('username', $_SESSION['username'])->select('count(*) as total, Users.*')->first();

    	if ($user['total'] > 0): 

    		$product = $db->from('Products')->where('id', post('id'))->select('count(*) as total, Products.*')->first();

            if ($product['total'] > 0): 

                $server = $db->from('Servers')->where('id', $product['serverID'])->select('count(*) as total, Servers.*')->first();

                if ($server['total'] > 0):

                    if ($product['stockStatus']==1):
                        
                        if ($product['stock'] > 0):
                            
                            $stockStatus = 1;

                        else:

                            $stockStatus = 0;

                        endif;

                    else:

                        $stockStatus = 1;

                    endif;

                    if ($stockStatus == 1):

                        if ($product['discount']=="1"):

                            if ($product['discountDuration'] == "1"):

                                if ($product['discountExpiry'] > $date):

                                	$price = $product['discountPrice'];

                                else:

                                	$price = $product['price'];

                                endif;

                            else:

                                $price = $product['discountPrice'];

                            endif;
                            
                        else:

                        	$price = $product['price'];

                        endif;

                        if ($user['credit'] >= $price):
                        
                        	$newCredit = $user['credit'] - $price;

                        	$updateUser = $db->update('Users')
                        					->where('id', $user['id'])
                        					->set([
                        					  'credit' => $newCredit
                        					]);

                        	if ($updateUser):

                                $creditHistoryData = array(
                                    'accID' => $user['id'],
                                    'paymentID' => md5(uniqid(rand(0, 999999))),
                                    'paymentAPI' => '0',
                                    'paymentStatus' => '1',
                                    'type' => '6',
                                    'price' => $price,
                                    'earnings' => '0',
                                    'creationDate' => date('Y-m-d H:i:s')
                                );

                                $insertHistory = $db->insert('CreditHistory')->set($creditHistoryData);

                        		$historyData = array(
                        			'accID' => $user['id'],
                        			'productID' => $product['id'],
                        			'serverID' => $product['serverID'],
                        			'price' => $price,
                                    'creationDate' => date('Y-m-d H:i:s')
                        		);

                        		$insertHistory = $db->insert('StoreHistory')->set($historyData);

                                if ($product['stockStatus']==1):

                                    $stock = $product['stock']-1;
                                    
                                    $updateStock = $db->update('Products')->where('id', $product['id'])->set(['stock' => $stock]);

                                endif;

                                $sales = $product['totalSales']+1;

                                $updateStock = $db->update('Products')->where('id', $product['id'])->set(['totalSales' => $sales]);

                        		$chestData = array(
                        			'accID' => $user['id'],
                        			'productID' => $product['id'],
                        			'status' => '1',
                                    'creationDate' => date('Y-m-d H:i:s')
                        		);

                        		$insertProduct = $db->insert('Chests')->set($chestData);

                        		if ($insertProduct):

                                    $notificationData = array(
                                        'accID' => $user['id'],
                                        'type' => '3',
                                        'data' => $product['heading'],
                                        'status' => '1',
                                        'creationDate' => date('Y-m-d H:i:s')
                                    );

                                    $insertNotification = $db->insert('Notifications')->set($notificationData);

                                    if ($settings['storeWebhook']==1):

                                        $storeWebhook = json_decode(base64_decode($settings['storeWebhookData']), true);

                                        $storeWebhook['username'] = $user['username'];

                                        $storeWebhook['content'] = str_replace("%username%", $user['username'], $storeWebhook['content']);

                                        $storeWebhook['content'] = str_replace("%server%", $server['heading'], $storeWebhook['content']);

                                        $storeWebhook['content'] = str_replace("%product%", $product['heading'], $storeWebhook['content']);

                                        $storeWebhook['description'] = str_replace("%username%", $user['username'], $storeWebhook['description']);

                                        $storeWebhook['description'] = str_replace("%server%", $server['heading'], $storeWebhook['description']);

                                        $storeWebhook['description'] = str_replace("%product%", $product['heading'], $storeWebhook['description']);

                                        webhook($storeWebhook);

                                    endif;

                        			echo alert('success', 'Başarılı! Ürün Sandığınıza eklendi.');
                        			echo "<script>setTimeout(function(){window.location = '/sandik'; }, 1500);</script>";

                        		else:

                        			echo alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

                        		endif;
                        		
                        	else:

                        		echo alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

                        	endif;

                        else:

                        	echo alert('danger', 'Yeterli krediniz bulunmuyor.');

                        endif;

                    else:

                        echo alert('danger', 'Ürün stokları tükenmiş.');

                    endif;

                else:

                	echo alert('danger', 'Sunucu Bulunamadı.');

                endif;

            else:

                echo alert('danger', 'Ürün Bulunamadı.');

            endif;

    	else:

    		echo alert('danger', 'Kullanıcı Bulunamadı.');

    	endif;

    else:

    	echo alert('danger', 'Lütfen giriş yapınız.');

    endif;

?>