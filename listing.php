<?php
require_once "./core/listing_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$listing_content = file_get_contents("./contents/listing_content.html");
$user_book = boilerplate($listing_content);

$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$header = printHeader("annuncio", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("annuncio", $arrayAnnuncio['titolo']);
// Prendo il percorso e inserisco l'immagine
$listing_img = '<img width="300" height="400" src="' . $arrayAnnuncio["mediapath"] . '">';

// Controllo il login e mostro le parti corrette
$listing_price = '<p id="listing-price">' . $arrayAnnuncio['prezzo'] . '€</p>';
$listing_title = $arrayAnnuncio['titolo'];
$listing_user = $arrayAnnuncio['username'];
$listing_subject = '<dd>' . $arrayAnnuncio['materia'] . '</dd>';
$listing_descr = '<p id="listing-descr">' . $arrayAnnuncio['descrizione'] . '</p>';


$button_save = '<a href="" class="listing-btn">Salva annuncio</a>';
$button_edit = '<a href="edit_listing.php?modifica="' . $arrayAnnuncio['id'] . '" class="listing-btn">Modifica annuncio</a>';
$button_delete = '<a href="edit_listing.php?elimina="' . $arrayAnnuncio['id'] . '" class="listing-btn">Elimina annuncio</a>';
$user_email = '<a href="mailto:$mailVenditore" class="listing-btn">$mailVenditore</a>';

if ($auth->getIfLogin()) {
    if ($arrayAnnuncio['username'] == $_SESSION["loginAccount"]) {
        $user_book = str_replace('<php-buttons />', $button_edit . $button_delete, $user_book);
    } else {
        $user_book = str_replace('<php-buttons />', $button_save . $user_email, $user_book);
    }
}

if (!empty($arrayAnnuncio['autore'])) {
    $book_author = $arrayAnnuncio['autore'];
    $book_author_def = '<div class="definition">
    <dt>Autore</dt>
    <dd>' . $book_author . '</dd>
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
$user_book = str_replace('<php-header />', $header, $user_book);

$user_book = str_replace('<php-img />', $listing_img, $user_book);
$user_book = str_replace('<php-price />', $listing_price, $user_book);
$user_book = str_replace('<php-title />', $listing_title, $user_book);
$user_book = str_replace('<php-descr />', $listing_descr, $user_book);
$user_book = str_replace('<php-subject />', $listing_subject, $user_book);
$user_book = str_replace('<php-user />', $listing_user, $user_book);
$user_book = str_replace('<php-author />', $book_author, $user_book);
$user_book = str_replace('<php-author-def />', $book_author_def, $user_book);
$user_book = str_replace('<php-edition-def />', $book_edition, $user_book);
$user_book = str_replace('<php-isbn-def />', $book_isbn, $user_book);

$user_book = str_replace('<php-footer />', $footer, $user_book);

// Mostro la pagina
echo $user_book;
?>