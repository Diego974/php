<?php
$contenido = file_get_contents("accesos.txt");
echo "Total de accesos ".$contenido;
$contenido = $contenido + 1;
file_put_contents("accesos.txt", $contenido)
?>