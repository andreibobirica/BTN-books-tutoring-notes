<?php
require_once "./core/index_control.php";
require_once "./core/imports.php";

// Prendo l'HTML della pagina, dell'header e del footer
$info_content = file_get_contents("./contents/home_content.html");
$info = boilerplate($info_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("cerca", $auth->getIfLogin());

// Rimpiazzo i segnaposti coi contenuti HTML
$info = str_replace('<php-header />', $header, $info);
$info = str_replace('<php-footer />', $footer, $info);

// Mostro la pagina
echo $info;
?>