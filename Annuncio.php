<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once 'Authentification.php';
$auth = new Authentification();
require_once 'RichiesteAnnunci.php';
$rich = new RichiesteAnnunci();

if (isset($_GET["annuncio"]) && !empty($_GET["annuncio"])){
    $arrayAnnuncio = $rich->getAnnuncio($_GET["annuncio"]);
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title><abbr title="Book Tutoring Notes">BTN</abbr> - Libri, appunti, ripetizioni</title>
</head>

<body>
    <header>
        <div>
            <div id="logo">
                <h1><abbr title="Book Tutoring Notes">BTN</abbr></h1>
                <img src="./assets/imgs/button.png" alt="" width="60" height="60">
            </div>

            <button id="menu-btn" class="button" onclick="menuOnClick()">MENU</button>
        </div>

        <nav id="menu">
            <ul>
                <li><a href="./index.php">Cerca</a></li>
                <li><a href="./info.php">Info</a></li>
                <?php if(!$auth->getIfLogin()) : ?>
                  <li><a href="./login.php">Accedi</a></li>
                  <li><a href="./registrazione.php">Registrati</a></li>
                <?php else :?>
                    <li><a href="./areariservata.php">Area Riservata</a></li>
                    <li><a href="./areariservata.php?logout">Log Out</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="container">
        <label id="labelTipo"><strong>Tipo Annuncio</strong></label>
        <label id="labelTitolo"><strong>Titolo</strong></label>
        <label id="labelDescrizione"><strong>Descrizione</strong></label>
        <label id="labelPrezzo"><strong>Prezzo</strong></label>
        <label id="labelMediapath"><strong>MediaPath</strong></label>
        <label id="labelMateria"><strong>Materia</strong></label>
        <label id="labelAutore"><strong>Autore</strong></label>
        <label id="labelEdizione"><strong>Edizione</strong></label>
        <label id="labelISBN"><strong>ISBN</strong></label>
        <?php print_r($arrayAnnuncio); ?>
        <img width="500" height="600" src="<?php print($arrayAnnuncio["mediapath"])?>">
    </div> 
</body>
