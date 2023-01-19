<?php
//Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/RichiesteAnnunci.php';
$rich = new RichiesteAnnunci();
require_once './core/itemNavMenu.php';
require_once "./core/itemBreadcrumb.php";

if (isset($_GET["annuncio"]) && !empty($_GET["annuncio"])) {
    $arrayAnnuncio = $rich->getAnnuncio($_GET["annuncio"]);
}

?>