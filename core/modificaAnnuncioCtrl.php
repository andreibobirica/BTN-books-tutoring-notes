<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentification.php';
$auth = new Authentification();
require_once './core/RichiesteAnnunci.php';
$rich = new RichiesteAnnunci();


if (isset($_GET["elimina"]) && !empty($_GET["elimina"])){
    if($rich->verifyAnnuncioUser($_SESSION["loginAccount"], $_GET["elimina"]))
        $rich->deleteAnnuncio($_GET["elimina"]);
        header("location:./areariservata.php");
}

//Script Modifica Annuncio
if (isset($_POST["modificaAnnuncio"])) {
    $result = $rich->modificaAnnuncio(
        array("id"=>$_POST["modificaAnnuncio"],"titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
    );
    if($result["lastid"] != 0)
        header("location:./Annuncio.php?annuncio=$result[lastid]");
    else
        print($result['upload']['errore']);
}


if($auth->getIfLogin()){
    if (isset($_GET["modifica"]) && !empty($_GET["modifica"])){
        if ($rich->verifyAnnuncioUser($_SESSION["loginAccount"], $_GET["modifica"])) {
            $arrayAnnuncio = $rich->getAnnuncio($_GET["modifica"]);
        }else{
            header("location:./areariservata.php");
        } 
    }
}else{
    header("location:./areariservata.php");
}

?>
