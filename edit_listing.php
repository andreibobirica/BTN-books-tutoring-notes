<?php
require_once './core/edit_listing_control.php';

// Prendo l'HTML della pagina, dell'header e del footer
$edit_listing_content = file_get_contents("./contents/edit_listing_content.html");
$edit_listing = boilerplate($edit_listing_content);

$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printHeader("editListing", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("edit_listing", $arrayAnnuncio['id'] );

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$edit_listing = str_replace('<php-header />', $header, $edit_listing);

$edit_listing = str_replace('php-action', $_SERVER['PHP_SELF'], $edit_listing);
$edit_listing = str_replace('php-listing-title', $arrayAnnuncio['titolo'], $edit_listing);
$edit_listing = str_replace('php-listing-descr', $arrayAnnuncio['descrizione'], $edit_listing);
$edit_listing = str_replace('php-listing-price', $arrayAnnuncio['prezzo'], $edit_listing);
$edit_listing = str_replace('php-listing-media', $arrayAnnuncio['mediapath'], $edit_listing);
$edit_listing = str_replace('php-listing-subject', $arrayAnnuncio['materia'], $edit_listing);
$edit_listing = str_replace('php-listing-author', $arrayAnnuncio['autore'], $edit_listing);
$edit_listing = str_replace('php-listing-edition', $arrayAnnuncio['edizione'], $edit_listing);
$edit_listing = str_replace('php-listing-ISBN', $arrayAnnuncio['isbn'], $edit_listing);
$edit_listing = str_replace('php-button-value', $_GET["modifica"], $edit_listing);

// Non si può cambiare tipo di annuncio, ma viene mostrato il tipo corretto
$edit_listing = str_replace('value="'.$arrayAnnuncio['tipo'].'"', 'value="'.$arrayAnnuncio['tipo'].'" selected', $edit_listing);

$edit_listing = str_replace('<php-footer />', $footer, $edit_listing);

// Mostro la pagina
echo $edit_listing;
?>