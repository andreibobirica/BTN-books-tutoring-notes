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
require_once "imports.php";

if (isset($_GET["elimina"]) && !empty($_GET["elimina"])) {
    print_r("elimina");
    if ($request->verifyAnnuncioUser($_SESSION["loginAccount"], $_GET["elimina"]))
        $request->deleteAnnuncio($_GET["elimina"]);
    //header("location:./area_riservata.php");
}

//Script Modifica Annuncio
if (isset($_POST["edit_listing"])) {
    $result = $request->edit_listing(
        array("id" => $_POST["edit_listing"], "titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
    );
    if ($result["lastid"] != 0)
        header("location:./listing.php?annuncio=$result[lastid]");
    else
        print($result['upload']['errore']);
}


if ($auth->getIfLogin()) {
    if (isset($_GET["modifica"]) && !empty($_GET["modifica"])) {
        // Se l'utente è loggato si controlla la volontà di modificare l'annuncio e quale
        if ($request->verifyAnnuncioUser($_SESSION["loginAccount"], $_GET["modifica"])) {
            // In caso affermativo si verifica la proprietà dell'annuncio e si procede alla modifica
            $arrayAnnuncio = $request->getAnnuncio($_GET["modifica"]);
        } else {
            // In caso negativo area riservata
            header("location:./area_riservata.php");
        }
    } else {
        // In caso negativo area riservata
        header("location:./area_riservata.php");
    }
} else {
    // Se l'utente non è loggato viene mandato alla pagina di login
    header("location:./login.php");
}
?>