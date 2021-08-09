<?php

$host = 'localhost';
$db   = 'districts';
$user = 'test_user'; 
$pass = 'test';
$charset = 'utf8';

$session_name="districts_db_session";

session_name($session_name);
if( !isset($_SESSION) ) session_start();

    
?>
