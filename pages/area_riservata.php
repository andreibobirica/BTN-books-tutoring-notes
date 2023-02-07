<?php
require_once './utils/area_riservata_control.php';

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
    $user_books = $request->getAnnunciOfUser($_SESSION["loginAccount"], 'libri');
    $user_tutorings = $request->getAnnunciOfUser($_SESSION["loginAccount"], 'ripetizioni');
    $user_notes = $request->getAnnunciOfUser($_SESSION["loginAccount"], 'appunti');

    $user_listings_list = "";

    // Se non c'è nessun tipo di annuncio si mostra un messaggio che lo comunica
    if (empty($user_books) && empty($user_tutorings) && empty($user_notes)) {
        $user_listings_list = '<p class="no-listings">Non ci sono annunci pubblicati</p>';
    } else {
        // Libri
        $user_listings_list .= '<h4>Libri</h4>';
        $user_listings_list .= listingsList($user_books, 'libri');

        // Appunti
        $user_listings_list .= '<h4>Appunti</h4>';
        $user_listings_list .= listingsList($user_notes, 'appunti');

        // Ripetizioni
        $user_listings_list .= '<h4>Ripetizioni</h4>';
        $user_listings_list .= listingsList($user_tutorings, 'ripetizioni');
    }

    // Elenco degli annunci salvati
    $saved_books = $request->getSavedAnnunciOfUser($_SESSION["loginAccount"], 'libri');
    $saved_notes = $request->getSavedAnnunciOfUser($_SESSION["loginAccount"], 'appunti');
    $saved_tutorings = $request->getSavedAnnunciOfUser($_SESSION["loginAccount"], 'ripetizioni');

    $saved_listings_list = "";

    // Se non c'è nessun tipo di annuncio si mostra un messaggio che lo comunica
    if (empty($saved_books) && empty($saved_notes) && empty($saved_tutorings)) {
        $saved_listings_list = '<p class="no-listings">Non ci sono annunci salvati</p>';
    } else {
        // Libri
        $saved_listings_list .= '<h4>Libri</h4>';
        $saved_listings_list .= listingsList($saved_books, 'libri');

        // Appunti
        $saved_listings_list .= '<h4>Appunti</h4>';
        $saved_listings_list .= listingsList($saved_notes, 'appunti');

        // Ripetizioni
        $saved_listings_list .= '<h4>Ripetizioni</h4>';
        $saved_listings_list .= listingsList($saved_tutorings, 'ripetizioni');
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