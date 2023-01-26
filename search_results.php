<?php
require_once "core/search_results_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$search_results_content = file_get_contents("./contents/search_results_content.html");
$search_results = boilerplate($search_results_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto della navbar
$header = printHeader("risultati", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("risultati", $_POST['search']);

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$search_results = str_replace('<php-header />', $header, $search_results);

$search = new Search_Results_Control();
$risultati = $search->getResults($_POST['search'], $_POST['categoria']);
$listings = '<h2> Ricerca ' . $_POST['categoria'] . ' "' . $_POST['search'] . '"</h2>';
$listings .= listingsList($risultati, $_POST['categoria']);

$search_results = str_replace('<php-listings />', $listings, $search_results);

$search_results = str_replace('<php-footer />', $footer, $search_results);

// Mostro la pagina
echo $search_results;
?>