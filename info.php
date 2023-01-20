<?php
require_once "./core/index_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$info = file_get_contents("./contents/info_content.html");
$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printNavbar("cerca", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("info");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$header = str_replace('<breadcrumb/>', $breadcrumb, $header);
$info = str_replace('<php-header />', $header, $info);
$info = str_replace('<php-footer />', $footer, $info);

// Mostro la pagina
echo $info;
?>