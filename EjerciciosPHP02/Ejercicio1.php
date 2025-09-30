<?php
// Creo tres variables
$A = random_int(1,10);
$B = random_int(1,10);
$C = 0;
// Comparo las variables A y B y le doy el valor más alto a C
if ($A > $B){
    $C = $A;
    echo "$C , A es mayor que B";
}
elseif ($B > $A){
    $C = $B;
    echo "$C , B es mayor que A";
}
// Si las dos variables son iguales, $C tendrá como valor 0
else{
    echo "$C , A y B son iguales";
}
?>