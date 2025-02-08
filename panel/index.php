<?php

session_start();

require '../connect.php';
require '../build.php';

require __DIR__ . '/classes/Supports.class.php';

$readSettings = $db->from('Settings')->where('id', '1')->first();

if($readSettings['sslStatus']=="1"):

    $baseURL = "https://" . $_SERVER['HTTP_HOST'] . "/";

    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"):

        $redirect = $baseURL . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $redirect);
        exit();

    endif;

else:

    $baseURL = "http://" . $_SERVER['HTTP_HOST'] . "/";    

endif;

require __DIR__ . '/helper.php';

function go($url) {

    header("Location: $url");
    exit();

}

if (isset($_COOKIE["rememberMe"]) || isset($_SESSION["token"])):

    $loginToken = ((isset($_COOKIE["rememberMe"])) ? $_COOKIE["rememberMe"] : ((isset($_SESSION["token"])) ? $_SESSION["token"] : null));

    $sessionIP = getIP();

    $readAdmin = $db->from('Users')
                    ->join('Sessions', 'Users.id = Sessions.accID')
                    ->select('Users.*, Sessions.loginToken, count(*) as total')
                    ->where('Sessions.loginToken', $loginToken)
                    ->where('Sessions.creationIP', $sessionIP)
                    ->where('Sessions.expiryDate', date("Y-m-d H:i:s"), '>')
                    ->where('Users.permission', '1', '!=')
                    ->first();

    if (isset($readAdmin) && $readAdmin['total'] > 0):

    	$action = array_filter(explode("/", isset($_GET['action']) ? $_GET['action'] : ''));
        
        $_SESSION["token"] = $readAdmin["loginToken"];
        $_SESSION["username"] = $readAdmin["username"];
        $_SESSION["login"] = "1";
        
        if (!isset($_COOKIE["rememberMe"])):

            $updateSession = $db->update('Session')->where('accID', $readAdmin['id'])->where('loginToken', $loginToken)->set(array('expiryDate' => createDuration(0.01666666666)));
        
        endif;

        if ($readAdmin['permission'] != 0 OR $readAdmin['permission'] != 1):

			if ($readAdmin['permission']=="2"):

				$permission = "Destek";
				
				if (isset($action[0]) && $action[0]!="destek"):
					
					header('Location: /panel');

				endif;

			elseif ($readAdmin['permission']=="3"):

				if (isset($action[0])):

					if ($action[0] == "haber" OR $action[0] == "sayfa"):
						
						$action[0] = $action[0];

					else:

						header('Location: /panel');

					endif;

				endif;

				$permission = "Yazar";
			
			elseif($readAdmin['permission']=="4"):

				if (isset($action[0])):

					if ($action[0]=="odeme" OR $action[0]=="sunucu" OR $action[0]=="magaza" OR $action[0]=="ayarlar" OR $action[0]=="tema-ayarlari" OR $action[0]=="hesap"):
						
						header('Location: /panel');

					endif;

				endif;
			
				$permission = "Görevli";
			
			elseif($readAdmin['permission']=="5"):

				if (isset($action[0])):

					if ($action[0]=="odeme" OR $action[0]=="sunucu" OR $action[0]=="magaza" OR $action[0]=="ayarlar" OR $action[0]=="tema-ayarlari"):
						
						header('Location: /panel');

					endif;

				endif;
			
				$permission = "Moderatör";
			
			elseif($readAdmin['permission']=="6"):

				$permission = "Yönetici";
			
			else:
				
				header('Location: ' . $baseURL);

			endif;

			if (!isset($action[0])) {
			    $action[0] = 'index';
			}
			if (!file_exists('controller/' . strtolower($action[0] . '.php'))) {
			    $action[0] = 'index';
			}

			require 'controller/' . $action[0] . '.php';

		else:

			header('Location: ' . $baseURL);

		endif;

    else:

        if (isset($_COOKIE["rememberMe"])):
            
            setcookie("rememberMe", "", time()-86400*365, '/');
        
        endif;
        
        session_destroy();
        go("/giris-yap");

    endif;

else:

    go("/giris-yap");

endif;