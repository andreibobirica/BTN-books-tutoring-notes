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

//Visualizzazione info annuncio
if (isset($_GET["annuncio"]) && !empty($_GET["annuncio"])) {
    $arrayAnnuncio = $request->getAnnuncio($_GET["annuncio"]);
    //Rimozione Annuncio Salvato
    if (isset($_GET["removesave"]) && $auth->getIfLogin() ) {
        $request->deleteSavedAnnuncio($_GET["annuncio"],$_SESSION["loginAccount"]);
    }else if (isset($_GET["insertsave"]) && $auth->getIfLogin() ) {
        $request->insertSavedAnnuncio($_GET["annuncio"],$_SESSION["loginAccount"]);
    }
}



?>