<?php
require_once "./core/header.php";
require_once "./core/Authentication.php";
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

    public function getResults($search,$categoria){
        $risultatiArray = array();
        //SELECT UNIQUE titolo, utenti.nome, utenti.cognome, annunci.id FROM annunci JOIN utenti JOIN libri WHERE MATCH(titolo,descrizione,materia) AGAINST('Analisi') AND annunci.username = utenti.username;
        $queryUser = "";
        switch ($categoria) {
            case 'libri':
                $queryUser = "SELECT titolo, annunci.id, prezzo, nome, cognome, mediapath, autore FROM annunci RIGHT JOIN libri ON annunci.id = libri.id LEFT JOIN utenti ON annunci.username = utenti.username WHERE MATCH(titolo,descrizione,materia) AGAINST('".$search."');";
                $result = $this->db->query($queryUser);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($risultatiArray,array("id"=>$row['id'],"autore"=>$row['autore'],"mediapath"=>$row['mediapath'],"prezzo"=>$row['prezzo'],"titolo"=>$row['titolo'],"utente"=>$row['nome']." ".$row['cognome']));
                    }
                }
                break;
            case 'appunti':
                $queryUser = "SELECT titolo, annunci.id, prezzo, nome, cognome, mediapath FROM annunci RIGHT JOIN appunti ON annunci.id = appunti.id LEFT JOIN utenti ON annunci.username = utenti.username WHERE MATCH(titolo,descrizione,materia) AGAINST('".$search."');";
                $result = $this->db->query($queryUser);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($risultatiArray,array("id"=>$row['id'],"mediapath"=>$row['mediapath'],"prezzo"=>$row['prezzo'],"titolo"=>$row['titolo'],"utente"=>$row['nome']." ".$row['cognome']));
                    }
                }
                break;
            case 'ripetizioni':
                $queryUser = "SELECT titolo, annunci.id, prezzo, nome, cognome FROM annunci RIGHT JOIN ripetizioni ON annunci.id = ripetizioni.id LEFT JOIN utenti ON annunci.username = utenti.username WHERE MATCH(titolo,descrizione,materia) AGAINST('".$search."');";
                $result = $this->db->query($queryUser);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        array_push($risultatiArray,array("id"=>$row['id'],"prezzo"=>$row['prezzo'],"titolo"=>$row['titolo'],"utente"=>$row['nome']." ".$row['cognome']));
                    }
                }
                break;
        }
        return $risultatiArray;
    }
}


?>
