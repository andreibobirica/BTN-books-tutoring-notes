
<?php

//Funzione che stampa l'item di Nav Menu
function printItemNavMenu($pagina,$login){
    //inizio lettura html
    ob_start(); ?>
    <nav id="menu">
        <ul>
            <li><a href="./index.php">Cerca</a></li>
            <li><a href="./info.php">Info</a></li>
            <li><a href="./login.php">Accedi</a></li>
            <li><a href="./registrazione.php">Registrati</a></li>
            <li><a href="./areariservata.php">Area Riservata</a></li>
            <li><a href="./areariservata.php?logout">Log Out</a></li>
        </ul>
    </nav>

    <?php
    //fine lettura html
    $nav = ob_get_clean();

    //Cosa mostrare se si è loggati o meno
    if($login){
        $nav = str_replace('<li><a href="./login.php">Accedi</a></li>',"",$nav);
        $nav = str_replace('<li><a href="./registrazione.php">Registrati</a></li>',"",$nav);
    }else{
        $nav = str_replace('<li><a href="./areariservata.php">Area Riservata</a></li>',"",$nav);
        $nav = str_replace('<li><a href="./areariservata.php?logout">Log Out</a></li>',"",$nav);   
    }

    if($pagina=="cerca"){
        $nav = str_replace('<li><a href="./index.php">Cerca</a></li>',"<li>Cerca</li>",$nav);
    }elseif($pagina=="info"){
        $nav = str_replace('<li><a href="./info.php">Info</a></li>',"<li>Info</li>",$nav);
    }elseif($pagina=="accedi"){
        $nav = str_replace('<li><a href="./login.php">Accedi</a></li>',"<li>Accedi</li>",$nav);
    }elseif($pagina=="registrazione"){
        $nav = str_replace('<li><a href="./registrazione.php">Registrati</a></li>',"<li>Registrati</li>",$nav);
    }elseif($pagina=="areariservata"){
        $nav = str_replace('<li><a href="./areariservata.php">Area Riservata</a></li>',"<li>Area Riservata</li>",$nav);
    }

    print($nav);
}


?>
