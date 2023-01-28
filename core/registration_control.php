<?php
//Start Session
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/header.php';
require_once "imports.php";
require_once './core/Sanitizer.php';
$san = new Sanitizer();

if(isset($_POST['username']) && !empty($_POST['username'])){
    //Verifico input
    $username = $san->sanitizeString($_POST["username"]);
    $email = $san->sanitizeString($_POST["email"]);
    $password = $san->sanitizeString($_POST["password"]);
    $confPassword = $san->sanitizeString($_POST["confPassword"]);
    $nome = $san->sanitizeString($_POST["nome"]);
    $cognome = $san->sanitizeString($_POST["cognome"]);
    $dataNascita = $san->sanitizeString($_POST["dataNascita"]);
    if (!$san->validateEmail($email))print("email");
    if (!$san->validatePassword($password))print("password");
    if (!$san->validatePassword($confPassword))print("2password");
    if (!$san->validateName($nome))print("nome");
    if (!$san->validateName($cognome))print("cognome");
    if (!$san->validateDate($dataNascita))print("data");
    $verifica = $san->validateEmail($email) && $san->validatePassword($password)
        && $san->validatePassword($confPassword) && $san->validateName($nome) 
        && $san->validateName($cognome) && $san->validateDate($dataNascita);
    $verifica = $verifica && $password == $confPassword;

    //Responso corretto
    $retResponse = array(
        "return" => true,
        "error" => ""
    );
    //Procedura di registrazione
    if($verifica)
    $retResponse = $auth->register($username, $email, $password, $confPassword, $nome, $cognome, $dataNascita);
    if (!$verifica) {
        print("Errore nei dati inseriti, riprovare");
    }else if ($retResponse["return"] === TRUE) {
        print("
        <script>
        alert('Registrazione Avvenuta con successo');
        window.location = './area_riservata.php';
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
