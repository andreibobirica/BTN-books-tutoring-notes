<?php
require_once "./core/header.php";
require_once "./core/Authentication.php";
$auth = new Authentication();
require_once "./core/imports.php";

// Prendo l'HTML della pagina, dell'header e del footer
$info = file_get_contents("./contents/info_content.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("info", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("info");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$info = str_replace('<php-header />', $header, $info);
$info = str_replace('<php-footer />', $footer, $info);

// Mostro la pagina
echo $info;
?>