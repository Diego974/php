<?php

require 'funcionesvar.php';
// Defino dos variables
$num1 = random_int(1,10);
$num2 = random_int(1,10);
echo "Numero 1: $num1 <br>";
echo "Numero 2: $num2 <br>";
echo funcionesvar($num1,$num2);
?>