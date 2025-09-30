<?php

function funcionesvar($num1, $num2){
    $resultado  = "$num1 + $num2 = " . ($num1 + $num2) . "<br>";
    $resultado .= "$num1 - $num2 = " . ($num1 - $num2) . "<br>";
    $resultado .= "$num1 * $num2 = " . ($num1 * $num2) . "<br>";
    $resultado .= "$num1 / $num2 = " . ($num1 / $num2) . "<br>";
    $resultado .= "$num1 ** $num2 = " . ($num1 ** $num2) . "<br>";
    
    return $resultado;
}
?>