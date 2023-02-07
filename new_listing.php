<?php
require_once './core/new_listing_control.php';

// Prendo l'HTML della pagina, dell'header e del footer
$new_listing_content = file_get_contents("./contents/new_listing_content.html");
$new_listing = boilerplate($new_listing_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$header = printHeader("inserimentoAnnuncio", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("new_listing", $_GET['categoria']);

$new_listing_file = '<label for="new-listing-file" class="">Carica una foto</label>';
$new_listing_file .= '<input type="file" name="mediapath" id="new-listing-file">';

$new_listing_author = '<label for="new-listing-author">Autore</label>';
$new_listing_author .= '<input type="text" placeholder="Inserisci autore" maxlength="40" name="autore" id="new-listing-author" required/>';

$new_listing_edition = '<label for="new-listing-edition">Edizione</label>';
$new_listing_edition .= '<input type="text" placeholder="Inserisci edizione" maxlength="40" name="edizione" id="new-listing-edition" required/>';

$new_listing_isbn = '<label id="labelISBN" for="new-listing-isbn">ISBN</label>';
$new_listing_isbn .= '<input id="new-listing-isbn" type="text" placeholder="Inserisci ISBN" maxlength="13" name="isbn" id="new-listing-isbn" required/>';
$new_listing_isbn .= '<p id="isbn-errore" class="input-hint">10-13 cifre</p>';

$new_listing_cat_libri = '<input type="hidden" name="categoria" value="libri" id="new-listing-categoria" />';
$new_listing_cat_appunti = '<input type="hidden" name="categoria" value="appunti" id="new-listing-categoria" />';
$new_listing_cat_ripetizioni = '<input type="hidden" name="categoria" value="ripetizioni" id="new-listing-categoria" />';


// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$new_listing = str_replace('<php-header />', $header, $new_listing);

$new_listing = str_replace('php-action', $_SERVER['PHP_SELF'], $new_listing);

// MOSTRARE O NASCONDERE IN BASE AL TIPO DI ANNUNCIO
if($_GET["categoria"]=="libri"){
    $new_listing = str_replace('<!-- <php-author /> -->', $new_listing_author, $new_listing);
    $new_listing = str_replace('<!-- <php-edition /> -->', $new_listing_edition, $new_listing);
    $new_listing = str_replace('<!-- <php-isbn /> -->', $new_listing_isbn, $new_listing);
    $new_listing = str_replace('<!-- <php-categoria /> -->', $new_listing_cat_libri, $new_listing);
    $new_listing = str_replace('<!-- <php-file /> -->', $new_listing_file, $new_listing);
}
if($_GET["categoria"]=="appunti"){
    $new_listing = str_replace('<!-- <php-author /> -->', '', $new_listing);
    $new_listing = str_replace('<!-- <php-edition /> -->', '', $new_listing);
    $new_listing = str_replace('<!-- <php-isbn /> -->', '', $new_listing);
    $new_listing = str_replace('<!-- <php-categoria /> -->', $new_listing_cat_appunti, $new_listing);
    $new_listing = str_replace('<!-- <php-file /> -->', $new_listing_file, $new_listing);
}
if($_GET["categoria"]=="ripetizioni"){
    $new_listing = str_replace('<!-- <php-author /> -->', '', $new_listing);
    $new_listing = str_replace('<!-- <php-edition /> -->', '', $new_listing);
    $new_listing = str_replace('<!-- <php-isbn /> -->', '', $new_listing);
    $new_listing = str_replace('<!-- <php-file /> -->', '', $new_listing);
    $new_listing = str_replace('<!-- <php-categoria /> -->', $new_listing_cat_ripetizioni, $new_listing);
}

$new_listing = str_replace('<php-footer />', $footer, $new_listing);
$new_listing = str_replace('php-type', $_GET['categoria'], $new_listing);

//gestione errori
if(isset($_GET['errore']) && !empty($_GET['errore']))
    $new_listing = str_replace('<php-errore />', "<p class='backend-error'>$_GET[errore]</p>", $new_listing);
else
    $new_listing = str_replace('<php-errore />', "", $new_listing);

// Mostro la pagina
echo $new_listing;
?>