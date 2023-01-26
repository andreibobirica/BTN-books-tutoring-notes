<?php
function listingsList($listings, $categoria)
{
    if (empty($listings)) {
        $list = '<p class="no-listings">Nessun annuncio di ' . $categoria . '</p>';
    } else {
        $list = '<ul class="listings-list">';

        switch ($categoria) {
            case 'libri':
                foreach ($listings as $book) {
                    $list .= '<li class="listing">';
                    $list .= '<p class="listing-title">' . $book['titolo'] . '</p>';
                    $list .= '<p class="listing-author">' . $book['autore'] . '</p>';
                    $list .= '<img src="' . $book['mediapath'] . '" class="listing-img" alt="'.$book['descrizione'].'" />';
                    $list .= '<p class="listing-user">' . $book['username'] . '<p>';
                    $list .= '<p class="listing-price">' . $book['prezzo'] . '€<p>';
                    $list .= '<a href="listing.php?annuncio=' . $book['id'] . '">Vedi annuncio</a>';
                    $list .= '</li>';
                }
                break;

            case 'appunti':
                foreach ($listings as $note) {
                    $list .= '<li class="listing">';
                    $list .= '<p class="listing-title">' . $note['titolo'] . '</p>';
                    $list .= '<img src="' . $note['mediapath'] . '" class="listing-img" alt="'.$note['descrizione'].'" />';
                    $list .= '<p class="listing-user">' . $note['username'] . '<p>';
                    $list .= '<p class="listing-price">' . $note['prezzo'] . '€<p>';
                    $list .= '<a href="listing.php?annuncio=' . $note['id'] . '">Vedi annuncio</a>';
                    $list .= '</li>';
                }
                break;

            case 'ripetizioni':
                foreach ($listings as $tutoring) {
                    $list .= '<li class="listing">';
                    $list .= '<p class="listing-title">' . $tutoring['titolo'] . '</p>';
                    $list .= '<p class="listing-descr">' . $tutoring['descrizione'] . '</p>';
                    $list .= '<p class="listing-user">' . $tutoring['username'] . '</p>';
                    $list .= '<p class="listing-price">' . $tutoring['prezzo'] . '€<p>';
                    $list .= '<a href="listing.php?annuncio=' . $tutoring['id'] . '">Vedi annuncio</a>';
                    $list .= '</li>';
                }
                break;
        }

        $list .= '</ul>';
    }

    return $list;
}
?>