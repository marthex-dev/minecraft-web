<?php

if (!isset($action[1])):

	$totalDownloads = $db->from('Downloads')->select('count(*) as total')->total();

    if ($totalDownloads > 0):

        $download = $db->from('Downloads')->first();

        header('Location: /indir/'.$download['slug']);

    endif;

elseif(isset($action[1])):

	$downloads = $db->from('Downloads')->all();

    $readDownload = $db->from('Downloads')->where('slug', $action[1])->select('count(*) as total, Downloads.*')->first();

endif;

require $realPath . '/view/download.php';