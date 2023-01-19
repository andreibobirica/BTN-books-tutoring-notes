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
        return $string;
    }
}

?>
