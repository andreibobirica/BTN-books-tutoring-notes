<?php
require_once "./core/listing_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$listing_content = file_get_contents("./contents/listing_content.html");
$listing = boilerplate($listing_content);

$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$header = printHeader("annuncio", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("annuncio", $arrayAnnuncio['id']);
// Prendo il percorso e inserisco l'immagine
$listing_img = '<img width="300" height="400" src="' . $arrayAnnuncio["mediapath"] . '">';

// Controllo il login e mostro le parti corrette
$listing_price = '<p id="listing-price">' . $arrayAnnuncio['prezzo'] . '€</p>';
$listing_title = '<dd>' . $arrayAnnuncio['titolo'] . '</dd>';
$listing_subject = '<dd>' . $arrayAnnuncio['materia'] . '</dd>';
$listing_descr = '<p id="listing-descr">'.$arrayAnnuncio['descrizione'].'</p>';


$button_save = '<a href="" class="listing-btn">Salva annuncio</a>';
$button_edit = '<a href="edit_listing.php?modifica="' . $arrayAnnuncio['id'] . '" class="listing-btn">Modifica annuncio</a>';
$button_delete = '<a href="edit_listing.php?elimina="' . $arrayAnnuncio['id'] . '" class="listing-btn">Elimina annuncio</a>';
$user_email = '<a href="mailto:$mailVenditore" class="listing-btn">$mailVenditore</a>';

if ($auth->getIfLogin()) {
    if ($arrayAnnuncio['username'] == $_SESSION["loginAccount"]) {
        $listing = str_replace('<php-buttons />', $button_edit . $button_delete, $listing);
    } else {
        $listing = str_replace('<php-buttons />', $button_save . $user_email, $listing);
    }
}

if (!empty($arrayAnnuncio['autore'])) {
    $book_author = '<div class="definition">
    <dt>Autore</dt>
    <dd>' . $arrayAnnuncio['autore'] . '</dd>
</div>';
}

if (!empty($arrayAnnuncio['edizione'])) {
    $book_edition = '<div class="definition">
    <dt>Edizione</dt>
    <dd>' . $arrayAnnuncio['edizione'] . '</dd>
</div>';
}

if (!empty($arrayAnnuncio['isbn'])) {
    $book_isbn = '<div class="definition">
    <dt>ISBN</dt>
    <dd>' . $arrayAnnuncio['isbn'] . '</dd>
</div>';
}

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$listing = str_replace('<php-header />', $header, $listing);

$listing = str_replace('<php-img />', $listing_img, $listing);
$listing = str_replace('<php-price />', $listing_price, $listing);
$listing = str_replace('<php-title />', $listing_title, $listing);
$listing = str_replace('<php-descr />', $listing_descr, $listing);
$listing = str_replace('<php-subject />', $listing_subject, $listing);
$listing = str_replace('<php-author />', $book_author, $listing);
$listing = str_replace('<php-edition />', $book_edition, $listing);
$listing = str_replace('<php-isbn />', $book_isbn, $listing);

$listing = str_replace('<php-footer />', $footer, $listing);

// Mostro la pagina
echo $listing;
?>