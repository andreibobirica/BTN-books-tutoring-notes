<?php


/**
 * $email = 'myname@gmail.com';
 *$emailSanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
 */

require_once "Database.php";
/**
 * Class Authentication that serves server side request to confirm login and registration process
 */
class Authentication
{
    public $db = null;

    public function __CONSTRUCT()
    {
        $this->db = new Database();
    }

    /**
     * Function that make the login with the parameters user and pass
     * @param $user username in login
     * @param $pass password in login
     * @return boolean , if with that function from that moment we are loged in, Returns true if we estabilished a new log in connection, or false if we not do so
     * if we return false the motivation could be a validation of character not correct, or esentialy we are not be able to log in cause the incorect email or pass
     */

    function login($username, $pass)
    {
        //Controll if we are not already loged in
        //if (!isset($_SESSION["loginAccount"]) || empty($_SESSION["loginAccount"])) {
            //Traditional login with email and pass to the DB

            //Execute query to DB to solve login request
            $query = "SELECT username FROM utenti WHERE username='" . $username . "' AND password = '" . $pass . "'";
            $result = $this->db->query($query);

            //Control on the result of DB to enstablish or not the login
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION["loginAccount"] = $row["username"];
                $_SESSION["emailAccount"] = "";
                $_SESSION["nameAccount"] = "";
                $_SESSION["surnameAccount"] = "";
                $_SESSION["birthdateAccount"] = "";
                $queryUser = "SELECT email,nome,cognome,datanascita FROM `utenti` WHERE username = '$row[username]'";
                //Applaying query user
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

    function getPassword($username){
        $queryUser = "SELECT password FROM `utenti` WHERE username = '$username'";
        $result = $this->db->query($queryUser);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row["password"];
        }
        return "";
    }

    /**
     * Function that returns the variable login, returns if there is a login or not
     * Another thing that this function do, is control if we expire the session time, if we expire the limited time to be loged in, we
     * occur to log in another time
     * @return bool|mixed
     */
    function getIfLogin()
    {
        //Control of session time
        $this->sessionTimeExpire();

        //Return the information about the login
        if (!isset($_SESSION["loginAccount"]) || empty($_SESSION["loginAccount"]))
            return false;
        else
            return true;
    }

    /**
     * Another thing that this function do, is control if we expire the session time, if we expire the limited time to be loged in, we
     * occur to log in another time
     * After 30 minutes 1800 seconds the session exepires
     */
    function sessionTimeExpire()
    {
        //Control of session time
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset(); // unset $_SESSION variable for the run-time
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
                "error" => "Le password non Coincidono"
        );

        //verifico se username già esistente 
        $result = $this->db->query("SELECT username FROM utenti WHERE username='$username'");
        if ($result->num_rows != 0) {
            return array(
                "return" => false,
                "error" => "Username già esistente, riprovare con altro."
            );
        }

        //Applying query account on db
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

    function edit_account($vecchioUsername,$username, $email, $nome, $cognome, $data,$pass1, $pass2): array
    {
        //Messaggio di conferma nel caso registrazione positiva
        $retResponse = array(
            "return" => true,
            "error" => ""
        );

        //Password non coincidono
        if ($pass1 != $pass2)
            return array(
                "return" => false,
                "error" => "Le password non Coincidono"
        );

        //verifico se username già esistente 
        $result = $this->db->query("SELECT username FROM utenti WHERE username='$username'");
        if ($result->num_rows != 0 && $username!=$vecchioUsername) {
            return array(
                "return" => false,
                "error" => "Username già esistente, riprovare con altro."
            );
        }

        //Applying query account on db
        $queryAccount = "UPDATE utenti SET nome = '$nome', password = '$pass1' , cognome = '$cognome', username = '$username', email = '$email' WHERE utenti.username = '$vecchioUsername';";
        $res = $this->db->query($queryAccount);
        //se modifica avvenuta correttamente  , altrimenti messaggio di errore
        if (($res === TRUE)) {
            //login
            if($this->login($username, $pass1))
            print("login avvenuto");
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