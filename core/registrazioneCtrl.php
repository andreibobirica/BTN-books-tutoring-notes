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
