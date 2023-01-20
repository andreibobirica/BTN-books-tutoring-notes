<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/RichiesteAnnunci.php';
$request = new RichiesteAnnunci();
require_once './core/navbar.php';
require_once "./core/breadcrumb.php";


if (isset($_GET["elimina"]) && !empty($_GET["elimina"])){
    if($request->verifyAnnuncioUser($_SESSION["loginAccount"], $_GET["elimina"]))
        $request->deleteAnnuncio($_GET["elimina"]);
        header("location:./area_riservata.php");
}

//Script Modifica Annuncio
if (isset($_POST["edit_listing"])) {
    $result = $request->edit_listing(
        array("id"=>$_POST["edit_listing"],"titolo" => $_POST['titolo'], "descrizione" => $_POST['descrizione'], "prezzo" => $_POST['prezzo'], "username" => $_SESSION["loginAccount"], "mediapath" => $_FILES["mediapath"], "materia" => $_POST['materia'], "autore" => $_POST['autore'], "edizione" => $_POST['edizione'], "isbn" => $_POST['isbn'])
    );
    if($result["lastid"] != 0)
        header("location:./listing.php?annuncio=$result[lastid]");
    else
        print($result['upload']['errore']);
}


if($auth->getIfLogin()){
    if (isset($_GET["modifica"]) && !empty($_GET["modifica"])){
        if ($request->verifyAnnuncioUser($_SESSION["loginAccount"], $_GET["modifica"])) {
            $arrayAnnuncio = $request->getAnnuncio($_GET["modifica"]);
        }else{
            header("location:./area_riservata.php");
        } 
    }
}else{
    header("location:./area_riservata.php");
}

?>
