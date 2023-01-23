<?php
require_once "./core/login_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$login = file_get_contents("./contents/login_content.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("accedi", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("accedi");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$login = str_replace('<php-header />', $header, $login);
$login = str_replace('<php-footer />', $footer, $login);

// Mostro la pagina
echo $login;
?>