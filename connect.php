<?php

$db_host = "localhost";
$db_name = "rabiwebcom_webscript";
$db_username = "rabiwebcom_webscript";
$db_password = "rabiwebcom_webscript1";

date_default_timezone_set('Europe/Istanbul');
require __DIR__ . '/classes/BasicDB.class.php';
$db = new BasicDB($db_host, $db_name, $db_username, $db_password);

$find_read_page = "/upload/img/";
$find_read_panel = "../upload/img/";