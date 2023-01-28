<?php
require_once './core/edit_listing_control.php';

// Prendo l'HTML della pagina, dell'header e del footer
$edit_listing_content = file_get_contents("./contents/edit_listing_content.html");
$edit_listing = boilerplate($edit_listing_content);

// Prendo il contenuto corretto della navbar
$header = printHeader("inserimentoAnnuncio", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("edit_listing", $_GET['categoria']);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printHeader("editListing", $auth->getIfLogin());
//Contenuti in base alla categoria di annuncio
$edit_listing_file = '<label for="new-listing-file" class="">Carica una foto</label>';
$edit_listing_file .= '<input type="file" name="mediapath" id="new-listing-file">';

$edit_listing_author = '<label for="new-listing-author">Autore</label>';
$edit_listing_author .= '<input type="text" value="'.$arrayAnnuncio['autore'].'" placeholder="Inserisci autore" maxlength="25" name="autore" id="new-listing-author" />';

$edit_listing_edition = '<label for="new-listing-edition">Edizione</label>';
$edit_listing_edition .= '<input type="text" value="'.$arrayAnnuncio['edizione'].'" placeholder="Inserisci edizione" maxlength="25" name="edizione" id="new-listing-edition" />';

$edit_listing_isbn = '<label for="new-listing-isbn">ISBN</label>';
$edit_listing_isbn .= '<input type="text" value="'.$arrayAnnuncio['isbn'].'" placeholder="Inserisci ISBN" maxlength="25" name="isbn" id="new-listing-isbn" />';

$edit_listing_cat_libri = '<input type="hidden" name="categoria" value="libri" id="new-listing-categoria" />';
$edit_listing_cat_appunti = '<input type="hidden" name="categoria" value="appunti" id="new-listing-categoria" />';
$edit_listing_cat_ripetizioni = '<input type="hidden" name="categoria" value="ripetizioni" id="new-listing-categoria" />';

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$edit_listing = str_replace('<php-header />', $header, $edit_listing);

//categoria
$edit_listing = str_replace('php-type', $_GET['categoria'], $edit_listing);
//aggiunta id al form
$edit_listing = str_replace('php-annuncio-id', " value='$arrayAnnuncio[id]' ", $edit_listing);


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
// MOSTRARE O NASCONDERE IN BASE AL TIPO DI ANNUNCIO
if($_GET["categoria"]=="libri"){
    $edit_listing = str_replace('<php-author />', $edit_listing_author, $edit_listing);
    $edit_listing = str_replace('<php-edition />', $edit_listing_edition, $edit_listing);
    $edit_listing = str_replace('<php-isbn />', $edit_listing_isbn, $edit_listing);
    $edit_listing = str_replace('<php-categoria />', $edit_listing_cat_libri, $edit_listing);
    $edit_listing = str_replace('<php-file />', $edit_listing_file, $edit_listing);
}
if($_GET["categoria"]=="appunti"){
    $edit_listing = str_replace('<php-author />', '', $edit_listing);
    $edit_listing = str_replace('<php-edition />', '', $edit_listing);
    $edit_listing = str_replace('<php-isbn />', '', $edit_listing);
    $edit_listing = str_replace('<php-categoria />', $edit_listing_cat_appunti, $edit_listing);
    $edit_listing = str_replace('<php-file />', $edit_listing_file, $edit_listing);
}
if($_GET["categoria"]=="ripetizioni"){
    $edit_listing = str_replace('<php-author />', '', $edit_listing);
    $edit_listing = str_replace('<php-edition />', '', $edit_listing);
    $edit_listing = str_replace('<php-isbn />', '', $edit_listing);
    $edit_listing = str_replace('<php-file />', '', $edit_listing);
    $edit_listing = str_replace('<php-categoria />', $edit_listing_cat_ripetizioni, $edit_listing);
}

// Non si può cambiare tipo di annuncio, ma viene mostrato il tipo corretto
$edit_listing = str_replace('value="'.$arrayAnnuncio['tipo'].'"', 'value="'.$arrayAnnuncio['tipo'].'" selected', $edit_listing);

$edit_listing = str_replace('<php-footer />', $footer, $edit_listing);

// Mostro la pagina
echo $edit_listing;
?>