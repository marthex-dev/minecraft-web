<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Payments.class.php';
require realpath('.') . '/classes/ExtraResources.class.php';

if (isset($action[1]) && $action[1]=="liste"):

	$payments = payment::getPayments();

elseif (isset($action[1]) && $action[1]=="duzenle"):

	$extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/js/pages/payment.js');

    if ($_POST):

    	if (!empty(post('heading'))):
    		
    		$data = array(
    			'id' => $action[2],
    			'heading' => post('heading'),
    			'paymentStatus' => post('paymentStatus') 
    		);

            if ($action[2]==1):

    			$paymentData = array();

    			foreach ($_POST['realname'] as $key => $readPaymentData):
    			
    				if (!empty($readPaymentData)):
    					
    					array_push($paymentData, array(
    		            	'realname'  => $_POST['realname'][$key],
    		            	'bankname'  => $_POST['bankname'][$key],
    		            	'iban'      => $_POST['iban'][$key]
    		            ));

    				endif;

    			endforeach;

    			$data['paymentData'] = base64_encode(json_encode($paymentData));

    		elseif ($action[2]==2 OR $action[2]==3):

    			$data['paymentData'] = base64_encode(json_encode($_POST['paymentData']));

            elseif ($action[2]==4 OR $action[2]==5):

                $data['paymentData'] = post('paymentData');

            elseif ($action[2]==6):

                $data['paymentData'] = base64_encode(json_encode(array(
                    'merchantID' => post('merchantID'),
                    'merchantKey' => post('merchantKey'),
                    'merchantSalt' => post('merchantSalt') 
                )));

            elseif ($action[2]==7 OR $action[2]==8):

                $data['paymentData'] = base64_encode(json_encode(array(
                    'paymentID' => post('paymentID'),
                    'token' => post('token')
                )));

            elseif ($action[2]==9 OR $action[2]==10):

                $data['paymentData'] = base64_encode(json_encode(array(
                    'paymentID' => post('paymentID'),
                    'token' => post('token')
                )));

            elseif ($action[2]==11 OR $action[2]==12):

                $data['paymentData'] = base64_encode(json_encode(array(
                    'paymentID' => post('paymentID'),
                    'token' => post('token'),
                    'paymentMail' => post('paymentMail')
                )));

            elseif ($action[2]==13):

                $data['paymentData'] = base64_encode(json_encode(array(
                    'apiKey' => post('apiKey'),
                    'apiSecretKey' => post('apiSecretKey'),
                    'commissionType' => post('commissionType')
                )));

            elseif ($action[2]==14):

                $data['paymentData'] = base64_encode(json_encode(array(
                    'apiKey' => post('apiKey'),
                    'apiSecretKey' => post('apiSecretKey')
                )));

    		endif;

    		$updatePayment = payment::updatePayments($data);

    		if ($updatePayment):
    			
    			$response = alertSuccess('Ödeme bilgileri başarıyla güncellendi.');

    		else:

    			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

    		endif;

    	else:

    		$response = alertDanger('Lütfen boş alan bırakmayınız.');

    	endif;

    endif;

    $paymentInfo = payment::getPaymentInfo($action[2]);

else:

    header('Location: odeme/liste');

endif;

require realpath('.') . '/view/payment.php';