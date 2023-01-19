<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once './core/Authentification.php';
$auth = new Authentification();

if(isset($_POST['username']) && !empty($_POST['username'])){

    require_once './core/Sanitizer.php';
    $san = new Sanitizer();
    
    $username = $san->sanitizeString($_POST["username"]);
    $email = $san->sanitizeString($_POST["email"]);
    $password = $san->sanitizeString($_POST["password"]);
    $confPassword = $san->sanitizeString($_POST["confPassword"]);
    $nome = $san->sanitizeString($_POST["nome"]);
    $cognome = $san->sanitizeString($_POST["cognome"]);
    $dataNascita = $san->sanitizeString($_POST["dataNascita"]);

    //Responso corretto
    $retResponse = array(
        "return" => true,
        "error" => ""
    );
    //Procedura di registrazione
    $retResponse = $auth->register($username, $email, $password, $confPassword, $nome, $cognome, $dataNascita);
    if ($retResponse["return"] === TRUE) {
        print("
        <script>
        alert('Registrazione Avvenuta con successo');
        window.location = './areariservata.php';
        </script>
        ");
    } else {
        //messaggio di conferma non visibile dato che viene reindirizzato da php l'header
        print("
        <script>alert('Errore:". $retResponse['error']. " ');</script>
        ");
    }
}
?>



<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registrati su BTN per vendere libri, annunci e ripetizioni o salvare elementi di interesse.">
    <meta name="keywords" content="BTN, registrazione">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" async></script>
    <script src="assets/script/formManager.js" async></script>
    <title><abbr title="Book Tutoring Notes">BTN</abbr> - Registrazione</title>
</head>

<body>
    <header>
        <div>
            <div>
                <h1><a href="./index.html" class="logo"><abbr title="Book Tutoring Notes">BTN</abbr></a></h1>
                <button id="menu-btn" class="button" onclick="menuOnClick()"><span lang="en">MENU</span></button>
            </div>

            <button id="menu-btn" class="button" onclick="menuOnClick()"><span lang="en">MENU</span></button>
        </div>

        <nav id="menu">
            <ul>
                <li><a href="./index.php">Cerca</a></li>
                <li><a href="./info.php">Info</a></li>
                <?php if(!$auth->getIfLogin()) : ?>
                    <li><a href="./login.php">Accedi</a></li>
                    <li>Registrati</li>
                <?php else :?>
                    <li><a href="./areariservata.php">Area Riservata</a></li>
                    <li><a href="./areariservata.php?logout">Log Out</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <nav id="breadcrumb">
        <p><a href="./index.html" lang="en">Home</a> / Registrazione</p>
    </nav>
    <main id="login-main">
        <div id="registration-container">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="registration-form" method="POST">
                <label id="labelNome"><strong>Nome</strong></label>
                <input type="text" placeholder="Inserisci il tuo nome" maxlength="25" name="nome" id="inputNome" />
                <label id="labelCognome"><strong>Cognome</strong></label>
                <input type="text" placeholder="Inserisci il tuo cognome" maxlength="25" name="cognome"
                    id="inputCognome" />
                <label id="labelUsername" lang="en"><strong>Username</strong></label>
                <input type="text" placeholder="Inserisci il tuo username" maxlength="30" name="username"
                    id="inputUsername" />
                <label id="labelPassword" lang="en"><strong>Password</strong></label>
                <input type="password" placeholder="Password" maxlength="50" name="password" id="inputPassword" />
                <label id="labelConfPassword"><strong>Conferma <span lang="en">Password</span></strong></label>
                <input type="password" placeholder="Reinserici la tua password" maxlength="50" name="confPassword"
                    id="inputConfPassword" />
                <label id="labelDataNascita"><strong>Data di nascita</strong></label>
                <input type="date" placeholder="Data di nascita" name="dataNascita" id="inputDataNascita" />
                <label id="labelEmail" lang="en"><strong>Email</strong></label>
                <input type="email" placeholder="Inserisci la tua E-mail" maxlength="70" name="email" id="inputEmail" />

                <button type="submit" id="login-button">Registrati</button>
                <p>Hai già un <span lang ="en">account</span>?<a href="login.php"> Accedi</a></p>
            </form>

            <h2>I vantaggi di registrarsi</h2>
            <ul id="listaVantaggi">
                <li>
                    <span id="addAnnuncioImg"></span>
                    <p>Ottieni la possibilità di aggiungere annunci</p>
                </li>
                <li>
                    <span id="salvaAnnuncioImg"></span>
                    <p>Salva gli annunci che ti interessano con la possibilità di ritrovarli facilmente</p>
                </li>
                <li>
                    <span id="feedbackImg"></span>
                    <p>Ottieni la possiblità di lasciare un feedback sulla tua esperienza utente</p>
                </li>
            </ul>
        </div>


        </div>
    </main>

    <footer>
        <p><abbr title="Book Tutoring Notes">BTN</abbr></p>
    </footer>
</body>

</html>