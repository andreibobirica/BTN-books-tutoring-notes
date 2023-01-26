<?php

function printHeader($pagina = 'default', $login)
{
    $header = file_get_contents("./contents/header.html");
    //Cosa mostrare se si è loggati o meno
    if ($login) {
        $header = str_replace('<li><a href="./login.php">Accedi</a></li>', "", $header);
        $header = str_replace('<li><a href="./registration.php">Registrati</a></li>', "", $header);
    } else {
        $header = str_replace('<li><a href="./area_riservata.php">Area Riservata</a></li>', "", $header);
        $header = str_replace('<li><a href="./area_riservata.php?logout">Log Out</a></li>', "", $header);
    }

    switch ($pagina) {
        case "cerca":
            $header = str_replace('<li><a href="./index.php">Cerca</a></li>', "<li>Cerca</li>", $header);
            $header = str_replace('<a href="./index.php" class="logo"><abbr title="Books Tutoring Notes">BTN</abbr></a>', '<abbr title="Books Tutoring Notes">BTN</abbr>', $header);
            break;
        case "info":
            $header = str_replace('<li><a href="./info.php">Info</a></li>', "<li>Info</li>", $header);
            break;
        case "accedi":
            $header = str_replace('<li><a href="./login.php">Accedi</a></li>', "<li>Accedi</li>", $header);
            break;
        case "registrazione":
            $header = str_replace('<li><a href="./registration.php">Registrati</a></li>', "<li>Registrati</li>", $header);
            break;
        case "areariservata":
            $header = str_replace('<li><a href="./area_riservata.php">Area Riservata</a></li>', "<li>Area Riservata</li>", $header);
            break;
        case "default":
        default:
            break;
    }
    return $header;
}

function printBreadcrumb($pagina, $altro = '')
{
    $breadcrumb = '<nav id="breadcrumb">';
    $breadcrumb .= '<ol>';

    switch ($pagina) {
        case "info":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li>Info</li>';
            break;
        case "accedi":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li>Login</li>';
            break;
        case "registrati":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li>Registrati</li>';
            break;
        case "areariservata":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li>Area Riservata</li>';
            break;
        case "annuncio":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li><a href="./area_riservata.php" lang="en">Area Riservata</a></li>';
            $breadcrumb .= '<li>' . $altro . '</li>';
            break;
        case "new_listing":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li><a href="./area_riservata.php" lang="en">Area Riservata</a></li>';
            $breadcrumb .= '<li>Nuovo annuncio ' . $altro . '</li>';
            break;
        case "edit_listing":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li><a href="./area_riservata.php" lang="en">Area Riservata</a></li>';
            $breadcrumb .= '<li>Modifica annuncio ' . $altro . '</li>';
            break;
        case "404":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li>Pagina non trovata</li>';
            break;
        case "500":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li>Errore del server</li>';
            break;
        case "risultati":
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
            $breadcrumb .= '<li>Ricerca "' . $altro . '"</li>';
            break;
        default:
            $breadcrumb .= '<li><a href="./index.php" lang="en">Home</a></li>';
    }

    $breadcrumb .= '</ol></nav>';

    return $breadcrumb;
}
?>