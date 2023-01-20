<?php
require_once './core/new_listing_control.php';

// Prendo l'HTML della pagina, dell'header e del footer
$new_listing = file_get_contents("./contents/new_listing_content.html");
$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printNavbar("inserimentoAnnuncio", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("new_listing");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$header = str_replace('<breadcrumb/>', $breadcrumb, $header);
$new_listing = str_replace('<php-header />', $header, $new_listing);

$new_listing = str_replace('php-action', $_SERVER['PHP_SELF'], $new_listing);

$new_listing = str_replace('<php-footer />', $footer, $new_listing);

// Mostro la pagina
echo $new_listing;
?>