<?php
require_once "./core/header.php";
require_once "./core/Authentication.php";
$auth = new Authentication();


// Prendo l'HTML della pagina, dell'header e del footer
$server_error = file_get_contents("./contents/500_content.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("err", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("500");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$server_error = str_replace('<php-header />', $header, $server_error);
$server_error = str_replace('<php-footer />', $footer, $server_error);

// Mostro la pagina
echo $server_error;
?>