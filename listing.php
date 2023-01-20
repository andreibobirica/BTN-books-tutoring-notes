<?php
require_once "./core/listing-control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$listing = file_get_contents("./contents/listing_content.html");
$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printNavbar("annuncio", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("annuncio");
// Prendo il percorso e inserisco l'immagine
$php_img = '<img width="500" height="600" src='.$arrayAnnuncio["mediapath"].'>';

// Controllo il login ed in caso mostro i bottoni per modificare e eliminare l'annuncio
$button_edit = '<a href="edit_listing.php?modifica="'.$arrayAnnuncio['id'].'">Modifica</a>';
$button_delete = '<a href="edit_listing.php?elimina="'.$arrayAnnuncio['id'].'">Elimina</a>';

if($auth->getIfLogin()) {
    $listing = str_replace('<php-buttons/>', $button_edit.$button_delete, $listing);
}

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$header = str_replace('<breadcrumb/>', $breadcrumb, $header);
$listing = str_replace('<php-header />', $header, $listing);
$listing = str_replace('<php-array/>', implode($arrayAnnuncio), $listing);
$listing = str_replace('<php-img/>', $php_img, $listing);
$listing = str_replace('<php-footer />', $footer, $listing);

// Mostro la pagina
echo $listing;
?>