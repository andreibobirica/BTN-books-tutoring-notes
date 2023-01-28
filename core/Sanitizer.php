<?php
class Sanitizer{
    function sanitizeString($string){
        $admited = "abcdefghijklmnopqrstuvwxyz";
        $admited .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $admited .= "0123456789";
        $admited .= "áéíñóúü¿¡ÁÉÍÑÓÚÜè+ùòà,.-é*§ç°;:_[]@#{}€$!/ ";
        if(!empty($string)){
            for ($pos = 0; $pos < strlen($string); $pos++) {
                $car = substr($string, $pos, 1);
                if (strpos($admited, $car) === false){
                    $string = str_replace($car,' ',$string);
                }
            }
        }
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    function validateName($name) : bool{
        return (!preg_match("/^[a-zA-Z-' ]*$/", $name));
    }

    function validateNumber($number) : bool{
        return preg_match('/^([0-9]*)$/', $number);
    }
    
    function validatePassword($password):bool{
        $ret = preg_match("/[0-9]/", $password) &&
        preg_match("/[A-Z]/", $password) &&
        preg_match('/[\\*-\\+\\=\\.,\\?\\^!\\/&%\\$£;°ç\\[\\]\\(\\)\\{\\}<>_\\\\!]/', $password);
        return $ret;
    }

    function validateDate($date, $format = 'd-m-'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date && $d->format('Y') > "1930" && $d->format('Y') < "2023";
    }

    function validateEmail($email) : bool{
        return (!filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    function validateURL($url) : bool{
        return (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url));
    }

}

?>
