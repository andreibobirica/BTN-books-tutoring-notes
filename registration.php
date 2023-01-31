<?php
require_once "./core/registration_control.php";

// Prendo l'HTML della pagina, dell'header e del footer
$registration_content = file_get_contents("./contents/registration_content.html");
$registration = boilerplate($registration_content);

$footer = file_get_contents("./contents/footer.html");
// Prendo il contenuto corretto dell'header
$header = printHeader("registrazione", $auth->getIfLogin());
$breadcrumb = printBreadcrumb("registrati");

// Rimpiazzo i segnaposti coi contenuti HTML
$header = str_replace('<breadcrumb />', $breadcrumb, $header);
$registration = str_replace('<php-header />', $header, $registration);
$registration = str_replace('php-action', $_SERVER['PHP_SELF'], $registration);
$registration = str_replace('<php-footer />', $footer, $registration);
if(isset($_GET['errore']) && !empty($_GET['errore']))
    $registration = str_replace('<php-errore />', "<p class='emptyErrorMessage'>$_GET[errore]</p>", $registration);
else
    $registration = str_replace('<php-errore />', "", $registration);

// Mostro la pagina
echo $registration;
?>