<?php
require_once './core/Authentication.php';

class RichiesteAnnunci
{
    private $auth = null;

    public function __CONSTRUCT()
    {
        $this->auth = new Authentication();
    }

    //Ritorna un array con tutti gli annunci di un certo user $username
    function getAnnunciOfUser($username): array
    {
        //ritorna un array con tutti gli annunci, con solo i dettagli principali
        //ID TITOLO MATERIA PREZZO
        $sql = "SELECT id, titolo, materia, prezzo FROM annunci WHERE username = '$username'";
        $result = $this->auth->db->query($sql);
        $arrayRet = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //	id	titolo	descrizione	prezzo	username	mediapath	materia
                array_push($arrayRet, array("id" => $row['id'], "titolo" => $row['titolo'], "materia" => $row['materia'], "prezzo" => $row['prezzo']));
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

    //getAnnuncio
    function getAnnuncio($annuncio)
    {
        $sql = "SELECT * FROM annunci WHERE id = $annuncio";
        $result = $this->auth->db->query($sql);
        $arrayRet = array();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            //	id	titolo	descrizione	prezzo	username	mediapath	materia
            $arrayRet = array("id" => $row['id'], "tipo" => "", "titolo" => $row['titolo'], "descrizione" => $row['descrizione'], "prezzo" => $row['prezzo'], "username" => $row["username"], "mediapath" => "", "materia" => $row['materia'], "autore" => "", "edizione" => "", "isbn" => "");
            $idAnnuncio = $row['id'];
            //Libri
            $sqlTipo = "SELECT * FROM libri WHERE id = $idAnnuncio";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $arrayRet['tipo'] = "libri";
                $arrayRet['autore'] = $row['autore'];
                $arrayRet['edizione'] = $row['edizione'];
                $arrayRet['isbn'] = $row['ISBN'];
                $arrayRet['mediapath'] = $row['mediapath'];
                return $arrayRet;
            }

            //Appunti
            $sqlTipo = "SELECT * FROM appunti WHERE id = $idAnnuncio";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $arrayRet['tipo'] = "appunti";
                $arrayRet['mediapath'] = $row['mediapath'];
                return $arrayRet;
            }

            //Ripetizioni
            $sqlTipo = "SELECT * FROM ripetizioni WHERE id = $idAnnuncio";
            $result = $this->auth->db->query($sqlTipo);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $arrayRet['tipo'] = "ripetizioni";
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
        if ($annuncio['tipo'] == "libri" || $annuncio['tipo'] == "appunti") {
            $upload = $this->uploadFile($annuncio['mediapath']);
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
                print_r($annuncio['mediapath']['name']);
                if (!empty($annuncio['mediapath']['name'])) {
                    $upload = $this->uploadFile($annuncio['mediapath']);
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
                    print($sqlTipo);
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
    function uploadFile($file)
    {
        print_r($file);
        if (empty($file['name']))
            return array("esito" => true, "errore" => "Nessun File Inserito", "path" => "");
        ;
        $target_dir = "uploads/";
        $target_file_origin = $target_dir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($target_file_origin, PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($file["name"], $imageFileType) . md5_file($file['tmp_name']) . "." . $imageFileType;
        $uploadOk = array("esito" => true, "errore" => "", "path" => $target_file);
        // Check if image file is a actual image or fake image
        if (getimagesize($file["tmp_name"]) === false) {
            $uploadOk["errore"] = "File is not an image.";
            $uploadOk["esito"] = false;
            return $uploadOk;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk["errore"] = "Sorry, file already exists.";
            $uploadOk["esito"] = false;
            return $uploadOk;
        }

        // Check file size
        if ($file["size"] > 500000) {
            $uploadOk["errore"] = "Sorry, your file is too large.";
            $uploadOk["esito"] = false;
            return $uploadOk;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $uploadOk["errore"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk["esito"] = false;
            return $uploadOk;

        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk["esito"]) {
            if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                $uploadOk["errore"] = "Sorry, there was an error uploading your file.";
                $uploadOk["esito"] = false;
                return $uploadOk;
            }
        }
        return $uploadOk;
    }
}
?>