<?php
require_once "./core/mod_account_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$mod_account_content = file_get_contents("./contents/mod_account_content.html");
$mod_account = boilerplate($mod_account_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("mod_account", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("mod_account");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$mod_account = str_replace('<php-header />', $header, $mod_account);
$mod_account = str_replace('php-action', $_SERVER['PHP_SELF'], $mod_account);
$mod_account = str_replace('<php-footer />', $footer, $mod_account);
if ($auth->getIfLogin()) {
    // Messaggio di benvenuto e informazioni utente
    $user_nome = $_SESSION["nameAccount"];
    $user_cognome = $_SESSION["surnameAccount"];
    $user_username = $_SESSION["loginAccount"];
    $user_email = $_SESSION["emailAccount"];
    $user_birth = $_SESSION["birthdateAccount"];
    //$user_birth =substr($user_birth, 8, 2) . "-" . substr($user_birth, 5, 2) . "-" . substr($user_birth, 0, 4);
    $password = $auth->getPassword($user_username);
    $mod_account = str_replace('php-value-nome'," value='".$user_nome."' ", $mod_account);
    $mod_account = str_replace('php-value-cognome'," value='".$user_cognome."' ", $mod_account);
    $mod_account = str_replace('php-value-username'," value='".$user_username."' ", $mod_account);
    $mod_account = str_replace('php-value-email'," value='".$user_email."' ", $mod_account);
    $mod_account = str_replace('php-value-data'," value='".$user_birth."' ", $mod_account);
    $mod_account = str_replace('php-value-oldusername'," value='".$user_username."' ", $mod_account);
    $mod_account = str_replace('php-value-password'," value='".$password."' ", $mod_account);
    $mod_account = str_replace('php-value-confPassword'," value='".$password."' ", $mod_account);

}
// Mostro la pagina
echo $mod_account;
?>