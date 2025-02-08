<?php

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

        $json_data["embeds"]["0"]["footer"] = array("text" => "RabiWeb", "icon_url" => "");
    
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

class paying
{

	public static function addPaymentHistory($data)
	{

		global $db;

		$checkUser = $db->from('Users')->where('id', $data['accID'])->select('count(*) as total, Users.*')->first();

		if ($checkUser['total'] > 0):
			
			$readSettings = $db->from('Settings')->where('id', '1')->first();

			if ($readSettings['bonusCreditStatus'] == 1):

				$data['earnings'] = $data['price']/100*$readSettings['bonusCredit'];

			endif;

			$addPaymentHistory = $db->insert('CreditHistory')->set($data);

			if ($addPaymentHistory):
				
				return true;

			else:

				return false;

			endif;

		else:

			return false;

		endif;

	}

	public static function updateHistory($data)
	{

		global $db;

		$checkHistory = $db->from('CreditHistory')->where('id', $data['id'])->select('count(*) as total')->total();

		if ($checkHistory > 0):

			$readSettings = $db->from('Settings')->where('id', '1')->first();

			if ($readSettings['bonusCreditStatus'] == 1):

				$data['earnings'] = $data['price']/100*$readSettings['bonusCredit'];

			else:

				$data['earnings'] = 0;

			endif;
			
			$updateHistory = $db->update('CreditHistory')->where('id', $data['id'])->set($data);

			if ($updateHistory):
				
				return true;

			else:

				return false;

			endif;

		else:

			return false;

		endif;

	}

	public static function updateCredit($data)
	{

		global $db;

		$checkUser = $db->from('Users')->where('id', $data['accID'])->select('count(*) as total, Users.*')->first();

		if ($checkUser['total'] > 0):
			
			$readSettings = $db->from('Settings')->where('id', '1')->first();

			$realPrice = $data['price'];

			if ($readSettings['bonusCreditStatus'] == 1):

				if (!empty($readSettings['bonusCredit'])):

					$data['price'] = $data['price'] + $data['price']/100*$readSettings['bonusCredit'];

				endif;

			endif;

			if ($readSettings['creditWebhook']==1):

                $creditWebhook = json_decode(base64_decode($readSettings['creditWebhookData']), true);

                $creditWebhook['username'] = $checkUser['username'];

                $creditWebhook['content'] = str_replace("%username%", $creditWebhook['username'], $creditWebhook['content']);

                $creditWebhook['content'] = str_replace("%credit%", $data['price'], $creditWebhook['content']);

                $creditWebhook['content'] = str_replace("%money%", $realPrice, $creditWebhook['content']);

                $creditWebhook['description'] = str_replace("%username%", $creditWebhook['username'], $creditWebhook['description']);

                $creditWebhook['description'] = str_replace("%credit%", $data['price'], $creditWebhook['description']);

                $creditWebhook['description'] = str_replace("%money%", $realPrice, $creditWebhook['description']);
                
                webhook($creditWebhook);

            endif;

			$newCredit = $checkUser['credit'] + $data['price'];

			$updateCredit = $db->update('Users')->where('id', $data['accID'])->set('credit', $newCredit);

			if ($updateCredit):
				
				return true;

			else:

				return false;

			endif;

		else:

			return false;

		endif;

	}

}