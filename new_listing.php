<?php
require_once './core/new_listing_control.php';

// Prendo l'HTML della pagina, dell'header e del footer
$new_listing_content = file_get_contents("./contents/new_listing_content.html");
$new_listing = boilerplate($new_listing_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$header = printHeader("inserimentoAnnuncio", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("new_listing");

$new_listing_file = '<label for="new-listing-file" class="">Carica una foto</label>';
$new_listing_file .= '<input type="file" name="mediapath" id="new-listing-file">';

$new_listing_author = '<label for="new-listing-author">Autore</label>';
$new_listing_author .= '<input type="text" placeholder="Inserisci autore" maxlength="25" name="autore" id="new-listing-author" />';

$new_listing_edition = '<label for="new-listing-edition">Edizione</label>';
$new_listing_edition .= '<input type="text" placeholder="Inserisci edizione" maxlength="25" name="edizione" id="new-listing-edition" />';

$new_listing_isbn = '<label for="new-listing-isbn">ISBN</label>';
$new_listing_isbn .= '<input type="text" placeholder="Inserisci ISBN" maxlength="25" name="isbn" id="new-listing-isbn" />';

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$new_listing = str_replace('<php-header />', $header, $new_listing);

$new_listing = str_replace('php-action', $_SERVER['PHP_SELF'], $new_listing);

// MOSTRARE O NASCONDERE IN BASE AL TIPO DI ANNUNCIO
$new_listing = str_replace('<php-file />', $new_listing_file, $new_listing);
$new_listing = str_replace('<php-author />', $new_listing_author, $new_listing);
$new_listing = str_replace('<php-edition />', $new_listing_edition, $new_listing);
$new_listing = str_replace('<php-isbn />', $new_listing_isbn, $new_listing);

$new_listing = str_replace('<php-footer />', $footer, $new_listing);

// Mostro la pagina
echo $new_listing;
?>