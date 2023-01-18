<?php
//Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Authentification.php';
$auth = new Authentification();

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cerca libri, appunti e ripetizioni e mettiti in contatto direttamente con i venditori">
    <meta name="keywords" content="BTN, informazioni">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>BTN - Informazioni</title>
</head>

<body>
    <header>
        <div>
            <h1><a href="./index.php" class="logo"><abbr title="Book Tutoring Notes">BTN</abbr></a></h1>
            <button id="menu-btn" class="button" onclick="menuOnClick()"><span lang="en">MENU</span></button>
        </div>

        <nav id="menu">
            <ul>
                <li><a href="./index.php">Cerca</a></li>
                <li>Info</li>
                <?php if (!$auth->getIfLogin()): ?>
                    <li><a href="./login.php">Accedi</a></li>
                    <li><a href="./registrazione.php">Registrati</a></li>
                <?php else: ?>
                    <li><a href="./areariservata.php">Area Riservata</a></li>
                    <li><a href="./areariservata.php?logout">Log Out</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <nav id="breadcrumb">
        <p><a href="./index.php" lang="en">Home</a> / Info</p>
    </nav>
    <main>
        <section id="info">
            <img src="./assets/imgs/studyoutside_square.jpg" class="sectionimg" />
            <div class="text">
                <p><abbr title="Book Tutoring Notes">BTN</abbr> è un sito per la compravendita di libri, appunti e
                    ripetizioni tra studenti
                    universitari.</p>
                <p>Il nostro obiettivo è semplificare la vita agli studenti universitari, offrendo loro una piattaforma
                    dove poter trovare facilmente i libri e gli appunti di cui hanno bisogno per seguire i propri corsi
                    di
                    studi.</p>
            </div>
        </section>
        <section id="disclaimer">
            <img src="./assets/imgs/studyingheadphones_square.jpg" class="sectionimg" />
            <div class="text">
                <p>
                    Sul nostro sito potrete cercare libri, appunti e ripetizioni specificando parametri quali titolo,
                    autore, corso di studi, ecc.; inoltre, potrete mettervi in contatto direttamente con i venditori per
                    accordarvi sui dettagli dell'acquisto.</p>

                <!-- <p>
                    Vi ricordiamo che <abbr title="Book Tutoring Notes">BTN</abbr> non si occupa di gestire l'acquisto finale ma solo di fare da vetrina per
                    gli annunci di libri, appunti e ripetizioni in vendita. Vogliamo offrire un punto di incontro tra
                    venditori
                    e acquirenti, che rimangono responsabili delle trattative e dell'acquisto finale.</p> -->
            </div>
        </section>
    </main>

    <footer>
        <p><abbr title="Book Tutoring Notes">BTN</abbr></p>
    </footer>
</body>

</html>