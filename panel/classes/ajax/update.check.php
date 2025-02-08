<?php

$checkUpdateURL = "https://Rabiweb.web.tr/update/updateCheck.php?v=".$RabiwebVersion;

if (@file_get_contents($checkUpdateURL)):

    $checkUpdate = file_get_contents($checkUpdateURL);

	$updateCheck = json_decode($checkUpdate, true); 
	
	if (isset($updateCheck['version']) && !empty($updateCheck['version'])):

		if ($updateCheck['version'] > $RabiwebVersion):
		    
		    $response = alertSuccess('Yeni bir güncelleme mevcut! - &nbsp;<a onclick="return confirm(\'Güncelleme yapmak istediğinize emin misiniz?\');" href="update">Güncelleme yapmak için tıklayınız.</a>');
		
		endif;

	endif;

endif;