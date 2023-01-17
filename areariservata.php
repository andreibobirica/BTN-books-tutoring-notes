<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once 'Authentification.php';
$auth = new Authentification();

//LogOut
if (isset($_GET["logout"])) {
  session_destroy(); //destroy the session
  header("location:/ProgettoTecWeb/index.php"); //to redirect back to "index.php" after logging out
  exit();
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
                    <li>Area Riservata</li>
                    <li><a href="./areariservata.php?logout">Log Out</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <?php if(!$auth->getIfLogin()) : ?>
      <div class="container">
      <div id="welcome-message">
        <h2>Utente Non Loggato</h2><span>Si prega di effetuare il Login Prima<span>
        <p>Hai già un <span lang ="en">account</span>?<a href="login.php"> Accedi</a></p>
        <p>Prima volta su <abbr title="Book Tutoring Notes">BTN</abbr>? <a href="registrazione.html">Registrati</a></p>
      </div>
    </div>       
    <?php else :?>
      <div class="container">
        <div id="welcome-message">
          <h1>Benvenuto, <?php echo $_SESSION["loginAccount"]?></h1>
          <img src="./assets/imgs/icona.png"alt="" width="150" height="150" style="margin-top: 10px;">
        </div>
        <div id="user-info">
          <p>Nome: <?php echo $_SESSION["nameAccount"]?></p>
          <p>Cognome: <?php echo $_SESSION["surnameAccount"]?></p>
          <p>Email: <?php echo $_SESSION["emailAccount"]?></p>
          <p>Data Di Nascita: <?php echo $_SESSION["birthdateAccount"]?></p>
        </div>
      </div>
      <div id="annunci-container" >
        <div id="annunci-pubblicati">
          <!-- tabella annunci pubblicati -->
          <h3>Annunci pubblicati</h3>
          <table>
            <tr>
              <th>Titolo</th>
              <th>Materia Scolastica</th>
              <th>Prezzo</th>
            </tr>
            <tr>
              <td>Libro di Matematica</td>
              <td>Matematica</td>
              <td>10$</td>
            </tr>

          </table>
        </div>

        <div id="annunci-salvati">
          <!-- tabella annunci salvati -->
          <h3>Annunci salvati</h3>
          <table>
            <tr>
              <th>Titolo</th>
              <th>Materia Scolastica</th>
              <th>Prezzo</th>
            </tr>
            <tr>
              <td>Tutor privato</td>
              <td>Inglese</td>
              <td>€30/ora</td>
            </tr>
          </table>
        </div>
      </div>
    <?php endif; ?>

    
</body>
