<?php

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
    if (isset($_SESSION[$name]))
        return $_SESSION[$name];
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

/**
 * @param $text
 * @return string|string[]
 */

function catchEmoji($text)
{
    $emojiPath = "assets/img/emojis";
    $emojiText = array(":D", ";)", ":)", "<3", ":(", ":O", ":o", ":P", ":')", ":8", "-_-", "(y)");
    $emojiImage = array("<img src=\"" . $emojiPath . "/1.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/2.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/3.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/4.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/5.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/6.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/6.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/7.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/8.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/9.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/10.png\" width=\"18px\" />", "<img src=\"" . $emojiPath . "/11.png\" width=\"18px\" />");
    return str_ireplace($emojiText, $emojiImage, $text);
}

/**
 * @param $type
 * @param $text
 * @return string
 */

function alert($type, $text)
{

    if($type == "danger"):

        return '<div class="alert alert-danger border-radius-20" role="alert">'. $text .'</div>';

    elseif($type == "success"):

        return '<div class="alert alert-success border-radius-20" role="alert">'. $text .'</div>';

    elseif($type == "warning"):

        return '<div class="alert alert-warning border-radius-20" role="alert">'. $text .'</div>';

    endif;

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
 * @return bool
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
 * @return array|false|string
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
 * @param $password
 * @return mixed
 */

function checkBadPassword($password)
{
    $badPasswordList = array("1234", "12345", "123456", "1234567", "12345678", "123456789", "1234567890", "abc123", "xyz123", "qwerty", "qwerty123", "sifre", "sifre0", "sifre123", "password", "password0");
    return in_array($password, $badPasswordList);
}

function avatar($username, $size, $type = 0)
{

    global $readSettings;

    if ($type == 0):

        if ($readSettings['avatarApi']=="0"):

            return "https://minotar.net/avatar/" .$username. "/" .$size. ".png";

        elseif($readSettings['avatarApi']==1):

            return "https://cravatar.eu/avatar/" .$username. "/" .$size. ".png";

        endif;

    else:

        return "https://minotar.net/body/" .$username. "/" .$size. ".png";

    endif;

}

function discountTotal($price, $discountPrice)
{

    $discountPerc = $price / 100;
    $discountExc = $discountPrice / $discountPerc;
    $discountTotal = 100 - $discountExc;

    return "%".round($discountTotal);

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

        $json_data["embeds"]["0"]["footer"] = array("text" => "Rabiweb Yazılım", "icon_url" => "http://demo.Rabiweb-software.net/upload/img/bb2d30859adfa303df28779ef04fe69a.jpg");
    
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