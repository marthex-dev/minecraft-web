<?php

if (isset($action[1]) && $action[1]=="eft"):

	$bankAccList = $db->from('Payments')->where('id', '1')->first();

	$paymentDataList = json_decode(base64_decode($bankAccList['paymentData']), true);

elseif (isset($action[1]) && $action[1]=="ininal"):

	$payments = $db->from('Payments')->where('id', '2')->first();

    $paymentDataList = json_decode(base64_decode($payments['paymentData']));

elseif (isset($action[1]) && $action[1]=="papara"):

	$payments = $db->from('Payments')->where('id', '3')->first();

    $paymentDataList = json_decode(base64_decode($payments['paymentData']));

endif;

require $realPath . '/view/payment.php';