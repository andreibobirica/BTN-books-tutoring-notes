<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once 'Authentification.php';
$auth = new Authentification();
require_once 'RichiesteAnnunci.php';
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
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="newAnnuncioForm" method="POST" enctype="multipart/form-data">
            <label id="labelNome"><strong>Tipo Annuncio</strong></label>
            <select name="tipo" id="cars">
                <option value="appunti">Appunti</option>
                <option value="libri">Libri</option>
                <option value="ripetizioni">Ripetizioni</option>
            </select>
            <label id="labelTitolo"><strong>Titolo</strong></label>
            <input type="text" placeholder="Inserisci il titolo" maxlength="25" name="titolo" id="inputTitolo" />
            <label id="labelDescrizione"><strong>Descrizione</strong></label>
            <input type="text" placeholder="Inserisci Descrizione" maxlength="255" name="descrizione" id="inputDescrizione" />
            <label id="labelPrezzo"><strong>Prezzo</strong></label>
            <input type="text" placeholder="Inserisci il titolo" maxlength="25" name="prezzo" id="inputPrezzo" />
            <label id="labelMediapath"><strong>MediaPath</strong></label>
            <input type="file" name="mediapath" id="mediapath">
            <label id="labelMateria"><strong>Materia</strong></label>
            <input type="text" placeholder="Inserisci la materia" maxlength="25" name="materia" id="inputMateria" />
            <label id="labelAutore"><strong>Autore</strong></label>
            <input type="text" placeholder="Inserisci Autore" maxlength="25" name="autore" id="inputAutore" />
            <label id="labelEdizione"><strong>Edizione</strong></label>
            <input type="text" placeholder="Inserisci la Edizione" maxlength="25" name="edizione" id="inputEdizione" />
            <label id="labelISBN"><strong>ISBN</strong></label>
            <input type="text" placeholder="Inserisci ISBN" maxlength="25" name="isbn" id="inputMateria" />
            <button type="submit" name="inserisciAnnuncio" id="inserisciAnnuncio">Inserisci</button>
        </form>
    </div>       
</body>
