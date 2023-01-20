<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/navbar.php';
require_once "./core/breadcrumb.php";

?>
