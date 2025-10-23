<?php
function usuarioOk($usuario, $contraseña) :bool {
  
   return ( strlen($usuario) >= 8  && $usuario == strrev($contraseña) );
    
}

function contarPalabras ($cadena){
    return str_word_count($cadena,0);
    
}
function letraMasRepetida (string $palabra) {

   $palabra = strtolower($palabra);

   if (strlen($palabra) == 0) {

      return false;
   }

   $letrasPalabra = mb_str_split($palabra);
   $contador = array_count_values($letrasPalabra);

   arsort($contador);

   $letraMasRepetida = array_key_first($contador);

   return $letraMasRepetida;
}

function palabraMasrepetida ($cadena){
    $palabras = str_word_count($cadena,1);
   
    $palabrasveces = array_count_values($palabras);
    
    asort($palabrasveces);
    return array_key_last($palabrasveces); 
 }

 function limpiarEntrada (&$cadena){
    $cadena = htmlspecialchars($cadena);
 }