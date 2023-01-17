<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once 'Authentification.php';
$auth = new Authentification();

if (isset($_POST['utente']) && !empty($_POST['utente'])) {
    require_once 'Sanitizer.php';
    $san = new Sanitizer();
    $username = $san->sanitizeString($_POST["utente"]);
    $password = $san->sanitizeString($_POST["password"]);

    $retResponse = $auth->login($username,$password);
    print_r($retResponse);
    if ($retResponse === TRUE) {
        print("
        <script>
        alert('Login Avvenuta con successo');
        window.location = './areariservata.php';
        </script>
        ");
    } else {
        print("
        <script>alert('Errore: Login ');</script>
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
    <meta name="description" content="Effettua il login su BTN per vendere libri, annunci e ripetizioni o vedere gli elementi salvati.">
    <meta name="keywords" content="BTN, login">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>BTN - Login</title>
</head>

<body>
    <header>
        <div>
            <div id="logo"><a href="./index.html">
                    <h1><abbr title="Book Tutoring Notes">BTN</abbr></h1>
                    <img src="./assets/imgs/button.png" alt="" width="60" height="60">
                </a>
            </div>

            <button id="menu-btn" class="button" onclick="menuOnClick()"><span lang="en">MENU</span></button>
        </div>

        <nav id="menu">
            <ul>
                <li><a href="./index.php">Cerca</a></li>
                <li><a href="./info.php">Info</a></li>
                <?php if(!$auth->getIfLogin()) : ?>
                    <li>Accedi</li>
                    <li><a href="./registrazione.php">Registrati</a></li>
                <?php else :?>
                    <li><a href="./areariservata.php">Area Riservata</a></li>
                    <li><a href="./areariservata.php?logout">Log Out</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <nav id="breadcrumb">
        <p><a href="./index.html" lang="en">Home</a> / <span lang="en">Login</span></p>
    </nav>

    <main id="login-main">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="login-form" method="POST">
            <h2 id="login-title" lang ="en">Login</h2>
            <label lang="en"><strong>Username</strong></label>
            <input type="text" placeholder="Utente" name="utente" />
            <label><strong><span lang="en">Password</span></strong></label>
            <input type="password" placeholder="Password" name="password" />
            <button type="submit" id="login-button">Accedi</button>

            <p>Prima volta su <abbr title="Book Tutoring Notes">BTN</abbr>? <a href="registrazione.html">Registrati</a></p>
        </form>
    </main>

    <footer>
        <p><abbr title="Book Tutoring Notes">BTN</abbr></p>
    </footer>
</body>

</html>