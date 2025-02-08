<?php

if (!$_SESSION['login']) header('Location:' . site_url() . '/giris-yap');

$externalCSS = array('/'.$realPath.'assets/css/sweetalert.css');

$externalJS = array('/'.$realPath.'assets/js/pages/chest.js', '/'.$realPath.'assets/js/sweetalert.js');

$productExpiryHistory = $db->from('ProductExpiryCommands')->join('Products', 'Products.id = ProductExpiryCommands.productID')->where('accID', $readUser['id'])->where('status', '1')->select('count(*) as total')->total();

if ($productExpiryHistory > 0):
  
  $productExpiry = $db->from('ProductExpiryCommands')
                             ->join('Products', 'Products.id = ProductExpiryCommands.productID')
                             ->join('Servers', 'Servers.id = Products.serverID')
                             ->where('accID', $readUser['id'])
                             ->where('status', '1')
                             ->select('Products.heading, ProductExpiryCommands.expiryDate, ProductExpiryCommands.id, Servers.heading as serverName, ProductExpiryCommands.creationDate, Products.id as pID')
                             ->all();

endif;

$totalChestHistory = $db->from('ChestsHistory')->join('Products', 'Products.id = ChestsHistory.productID')->join('Users', 'Users.id = ChestsHistory.accID')->where('accID', $readUser['id'])->select('count(*) as total')->total();

if ($totalChestHistory > 0):
    
    $chestHistory = $db->from('ChestsHistory')
                       ->join('Products', 'Products.id = ChestsHistory.productID')
                       ->join('Users', 'Users.id = ChestsHistory.accID')
                       ->where('ChestsHistory.accID', $readUser['id'])
                       ->select('Products.heading as ProductName, Users.username, Users.realname, ChestsHistory.type')
                       ->orderby('ChestsHistory.id', 'desc')
                       ->all();

endif;

if (!isset($action[1])):

    if ($totalChest > 0):

        $chest = $db->from('Chests')
                    ->join('Users', 'Users.id = Chests.accID')
                    ->join('Products', 'Products.id = Chests.productID')
                    ->join('Servers', 'Servers.id = Products.serverID')
                    ->where('Chests.accID', $readUser['id'])
                    ->where('Chests.status', '1')
                    ->where('Chests.type', '1')
                    ->select('Users.username, Products.heading as ProductName, Servers.heading as ServerName, Chests.creationDate, Chests.id, Products.duration, Products.durationDay')
                    ->orderby('Chests.id', 'DESC')
                    ->all();

    endif;

    $vipExpiryHistory = $db->from('VipExpiryCommands')->join('Vips', 'Vips.id = VipExpiryCommands.productID')->where('accID', $readUser['id'])->where('status', '1')->select('count(*) as total')->total();

    if ($vipExpiryHistory > 0):
  
        $vipExpiry = $db->from('VipExpiryCommands')
                        ->join('Vips', 'Vips.id = VipExpiryCommands.productID')
                        ->join('Servers', 'Servers.id = Vips.serverID')
                        ->where('accID', $readUser['id'])
                        ->where('status', '1')
                        ->select('Vips.heading, VipExpiryCommands.expiryDate, VipExpiryCommands.id, Servers.heading as serverName, Servers.slug, VipExpiryCommands.creationDate, Vips.id as pID')
                        ->all();

    endif;

    if ($totalVips > 0):

        $vips = $db->from('Chests')
                    ->join('Users', 'Users.id = Chests.accID')
                    ->join('Vips', 'Vips.id = Chests.productID')
                    ->join('Servers', 'Servers.id = Vips.serverID')
                    ->where('Chests.accID', $readUser['id'])
                    ->where('Chests.status', '1')
                    ->where('Chests.type', '2')
                    ->select('Users.username, Vips.heading as ProductName, Servers.heading as ServerName, Chests.creationDate, Chests.id, Vips.duration, Vips.durationDay')
                    ->orderby('Chests.id', 'DESC')
                    ->all();

    endif;
    
elseif (isset($action[1]) && $action[1]=="hediye"):

    if ($totalChest > 0 OR $totalVips > 0):

        $chest = $db->from('Chests')
                    ->join('Users', 'Users.id = Chests.accID')
                    ->where('Chests.accID', $readUser['id'])
                    ->where('Chests.status', '1')
                    ->where('Chests.id', $action[2])
                    ->select('count(*) as total, Users.username, Chests.type, Chests.creationDate, Chests.productID, Chests.id')
                    ->first();

        if ($chest > 0):
            
            if ($chest['type'] == 1):

                $product = $db->from('Products')->where('id', $chest['productID'])->first();     

            else:

                $product = $db->from('Vips')->where('id', $chest['productID'])->first();

            endif;

        endif;

    endif;

endif;

require $realPath . '/view/chest.php';