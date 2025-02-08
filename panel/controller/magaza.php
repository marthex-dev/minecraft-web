<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Store.class.php';
require realpath('.') . '/classes/ExtraResources.class.php';

if ($action[1]=="ekle" AND $_POST OR $action[1]=="duzenle" AND $_POST):

	require realpath('.') . '/classes/Upload.class.php';
	
	if (!empty(post('heading')) && !empty(post('servers')) && !empty(post('categoryID')) && !empty(post('price'))):
		
		$data = array(
			'heading' => post('heading'),
			'serverID' => post('servers'),
			'categoryID' => post('categoryID'),
			'price' => post('price'),
			'duration' => post('duration'),
			'discountDuration' => post('discountDuration'),
			'content' => htmlspecialchars_decode(post('content')),
			'commands' => base64_encode(json_encode($_POST['commands'])),
			'stockStatus' => post('stockStatus')
		);

		if (post('discount')==1):
			
			$data['discount'] = 1;

			if (!empty(post('discountPrice'))):
				
				$data['discountPrice'] = post('discountPrice');

				if (post('discountDuration')==1):
					
					if (!empty(post('discountExpiry'))):
						
						$data['discountExpiry'] = post('discountExpiry');

					endif;

				endif;

			endif;

		else:

			$data['discount'] = 0;

		endif;

		if (post('duration')==1):

			if (!empty(post('durationDay'))):
				
				$data['durationDay'] = post('durationDay');
				$data['expiryCommands'] = base64_encode(json_encode($_POST['expiryCommands']));

			endif;

		endif;

		if (post('stockStatus')==1):
			
			if (empty(post('stock'))):
				
				$data['stock'] = 0;

			else:

				$data['stock'] = post('stock');

			endif;

		endif;

		if ($_FILES["image"] != null):

			$upload = new Upload($_FILES["image"], "tr_TR");
			$image = md5(uniqid(rand(0, 9999)));
			if ($upload->uploaded):

				$upload->allowed = array("image/*");
				$upload->file_new_name_body = $image;
				$upload->Process($find_read_panel);

            	if ($upload->processed):

                	$image = $image.".".$upload->file_dst_name_ext;

					$data['image'] = $image;

				else:

					$response = alertDanger('Hata! '.$upload->error);

				endif;

			else:

				$response = alertDanger('Hata! '.$upload->error);

			endif;

		endif;

		if ($action[1]=="ekle"):
			
			$addProduct = store::addProducts($data);

			if ($addProduct):
				
				$response = alertSuccess('Ürün başarıyla eklendi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		elseif ($action[1]=="duzenle"):

			$data['id'] = $action[2];

			$editProduct = store::updateProducts($data);

			if ($editProduct):
				
				$response = alertSuccess('Ürün başarıyla güncellendi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

	else:

		$response = alertDanger('Lütfen boş alan bırakmayınız.');

	endif;

endif;

if ($action[1]=="liste"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		$deleteProducts = store::deleteProducts($action[3]);

		if ($deleteProducts):
			
			$response = alertSuccess('Ürün başarıyla silindi.');

		else:

			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		endif;

	endif;

	if ($_POST):
		
		$query = store::getProducts(post('query'));

	else:

		$totalProducts = $db->from('Products')->join('Servers', 'Servers.id = Products.serverID')->join('ProductsCategories', 'ProductsCategories.id = Products.categoryID')->select('count(*) as total')->total();

        if ($totalProducts > 0):

            $totalPage = ceil($totalProducts / "50");

            $pagination = $db->pagination($totalProducts, "50", "limit");

            $query = $db->from('Products')
                        ->join('Servers', 'Servers.id = Products.serverID')
                        ->join('ProductsCategories', 'ProductsCategories.id = Products.categoryID')
                        ->select('Products.*, Servers.heading as serverName, ProductsCategories.heading as CategoryName')
                        ->orderby('Products.id', 'DESC')
                        ->limit($pagination['start'], $pagination['limit'])
                        ->all();

            if (!isset($_GET['limit'])):
        
                $_GET['limit'] = "1";
            
            endif;
            
            $prevPage = $_GET['limit'] - 1;
            
            $nextPage = $_GET['limit'] + 1;

        endif;

	endif;

elseif ($action[1]=="ekle" OR $action[1]=="duzenle"):

	$extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');
    $extraResourcesJS->addResource('assets/js/pages/store.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null})');

    if ($action[1]=="ekle"):
	
		$servers = store::getServers();

		if ($servers):
				
			$categories = store::getCategories($servers[0]['id'], "1");

		endif;

	elseif ($action[1]=="duzenle"):

		$query = store::getProductsInfo($action[2]);

		$servers = store::getServers();

		if ($servers):
				
			$categories = store::getCategories($query['serverID'], "1");

		endif;

	endif;

elseif ($action[1]=="kategori"):

	if($_POST && $action[2]=="duzenle" OR $_POST && $action[2]=="ekle"):

		require realpath('.') . '/classes/Upload.class.php';

		if (!empty(post('heading'))):

		    $slug = convertURL(post('heading'));

		    $query = $db->from('ProductsCategories')->where('slug', $slug)->select('count(id) as total')->total();

		    if($query > 0):

		        $slug = $slug."-".rand(1, 9999);

		    endif;

		    $data = array(
		        'heading' => post('heading'),
		        'serverID' => post('serverID'),
		        'parent' => post('parent'),
		        'slug' => $slug
		    );

		    if ($_FILES["image"] != null):

		        $upload = new Upload($_FILES["image"], "tr_TR");
		        $image = md5(uniqid(rand(0, 9999)));
		        if ($upload->uploaded):

		            $upload->allowed = array("image/*");
		            $upload->file_new_name_body = $image;
		            $upload->Process($find_read_panel);

		            if ($upload->processed):

		                $image = $image.".".$upload->file_dst_name_ext;

		                $data['image'] = $image;

		            else:

		                $response = alertDanger('Hata! '.$upload->error);

		            endif;

		        else:

		            $response = alertDanger('Hata! '.$upload->error);

		        endif;

		    endif;

		    if ($action[2]=="ekle"):

		        $addCategories = store::addCategories($data);

		        if ($addCategories):

		            $response = alertSuccess('Kategori başarıyla eklendi.');

		        else:

		            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		        endif;

		    elseif ($action[2]=="duzenle"):

		        $query = $db->from('ProductsCategories')->where('id', $action[3])->first();

		        if($query['heading'] == post('heading')):

		            $data['slug'] = $query['slug'];

		        endif;

		        $data['id'] = $action[3];

		        $editCategories = store::updateCategories($data);

		        if ($editCategories):

		            $response = alertSuccess('Kategori başarıyla güncellendi.');

		        else:

		            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		        endif;

		    endif;

		else:

		    $response = alertDanger('Lütfen boş alan bırakmayınız');

		endif;

	endif;
	
	if ($action[2]=="ekle"):
		
		$servers = store::getServers();

		if ($servers):
			
			$categories = store::getCategories($servers[0]['id'], "1");

		endif;

	elseif($action[2]=="duzenle"):

		$query = store::getCategories($action[3], "2");

		$servers = store::getServers();
			
		$subCategory=array();

		$subCategory[] = $action[3];

		$notInCategories = $db->from('ProductsCategories')->where('id', $action[3])->all();

		foreach ($notInCategories as $value):
		    subCategory($value['id']);
		endforeach;

		$notInCategory = implode(',', $subCategory);

		$category = $db->from('ProductsCategories')
        ->notIn('id', [$notInCategory])
        ->where('serverID', $query['serverID'])
        ->all();

	elseif ($action[2]=="liste"):

		if (isset($action[3]) && $action[3]=="sil"):
		
			$deleteProductsCategories = store::deleteCategories($action[4]);

			if ($deleteProductsCategories):
				
				$response = alertSuccess('Kategori başarıyla silindi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

		if ($_POST):
			
			$query = store::getCategories(post('query'), '3');

		else:

			$totalCategories = $db->from('ProductsCategories')->join('Servers', 'Servers.id = ProductsCategories.serverID')->select('count(*) as total')->total();

			if ($totalCategories > 0):

			    $totalPage = ceil($totalCategories / "50");

			    $pagination = $db->pagination($totalCategories, "50", "limit");

			    $query = $db->from('ProductsCategories')
                    ->join('Servers', 'Servers.id = ProductsCategories.serverID')
                    ->select('ProductsCategories.*, Servers.heading as serverName, Servers.slug as serverSlug')
                    ->orderby('ProductsCategories.id', 'desc')
                    ->limit($pagination['start'], $pagination['limit'])
                    ->all();

			    if (!isset($_GET['limit'])):
			
			        $_GET['limit'] = "1";
			    
			    endif;
			    
			    $prevPage = $_GET['limit'] - 1;
			    
			    $nextPage = $_GET['limit'] + 1;

			endif;

		endif;

	endif;

elseif ($action[1]=="kredi-gonder"):

	$payments = $db->from('Payments')->all();

	if (isset($action[2])):
		
		$readUser = $db->from('Users')->where('id', $action[2])->select('count(*) as total, Users.*')->first();

	endif;

	if ($_POST):

		$data = array(
			'paymentID' => md5(uniqid(rand(0, 999999))),
			'price' => post('credit'),
			'paymentAPI' => post('paymentApi'),
			'paymentStatus' => '1',
			'earnings' => '0',
    		'creationDate' => date('Y-m-d H:i:s')
		);

		if (isset($readUser) && $readUser['total'] > 0):
			
			$user = $readUser;

		else:

			$user = $db->from('Users')->where('username', post('username'))->select('count(*) as total, Users.*')->first();

		endif;

		if ($user['total'] > 0):
			
			$data['accID'] = $user['id'];

			$payment = $db->from('Payments')->where('id', post('paymentApi'))->select('count(*) as total, Payments.*')->first();

			if ($payment['total'] > 0):
				
				$data['type'] = $payment['paymentType'];

				$insertHistory = $db->insert('CreditHistory')->set($data);

				if ($insertHistory):
					
					$newCredit = $user['credit'] + $data['price'];

					$updateCredit = $db->update('Users')->where('id', $data['accID'])->set('credit', $newCredit);

					if ($updateCredit):
						
						$response = alertSuccess('Kredi başarıyla gönderildi');

					else:

						$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

					endif;

				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			else:

				$response = alertDanger('Ödeme yöntemi bulunamadı');

			endif;

		else:

			$response = alertDanger('Kullanıcı bulunamadı.');

		endif;

	endif;

elseif ($action[1]=="esya-gonder"):

	$extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/js/pages/send-item.js');

	if (isset($action[2])):
		
		$readUser = $db->from('Users')->where('id', $action[2])->select('count(*) as total, Users.*')->first();

	endif;

    if ($_POST):

    	if (isset($action[2])):
		
			$user = $db->from('Users')->where('id', $action[2])->select('count(*) as total, Users.*')->first();

		else:

			$user = $db->from('Users')->where('username', post('username'))->select('count(*) as total, Users.*')->first();

		endif;

    	if ($user['total'] > 0): 

    		$product = $db->from('Products')->where('id', post('productID'))->select('count(*) as total, Products.*')->first();

            if ($product['total'] > 0): 

                $server = $db->from('Servers')->where('id', post('serverID'))->select('count(*) as total, Servers.*')->first();

                if ($server['total'] > 0):

                	$historyData = array(
                    	'accID' => $user['id'],
                    	'productID' => $product['id'],
                    	'serverID' => $product['serverID'],
                    	'price' => $product['price'],
                    	'creationDate' => date('Y-m-d H:i:s')
                    );

                    $insertHistory = $db->insert('StoreHistory')->set($historyData);

                    $chestData = array(
                    	'accID' => $user['id'],
                    	'productID' => $product['id'],
                    	'status' => '1',
                    	'creationDate' => date('Y-m-d H:i:s')
                    );

                    $insertProduct = $db->insert('Chests')->set($chestData);

                    if ($insertProduct):

                        if ($readSettings['storeWebhook']==1):

                            $storeWebhook = json_decode(base64_decode($readSettings['storeWebhookData']), true);

                            $storeWebhook['username'] = $user['username'];

                            $storeWebhook['content'] = str_replace("%username%", $user['username'], $storeWebhook['content']);

                            $storeWebhook['content'] = str_replace("%server%", $server['heading'], $storeWebhook['content']);

                            $storeWebhook['content'] = str_replace("%product%", $product['heading'], $storeWebhook['content']);

                            $storeWebhook['description'] = str_replace("%username%", $user['username'], $storeWebhook['description']);

                            $storeWebhook['description'] = str_replace("%server%", $server['heading'], $storeWebhook['description']);

                            $storeWebhook['description'] = str_replace("%product%", $product['heading'], $storeWebhook['description']);

                            webhook($storeWebhook);

                        endif;

                    	$response = alertSuccess('Başarılı! Ürün gönderildi.');

                    else:

                    	$response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

                    endif;

                else:

                	$response = alertDanger('Sunucu Bulunamadı.');

                endif;

            else:

                $response = alertDanger('Ürün Bulunamadı.');

            endif;

    	else:

    		$response = alertDanger('Kullanıcı Bulunamadı.');

    	endif;

    endif;

	$totalServers = $db->from('Servers')->select('count(*) as total')->total();

	if ($totalServers > 0):
		
		$servers = $db->from('Servers')->all();

	endif;

elseif ($action[1]=="kredi-yukleme-gecmisi" OR $action[1]=="kredi-kullanim-gecmisi"):

	$updateNotifications = $db->update('Notifications')->where('type', '4')->where('status', '1')->set(array('status' => '0'));

	if (isset($action[2]) && $action[2]=="sil"):
		
		$deleteHistory = $db->delete('CreditHistory')->where('id', $action[3])->done();

		if ($deleteHistory):
			
			$response = alertSuccess('Geçmiş başarıyla silindi.');

		else:

			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		endif;

	endif;

	if ($action[1]=="kredi-yukleme-gecmisi"):

		if ($_POST):

			$totalCreditHistory = $db->from('CreditHistory')->join('Payments', 'Payments.id = CreditHistory.PaymentAPI')->join('Users', 'Users.id = CreditHistory.accID')->like('Users.username', post('query'))->where('type', '3')->where('CreditHistory.paymentStatus', '1')->or_where('type', '4')->where('CreditHistory.paymentStatus', '1')->like('Users.username', post('query'))->or_where('type', '5')->where('CreditHistory.paymentStatus', '1')->like('Users.username', post('query'))->select('count(*) as total')->total();

			if ($totalCreditHistory > 0):
			
				$creditHistory = $db->from('CreditHistory')
									->like('Users.username', post('query'))
									->where('type', '3')
									->where('CreditHistory.paymentStatus', '1')
									->or_where('type', '4')
									->where('CreditHistory.paymentStatus', '1')
									->like('Users.username', post('query'))
									->or_where('type', '5')
									->where('CreditHistory.paymentStatus', '1')
									->like('Users.username', post('query'))
									->join('Users', 'Users.id = CreditHistory.accID')
									->join('Payments', 'Payments.id = CreditHistory.PaymentAPI')
									->select('Users.username, Users.id as UserID, CreditHistory.price, CreditHistory.type, CreditHistory.id, CreditHistory.earnings, Payments.heading as PaymentName, CreditHistory.creationDate')
									->orderby('CreditHistory.id', 'desc')
									->all();

			endif;

		else:

			$totalCreditHistory = $db->from('CreditHistory')->join('Users', 'Users.id = CreditHistory.accID')->join('Payments', 'Payments.id = CreditHistory.PaymentAPI')->where('type', '3')->where('CreditHistory.paymentStatus', '1')->or_where('type', '4')->where('CreditHistory.paymentStatus', '1')->or_where('type', '5')->where('CreditHistory.paymentStatus', '1')->select('count(*) as total')->total();

			if ($totalCreditHistory > 0):

			    $totalPage = ceil($totalCreditHistory / "50");

			    $pagination = $db->pagination($totalCreditHistory, "50", "limit");

			    $creditHistory = $db->from('CreditHistory')
									->where('type', '3')
									->where('CreditHistory.paymentStatus', '1')
									->or_where('type', '4')
									->where('CreditHistory.paymentStatus', '1')
									->or_where('type', '5')
									->where('CreditHistory.paymentStatus', '1')
									->join('Users', 'Users.id = CreditHistory.accID')
									->join('Payments', 'Payments.id = CreditHistory.PaymentAPI')
									->select('Users.username, Users.id as UserID, CreditHistory.price, CreditHistory.type, CreditHistory.id, CreditHistory.earnings, Payments.heading as PaymentName, CreditHistory.creationDate')
									->orderby('CreditHistory.id', 'desc')
									->limit($pagination['start'], $pagination['limit'])
									->all();

			    if (!isset($_GET['limit'])):
			
			        $_GET['limit'] = "1";
			    
			    endif;
			    
			    $prevPage = $_GET['limit'] - 1;
			    
			    $nextPage = $_GET['limit'] + 1;

			endif;

		endif;

	elseif ($action[1]=="kredi-kullanim-gecmisi"):

		if ($_POST):

			$totalCreditHistory = $db->from('CreditHistory')->where('type', '3', '!=')->where('type', '4', '!=')->where('type', '5', '!=')->like('Users.username', post('query'))->join('Users', 'Users.id = CreditHistory.accID')->select('count(*) as total')->total();

			if ($totalCreditHistory > 0):
			
				$creditHistory = $db->from('CreditHistory')
									->where('type', '3', '!=')
									->where('type', '4', '!=')
									->where('type', '5', '!=')
									->join('Users', 'Users.id = CreditHistory.accID')
									->select('Users.username, Users.id as UserID, CreditHistory.price, CreditHistory.type, CreditHistory.id, CreditHistory.earnings, CreditHistory.creationDate')
									->orderby('CreditHistory.id', 'desc')
									->all();

			endif;

		else:

			$totalCreditHistory = $db->from('CreditHistory')->join('Users', 'Users.id = CreditHistory.accID')->where('type', '3', '!=')->where('type', '4', '!=')->where('type', '5', '!=')->select('count(*) as total')->total();

			if ($totalCreditHistory > 0):

			    $totalPage = ceil($totalCreditHistory / "50");

			    $pagination = $db->pagination($totalCreditHistory, "50", "limit");

			    $creditHistory = $db->from('CreditHistory')
									->where('type', '3', '!=')
									->where('type', '4', '!=')
									->where('type', '5', '!=')
									->join('Users', 'Users.id = CreditHistory.accID')
									->select('Users.username, Users.id as UserID, CreditHistory.price, CreditHistory.type, CreditHistory.id, CreditHistory.earnings, CreditHistory.creationDate')
									->orderby('CreditHistory.id', 'desc')
									->limit($pagination['start'], $pagination['limit'])
									->all();

			    if (!isset($_GET['limit'])):
			
			        $_GET['limit'] = "1";
			    
			    endif;
			    
			    $prevPage = $_GET['limit'] - 1;
			    
			    $nextPage = $_GET['limit'] + 1;

			endif;

		endif;

   	endif;

elseif ($action[0]=="magaza" && $action[1]=="gecmis"):

	$updateNotifications = $db->update('Notifications')->where('type', '3')->where('status', '1')->set(array('status' => '0'));

	if (isset($action[2]) && $action[2]=="sil"):
		
		$deleteHistory = $db->delete('StoreHistory')->where('id', $action[3])->done();

		if ($deleteHistory):
			
			$response = alertSuccess('Geçmiş başarıyla silindi.');

		else:

			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		endif;

	endif;

	if ($_POST):
		
		$totalStoreHistory = $db->from('StoreHistory')->like('Users.username', post('query'))->join('Users', 'Users.id = StoreHistory.accID')->join('Products', 'Products.id = StoreHistory.productID')->join('Servers', 'Servers.id = StoreHistory.serverID')->select('count(*) as total')->total();

		if ($totalStoreHistory > 0):
		
		    $storeHistory = $db->from('StoreHistory')
		                    ->join('Users', 'Users.id = StoreHistory.accID')
		                    ->join('Products', 'Products.id = StoreHistory.productID')
		                    ->join('Servers', 'Servers.id = StoreHistory.serverID')
		                    ->select('Users.username, StoreHistory.id, Servers.heading as serverName, StoreHistory.price, Products.heading, Users.id as UserID, StoreHistory.creationDate')
		                    ->like('Users.username', post('query'))
		                    ->orderby('StoreHistory.id', 'desc')
		                    ->all();

		endif;

	else:

		$totalStoreHistory = $db->from('StoreHistory')->join('Users', 'Users.id = StoreHistory.accID')->join('Products', 'Products.id = StoreHistory.productID')->join('Servers', 'Servers.id = StoreHistory.serverID')->select('count(*) as total')->total();

		if ($totalStoreHistory > 0):

		    $totalPage = ceil($totalStoreHistory / "50");

		    $pagination = $db->pagination($totalStoreHistory, "50", "limit");

		    $storeHistory = $db->from('StoreHistory')
		                    ->join('Users', 'Users.id = StoreHistory.accID')
		                    ->join('Products', 'Products.id = StoreHistory.productID')
		                    ->join('Servers', 'Servers.id = StoreHistory.serverID')
		                    ->select('Users.username, StoreHistory.id, Servers.heading as serverName, StoreHistory.price, Products.heading, Users.id as UserID, StoreHistory.creationDate')
		                    ->orderby('StoreHistory.id', 'desc')
		                    ->limit($pagination['start'], $pagination['limit'])
		                    ->all();

		    if (!isset($_GET['limit'])):
		
		        $_GET['limit'] = "1";
		    
		    endif;
		    
		    $prevPage = $_GET['limit'] - 1;
		    
		    $nextPage = $_GET['limit'] + 1;

		endif;

	endif;

endif;

require realpath('.') . '/view/store.php';