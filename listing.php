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
if ($arrayAnnuncio['tipo'] != "ripetizioni") {
    $listing_img = '<img width="300" height="400" src="' . $arrayAnnuncio["mediapath"] . '" alt="">';
    $listing_price = '<p id="listing-price">' . $arrayAnnuncio['prezzo'] . '&euro;</p>';
} else {
    $listing_img = "";
    $listing_price = '<p id="listing-price">' . $arrayAnnuncio['prezzo'] . '&euro;/ora</p>';
}
// Controllo il login e mostro le parti corrette
$listing_title = $arrayAnnuncio['titolo'];
$listing_user = $arrayAnnuncio['username'];
$listing_subject = '<dd>' . $arrayAnnuncio['materia'] . '</dd>';
$listing_descr = '<p id="listing-descr">' . $arrayAnnuncio['descrizione'] . '</p>';

$button_insert_save = '<a role="button" href="./listing.php?annuncio=' . $arrayAnnuncio['id'] . '&insertsave" class="listing-btn">Salva annuncio</a>';
$button_remove_save = '<a role="button" href="./listing.php?annuncio=' . $arrayAnnuncio['id'] . '&removesave" class="listing-btn">Rimuovi annuncio dai Salvati</a>';
$button_edit = '<a role="button" href="edit_listing.php?categoria=' . $arrayAnnuncio['tipo'] . '&modifica=' . $arrayAnnuncio['id'] . '" class="listing-btn">Modifica annuncio</a>';
$button_delete = '<a role="button" href="edit_listing.php?elimina=' . $arrayAnnuncio['id'] . '" class="listing-btn">Elimina annuncio</a>';
$user_email = '<a href="mailto:' . $arrayAnnuncio['email'] . '" class="listing-btn">' . $arrayAnnuncio['email'] . '</a>';

$button_save = "";
if ($auth->getIfLogin())
    $button_save = $button_insert_save;
if ($auth->getIfLogin() && $request->verifySaveAnnuncioUser($_SESSION["loginAccount"], $arrayAnnuncio['id'])) {
    $button_save = $button_remove_save;
}

if ($auth->getIfLogin()) {
    if ($arrayAnnuncio['username'] == $_SESSION["loginAccount"]) {
        $user_book = str_replace('<!--<php-buttons />-->', $button_edit . $button_delete, $user_book);
    } else {
        $user_book = str_replace('<!--<php-buttons />-->', $button_save . $user_email, $user_book);
    }
}
$book_isbn = "";
$book_author = "";
$book_author_def = "";
$book_edition = "";
$book_isbn = "";
if (isset($arrayAnnuncio['autore']) && !empty($arrayAnnuncio['autore'])) {
    $book_author = $arrayAnnuncio['autore'];
    $book_author_def = '<dt>Autore</dt>
    <dd>' . $book_author . '</dd>';
}

if (isset($arrayAnnuncio['edizione']) && !empty($arrayAnnuncio['edizione'])) {
    $book_edition = '<dt>Edizione</dt>
    <dd>' . $arrayAnnuncio['edizione'] . '</dd>';
}

if (isset($arrayAnnuncio['isbn']) && !empty($arrayAnnuncio['isbn'])) {
    $book_isbn = '<dt>ISBN</dt>
    <dd>' . $arrayAnnuncio['isbn'] . '</dd>';
}

// Suddivido titolo, autore e materia in singole parole da usare come keywords e le unisco in un array
$keywords = array_merge(explode(' ', $arrayAnnuncio['titolo']), explode(' ', $arrayAnnuncio['autore']), explode(' ', $arrayAnnuncio['materia']));
// Rimuovo le parole con lunghezza <=2
foreach ($keywords as $keyword) {
    if (strlen($keyword) <= 2) {
        unset($keywords[array_search($keyword, $keywords)]);
    }
}
// Converto tutto in minuscolo e unisco le parole con una virgola in una stringa, togliendo i doppioni
$keywords = strtolower(implode(', ', array_unique($keywords)));

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$user_book = str_replace('<php-header />', $header, $user_book);
$user_book = str_replace('php-meta-descr', $arrayAnnuncio['descrizione'], $user_book);
$user_book = str_replace('php-meta-keys', $keywords, $user_book);
$user_book = str_replace('<php-img />', $listing_img, $user_book);
$user_book = str_replace('<php-price />', $listing_price, $user_book);
$user_book = str_replace('<php-title />', $listing_title, $user_book);
$user_book = str_replace('<php-descr />', $listing_descr, $user_book);
$user_book = str_replace('<php-subject />', $listing_subject, $user_book);
$user_book = str_replace('<php-user />', $listing_user, $user_book);
$user_book = str_replace('<!-- <php-author /> -->', $book_author, $user_book);
$user_book = str_replace('<php-author-def />', $book_author_def, $user_book);
$user_book = str_replace('<php-edition-def />', $book_edition, $user_book);
$user_book = str_replace('<php-isbn-def />', $book_isbn, $user_book);

$user_book = str_replace('<php-footer />', $footer, $user_book);

// Mostro la pagina
echo $user_book;
?>