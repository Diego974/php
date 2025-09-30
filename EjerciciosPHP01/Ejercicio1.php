<?php
// Genero dos variables con numeros aleatorios entre 1 y 10
$num1 = random_int(1, 10);
$num2 = random_int(1, 10);

// Muestro los valores asignados
echo "1º Número: $num1 <br>";
echo "2º Número: $num2 <br><br>";

// Hago la suma, la resta, la multiplicacion, la division y la potencia 
echo "$num1 + $num2 = " . ($num1 + $num2) . "<br>";
echo "$num1 - $num2 = " . ($num1 - $num2) . "<br>";
echo "$num1 * $num2 = " . ($num1 * $num2) . "<br>";
echo "$num1 / $num2 = " . ($num1 / $num2) . "<br>";
echo "$num1 ** $num2 = " . ($num1 ** $num2) . "<br>";
?>
