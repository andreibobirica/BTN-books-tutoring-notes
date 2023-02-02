<?php
require_once "./core/login_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$login_content = file_get_contents("./contents/login_content.html");
$login = boilerplate($login_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("accedi", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("accedi");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$login = str_replace('<php-header />', $header, $login);
$login = str_replace('<php-footer />', $footer, $login);
if(!isset($_GET['errore']))
    $login = str_replace('<php-errore />', "", $login);
else
    $login = str_replace('<php-errore />', "<p class='backend-error'>Username o password errati</p>", $login);
// Mostro la pagina
echo $login;
?>