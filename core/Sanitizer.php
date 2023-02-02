<?php
class Sanitizer
{
    function sanitizeString($string)
    {
        $admitted = "abcdefghijklmnopqrstuvwxyz";
        $admitted .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $admitted .= "0123456789";
        $admitted .= "'áéíñóúü¿¡ÁÉÍÑÓÚÜè+ùòà,.-é*§ç°;:_[]@#{}€$!/ ";
        if (!empty($string)) {
            for ($pos = 0; $pos < strlen($string); $pos++) {
                $car = substr($string, $pos, 1);
                if (strpos($admitted, $car) === false) {
                    $string = str_replace($car, ' ', $string);
                }
            }
        }
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    function validateName($name): bool
    {
        return (preg_match("/^[a-zA-Z-' ,.+]*$/", $name) && !empty($name));
    }

    function validateNameNumber($name): bool
    {
        return (preg_match("/^[a-zA-Z0-9-' ,.+]*$/", $name) && !empty($name));
    }

    function validateNameNumberMaxLength($name): bool
    {
        return ($this->validateNameNumber($name) && strlen($name) <= 40 && !empty($name));
    }

    function validateNameMaxLength($name): bool
    {
        return ($this->validateName($name) && strlen($name) <= 40 && !empty($name));
    }

    function validateNumber($number): bool
    {
        return preg_match('/^([0-9]*)$/', $number) && !empty($number);
    }
    function validateDescription($name)
    {
        return ($this->validateNameNumber($name) && strlen($name) <= 300 && !empty($name));
    }

    function validateTitle($name)
    {
        return ($this->validateNameNumber($name) && strlen($name) <= 60 && !empty($name));
    }

    function validateUsername($name): bool
    {
        return ($this->validateNameNumber($name) && strlen($name) <= 25 && !empty($name));
    }

    function validateISBN($number)
    {
        return ($this->validateNumber($number) && strlen($number) <= 13 && !empty($number));
    }

    function validatePassword($password): bool
    {
        $ret = preg_match("/[0-9]+/", $password) &&
            preg_match("/[A-Z]+/", $password) &&
            preg_match('/[\\*-\\+\\=\\.,\\?\\^!\\/&%\\$£;°ç\\[\\]\\(\\)\\{\\}<>_\\\\!]+/', $password)
            && strlen($password) <= 40
            && !empty($password);
        return $ret;
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date && $d->format('Y') > "1930" && $d->format('Y') < "2023";
    }

    function validateEmail($email): bool
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) <= 60 && !empty($email));
    }

}

?>