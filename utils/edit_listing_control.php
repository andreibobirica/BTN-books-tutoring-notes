<?php
require_once 'imports.php';
require_once './utils/RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './utils/Sanitizer.php';
$sanit = new Sanitizer();

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
    if (isset($_POST['categoria']) && $_POST['categoria'] == "libri") {
        $_POST['titolo'] = $sanit->sanitizeString($_POST['titolo']);
        $_POST['edizione'] = $sanit->sanitizeString($_POST['edizione']);
        $_POST['isbn'] = $sanit->sanitizeString($_POST['isbn']);
    }

    $error = array();
    if (!$sanit->validateTitle($_POST['titolo']))
        array_push($error, "Formato Titolo non corretto");
    if (!$sanit->validateDescription($_POST['descrizione']))
        array_push($error, "Formato Descrizione non corretto");
    if (!$sanit->validateNumber($_POST['prezzo']))
        array_push($error, "Formato Prezzo non corretto");
    if (!$sanit->validateNameNumberMaxLength($_POST['materia']))
        array_push($error, "Formato materia non corretto");
    if (isset($_POST['categoria']) && $_POST['categoria'] == "libri") {
        if (!$sanit->validateNameMaxLength($_POST['autore']))
            array_push($error, "Formato autore non corretto");
        if (!$sanit->validateNameNumberMaxLength($_POST['edizione']))
            array_push($error, "Formato edizione non corretto");
        if (!$sanit->validateISBN($_POST['isbn']))
            array_push($error, "Formato ISBN non corretto");
    }
    $verifica =
        $sanit->validateTitle($_POST['titolo']) &&
        $sanit->validateDescription($_POST['descrizione']) &&
        $sanit->validateNumber($_POST['prezzo']) &&
        $sanit->validateNameNumberMaxLength($_POST['materia']);

    if (isset($_POST['categoria']) && $_POST['categoria'] == "libri") {
        $verifica = $verifica &&
            $sanit->validateNameMaxLength($_POST['autore']) &&
            $sanit->validateNameNumberMaxLength($_POST['edizione']) &&
            $sanit->validateISBN($_POST['isbn']);
    }

    //Mando i dati da modificare del annuncio alla funzione edit_listing con una struttura dati array
    if ($verifica) {
        $result = $request->edit_listing(
            array("id" => $_POST["edit_listing"], "titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
        );
    } else {
        header('location:./edit_listing.php?categoria=' . $_POST['categoria'] . '&modifica=' . $_POST['edit_listing'] . '&errore=' . implode(" - ", $error));
        exit();
    }
    //Se nei risultati il campo lastid è valorizzato !=0 la modifica è avvenuta con successo
    if ($result["lastid"] != 0) {
        header("location:./listing.php?annuncio=$_POST[edit_listing]");
        exit();
    } else {
        $error = $result['upload']['errore'];
        header('location:./edit_listing.php?categoria=' . $_POST['categoria'] . '&modifica=' . $_POST['edit_listing'] . '&errore=' . implode(" - ", $error));
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