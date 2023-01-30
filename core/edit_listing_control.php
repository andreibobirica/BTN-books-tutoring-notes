<?php
//Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './core/Sanitizer.php';
$sanit = new Sanitizer();
require_once './core/header.php';
require_once "imports.php";

if (isset($_GET["elimina"]) && !empty($_GET["elimina"])) {
    //Verifico Input
    $_GET["elimina"] = $sanit->sanitizeString($_GET["elimina"]);
    //verifico che l'annuncio sia del utente loggato
    if ($auth->getIfLogin() && $request->verifyAnnuncioUser($_SESSION["loginAccount"], $_GET["elimina"])) {
        $request->deleteAnnuncio($_GET["elimina"]);
        header("location:./area_riservata.php");
    }
}

//Script Modifica Annuncio
if (isset($_POST["edit_listing"])) {
    //Verifico Input e sanitize
    $_POST['titolo'] = $sanit->sanitizeString($_POST['titolo']);
    $_POST['descrizione'] = $sanit->sanitizeString($_POST['descrizione']);
    $_POST['prezzo'] = $sanit->sanitizeString($_POST['prezzo']);
    $_POST['materia'] = $sanit->sanitizeString($_POST['materia']);
    $_POST['autore'] = $sanit->sanitizeString($_POST['autore']);
    $_POST['titolo'] = $sanit->sanitizeString($_POST['titolo']);
    $_POST['edizione'] = $sanit->sanitizeString($_POST['edizione']);
    $_POST['isbn'] = $sanit->sanitizeString($_POST['isbn']);
    $error="";
    if(!$sanit->validateTitle($_POST['titolo']))$error.="Formato Titolo non corretto - ";
    if(!$sanit->validateDescription($_POST['descrizione']))$error.="Formato Descrizione non corretto - ";
    if(!$sanit->validateNumber($_POST['prezzo']))$error.="Formato Prezzo non corretto - ";
    if(!$sanit->validateNameNumberMaxLength($_POST['materia']))$error.="Formato Materia non corretto - ";
    if(!$sanit->validateNameMaxLength($_POST['autore']))$error.="Formato Autore non corretto - ";
    if(!$sanit->validateNameNumberMaxLength($_POST['edizione']))$error.="Formato Edizione non corretto - ";
    if(!$sanit->validateISBN($_POST['isbn']))$error.="Formato ISBN non corretto - ";
    $verifica = 
    $sanit->validateTitle($_POST['titolo']) &&
    $sanit->validateDescription($_POST['descrizione']) &&
    $sanit->validateNumber($_POST['prezzo']) && 
    $sanit->validateNameNumberMaxLength($_POST['materia']) &&
    $sanit->validateNameMaxLength($_POST['autore']) &&
    $sanit->validateNameNumberMaxLength($_POST['edizione']) &&
    $sanit->validateISBN($_POST['isbn']);

    //Mando i dati da modificare del annuncio alla funzione edit_listing con una struttura dati array
    if($verifica){
        $result = $request->edit_listing(
            array("id" => $_POST["edit_listing"], "titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
        );
    }else{
        header("location:./edit_listing.php?categoria=$_POST[categoria]&modifica=$_POST[edit_listing]&errore=$error'");
        exit();
    }
    //Se nei risultati il campo lastid è valorizzato !=0 la modifica è avvenuta con successo
    if ($result["lastid"] != 0){
        header("location:./listing.php?annuncio=$_POST[edit_listing]");
        exit();
    }else{
        header("location:./edit_listing.php?categoria=$_POST[categoria]&modifica=$_POST[edit_listing]&errore=$result[upload][errore]'");
        exit();
    }
}

//Prendo i dati dell'anuncio da modificare
if ($auth->getIfLogin()) {
    if (isset($_GET["modifica"]) && !empty($_GET["modifica"])) {
        //Verifico Input
        $_GET["modifica"] = $sanit->sanitizeString($_GET["modifica"]);
        // Se l'utente è loggato si controlla la volontà di modificare l'annuncio e quale
        if ($request->verifyAnnuncioUser($_SESSION["loginAccount"], $_GET["modifica"])) {
            // In caso affermativo si verifica la proprietà dell'annuncio e si procede alla sua visualizzazione per la modifica
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