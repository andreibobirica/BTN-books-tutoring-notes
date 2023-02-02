<?php

require_once './core/Authentication.php';
$auth = new Authentication();
require_once './core/header.php';
require_once "imports.php";
require_once './core/Sanitizer.php';
$san = new Sanitizer();

if (isset($_POST['username'])) {
    //Responso corretto
    $retResponse = array(
        "return" => true,
        "error" => array()
    );

    //Verifico input
    $username = $san->sanitizeString($_POST["username"]);
    $email = $san->sanitizeString($_POST["email"]);
    $password = $san->sanitizeString($_POST["password"]);
    $confPassword = $san->sanitizeString($_POST["confPassword"]);
    $nome = $san->sanitizeString($_POST["nome"]);
    $cognome = $san->sanitizeString($_POST["cognome"]);
    $dataNascita = $san->sanitizeString($_POST["dataNascita"]);
    if (!$san->validateEmail($email)) {
        array_push($retResponse['error'], "Formato email non corretto");
    }
    if (!$san->validatePassword($password)) {
        array_push($retResponse['error'], "Formato password non corretto");
    }
    if (!$san->validatePassword($confPassword)) {
        array_push($retResponse['error'], "Formato conferma password non corretto");
    }
    if (!$san->validateNameMaxLength($nome)) {
        array_push($retResponse['error'], "Formato nome non corretto");
    }
    if (!$san->validateNameMaxLength($cognome)) {
        array_push($retResponse['error'], "Formato cognome non corretto");
    }
    if (!$san->validateUsername($username)) {
        array_push($retResponse['error'], "Formato username non corretto");
    }
    if (!$san->validateDate($dataNascita)) {
        array_push($retResponse['error'], "Data immessa non corretta");
    }
    $verifica = $san->validateEmail($email) && $san->validatePassword($password)
        && $san->validatePassword($confPassword) && $san->validateNameMaxLength($nome) && $san->validateUsername($username)
        && $san->validateNameMaxLength($cognome) && $san->validateDate($dataNascita);

    //Procedura di registrazione
    if ($verifica)
        $retResponse = $auth->register($username, $email, $password, $confPassword, $nome, $cognome, $dataNascita);
    else {
        header('Location: ./registration.php?errore=' . implode(" - ", $retResponse['error']));
        exit();
    }

    if ($retResponse["return"] === TRUE) {
        header("Location: ./area_riservata.php");
    } else {
        //messaggio di conferma non visibile dato che viene reindirizzato da php l'header
        header("Location: ./registration.php?errore='$retResponse[error]'");
    }
}
?>