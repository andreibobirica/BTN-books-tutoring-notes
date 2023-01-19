<?php
require_once "./core/risultatiCtrl.php";
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>BTN - Risultati</title>
</head>

<body>
    <header>
        <div>
            <div>
                <h1><a href="./index.html" class="logo"><abbr title="Book Tutoring Notes">BTN</abbr></a></h1>
                <button id="menu-btn" class="button" onclick="menuOnClick()"><span lang="en">MENU</span></button>
            </div>

            <button id="menu-btn" class="button" onclick="menuOnClick()">MENU</button>
        </div>

        <nav id="menu">
            <ul>
                <li><a href="./index.html">Cerca</a></li>
                <li><a href="./info.html">Info</a></li>
                <li><a href="./login.html">Accedi</a></li>
                <li><a href="./registrazione.html">Registrati</a></li>
            </ul>
        </nav>
    </header>

    <?php printItemBreadcrumb("risultati"); ?>

    <main id="risultati-main">
        <form id="orderForm">
            <label for="cars">Ordina per: </label>
            <select name="filtro_ordinamento" id="scelteOrdinamento">
                <option>più recente</option>
                <option>più vecchio</option>
                <option>ordine alfabetico (A-Z)</option>
                <option>ordine alfabetico (Z-A)</option>
            </select>
        </form>

        <ul id="listings-list">
            <li class="listing">
                <h3 class="listing-title">Titolo Libro</h3>
                <h4 class="listing-author">Autore Libro</h4>
                <img src="https://images.unsplash.com/photo-1564540400309-0745c2a66a11?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                    class="listing-img" alt="" />
                <p><span class="listing-user">Utente Venditore</span> - <span class="listing-price">10€</span></p>
                <a href="">Vedi annuncio</a>
            </li>

            <li class="listing">
                <h3 class="listing-title">Titolo Libro</h3>
                <h4 class="listing-author">Autore Libro</h4>
                <img src="https://images.unsplash.com/photo-1564540400309-0745c2a66a11?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                    class="listing-img" alt="" />
                <p><span class="listing-user">Utente Venditore</span> - <span class="listing-price">10€</span></p>
                <a href="">Vedi annuncio</a>
            </li>

            <li class="listing">
                <h3 class="listing-title">Titolo Libro</h3>
                <h4 class="listing-author">Autore Libro</h4>
                <img src="https://images.unsplash.com/photo-1564540400309-0745c2a66a11?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                    class="listing-img" alt="" />
                <p><span class="listing-user">Utente Venditore</span> - <span class="listing-price">10€</span></p>
                <a href="">Vedi annuncio</a>
            </li>

            <li class="listing">
                <h3 class="listing-title">Titolo Libro</h3>
                <h4 class="listing-author">Autore Libro</h4>
                <img src="https://images.unsplash.com/photo-1564540400309-0745c2a66a11?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                    class="listing-img" alt="" />
                <p><span class="listing-user">Utente Venditore</span> - <span class="listing-price">10€</span></p>
                <a href="">Vedi annuncio</a>
            </li>

            <li class="listing">
                <h3 class="listing-title">Titolo Libro</h3>
                <h4 class="listing-author">Autore Libro</h4>
                <img src="https://images.unsplash.com/photo-1564540400309-0745c2a66a11?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                    class="listing-img" alt="" />
                <p><span class="listing-user">Utente Venditore</span> - <span class="listing-price">10€</span></p>
                <a href="">Vedi annuncio</a>
            </li>
        </ul>

    </main>
    <footer>
        <p>BTN</p>
    </footer>
</body>



</html>