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
    $user_listings = $request->getAnnunciOfUser($_SESSION["loginAccount"]);

    if (empty($user_listings)) {
        $user_listings_list = '<p class="no-listings">Non ci sono annunci pubblicati</p>';
    } else {
        $user_listings_list = '<ul class="listings-list">';
        foreach ($user_listings as $listing) {
            $user_listings_list .= '<li class="listing">';
            $user_listings_list .= '<h4 class="listing-title">' . $listing['titolo'] . '</h4>';
            // AUTORE E IMMAGINI NON LI HANNO TUTTI MA SOLO I LIBRI
            $user_listings_list .= '<h5 class="listing-author">Autore Libro</h5>';
            $user_listings_list .= '<img
            src="https://images.unsplash.com/photo-1564540400309-0745c2a66a11?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
            class="listing-img"
            alt="" />';
            $user_listings_list .= '<p class="listing-user">' . $listing['username'] . '<p>';
            $user_listings_list .= '<p class="listing-price">' . $listing['prezzo'] . '€<p>';
            $user_listings_list .= '<a href="">Vedi annuncio</a>';
            $user_listings_list .= '</li>';
        }
        $user_listings_list .= '</ul>';
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