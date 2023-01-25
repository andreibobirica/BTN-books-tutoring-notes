<?php
require_once './core/area_riservata_control.php';

// HTML di pagina, header e footer
$area_riservata_content = file_get_contents("./contents/area_riservata_content.html");
$area_riservata = boilerplate($area_riservata_content);

$footer = file_get_contents("./contents/footer.html");

// Contenuto corretto di navbar e breadcrumb
$header = printHeader("areariservata", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("areariservata");

// Controllo il login
if ($auth->getIfLogin()) {
    // Messaggio di benvenuto e informazioni utente
    $user_name = $_SESSION["nameAccount"] . " " . $_SESSION["surnameAccount"];
    $user_username = $_SESSION["loginAccount"];
    $user_email = $_SESSION["emailAccount"];
    $user_birth = $_SESSION["birthdateAccount"];

    // Elenco degli annunci pubblicati
    $user_listings_books = $request->getAnnunciOfUser($_SESSION["loginAccount"], 'libri');
    $user_listings_tutoring = $request->getAnnunciOfUser($_SESSION["loginAccount"], 'ripetizioni');
    $user_listings_notes = $request->getAnnunciOfUser($_SESSION["loginAccount"], 'appunti');

    $user_listings_list = "";

    // Se non c'è nessun tipo di annuncio si mostra un messaggio che lo comunica
    if (empty($user_listings_books) && empty($user_listings_tutoring) && empty($user_listings_notes)) {
        $user_listings_list = '<p class="no-listings">Non ci sono annunci pubblicati</p>';
    } else {
        // Libri
        if (!empty($user_listings_books)) {
            $user_listings_list .= '<h4>Libri</h4>';
            $user_listings_list .= '<ul class="listings-list">';
            foreach ($user_listings_books as $user_book) {
                $user_listings_list .= '<li class="listing">';
                $user_listings_list .= '<p class="listing-title">' . $user_book['titolo'] . '</p>';
                $user_listings_list .= '<p class="listing-author">' . $user_book['autore'] . '</p>';
                $user_listings_list .= '<img src="' . $user_book['mediapath'] . '" class="listing-img" alt="" />';
                $user_listings_list .= '<p class="listing-user">' . $user_book['username'] . '<p>';
                $user_listings_list .= '<p class="listing-price">' . $user_book['prezzo'] . '€<p>';
                $user_listings_list .= '<a href="listing.php?annuncio=' . $user_book['id'] . '">Vedi annuncio</a>';
                $user_listings_list .= '</li>';
            }
            $user_listings_list .= '</ul>';
        }

        // Appunti
        if (!empty($user_listings_notes)) {
            $user_listings_list .= '<h4>Appunti</h4>';
            $user_listings_list .= '<ul class="listings-list">';
            foreach ($user_listings_notes as $user_note) {
                $user_listings_list .= '<li class="listing">';
                $user_listings_list .= '<p class="listing-title">' . $user_note['titolo'] . '</p>';
                $user_listings_list .= '<p class="listing-author">' . $user_note['username'] . '</p>';
                $user_listings_list .= '<img src="' . $user_note['mediapath'] . '" class="listing-img" alt="" />';
                $user_listings_list .= '<p class="listing-price">' . $user_note['prezzo'] . '€<p>';
                $user_listings_list .= '<a href="listing.php?annuncio=' . $user_note['id'] . '">Vedi annuncio</a>';
                $user_listings_list .= '</li>';
            }
            $user_listings_list .= '</ul>';
        }
    }

    // Elenco degli annunci salvati
    $saved_listings = '';

    if (empty($saved_listings)) {
        $saved_listings_list = '<p class="no-listings">Non ci sono annunci salvati</p>';
    } else {
    }

    // Sostituisco i segnaposti
    $area_riservata = str_replace('<php-user-name />', $user_name, $area_riservata);
    $area_riservata = str_replace('<php-user-username />', $user_username, $area_riservata);
    $area_riservata = str_replace('<php-user-email />', $user_email, $area_riservata);
    $area_riservata = str_replace('<php-user-birth />', $user_birth, $area_riservata);
    $area_riservata = str_replace('<php-user-listings />', $user_listings_list, $area_riservata);
    $area_riservata = str_replace('<php-saved-listings />', $saved_listings_list, $area_riservata);
} else {
    // Se non loggato non dovrei mai finire su questa pagina, ma in caso mi rimanda al login
    header("Location: login.php");
    exit();
}

// Sostituisco i segnaposti
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$area_riservata = str_replace('<php-header />', $header, $area_riservata);
$area_riservata = str_replace('<php-footer />', $footer, $area_riservata);

// Mostro la pagina
echo $area_riservata;
?>