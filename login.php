<?php
require_once "./core/login_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$login = file_get_contents("./contents/login_content.html");
$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printNavbar("login", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("login");

$login_form = '<form action="./core/login_control.php" id="login-form" method="POST">';

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$header = str_replace('<breadcrumb/>', $breadcrumb, $header);
$login = str_replace('<php-header />', $header, $login);
$login = str_replace('<php-form>', $login_form, $login);
$login = str_replace('</php-form>', '</form>', $login);
$login = str_replace('<php-footer />', $footer, $login);

// Mostro la pagina
echo $login;
?>