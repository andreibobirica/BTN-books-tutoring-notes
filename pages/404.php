<?php
require_once "./utils/imports.php";

// Prendo l'HTML della pagina, dell'header e del footer
$not_found_content = file_get_contents("./contents/404_content.html");
$not_found = boilerplate($not_found_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("err", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("404");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$not_found = str_replace('<php-header />', $header, $not_found);
$not_found = str_replace('<php-footer />', $footer, $not_found);

// Mostro la pagina
echo $not_found;
?>