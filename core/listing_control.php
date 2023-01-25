<?php
//Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'Authentication.php';
$auth = new Authentication();
require_once 'RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once 'header.php';
require_once 'imports.php';

if (isset($_GET["annuncio"]) && !empty($_GET["annuncio"])) {
    $arrayAnnuncio = $request->getAnnuncio($_GET["annuncio"]);
}

?>