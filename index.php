<?php
require_once "./core/index_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$home = file_get_contents("./contents/home_content.html");
$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printNavbar("cerca", $auth->getIfLogin());

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$home = str_replace('<php-header />', $header, $home);
$home = str_replace('<php-footer />', $footer, $home);

// Mostro la pagina
echo $home;
?>