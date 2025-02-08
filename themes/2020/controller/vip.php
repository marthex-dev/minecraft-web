<?php

if ($readSettings['vipGlobal'] == "1"):

    if (!isset($action[1])):

        $totalServers = $db->from('Servers')->select('count(*) as total')->total();

        if ($totalServers == 1):
            
            $readServer = $db->from('Servers')->first();

            header('Location: /vip/'. $readServer['slug']);

            exit;

        elseif ($totalServers > 0): 

            $servers = $db->from('Servers')->all();

        endif;

    elseif (!isset($action[2])):

        $externalCSS = array('/'.$realPath.'assets/css/sweetalert.css');

        $externalJS = array('/'.$realPath.'assets/js/pages/vip.js', '/'.$realPath.'assets/js/sweetalert.js');

        $totalServers = $db->from('Servers')->select('count(*) as total')->total();

        if ($totalServers > 0):

            $server = $db->from('Servers')->where('slug', $action[1])->select('count(*) as total, Servers.*')->first();

            if ($server['total'] > 0): 

                $totalVips = $db->from('Vips')->where('serverID', $server['id'])->select('count(*) as total')->total();

                if ($totalVips > 0):

                    $pageParam = 'limit';

                    $totalPage = ceil($totalVips / "5");

                    $pageLimit = "5";

                    $pagination = $db->pagination($totalVips, $pageLimit, $pageParam);

                    $vips = $db->from('Vips')->where('serverID', $server['id'])->orderby('price', 'ASC')->limit($pagination['start'], $pagination['limit'])->all();

                    $totalFeatures = $db->from('VipFeatures')->where('serverID', $server['id'])->orderby('id', 'ASC')->select('count(*) as total')->total();

                    if ($totalFeatures > 0):

                    	$features = $db->from('VipFeatures')->where('serverID', $server['id'])->orderby('id', 'ASC')->all();

                    endif;

                    if (!isset($_GET[$pageParam])):
        
                        $_GET[$pageParam] = "1";
                    
                    endif;
                    
                    $prevPage = $_GET[$pageParam] - 1;
                    
                    $nextPage = $_GET[$pageParam] + 1;

                endif;

            endif;

        endif;

    endif;

endif;

require $realPath . '/view/vip.php';