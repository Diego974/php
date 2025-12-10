<?php
function elegirPalabra(): string{
    static $tpalabras = ["Madrid","Sevilla","Murcia","Málaga","Mallorca","Menorca"];
   // COMPLETAR
   $pos = array_rand($tpalabras);
   return $tpalabras[$pos]; // Devuelve una palabra al azar    
}

function comprobarLetra($letra,$cadena): bool{
    // COMPLETAR
    return (strpos($cadena,$letra) !== false);
    // Devuelve true o false si la letra esta en la cadena  
}


/*
 * Devuelve una cadena donde aparecen las letras de la cadenapalabra en su posición    si cada letra se encuentra en la cadenaletras
 *
 * Ej  generaPalabraconHuecos("aeiou"     ,"hola pepe") -->"-o-a--e-e"
 *     generaPalabraconHuecos("abcdefghi ","hola pepe") -->"h--a -e-e"
 *
 */


function generaPalabraconHuecos($cadenaletras, $cadenapalabra) {
    // Genero una cadena resultado inicialmente con todas las posiciones con -
    $resu = $cadenapalabra;
    for ($i = 0; $i < strlen($resu); $i++) {
        $letraActual = $cadenapalabra[$i];
        if (strpos($cadenaletras, $letraActual) === false) {
            $resu[$i] = '-';
        }
    }
        // COMPLETAR rellenado la cadena resu

    return $resu;
}