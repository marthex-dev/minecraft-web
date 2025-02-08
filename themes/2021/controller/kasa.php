<?php

if (!isset($action[1])):
	
	header('Location: kasa/liste');

endif;

if (isset($action[1]) && $action[1] == "liste"):
	
	$totalServers = $db->from('Servers')->select('count(*) as total')->total();

	if ($totalServers == 1):
		
		$readServer = $db->from('Servers')->first();

		header('Location: /kasa/'. $readServer['slug']);

		$servers = $db->from('Servers')->all();

    elseif ($totalServers > 0):

        $servers = $db->from('Servers')->all();

    endif;

elseif (!isset($action[2]) && isset($action[1])):

	$readServer = $db->from('Servers')->where('slug', $action[1])->select('count(*) as total, Servers.*')->first();

	$servers = $db->from('Servers')->all();

    if ($servers && $readServer['total'] > 0): 

    	$totalCase = $db->from('Cases')->where('serverID', $readServer['id'])->select('count(*) as total')->total();

    	if ($totalCase > 0):
    		
    		$cases = $db->from('Cases')->where('serverID', $readServer['id'])->all();

    	endif;

    endif;

elseif (!isset($action[3]) && isset($action[2])):

	$externalCSS = array('/'.$realPath.'assets/css/sweetalert.css');

	$externalJS = array('/'.$realPath.'assets/js/pages/case.js', '/'.$realPath.'assets/js/sweetalert.js');

	$readCase = $db->from('Cases')->where('slug', $action[2])->select('count(*) as total, Cases.*')->first();

	$totalCaseHistory = $db->from('CasesHistory')->join('Users', 'Users.id = CasesHistory.accID')->where('caseID', $readCase['id'])->select('count(*) as total')->total();

	if ($totalCaseHistory > 0):

		$caseHistory = $db->from('CasesHistory')
						  ->join('Users', 'Users.id = CasesHistory.accID')
						  ->where('CasesHistory.caseID', $readCase['id'])
						  ->select('CasesHistory.*, Users.realname as username')
						  ->orderby('CasesHistory.id', 'DESC')
						  ->limit('0', '10')
						  ->all();

	endif;

endif;

require $realPath . '/view/case.php';