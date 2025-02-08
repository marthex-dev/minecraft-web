<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

$checkUpdateURL = "https://Rabiweb.web.tr/update/updateCheck.php?v=".$RabiwebVersion;

if (@file_get_contents($checkUpdateURL)):

  $checkUpdate = file_get_contents($checkUpdateURL);

  $updateCheck = json_decode($checkUpdate, true); 
  
  if ($updateCheck['version'] > $RabiwebVersion):

	  copy($updateCheck['download'], $updateCheck['zipname']);

	  $zip = new ZipArchive;

	  $res = $zip->open($updateCheck['zipname']);

	  if ($res === TRUE):

			  $zip->extractTo('../');
			  $zip->close($updateCheck['zipname']);

			  if (isset($updateCheck['dbStatus']) && $updateCheck['dbStatus'] == 1):
				
				    $dbConnectionForCreate = new PDO("mysql:host=".$db_host.";port=3306;dbname=".$db_name.";charset=utf8", $db_username, $db_password);
			      
            		$dbFileContents = file_get_contents("../".$updateCheck['dbName']);

			      	$dbCreate = $dbConnectionForCreate->exec($dbFileContents);

			      	unlink($updateCheck['dbname']);

			  endif;

			  unlink($updateCheck['zipname']);

			  header('Location: /');
	
	  else:
		
		  echo 'Hata! Yetkiliyle iletişime geçiniz.';

    endif;
	
	endif; // Version Check

endif; // Update URL