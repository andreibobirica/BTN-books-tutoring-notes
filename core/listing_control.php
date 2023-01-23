<?php
//Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './core/header.php';
require_once "./core/imports.php";

if (isset($_GET["annuncio"]) && !empty($_GET["annuncio"])) {
    $arrayAnnuncio = $request->getAnnuncio($_GET["annuncio"]);
}

?>