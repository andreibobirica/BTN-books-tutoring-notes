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

//Verifica se loggato
if (!$auth->getIfLogin()) {
    header("location:./area_riservata.php");
    exit();
}

//Script Inserimento Annuncio
if (isset($_POST["new_listing"])) {
    print_r($_POST);
    //Verifico Input e sanitize
    $_POST['titolo'] = $sanit->sanitizeString($_POST['titolo']);
    $_POST['descrizione'] = $sanit->sanitizeString($_POST['descrizione']);
    $_POST['prezzo'] = $sanit->sanitizeString($_POST['prezzo']);
    $_POST['materia'] = $sanit->sanitizeString($_POST['materia']);
    if ($_POST['categoria'] == "libri") {
        $_POST['titolo'] = $sanit->sanitizeString($_POST['titolo']);
        $_POST['edizione'] = $sanit->sanitizeString($_POST['edizione']);
        $_POST['isbn'] = $sanit->sanitizeString($_POST['isbn']);
    }
    $error = array();
    if (!$sanit->validateTitle($_POST['titolo'])) {
        array_push($error, "Formato Titolo non corretto");
    }
    if (!$sanit->validateDescription($_POST['descrizione'])) {
        array_push($error, "Formato Descrizione non corretto");
    }
    if (!$sanit->validateNumber($_POST['prezzo'])) {
        array_push($error, "Formato Prezzo non corretto");
    }
    if (!$sanit->validateNameNumberMaxLength($_POST['materia'])) {
        array_push($error, "Formato Materia non corretto");
    }
    if ($_POST['categoria'] == "libri") {
        if (!$sanit->validateNameMaxLength($_POST['autore'])) {
            array_push($error, "Formato Autore non corretto");
        }
        if (!$sanit->validateNameNumberMaxLength($_POST['edizione'])) {
            array_push($error, "Formato Edizione non corretto");
        }
        if (!$sanit->validateISBN($_POST['isbn'])) {
            array_push($error, "Formato ISBN non corretto");
        }
    }
    $verifica =
        $sanit->validateTitle($_POST['titolo']) &&
        $sanit->validateDescription($_POST['descrizione']) &&
        $sanit->validateNumber($_POST['prezzo']) &&
        $sanit->validateNameNumberMaxLength($_POST['materia']);
    if ($_POST['categoria'] == "libri") {
        $verifica = $verifica &&
            $sanit->validateNameMaxLength($_POST['autore']) &&
            $sanit->validateNameNumberMaxLength($_POST['edizione']) &&
            $sanit->validateISBN($_POST['isbn']);
    }



    //Mando i dati da modificare del annuncio alla funzione new_listing con una struttura dati array
    if ($verifica) {
        $result = $request->new_listing(
            array("tipo" => $_POST['categoria'], "titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
        );
    } else {
        header('location:./new_listing.php?categoria=' . $_POST['categoria'] . '&errore=' . implode(" - ", $error));
        exit();
    }
    //Se nei risultati il campo lastid è valorizzato !=0 la modifica è avvenuta con successo
    if ($result["lastid"] != 0) {
        header("location:./listing.php?annuncio=$result[lastid]");
        exit();
    } else {
        $error = $result['upload']['errore'];
        header("location:./edit_listing.php?categoria=$_POST[categoria]&errore=$error'");
        exit();
    }

}
?>