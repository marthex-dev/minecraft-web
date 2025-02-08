<?php

if (!isset($action[1])):

	$totalGames = $db->from('Games')->select('count(*) as total')->total();

		if ($totalGames > 0):

		    $games = $db->from('Games')->all();

		endif;

elseif (isset($action[1])):

	$totalGames = $db->from('Games')->select('count(*) as total')->total();

		if ($totalGames > 0):

		    $games = $db->from('Games')->all();

		    $readGame = $db->from('Games')->where('slug', $action[1])->select('count(*) as total, Games.*')->first();

		endif;

endif;

require $realPath . '/view/game.php';