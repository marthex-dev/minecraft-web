<?php

if (!isset($action[1])):

	$totalVotes = $db->from('Votes')->select('count(*) as total')->total();

    if ($totalVotes > 0):

        $votes = $db->from('Votes')->first();

        header('Location: /vote/'.$votes['slug']);

    endif;

elseif(isset($action[1])):

	$votes = $db->from('Votes')->all();

    $readVotes = $db->from('Votes')->where('slug', $action[1])->select('count(*) as total, Votes.*')->first();

endif;

require $realPath . '/view/vote.php';