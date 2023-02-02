<?php
require_once './core/Authentication.php';

class RichiesteAnnunci
{
    private $auth = null;

    public function __CONSTRUCT()
    {
        $this->auth = new Authentication();
    }

    //Ritorna un array con tutti gli annunci di un certo user e del tipo specificato
    function getAnnunciOfUser($username, $tipo): array
    {
        if ($tipo == 'libri') {
            $sql = "SELECT annunci.id, titolo, descrizione, prezzo, username, materia, libri.autore, edizione, ISBN, mediapath
                    FROM annunci JOIN libri ON annunci.id=libri.id
                    WHERE annunci.username= '$username'";
        } else if ($tipo == 'appunti') {
            $sql = "SELECT annunci.id, titolo, descrizione, prezzo, username, materia, mediapath
                    FROM annunci JOIN appunti ON annunci.id=appunti.id
                    WHERE annunci.username= '$username'";
        } else if ($tipo == 'ripetizioni') {
            $sql = "SELECT annunci.id, titolo, descrizione, prezzo, username, materia
                    FROM annunci JOIN ripetizioni ON annunci.id=ripetizioni.id
                    WHERE annunci.username= '$username'";
        }

        $result = $this->auth->db->query($sql);
        $arrayRet = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($arrayRet, $row);
            }
        }
        return $arrayRet;
    }

    //Ritorna un array con tutti gli annunci di un certo user e del tipo specificato salvati
    function getSavedAnnunciOfUser($username, $tipo): array
    {
        if ($tipo == 'libri') {
            $sql = "SELECT annunci.id, titolo, descrizione, prezzo, annunci.username, materia, libri.autore, edizione, ISBN, mediapath FROM salvati
            JOIN annunci ON salvati.annuncio = annunci.id
            JOIN utenti ON salvati.utente = utenti.username
            JOIN libri ON libri.id = salvati.annuncio
            WHERE salvati.utente = '$username';";
        } else if ($tipo == 'appunti') {
            $sql = "SELECT annunci.id, titolo, descrizione, prezzo, annunci.username, materia, mediapath FROM salvati
            JOIN annunci ON salvati.annuncio = annunci.id
            JOIN utenti ON salvati.utente = utenti.username
            JOIN appunti ON appunti.id = salvati.annuncio
            WHERE salvati.utente = '$username';";
        } else if ($tipo == 'ripetizioni') {
            $sql = "SELECT annunci.id, titolo, descrizione, prezzo, annunci.username, materia FROM salvati
            JOIN annunci ON salvati.annuncio = annunci.id
            JOIN utenti ON salvati.utente = utenti.username
            JOIN ripetizioni ON ripetizioni.id = salvati.annuncio
            WHERE salvati.utente = '$username';";
        }

        $result = $this->auth->db->query($sql);
        $arrayRet = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($arrayRet, $row);
            }
        }
        return $arrayRet;
    }
    //Ritorna un bool con l'esito della verifica
    //se l'annuncio appartiene al utente $user true, false il contrario
    function verifyAnnuncioUser($username, $annuncio): bool
    {
        $result = $this->auth->db->query("SELECT id FROM annunci WHERE username='$username' and id='$annuncio'");
        return ($result->num_rows == 1);
    }
    //Elimina annuncio of user
    function deleteAnnuncio($annuncio)
    {
        $this->deleteOldMediapath($annuncio);
        return $this->auth->db->query("DELETE FROM annunci WHERE id = '$annuncio'") === TRUE;
    }

    //Elimina Saved annuncio of user
    function deleteSavedAnnuncio($annuncio, $username)
    {
        return $this->auth->db->query("DELETE FROM salvati WHERE annuncio = '$annuncio' AND utente = '$username'") === TRUE;
    }

    //Insert Saved annuncio of user
    function insertSavedAnnuncio($annuncio, $username)
    {
        return $this->auth->db->query("INSERT INTO salvati (annuncio, utente) VALUES ('$annuncio', '$username');") === TRUE;
    }

    //Ritorna un bool con l'esito della verifica
    //se l'annuncio appartiene al utente $user true, false il contrario
    function verifySaveAnnuncioUser($username, $annuncio): bool
    {
        $result = $this->auth->db->query("SELECT annuncio FROM salvati WHERE utente='$username' and annuncio='$annuncio'");
        return ($result->num_rows == 1);
    }

    //getAnnuncio
    function getAnnuncio($annuncio)
    {
        $sql = "SELECT * FROM annunci WHERE id = $annuncio";
        $result = $this->auth->db->query($sql);
        $arrayRet = array();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            //	id	titolo	descrizione	prezzo	username	mediapath	materia
            $arrayRet = array("id" => $row['id'], "tipo" => "", "titolo" => $row['titolo'], "descrizione" => $row['descrizione'], "prezzo" => $row['prezzo'], "username" => $row["username"], "mediapath" => "", "materia" => $row['materia'], "autore" => "", "edizione" => "", "isbn" => "", "email" => "");
            $idAnnuncio = $row['id'];

            //Libri
            $sqlTipo = "SELECT * FROM libri JOIN annunci ON annunci.id = libri.id JOIN utenti ON annunci.username=utenti.username WHERE libri.id = $idAnnuncio;";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $arrayRet['tipo'] = "libri";
                $arrayRet['autore'] = $row['autore'];
                $arrayRet['edizione'] = $row['edizione'];
                $arrayRet['isbn'] = $row['ISBN'];
                $arrayRet['mediapath'] = $row['mediapath'];
                $arrayRet['email'] = $row['email'];
                return $arrayRet;
            }

            //Appunti
            $sqlTipo = "SELECT * FROM appunti JOIN annunci ON annunci.id = appunti.id JOIN utenti ON annunci.username=utenti.username WHERE appunti.id = $idAnnuncio;";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $arrayRet['tipo'] = "appunti";
                $arrayRet['mediapath'] = $row['mediapath'];
                $arrayRet['email'] = $row['email'];
                return $arrayRet;
            }

            //Ripetizioni
            $sqlTipo = "SELECT * FROM ripetizioni JOIN annunci ON annunci.id = ripetizioni.id JOIN utenti ON annunci.username=utenti.username WHERE ripetizioni.id = $idAnnuncio;";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $arrayRet['tipo'] = "ripetizioni";
                $arrayRet['email'] = $row['email'];
                return $arrayRet;
            }
        }
        return $arrayRet;
    }

    //Inserimento nuovo Annuncio
    //parametro $annuncio array formatato di conseguenza
    //return id of the annuncio just inserted
    //altrimenti 0
    function new_listing($annuncio)
    {
        $upload = array("lastid" => 0, "upload" => array("esito" => false, "errore" => "Errore Generico", "path" => ""));
        if ($annuncio['tipo'] == "libri" || $annuncio['tipo'] == "appunti") {
            $upload = $this->uploadFile($annuncio['mediapath'], $annuncio['username']);
            if (!$upload["esito"])
                return array("lastid" => 0, "upload" => $upload);
        }
        $sql = "INSERT INTO annunci (titolo,descrizione,prezzo,username,materia) VALUES ('$annuncio[titolo]', '$annuncio[descrizione]', '$annuncio[prezzo]', '$annuncio[username]', '$annuncio[materia]');";
        if ($this->auth->db->query($sql) === TRUE) {
            $last_id = $this->auth->db->getConn()->insert_id;
            $sqlTipo = "";
            switch ($annuncio['tipo']) {
                case "libri":
                    $sqlTipo = "INSERT INTO libri (mediapath, id, autore, edizione, ISBN) VALUES ( '$upload[path]', '$last_id', '$annuncio[autore]', '$annuncio[edizione]', '$annuncio[isbn]');";
                    break;
                case "appunti":
                    $sqlTipo = "INSERT INTO appunti (id, mediapath) VALUES ('$last_id','$upload[path]')";
                    break;
                case "ripetizioni":
                    $sqlTipo = "INSERT INTO ripetizioni (id) VALUES ('$last_id')";
                    break;
            }
            if ($this->auth->db->query($sqlTipo) === TRUE)
                return array("lastid" => $last_id, "upload" => $upload);
        }
        return array("lastid" => 0, "upload" => $upload);
    }
    //Modifica di un Annuncio
    //parametro $annuncio array formatato di conseguenza
    //return id of the annuncio just modifiye
    //altrimenti 0
    function edit_listing($annuncio)
    {
        $sql = "UPDATE annunci SET titolo='$annuncio[titolo]', descrizione='$annuncio[descrizione]',prezzo='$annuncio[prezzo]', username='$annuncio[username]',materia='$annuncio[materia]' WHERE id='$annuncio[id]';";
        if ($this->auth->db->query($sql) === TRUE) {
            $tipoAnnuncio =
                $this->auth->db->query("SELECT DISTINCT annunci.id FROM annunci JOIN appunti WHERE annunci.id = $annuncio[id] AND appunti.id = $annuncio[id];")->num_rows == 1 ? "appunti" :
                ($this->auth->db->query("SELECT DISTINCT annunci.id FROM annunci JOIN libri WHERE annunci.id = $annuncio[id] AND libri.id = $annuncio[id];")->num_rows == 1 ? "libri" : "ripetizioni");
            $sqlTipo = "";

            //se libri o appunti aggiorno il media, solo se presente quindi se cambiato
            //aggiorno la porzione di query del mediapath solo se cambiato
            $queryMediaPath = "";
            if ($tipoAnnuncio == "libri" || $tipoAnnuncio == "appunti") {
                if (!empty($annuncio['mediapath']['name'])) {
                    $upload = $this->uploadFile($annuncio['mediapath'], $annuncio['username']);
                    if (!$upload["esito"])
                        return array("lastid" => 0, "upload" => $upload);
                    else {
                        $this->deleteOldMediapath($annuncio["id"]);
                        $queryMediaPath = " mediapath='$upload[path]' ,";
                    }
                }
            }

            //Aggiorno il database in base a cosa è l'annuncio
            switch ($tipoAnnuncio) {
                case "libri":
                    $sqlTipo = "UPDATE libri SET " . $queryMediaPath . " autore='$annuncio[autore]', edizione='$annuncio[edizione]', ISBN='$annuncio[isbn]' WHERE id='$annuncio[id]';";
                    if ($this->auth->db->query($sqlTipo) === TRUE)
                        return array("lastid" => $annuncio['id'], "upload" => $upload);
                    break;
                case "appunti":
                    $sqlTipo = "UPDATE appunti SET " . $queryMediaPath . " id='$annuncio[id]' WHERE id='$annuncio[id]';";
                    if ($this->auth->db->query($sqlTipo) === TRUE)
                        return array("lastid" => $annuncio['id'], "upload" => $upload);
                    break;
                case "ripetizioni":
                    return array("lastid" => $annuncio['id'], "upload" => "");
            }
        }
        return array("lastid" => 0, "upload" => "");
    }

    //funzione che rimuove il media, il file, di un libro o un appunto che ha già un media inserito
    function deleteOldMediapath($id)
    {
        $result = $this->auth->db->query("SELECT mediapath FROM appunti WHERE id=$id;");
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (!empty($row["mediapath"]))
                unlink($row["mediapath"]);
            return true;
        }
        $result = $this->auth->db->query("SELECT mediapath FROM libri WHERE id=$id;");
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (!empty($row["mediapath"]))
                unlink($row["mediapath"]);
            return true;
        }
        return false;
    }

    //function di upload del file
    //riceve il file e prova a fare l'upload sul server
    //verifica che il file sia una immagine
    //verifica che il file non esista già
    //verifica che il file non superi una dimensione massima
    //verifica che il formato del file sia di tipo immagine
    //prova a fare l'upload
    //ritorna esito ed eventualmente un messaggio di errore attraverso un array()
    function uploadFile($file, $username)
    {
        if (empty($file['name'])) {
            return array("esito" => true, "errore" => "Nessun immagine inserita", "path" => "");
        }
        if (empty($file['tmp_name'])) {
            return array("esito" => false, "errore" => "Errore nel caricamento dell'immagine, provare con una di minori dimensioni. Max 2 MByte", "path" => "");
        }
        $target_dir = "uploads/";
        $target_file_origin = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file_origin, PATHINFO_EXTENSION));
        $target_file = $target_dir . $username . md5_file($file['tmp_name']) . "." . $imageFileType;
        $uploadOk = array("esito" => true, "errore" => "", "path" => $target_file);

        if (getimagesize($file["tmp_name"]) === false) {
            $uploadOk["errore"] = "Il file non è una immagine";
            $uploadOk["esito"] = false;
            return $uploadOk;
        }

        if (file_exists($target_file)) {
            $uploadOk["errore"] = "L'immagine esiste già nei tuoi annunci, caricarne un'altra";
            $uploadOk["esito"] = false;
            return $uploadOk;
        }

        if ($file["size"] > 2000000) {
            $uploadOk["errore"] = "Immagine troppo grande, max 2 Mbyte";
            $uploadOk["esito"] = false;
            return $uploadOk;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk["errore"] = "Estensione non ammessa, consentiti solo JPG, JPEG, PNG & GIF";
            $uploadOk["esito"] = false;
            return $uploadOk;

        }

        if ($uploadOk["esito"]) {
            if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                $uploadOk["errore"] = "C'è stato un errore nel caricamento dell'immagine";
                $uploadOk["esito"] = false;
                return $uploadOk;
            }
        }
        return $uploadOk;
    }
}
?>