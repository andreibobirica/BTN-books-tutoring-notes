<?php

//Funzione che stampa l'item di Nav Menu
function printItemBreadcrumb($pagina,$annuncio=0){
    //inizio lettura html
    ob_start(); ?>
    <nav id="breadcrumb">
        <bread/>
    </nav>
    <?php
    //fine lettura html
    $nav = ob_get_clean();


    if($pagina=="cerca"){
        $nav = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Cerca</p>',$nav);
    }elseif($pagina=="info"){
        $nav = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Info</p>',$nav);
    }elseif($pagina=="accedi"){
        $nav = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Login</p>',$nav);
    }elseif($pagina=="registrati"){
        $nav = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Registrati</p>',$nav);
    }elseif($pagina=="areariservata"){
        $nav = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / Area Riservata</p>',$nav);
    }elseif($pagina=="annuncio"){
        $nav = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / <a href="./areariservata.php" lang="en">Area Riservata</a> / Annuncio '.$annuncio.'</p>',$nav);
    }elseif($pagina=="inserisciannuncio"){
        $nav = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / <a href="./areariservata.php" lang="en">Area Riservata</a> / Inserimento Annuncio </p>',$nav);
    }elseif($pagina=="modificaannuncio"){
        $nav = str_replace('<bread/>','<p><a href="./index.php" lang="en">Home</a> / <a href="./areariservata.php" lang="en">Area Riservata</a> / Modifica Annuncio '.$annuncio.'</p>',$nav);
    }

    print($nav);
}


?>
