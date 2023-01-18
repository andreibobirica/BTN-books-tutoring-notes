<?php
require_once 'Authentification.php';


class RichiesteAnnunci{
    private $auth = null;

    public function __CONSTRUCT() {
        $this->auth = new Authentification();
    }

    //Ritorna un array con tutti gli annunci di un certo user $username
    function getAnnunciOfUser($username): array{
        //ritorna un array con tutti gli annunci, con solo i dettagli principali
        //ID TITOLO MATERIA PREZZO
        $sql = "SELECT id, titolo, materia, prezzo FROM annunci WHERE username = '$username'";
        $result = $this->auth->db->query($sql);
        $arrayRet = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //	id	titolo	descrizione	prezzo	username	mediapath	materia
                array_push($arrayRet, array("id"=> $row['id'], "titolo" => $row['titolo'],"materia" => $row['materia'], "prezzo" => $row['prezzo']));
            }
        }
        return $arrayRet;
    }
    //Ritorna un bool con l'esito della verifica
    //se l'annuncio appartiene al utente $user true, false il contrario
    function verifyAnnuncioUser($username,$annuncio): bool{
        $result = $this->auth->db->query("SELECT id FROM annunci WHERE username='$username' and id='$annuncio'");
        return ($result->num_rows == 1);
    }
    //Elimina annuncio of user
    function deleteAnnuncio($annuncio){
        return $this->auth->db->query("DELETE FROM annunci WHERE id = '$annuncio'") === TRUE;
    }

    //getAnnuncio
    function getAnnuncio($annuncio){
        $sql = "SELECT * FROM annunci WHERE id = $annuncio";
        $result = $this->auth->db->query($sql);
        $arrayRet = array();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            //	id	titolo	descrizione	prezzo	username	mediapath	materia
            $arrayRet = array("tipo" => "","titolo" => $row['titolo'], "descrizione" => $row['descrizione'], "prezzo" => $row['prezzo'], "username" => $row["username"], "mediapath" => "", "materia" => $row['materia'], "autore" => "", "edizione" => "", "isbn" => "");
            $idAnnuncio = $row['id'];
            //Libri
            $sqlTipo = "SELECT * FROM libri WHERE id = $idAnnuncio";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1){
                $row = $result->fetch_assoc();
                $arrayRet['tipo']="libri";
                $arrayRet['autore']=$row['autore'];
                $arrayRet['edizione']=$row['edizione'];
                $arrayRet['isbn']=$row['ISBN'];
                $arrayRet['mediapath']=$row['mediapath'];
                return $arrayRet;
            }
            
            //Appunti
            $sqlTipo = "SELECT * FROM appunti WHERE id = $idAnnuncio";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1){
                $row = $result->fetch_assoc();
                $arrayRet['tipo']="appunti";
                $arrayRet['mediapath']=$row['mediapath'];
                return $arrayRet;
            }

            //Ripetizioni
            $sqlTipo = "SELECT * FROM ripetizioni WHERE id = $idAnnuncio";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1){
                $row = $result->fetch_assoc();
                $arrayRet['tipo']="ripetizioni";
                return $arrayRet;
            }
        }
        return $arrayRet;
    }

    //Inserimento nuovo Annuncio
    //parametro $annuncio array formatato di conseguenza
    //return id of the annuncio just inserted
    //altrimenti 0
    function inserisciAnnuncio($annuncio){
        $sql = "INSERT INTO annunci (titolo,descrizione,prezzo,username,materia) VALUES ('$annuncio[titolo]', '$annuncio[descrizione]', '$annuncio[prezzo]', '$annuncio[username]', '$annuncio[materia]');";
        if ($this->auth->db->query($sql) === TRUE) {
            $last_id = $this->auth->db->getConn()->insert_id;
            $sqlTipo = "";
            switch ($annuncio['tipo']) {
                case "libri":
                    $sqlTipo = "INSERT INTO libri (mediapath, id, autore, edizione, ISBN) VALUES ( '$annuncio[mediapath]', '$last_id', '$annuncio[autore]', '$annuncio[edizione]', '$annuncio[isbn]');";
                    break;
                case "appunti":
                    $sqlTipo = "INSERT INTO appunti (id, mediapath) VALUES ('$last_id','$annuncio[mediapath]')";
                    break;
                case "ripetizioni":
                    $sqlTipo = "INSERT INTO ripetizioni (id) VALUES ('$last_id')";
                    break;
            }
            print($sqlTipo);
            if ($this->auth->db->query($sqlTipo) === TRUE)
                return $last_id;
        }
        return 0;
    }
    //Modifica di un Annuncio
    //parametro $annuncio array formatato di conseguenza
    //return id of the annuncio just modifiye
    //altrimenti 0
    function modificaAnnuncio($annuncio){
        $sql = "UPDATE annunci SET titolo='$annuncio[titolo]', descrizione='$annuncio[descrizione]',prezzo='$annuncio[prezzo]', username='$annuncio[username]',materia='$annuncio[materia]' WHERE id='$annuncio[id]';";
        if ($this->auth->db->query($sql) === TRUE) {            
            $tipoAnnuncio =
                $this->auth->db->query("SELECT DISTINCT annunci.id FROM annunci JOIN appunti WHERE annunci.id = $annuncio[id] AND appunti.id = $annuncio[id];")->num_rows == 1 ? "appunti" :
                ($this->auth->db->query("SELECT DISTINCT annunci.id FROM annunci JOIN libri WHERE annunci.id = $annuncio[id] AND libri.id = $annuncio[id];")->num_rows == 1 ? "libri" : "ripetizioni");
            $sqlTipo = "";
            //SELECT annunci.id FROM annunci JOIN appunti WHERE annunci.id = 30;
            switch ($tipoAnnuncio) {
                case "libri":
                    $sqlTipo = "UPDATE libri SET mediapath='$annuncio[mediapath]', autore='$annuncio[autore]', edizione='$annuncio[edizione]', ISBN='$annuncio[isbn]' WHERE id='$annuncio[id]';";
                    if ($this->auth->db->query($sqlTipo) === TRUE)
                        return $annuncio['id'];
                    break;
                case "appunti":
                    $sqlTipo = "UPDATE appunti SET mediapath='$annuncio[mediapath]' WHERE id='$annuncio[id]';";
                    if ($this->auth->db->query($sqlTipo) === TRUE)
                        return $annuncio['id'];
                case "ripetizioni":
                    return $annuncio['id'];
            }
        }
        return 0;
    }
}
?>