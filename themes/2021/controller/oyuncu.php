<?php

if ($_POST):
	
	$user = $db->from('Users')->where('username', post('username'))->select('count(*) as total, Users.*')->first();

	header('Location: oyuncu/'.$user['username']);

	exit;

endif;

if (isset($action[1])):

	$user = $db->from('Users')->where('username', $action[1])->select('count(*) as total, Users.*')->first();

endif;

require $realPath . '/view/users.php';