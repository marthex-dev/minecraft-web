<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/ExtraResources.class.php';
    
$extraResourcesJS = new ExtraResources('js');
$extraResourcesJS->addResource('assets/js/pages/index.js');

$totalStoreHistory = $db->from('StoreHistory')->join('Users', 'Users.id = StoreHistory.accID')->join('Products', 'Products.id = StoreHistory.productID')->join('Servers', 'Servers.id = StoreHistory.serverID')->select('count(*) as total')->total();

if ($totalStoreHistory > 0):
            
    $storeHistory = $db->from('StoreHistory')
                    ->join('Users', 'Users.id = StoreHistory.accID')
                    ->join('Products', 'Products.id = StoreHistory.productID')
                    ->join('Servers', 'Servers.id = StoreHistory.serverID')
                    ->select('Users.username, Servers.heading as serverName, Products.heading, Users.id')
                    ->orderby('StoreHistory.id', 'desc')
                    ->limit(0, 5)
                    ->all();

endif;

$totalCreditHistory = $db->from('CreditHistory')->join('Users', 'Users.id = CreditHistory.accID')->where('type', '3')->where('CreditHistory.paymentStatus', '1')->or_where('type', '4')->where('CreditHistory.paymentStatus', '1')->or_where('type', '5')->where('CreditHistory.paymentStatus', '1')->select('count(*) as total')->total();

if ($totalCreditHistory > 0):
    
    $creditHistory = $db->from('CreditHistory')
    					->where('type', '3')
                        ->where('CreditHistory.paymentStatus', '1')
    					->or_where('type', '4')
                        ->where('CreditHistory.paymentStatus', '1')
    					->or_where('type', '5')
                        ->where('CreditHistory.paymentStatus', '1')
    					->join('Users', 'Users.id = CreditHistory.accID')
    					->select('Users.username, CreditHistory.price, CreditHistory.type, Users.id')
    					->orderby('CreditHistory.id', 'desc')
    					->limit(0, 5)
    					->all();

endif;

require realpath('.') . '/classes/ajax/update.check.php';

require realpath('.') . '/view/index.php';