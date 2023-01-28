<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './core/header.php';
require_once "imports.php";

//Verifica se loggato
if(!$auth->getIfLogin()){
    header("location:./area_riservata.php");
    exit();
}

//Script Inserimento Annuncio
if (isset($_POST["new_listing"])) {
    //Verifico Input e sanitize
    $_POST['titolo'] = $sanit->sanitizeString($_POST['titolo']);
    $_POST['descrizione'] = $sanit->sanitizeString($_POST['descrizione']);
    $_POST['prezzo'] = $sanit->sanitizeString($_POST['prezzo']);
    $_POST['mediapath'] = $sanit->sanitizeString($_POST['mediapath']);
    $_POST['materia'] = $sanit->sanitizeString($_POST['materia']);
    $_POST['autore'] = $sanit->sanitizeString($_POST['autore']);
    $_POST['titolo'] = $sanit->sanitizeString($_POST['titolo']);
    $_POST['edizione'] = $sanit->sanitizeString($_POST['edizione']);
    $_POST['isbn'] = $sanit->sanitizeString($_POST['isbn']);
    $verifica = $sanit->validateNumber($_POST['prezzo']) && $sanit->validateNumber($_POST['isbn']);

    //Inserimento del annuncio
    if($verifica)
    $result = $request->new_listing(
        array("tipo" => $_POST['categoria'],"titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
    );
    //Mesaggio di conferma o di errore
    if (!$verifica) {
        print("Errore nei dati Inseriti, Riprovare");
    }else if ($result["lastid"] != 0){
        header("location:./listing.php?annuncio=$result[lastid]");
        exit();
    }
    else
        print($result['upload']['errore']);

}
?>
