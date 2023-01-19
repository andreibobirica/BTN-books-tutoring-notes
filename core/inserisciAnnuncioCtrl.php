<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/RichiesteAnnunci.php';
$rich = new RichiesteAnnunci();
require_once './core/itemNavMenu.php';
require_once "./core/itemBreadcrumb.php";

//Script Inserimento Annuncio
if ($auth->getIfLogin() && isset($_POST["new_listing"])) {
    $result = $rich->new_listing(
        array("tipo" => $_POST['tipo'],"titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
    );
    if($result["lastid"] != 0){
        header("location:./listing.php?annuncio=$result[lastid]");
        exit();
    }
    else
        print($result['upload']['errore']);

}

if(!$auth->getIfLogin() || !isset($_GET["nuovo"])){
    header("location:./area_riservata.php");
}
?>
