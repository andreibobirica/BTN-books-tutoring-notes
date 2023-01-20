<?php
require_once './core/areariservataCtrl.php';

// Prendo l'HTML della pagina, dell'header e del footer
$area_riservata = file_get_contents("./contents/area_riservata_content.html");
$header = file_get_contents("./contents/header.html");
$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$navbar = printItemNavMenu("areariservata", $auth->getIfLogin());
$breadcrumb = printItemBreadcrumb("areariservata");
$new_listing = '<p>Aggiungi Un Annuncio<a href="new_listing.php?nuovo">Nuovo</a></p>';

// Controllo il login e mostro il corretto messaggio di benvenuto
if ($auth->getIfLogin()) {
    $welcome_message_login =
        '<h1>Benvenuto, ' . $_SESSION["loginAccount"] . '</h1>
    <img src="./assets/imgs/icona.png" alt="" width="150" height="150" style="margin-top: 10px;">
    </div>';
    $user_info = '<p>Nome: ' . $_SESSION["nameAccount"] . '</p>
    <p>Cognome: ' . $_SESSION["surnameAccount"] . '</p>
    <p>Email: ' . $_SESSION["emailAccount"] . '</p>
    <p>Data Di Nascita: ' . $_SESSION["birthdateAccount"] . '</p>';

    // Preparo l'elenco degli annunci
    $listings_list = '<h3>Annunci pubblicati</h3><table>
    <tr>
        <th>Titolo</th>
        <th>Materia Scolastica</th>
        <th>Prezzo</th>
        <th></th>
        <th></th
    </tr>';

    $listings = $request->getAnnunciOfUser($_SESSION["loginAccount"]);

    foreach ($listings as $listing) {
        $listings_list .= '<tr>';
        $listings_list .= '<td>' . $listing['titolo'] . '</td>';
        $listings_list .= '<td>' . $listing['materia'] . '</td>';
        $listings_list .= '<td>' . $listing['prezzo'] . '€</td>';
        $listings_list .= '<td><a href="listing.php?annuncio=' . $listing['id'] . '">Visualizza</a></td>';
        $listings_list .= '<td><a href="edit_listing.php?modifica=' . $listing['id'] . '">Modifica</a></td>';
        $listings_list .= '<td><a href="edit_listing.php?elimina=' . $listing['id'] . '">Elimina</a></td>';
        $listings_list .= '</tr>';
    }

    $listings_list .= '</table>';

    $area_riservata = str_replace('<php-welcome-message/>', $welcome_message_login, $area_riservata);
    $area_riservata = str_replace('<php-user-info/>', $user_info, $area_riservata);
    $area_riservata = str_replace('<php-listings-list/>', $listings_list, $area_riservata);
    $area_riservata = str_replace('<php-new-listing/>', $new_listing, $area_riservata);
} else {
    // Se non loggato non dovrei finire su questa pagina, ma in caso mi rimanda al login
    header("Location: login.php");
    exit();
    /*$welcome_message = '<h2>Utente Non Loggato</h2>
    <p>Si prega di effetuare il Login Prima<p>
    <p>Hai già un <span lang="en">account</span>?<a href="login.php"> Accedi</a></p>
    <p>Prima volta su <abbr title="Book Tutoring Notes">BTN</abbr>? <a href="registration.php">Registrati</a></p>';

    $area_riservata = str_replace('<php-welcome-message/>', $welcome_message, $area_riservata);*/
}

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<navbar/>', $navbar, $header);
$header = str_replace('<breadcrumb/>', $breadcrumb, $header);
$area_riservata = str_replace('<php-header/>', $header, $area_riservata);
$area_riservata = str_replace('<php-footer/>', $footer, $area_riservata);

// Mostro la pagina
echo $area_riservata;
?>