<?php
require_once "./core/search_results_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$search_results_content = file_get_contents("./contents/search_results_content.html");
$search_results = boilerplate($search_results_content);

$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printHeader("risultati", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("risultati");
/*
// Prendo il percorso e inserisco l'immagine
$listing_img = '<img width="300" height="400" src="' . $arrayAnnuncio["mediapath"] . '">';

// Controllo il login e mostro le parti corrette
$listing_price = '<p id="listing-price">' . $arrayAnnuncio['prezzo'] . '€</p>';
$listing_title = '<dd>' . $arrayAnnuncio['titolo'] . '</dd>';
$listing_subject = '<dd>' . $arrayAnnuncio['materia'] . '</dd>';
$listing_descr = '<p id="listing-descr">' . $arrayAnnuncio['descrizione'] . '</p>';


$button_save = '<a href="" class="listing-btn">Salva annuncio</a>';*/

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$search_results = str_replace('<php-header />', $header, $search_results);

/*$search_results = str_replace('<php-img />', $listing_img, $search_results);
$search_results = str_replace('<php-price />', $listing_price, $search_results);
$search_results = str_replace('<php-title />', $listing_title, $search_results);
$search_results = str_replace('<php-descr />', $listing_descr, $search_results);
$search_results = str_replace('<php-subject />', $listing_subject, $search_results);
$search_results = str_replace('<php-author />', $book_author, $search_results);
$search_results = str_replace('<php-edition />', $book_edition, $search_results);
$search_results = str_replace('<php-isbn />', $book_isbn, $search_results);*/

$search_results = str_replace('<php-footer />', $footer, $search_results);

// Mostro la pagina
echo $search_results;
?>