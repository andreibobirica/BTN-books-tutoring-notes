<?php
require_once './core/loginCtrl.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Effettua il login su BTN per vendere libri, annunci e ripetizioni o vedere gli elementi salvati.">
    <meta name="keywords" content="BTN, login">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>BTN - Login</title>
</head>

<body>
    <header>
        <div>
            <h1><a href="./index.html" class="logo"><abbr title="Book Tutoring Notes">BTN</abbr></a></h1>
            <button id="menu-btn" class="button" onclick="menuOnClick()"><span lang="en">MENU</span></button>
        </div>

        <?php printItemNavMenu("accedi",$auth->getIfLogin());?>

    </header>
    <?php printItemBreadcrumb("accedi"); ?>
    <main id="login-main">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="login-form" method="POST">
            <h2 id="login-title" lang ="en">Login</h2>
            <label lang="en"><strong>Username</strong></label>
            <input type="text" placeholder="Utente" name="utente" />
            <label><strong><span lang="en">Password</span></strong></label>
            <input type="password" placeholder="Password" name="password" />
            <button type="submit" id="login-button">Accedi</button>

            <p>Prima volta su <abbr title="Book Tutoring Notes">BTN</abbr>? <a href="registrazione.html">Registrati</a>
            </p>
        </form>
    </main>

    <footer>
        <p><abbr title="Book Tutoring Notes">BTN</abbr></p>
    </footer>
</body>

</html>