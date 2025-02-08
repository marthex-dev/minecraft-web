<?php

$totalPage = $db->from('Pages')->select('count(*) as total')->total();

if (isset($action[1]) && $totalPage > 0):

	$readPage = $db->from('Pages')->where('slug', $action[1])->select('count(*) as total, Pages.*')->first();

endif;

require $realPath . '/view/page.php';