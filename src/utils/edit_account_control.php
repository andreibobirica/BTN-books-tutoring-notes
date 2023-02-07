<?php
require_once "imports.php";
require_once './utils/Sanitizer.php';
$san = new Sanitizer();

if ($auth->getIfLogin()) {
    if (isset($_POST['username'])) {
        //Responso corretto
        $retResponse = array(
            "return" => true,
            "error" => array()
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
        if (!$san->validateEmail($email)) {
            array_push($retResponse['error'], "Formato email non corretto");
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

        $verifica = $san->validateEmail($email) && $san->validateNameMaxLength($nome)
            && $san->validateUsername($username) && $san->validateNameMaxLength($cognome) && $san->validateDate($dataNascita);

        if (!empty($password) || !empty($confPassword)) {
            if (!$san->validatePassword($password)) {
                array_push($retResponse['error'], "Formato password non corretto");
            }
            
            $verifica = $verifica && $san->validatePassword($password);
        }
        //Procedura di registrazione
        if ($verifica) {
            $retResponse = $auth->edit_account($oldUsername, $username, $email, $nome, $cognome, $dataNascita, $password, $confPassword);
        } else {
            header("Location: ./edit_account.php?errore=" . implode(" - ", $retResponse['error']));
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