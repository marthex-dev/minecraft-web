<?php

$externalJS = array('/'.$realPath.'assets/js/pages/store.js');

if (!isset($action[1])):

    $totalServers = $db->from('Servers')->select('count(*) as total')->total();

    if ($totalServers == 1):
        
        $readServer = $db->from('Servers')->first();

        header('Location: /magaza/'. $readServer['slug']);

        exit;

    elseif ($totalServers > 0): 

        $servers = $db->from('Servers')->all();

    endif;

elseif (!isset($action[2])):

	$totalServers = $db->from('Servers')->select('count(*) as total')->total();

    if ($totalServers > 0):

        $servers = $db->from('Servers')->all();

        $server = $db->from('Servers')->where('slug', $action[1])->select('count(*) as total, Servers.*')->first();

        if ($server['total'] > 0): 

            $totalCategories = $db->from('ProductsCategories')->where('parent', '0')->where('serverID', $server['id'])->select('count(*) as total')->total();

            if ($totalCategories > 0):

                $categories = $db->from('ProductsCategories')->where('parent', '0')->where('serverID', $server['id'])->all();

            endif;

        endif;

    endif;

elseif (!isset($action[3])): 

	$totalServers = $db->from('Servers')->select('count(*) as total')->total();

    if ($totalServers > 0):

        $servers = $db->from('Servers')->all();

        $server = $db->from('Servers')->where('slug', $action[1])->select('count(*) as total, Servers.*')->first();

        if ($server['total'] > 0): 

            $categories = $db->from('ProductsCategories')->where('slug', $action[2])->where('serverID', $server['id'])->select('count(*) as total, ProductsCategories.*')->first();

            if ($categories['total'] > 0):

                $totalSubCategory = $db->from('ProductsCategories')->where('parent', $categories['id'])->where('serverID', $server['id'])->select('count(*) as total')->total();

                if ($totalSubCategory > 0):
                	
                	$subCategory = $db->from('ProductsCategories')->where('parent', $categories['id'])->where('serverID', $server['id'])->all();

                endif;

                $totalProducts = $db->from('Products')->where('categoryID', $categories['id'])->select('count(*) as total')->total();

                if ($totalProducts > 0):
                
                	$products = $db->from('Products')->where('categoryID', $categories['id'])->where('serverID', $server['id'])->all();
                
                endif;

            endif;

        endif;

    endif;

    if ($readSettings['mostProductsStatus']==1):

	    $totalSales = $db->from('Products')
                     	 ->join('Servers', 'Products.serverID = Servers.id')
                     	 ->select('Servers.heading as serverName, Products.*')
                     	 ->orderby('totalSales', 'desc')
                     	 ->limit('0', '5')
                     	 ->all();

    endif;

endif;

$date = date('Y-m-d');

require $realPath . '/view/store.php';