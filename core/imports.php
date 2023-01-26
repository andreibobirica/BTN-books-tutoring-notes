<?php

function boilerplate($pagina)
{
    $imports = '<meta charset="UTF-8" />';
    $imports .= '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
    $imports .= '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
    $imports .= '<link rel="stylesheet" href="print.css" media="print"/>';
    $imports .= '<link rel="stylesheet" href="style.css" />';
    $imports .= '<script src="./scripts/main_script.js" async></script>';

    $pagina = str_replace('<php-imports />', $imports, $pagina);

    return $pagina;
}
?>