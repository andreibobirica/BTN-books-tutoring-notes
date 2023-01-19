<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentification.php';
$auth = new Authentification();
require_once './core/itemNavMenu.php';
require_once "./core/itemBreadcrumb.php";

?>
