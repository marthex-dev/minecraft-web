<?php

require '../connect.php';

if (isset($_GET['api']) && $_GET['api'] == "son-kredi-yukleyenler"):

	if (isset($_GET['limit'])):

		$limit = $_GET['limit'];

	else:

		$limit = "5";

	endif;

	$totalCreditHistory = $db->from('CreditHistory')->join('Users', 'Users.id = CreditHistory.accID')->where('type', '3')->where('paymentStatus', '1')->or_where('type', '4')->where('paymentStatus', '1')->or_where('type', '5')->where('paymentStatus', '1')->select('count(*) as total')->total();

	if ($totalCreditHistory > 0):
    
    	$creditHistory = $db->from('CreditHistory')->where('type', '3')->where('paymentStatus', '1')->or_where('type', '4')->where('paymentStatus', '1')->or_where('type', '5')->where('paymentStatus', '1')->join('Users', 'Users.id = CreditHistory.accID')->select('Users.username, CreditHistory.price, CreditHistory.type')->orderby('CreditHistory.id', 'desc')->limit(0, $limit)->all();

    	$creditHistoryData = array();

    	foreach ($creditHistory as $key => $readCreditHistory):

    		$creditHistoryData[$key] = array(
    			'username' => $readCreditHistory['username'],
    			'price' => $readCreditHistory['price'] 
    		);

    	endforeach;

    	print_r(json_encode($creditHistoryData));

    else:

    	die(false);

   	endif;

elseif (isset($_GET['api']) && $_GET['api'] == "magaza-kullanimi"):

	if (isset($_GET['limit'])):

		$limit = $_GET['limit'];

	else:

		$limit = "5";

	endif;

	$totalStoreHistory = $db->from('StoreHistory')->join('Servers', 'Servers.id = StoreHistory.serverID')->join('Products', 'Products.id = StoreHistory.productID')->join('Users', 'Users.id = StoreHistory.accID')->select('count(*) as total')->total();

	if ($totalStoreHistory > 0):

    	$storeHistory = $db->from('StoreHistory')
                			->join('Users', 'Users.id = StoreHistory.accID')
                			->join('Products', 'Products.id = StoreHistory.productID')
                			->join('Servers', 'Servers.id = StoreHistory.serverID')
                			->select('Users.username, Servers.heading as serverName, Products.heading')
                			->orderby('StoreHistory.id', 'desc')
                			->limit(0, 5)
                			->all();

        $storeHistoryData = array();

        foreach ($storeHistory as $key => $readStoreHistory):

        	$storeHistoryData[$key] = array(
        		'username' => $readStoreHistory['username'],
        		'heading' => $readStoreHistory['heading']
        	);

        endforeach;

        print_r(json_encode($storeHistoryData));

    else:

    	die(false);

    endif;

elseif (isset($_GET['api']) && $_GET['api'] == "oyuncu-kredi" && isset($_GET['username']) && !empty($_GET['username'])):

    $readUser = $db->from('Users')->where('realname', $_GET['username'])->first();

    if ($readUser):

        echo $readUser['credit'];

    else: 

        die(false);

    endif;

endif;