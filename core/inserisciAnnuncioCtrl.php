<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentification.php';
$auth = new Authentification();
require_once './core/RichiesteAnnunci.php';
$rich = new RichiesteAnnunci();

//Script Inserimento Annuncio
if ($auth->getIfLogin() && isset($_POST["inserisciAnnuncio"])) {
    $result = $rich->inserisciAnnuncio(
        array("tipo" => $_POST['tipo'],"titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
    );
    if($result["lastid"] != 0){
        header("location:./Annuncio.php?annuncio=$result[lastid]");
        exit();
    }
    else
        print($result['upload']['errore']);

}

if(!$auth->getIfLogin() || !isset($_GET["nuovo"])){
    header("location:./areariservata.php");
}
?>
