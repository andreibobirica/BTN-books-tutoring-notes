<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once 'Authentication.php';
$auth = new Authentication();
require_once 'navbar.php';
require_once "breadcrumb.php";

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
        window.location = '../area_riservata.php';
        </script>
        ");
    } else {
        print("
        <script>alert('Errore: Login ');</script>
        ");
    }
}
?>
