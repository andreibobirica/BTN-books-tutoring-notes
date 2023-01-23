<?php
//Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/header.php';

?>