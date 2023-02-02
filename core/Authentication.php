<?php

require_once "Database.php";

class Authentication
{
    public $db = null;

    public function __CONSTRUCT()
    {
        $this->db = new Database();
    }

    function login($username, $pass)
    {

        $query = "SELECT username FROM utenti WHERE username='" . $username . "' AND password = '" . $pass . "'";
        $result = $this->db->query($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION["loginAccount"] = $row["username"];
            $_SESSION["emailAccount"] = "";
            $_SESSION["nameAccount"] = "";
            $_SESSION["surnameAccount"] = "";
            $_SESSION["birthdateAccount"] = "";
            $queryUser = "SELECT email,nome,cognome,datanascita FROM `utenti` WHERE username = '$row[username]'";

            $result = $this->db->query($queryUser);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION["emailAccount"] = $row["email"];
                $_SESSION["nameAccount"] = $row["nome"];
                $_SESSION["surnameAccount"] = $row["cognome"];
                $_SESSION["birthdateAccount"] = $row["datanascita"];
            }
            return true;
        }
        // }
        return false;
    }

    function getIfLogin()
    {
        $this->sessionTimeExpire();

        if (!isset($_SESSION["loginAccount"]) || empty($_SESSION["loginAccount"]))
            return false;
        else
            return true;
    }

    function sessionTimeExpire()
    {
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            session_unset();
            session_destroy(); // destroy session data in storage
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }

    function register($username, $email, $pass1, $pass2, $fName, $lName, $bDate): array
    {
        //Messaggio di conferma nel caso registrazione positiva
        $retResponse = array(
            "return" => true,
            "error" => ""
        );

        //Verifico se già loggato
        if ($this->getIfLogin() === TRUE)
            return array(
                "return" => false,
                "error" => "Utente Già Loggato, disconettersi prima di creare un nuovo account"
            );

        //Password non coincidono
        if ($pass1 != $pass2)
            return array(
                "return" => false,
                "error" => "Le password non coincidono"
            );

        //verifico se username già esistente 
        $result = $this->db->query("SELECT username FROM utenti WHERE username='$username'");
        if ($result->num_rows != 0) {
            return array(
                "return" => false,
                "error" => "Username già esistente, riprovare con altro."
            );
        }

        $queryAccount = "INSERT INTO utenti (nome, cognome, username, email, password, datanascita ) VALUES ('$fName', '$lName', '$username', '$email', '$pass1', '$bDate');";
        $res = $this->db->query($queryAccount);
        //se registrazione avvenuta correttamente , login , altrimenti messaggio di errore
        if (($res === TRUE)) {
            //login
            $this->login($username, $pass1);
            return $retResponse;
        } else {
            return array(
                "return" => false,
                "error" => "Errore Generico"
            );
        }

    }

    function edit_account($vecchioUsername, $username, $email, $nome, $cognome, $data, $pass1, $pass2): array
    {
        //Messaggio di conferma nel caso registrazione positiva
        $retResponse = array(
            "return" => true,
            "error" => ""
        );

        //verifico se username già esistente 
        $result = $this->db->query("SELECT username FROM utenti WHERE username='$username'");
        if ($result->num_rows != 0 && $username != $vecchioUsername) {
            return array(
                "return" => false,
                "error" => "Username già esistente, riprovare con altro."
            );
        }

        $queryAccount = "UPDATE utenti SET datanascita = '$data', nome = '$nome' REPLACEPASS, cognome = '$cognome', username = '$username', email = '$email' WHERE utenti.username = '$vecchioUsername';";
        if (!empty($pass1) || !empty($pass2)) {
            $queryAccount = str_replace('REPLACEPASS', ", password = '$pass1'", $queryAccount);
            //Password non coincidono
            if ($pass1 != $pass2)
                return array(
                    "return" => false,
                    "error" => "Le password non Coincidono"
                );
        } else {
            $queryAccount = str_replace('REPLACEPASS', "", $queryAccount);
        }

        print($queryAccount);
        $res = $this->db->query($queryAccount);
        //se modifica avvenuta correttamente  , altrimenti messaggio di errore
        if (($res === TRUE)) {
            //Aggiorno i dati nelle variabile di sessione
            $_SESSION["loginAccount"] = $username;
            $_SESSION["emailAccount"] = $email;
            $_SESSION["nameAccount"] = $nome;
            $_SESSION["surnameAccount"] = $cognome;
            $_SESSION["birthdateAccount"] = $data;
            return $retResponse;
        } else {
            return array(
                "return" => false,
                "error" => "Errore Generico"
            );
        }

    }
}

?>