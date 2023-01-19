<?php
require_once './core/registrazioneCtrl.php';
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

        <?php printItemNavMenu("registrazione",$auth->getIfLogin());?>

    </header>
    <?php printBreadcrumb("registrati"); ?>
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