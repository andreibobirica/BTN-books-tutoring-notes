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

if ($auth->getIfLogin()) {
    if (isset($_POST['username'])) {
        //Responso corretto
        $retResponse = array(
            "return" => true,
            "error" => ""
        );

        //Verifico input
        $username = $san->sanitizeString($_POST["username"]);
        $oldUsername = $san->sanitizeString($_POST["modifica"]);
        $email = $san->sanitizeString($_POST["email"]);
        $password = $san->sanitizeString($_POST["password"]);
        $confPassword = $san->sanitizeString($_POST["confPassword"]);
        $nome = $san->sanitizeString($_POST["nome"]);
        $cognome = $san->sanitizeString($_POST["cognome"]);
        $dataNascita = $san->sanitizeString($_POST["dataNascita"]);
        if (!$san->validateEmail($email))$retResponse['error'].="Formato email non corretto - ";
        if (!$san->validateNameMaxLength($nome))$retResponse['error'].="Formato nome non corretto - ";
        if (!$san->validateNameMaxLength($cognome))$retResponse['error'].="Formato cognome non corretto - ";
        if (!$san->validateUsername($username))$retResponse['error'].="Formato username non corretto - ";
        if (!$san->validateDate($dataNascita))$retResponse['error'].="Data immessa non corretta - ";
        $verifica = $san->validateEmail($email) && $san->validateNameMaxLength($nome) 
        && $san->validateUsername($username) && $san->validateNameMaxLength($cognome) && $san->validateDate($dataNascita);
        
        if(!empty($password) || !empty($confPassword)){
            if (!$san->validatePassword($password))$retResponse['error'].=" Formato password non corretto - ";
            if (!$san->validatePassword($confPassword))$retResponse['error'].="Formato password conferma non corretto - ";
            $verifica = $verifica && $san->validatePassword($password) && $san->validatePassword($confPassword);
        }
        //Procedura di registrazione
        if ($verifica){
            $retResponse = $auth->edit_account($oldUsername, $username, $email, $nome, $cognome, $dataNascita, $password, $confPassword);
        }
        else{
            header("Location: ./edit_account.php?errore='$retResponse[error]'");
            exit();
        }

        if ($retResponse["return"] === TRUE) {
            header("Location: ./area_riservata.php");    
        } else {
            header("Location: ./edit_account.php?errore='$retResponse[error]'");
        }
    }
} else {
    header("Location: ./login.php");
}
?>
