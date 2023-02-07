<?php
require_once "./utils/edit_account_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$edit_account_content = file_get_contents("./contents/edit_account_content.html");
$edit_account = boilerplate($edit_account_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("edit_account", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("edit_account");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$edit_account = str_replace('<php-header />', $header, $edit_account);
$edit_account = str_replace('php-action', $_SERVER['PHP_SELF'], $edit_account);
$edit_account = str_replace('<php-footer />', $footer, $edit_account);
if ($auth->getIfLogin()) {
    // Messaggio di benvenuto e informazioni utente
    $user_nome = $_SESSION["nameAccount"];
    $user_cognome = $_SESSION["surnameAccount"];
    $user_username = $_SESSION["loginAccount"];
    $user_email = $_SESSION["emailAccount"];
    $user_birth = $_SESSION["birthdateAccount"];
    //$user_birth =substr($user_birth, 8, 2) . "-" . substr($user_birth, 5, 2) . "-" . substr($user_birth, 0, 4);
    $edit_account = str_replace('php-value-nome'," value='".$user_nome."' ", $edit_account);
    $edit_account = str_replace('php-value-cognome'," value='".$user_cognome."' ", $edit_account);
    $edit_account = str_replace('php-value-username'," value='".$user_username."' ", $edit_account);
    $edit_account = str_replace('php-value-email'," value='".$user_email."' ", $edit_account);
    $edit_account = str_replace('php-value-data'," value='".$user_birth."' ", $edit_account);
    $edit_account = str_replace('php-value-oldusername'," value='".$user_username."' ", $edit_account);
    $edit_account = str_replace('php-value-password'," value='' ", $edit_account);
    $edit_account = str_replace('php-value-confPassword'," value='' ", $edit_account);
    $edit_account = str_replace('php-old-name',$user_nome, $edit_account);
    $edit_account = str_replace('php-old-surname', $user_cognome, $edit_account);
    $edit_account = str_replace('php-old-username', $user_username, $edit_account);
    $edit_account = str_replace('php-old-email', $user_email, $edit_account);
    
    if(isset($_GET['errore']) && !empty($_GET['errore']))
        $edit_account = str_replace('<php-errore />', "<p class='backend-error'>$_GET[errore]</p>", $edit_account);
    else
        $registration = str_replace('<php-errore />', "", $edit_account);
    }
// Mostro la pagina
echo $edit_account;
?>