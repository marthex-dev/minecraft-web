<?php

session_start();

header('Content-type: application/json');

require "../../../classes/rcon.class.php";
require "../../../classes/websender.class.php";
require "../../../classes/websend.class.php";
require '../../../connect.php';
require '../../helper.php';

function parseMinecraftColors($string) {
 $string = utf8_decode(htmlspecialchars($string, ENT_QUOTES, "UTF-8"));
 $string = preg_replace('/\xA7([0-9a-f])/i', '<span class="mc-color mc-$1">', $string, -1, $count) . str_repeat("</span>", $count);
 return utf8_encode(preg_replace('/\xA7([k-or])/i', '<span class="mc-$1">', $string, -1, $count) . str_repeat("</span>", $count));
}

if ($_SESSION['login']):

  $readAdmin = $db->from('Users')->where('username', $_SESSION['username'])->where('permission', '6')->select('count(*) as total, Users.*')->first();

  if ($readAdmin['total'] > 0):

    $serverControl = $db->from('Servers')->where('id', post('server'))->select('count(*) as total, Servers.*')->first();

    if ($serverControl['total'] > 0):

      $response = array();

      if ($serverControl['senderType']==1):
  
        $rcon = new Websend($serverControl['serverIP'], $serverControl['senderPort']);
        $rcon->password = base64_decode($serverControl['senderPassword']);

      elseif ($serverControl['senderType']==2):

        $rcon = new WebsenderAPI($serverControl['serverIP'], base64_decode($serverControl['senderPassword']), $serverControl['senderPort']);
      
      elseif ($serverControl['senderType']==3):
        
        $rcon = new rcon($serverControl['serverIP'], $serverControl['senderPort'], base64_decode($serverControl['senderPassword']), "120");

      endif;

      if(!isset($_POST['cmd'])){
        $response['status'] = 'error';
        $response['error'] = 'Lütfen gönderilecek komudu giriniz.';
      }
      else{
        if ($rcon->connect()){

          if ($serverControl['senderType']==1):
            
            $rcon->doCommandAsConsole($_POST['cmd']);

          else:

            $rcon->sendCommand($_POST['cmd']);

          endif;

          $response['status'] = 'success';
          $response['command'] = $_POST['cmd'];
          if ($serverControl['senderType']==3):
            $response['response'] = parseMinecraftColors($rcon->getResponse());
          else:
            $response['response'] = "Başarılı! Komut başarıyla gönderildi";
          endif;
        }
        else{
          $response['status'] = 'error';
          $response['error'] = 'Hata! Sunucuya bağlanılamadı.';
        }
      }

      echo json_encode($response);

    endif;

  endif;

endif;
?>