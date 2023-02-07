<?php
require_once 'imports.php';
require_once 'RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './core/Sanitizer.php';
$sanit = new Sanitizer();

//Visualizzazione info annuncio
if (isset($_GET["annuncio"]) && !empty($_GET["annuncio"])) {
    // Controlla se l'annuncio esiste nel db o è stato messo un numero sbagliato
    if (!empty($request->getAnnuncio($_GET["annuncio"]))) {
        //Verifico Input
        $_GET["annuncio"] = $sanit->sanitizeString($_GET["annuncio"]);
        //prendo i dati dell'annuncio
        $arrayAnnuncio = $request->getAnnuncio($_GET["annuncio"]);
        //Rimozione Annuncio Salvato
        if (isset($_GET["removesave"]) && $auth->getIfLogin()) {
            //Verifico Input
            $_GET["removesave"] = $sanit->sanitizeString($_GET["removesave"]);
            $request->deleteSavedAnnuncio($_GET["annuncio"], $_SESSION["loginAccount"]);
        } else if (isset($_GET["insertsave"]) && $auth->getIfLogin()) {
            //Verifico Input
            $_GET["insertsave"] = $sanit->sanitizeString($_GET["insertsave"]);
            $request->insertSavedAnnuncio($_GET["annuncio"], $_SESSION["loginAccount"]);
        }
    }else {
        header("Location: ./404.php");
        exit();
    }
}else {
    header("Location: ./404.php");
    exit();
}




?>