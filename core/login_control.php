<?php
require_once "imports.php";
require_once 'Sanitizer.php';
$san = new Sanitizer();

if (isset($_POST['utente']) && !empty($_POST['utente'])) {
    //Verifico Input
    $username = $san->sanitizeString($_POST["utente"]);
    $password = $san->sanitizeString($_POST["password"]);
    $retResponse = $auth->login($username,$password);
    if ($retResponse === TRUE) {
        header("Location: ../area_riservata.php");
    } else {
        header("Location: ../login.php?errore");
    }
}
?>
