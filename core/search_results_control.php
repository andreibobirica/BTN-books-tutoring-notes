<?php

require_once "./core/header.php";
require_once "./core/Authentication.php";
require_once './core/listings_list.php';
$auth = new Authentication();
require_once "imports.php";
require_once "Database.php";

class Search_Results_Control
{
    public $db = null;

    public function __CONSTRUCT()
    {
        $this->db = new Database();
    }

    public function getResults($search, $categoria, $ordine)
    {
        $risultatiArray = array();
        //SELECT UNIQUE titolo, utenti.nome, utenti.cognome, annunci.id FROM annunci JOIN utenti JOIN libri WHERE MATCH(titolo,descrizione,materia) AGAINST('Analisi') AND annunci.username = utenti.username;
        $queryUser = "";
        //tolgo caratteri speciali dalla ricerca come *
        while(str_contains($search, '*')){
            $search = str_replace('*', '', $search);
        }
        switch ($categoria) {
            case 'libri':
                $queryUser = "SELECT titolo, annunci.id, prezzo, nome, cognome, mediapath, autore, descrizione, annunci.username FROM annunci RIGHT JOIN libri ON annunci.id = libri.id LEFT JOIN utenti ON annunci.username = utenti.username WHERE MATCH(titolo,descrizione,materia) AGAINST(\"" . $search . "\") ";
                if (!empty($ordine) && $ordine == "prezzoasc")
                    $queryUser = $queryUser . "ORDER BY prezzo ASC;";
                else if (!empty($ordine) && $ordine == "prezzodisc")
                    $queryUser = $queryUser . "ORDER BY prezzo DESC;";

                $result = $this->db->query($queryUser);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($risultatiArray, array("id" => $row['id'], "autore" => $row['autore'], "mediapath" => $row['mediapath'], "prezzo" => $row['prezzo'], "titolo" => $row['titolo'], "utente" => $row['nome'] . " " . $row['cognome'], "username" => $row['username'], "descrizione" => $row['descrizione']));
                    }
                }
                break;
            case 'appunti':
                $queryUser = "SELECT titolo, annunci.id, prezzo, nome, cognome, mediapath, annunci.username, descrizione FROM annunci RIGHT JOIN appunti ON annunci.id = appunti.id LEFT JOIN utenti ON annunci.username = utenti.username WHERE MATCH(titolo,descrizione,materia) AGAINST('" . $search . "');";
                $result = $this->db->query($queryUser);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($risultatiArray, array("id" => $row['id'], "mediapath" => $row['mediapath'], "prezzo" => $row['prezzo'], "titolo" => $row['titolo'], "utente" => $row['nome'] . " " . $row['cognome'], "username" => $row['username'], "descrizione" => $row['descrizione']));
                    }
                }
                break;
            case 'ripetizioni':
                $queryUser = "SELECT titolo, annunci.id, prezzo, nome, cognome, descrizione, annunci.username FROM annunci RIGHT JOIN ripetizioni ON annunci.id = ripetizioni.id LEFT JOIN utenti ON annunci.username = utenti.username WHERE MATCH(titolo,descrizione,materia) AGAINST('" . $search . "');";
                $result = $this->db->query($queryUser);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($risultatiArray, array("id" => $row['id'], "prezzo" => $row['prezzo'], "titolo" => $row['titolo'], "utente" => $row['nome'] . " " . $row['cognome'], "descrizione" => $row['descrizione'], "username" => $row['username']));
                    }
                }
                break;
        }
        return $risultatiArray;
    }
}


?>