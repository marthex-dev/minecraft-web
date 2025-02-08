<?php

session_start();

require "connect.php";
require "build.php";

$readSettings = $db->from('Settings')->where('id', '1')->first();

$readSettings['vipGlobal'] = "1";

$action = array_filter(explode("/", isset($_GET['action']) ? $_GET['action'] : ''));

if (!isset($action[0])) {
    $action[0] = 'anasayfa';
}

$siteTitle = $readSettings['serverName']." | ".$readSettings['siteHeading'];

if ($readSettings['sslStatus']=="1"):

    $baseURL = "https://" . $_SERVER['HTTP_HOST'];

    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"):

        $redirect = $baseURL . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $redirect);
        exit();

    endif;

else:

    $baseURL = "http://" . $_SERVER['HTTP_HOST'];    

endif;

function createDuration($duration = 0) {

    return date("Y-m-d H:i:s", (strtotime(date("Y-m-d H:i:s")) + ($duration * 86400)));

}

function go($url) {

    header("Location: $url");
    exit();

}

if (isset($_COOKIE["rememberMe"]) || isset($_SESSION["token"])):

    $loginToken = ((isset($_COOKIE["rememberMe"])) ? $_COOKIE["rememberMe"] : ((isset($_SESSION["token"])) ? $_SESSION["token"] : null));

    if (getenv("HTTP_CLIENT_IP")):
        
        $sessionIP = getenv("HTTP_CLIENT_IP");

    elseif (getenv("HTTP_X_FORWARDED_FOR")): 
   
        $sessionIP = getenv("HTTP_X_FORWARDED_FOR");
    
        if (strstr($sessionIP, ",")):

            $tmp = explode (",", $sessionIP);
            $sessionIP = trim($tmp[0]);
        
        endif;

    else:

        $sessionIP = getenv("REMOTE_ADDR");
  
    endif;

    $readUser = $db->from('Users')
                    ->join('Sessions', 'Users.id = Sessions.accID')
                    ->select('Users.*, Sessions.loginToken, count(*) as total')
                    ->where('Sessions.loginToken', $loginToken)
                    ->where('Sessions.creationIP', $sessionIP)
                    ->where('Sessions.expiryDate', date("Y-m-d H:i:s"), '>')
                    ->first();

    if (isset($readUser) && $readUser['total'] > 0):
        
        $_SESSION["token"] = $readUser["loginToken"];
        $_SESSION["username"] = $readUser["username"];
        $_SESSION["login"] = "1";
        
        if (!isset($_COOKIE["rememberMe"])):

            $updateSession = $db->update('Session')->where('accID', $readUser['id'])->where('loginToken', $loginToken)->set(array('expiryDate' => createDuration(0.01666666666)));
        
        endif;

        $totalChest = $db->from('Chests')->join('Users', 'Users.id = Chests.accID')->join('Products', 'Products.id = Chests.productID')->join('Servers', 'Servers.id = Products.serverID')->where('accID', $readUser['id'])->where('Chests.type', '1')->where('status', '1')->select('count(*) as total')->total();

        $totalVips = $db->from('Chests')->join('Users', 'Users.id = Chests.accID')->join('Vips', 'Vips.id = Chests.productID')->join('Servers', 'Servers.id = Vips.serverID')->where('accID', $readUser['id'])->where('status', '1')->where('Chests.type', '2')->select('count(*) as total')->total();

        if ($totalChest > 0 OR $totalVips > 0):
        
            $chestCount = "(".($totalChest + $totalVips).")";

        endif;

    else:

        if (isset($_COOKIE["rememberMe"])):
            
            setcookie("rememberMe", "", time()-86400*365, '/');
        
        endif;
        
        session_destroy();
        go("/giris-yap");

    endif;

endif;

$readTheme = $db->from('Theme')->where('id', '1')->first();

if ($readSettings['maintenanceMode']=="1"):

    $maintenanceData = json_decode(base64_decode($readSettings['maintenanceData']), true);

    if ($action[0]=="giris-yap" OR $action[0]=="kayit-ol" OR $action[0]=="sifremi-unuttum"):
        
        $readTheme['theme'] = $readTheme['theme'];

    else:

        if (isset($readUser) && $readUser['permission']==6):

            $readTheme['theme'] = $readTheme['theme'];

        else:

            $nowDate = date('Y-m-d H:m');

            $maintenanceDate = date('Y-m-d H:m', strtotime($maintenanceData['maintenanceExpiry']." ".$maintenanceData['maintenanceExpiryTime']));

            if ($maintenanceDate > $nowDate OR $maintenanceData['maintenanceDuration'] == 0):

                $readTheme['theme'] = "maintenance";

            else:

                $readTheme['theme'] = $readTheme['theme'];

            endif;

        endif;

    endif;

endif;

$realPath = "themes/" . $readTheme['theme'] . "/";

require $realPath . "/helper.php";

if ($action[0]=='cikis-yap'):

    $deleteSession = $db->delete('Sessions')->where('accID', $readUser['id'])->done();
    session_destroy();
    header('Location:' . site_url());

endif;

if (!file_exists($realPath . "controller/" . strtolower($action[0] . ".php"))) {

    $action[0] = "anasayfa";
    
}

require $realPath . "controller/" . $action[0] . ".php";