<?php
require_once "./core/index_control.php";
require_once "./core/imports.php";

// Prendo l'HTML della pagina, dell'header e del footer
$home_content = file_get_contents("./contents/home_content.html");
$home = boilerplate($home_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("cerca", $auth->getIfLogin());

// Rimpiazzo i segnaposti coi contenuti HTML
$home = str_replace('<php-header />', $header, $home);
$home = str_replace('<php-footer />', $footer, $home);

// Mostro la pagina
echo $home;
?>