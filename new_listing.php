<?php
require_once './core/new_listingCtrl.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="./scripts/main_script.js"></script>
    <title>BTN - Libri, appunti, ripetizioni</title>
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

        <?php printItemNavMenu("inserimentoannuncio",$auth->getIfLogin());?>
    </header>
    <?php printItemBreadcrumb("new_listing"); ?>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="newAnnuncioForm" method="POST" enctype="multipart/form-data">
            <label id="labelNome">Tipo Annuncio</label>
            <select name="tipo" id="cars">
                <option value="appunti">Appunti</option>
                <option value="libri">Libri</option>
                <option value="ripetizioni">Ripetizioni</option>
            </select>
            <label id="labelTitolo">Titolo</label>
            <input type="text" placeholder="Inserisci il titolo" maxlength="25" name="titolo" id="inputTitolo" />
            <label id="labelDescrizione">Descrizione</label>
            <input type="text" placeholder="Inserisci Descrizione" maxlength="255" name="descrizione" id="inputDescrizione" />
            <label id="labelPrezzo">Prezzo</label>
            <input type="text" placeholder="Inserisci il titolo" maxlength="25" name="prezzo" id="inputPrezzo" />
            <label id="labelMediapath">MediaPath</label>
            <input type="file" name="mediapath" id="mediapath">
            <label id="labelMateria">Materia</label>
            <input type="text" placeholder="Inserisci la materia" maxlength="25" name="materia" id="inputMateria" />
            <label id="labelAutore">Autore</label>
            <input type="text" placeholder="Inserisci Autore" maxlength="25" name="autore" id="inputAutore" />
            <label id="labelEdizione">Edizione</label>
            <input type="text" placeholder="Inserisci la Edizione" maxlength="25" name="edizione" id="inputEdizione" />
            <label id="labelISBN">ISBN</label>
            <input type="text" placeholder="Inserisci ISBN" maxlength="25" name="isbn" id="inputMateria" />
            <button type="submit" name="new_listing" id="new_listing">Inserisci</button>
        </form>
    </div>       
</body>
