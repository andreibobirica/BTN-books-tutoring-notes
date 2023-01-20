<?php

//Funzione che stampa l'item di Nav Menu
function printBreadcrumb($pagina, $annuncio=0){
    //inizio lettura html
    ob_start(); ?>
    <nav id="breadcrumb">
        <bread/>
    </nav>
    <?php
    //fine lettura html
    $breadcrumb = ob_get_clean();


    if($pagina=="cerca"){
        $breadcrumb = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Cerca</p>',$breadcrumb);
    }elseif($pagina=="info"){
        $breadcrumb = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Info</p>',$breadcrumb);
    }elseif($pagina=="accedi"){
        $breadcrumb = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Login</p>',$breadcrumb);
    }elseif($pagina=="registrati"){
        $breadcrumb = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Registrati</p>',$breadcrumb);
    }elseif($pagina=="areariservata"){
        $breadcrumb = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Area Riservata</p>',$breadcrumb);
    }elseif($pagina=="annuncio"){
        $breadcrumb = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / <a href="./area_riservata.php" lang="en">Area Riservata</a> / Annuncio '.$annuncio.'</p>',$breadcrumb);
    }elseif($pagina=="new_listing"){
        $breadcrumb = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / <a href="./area_riservata.php" lang="en">Area Riservata</a> / Inserimento Annuncio </p>',$breadcrumb);
    }elseif($pagina=="edit_listing"){
        $breadcrumb = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / <a href="./area_riservata.php" lang="en">Area Riservata</a> / Modifica Annuncio '.$annuncio.'</p>',$breadcrumb);
    }

    return $breadcrumb;
}


?>
