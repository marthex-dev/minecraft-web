<?php

require '../../helper.php';

if (!empty(post('serverIP')) && !empty(post('senderPort')) && !empty(post('senderPassword')) && !empty(post('senderType'))):

	if (post('senderType')==1):
		
		require_once("../packages/websend.class.php");
		$ws = new Websend(post('serverIP'), post('senderPort'));
		$ws->password = post('senderPassword');

	elseif (post('senderType')==2):
	
		require "../packages/websender.class.php";
		$ws = new WebsenderAPI(post('serverIP'), post('senderPassword'), post('senderPort'));
	
	elseif (post('senderType')==3):

		require "../packages/rcon.class.php";
		$ws = new rcon(post('serverIP'), post('senderPort'), post('senderPassword'), "3");
	
	endif;

	if($ws->connect()):

		die(true);

	else:		

		die(false);

	endif;

	$ws->disconnect();

else:

	die(false);

endif;