<?php

	session_start();

    require '../../../connect.php';
    
    require '../helper.php';

    $settings = $db->from('Settings')->where('id', '1')->first();

    $date = date('Y-m-d');

    if ($_SESSION['login']):


    endif;

?>