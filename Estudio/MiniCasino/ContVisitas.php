<?php
// 1. Inicializar variable de visitas a 1
$visitas = 1;
// 2. Comprobar si existe la cookie 'visitas'
if (isset($_COOKIE['visitas'])) {
    // Si existe: recuperar valor y sumar 1
    $visitas = $_COOKIE['visitas'] + 1;
}
else {
    $visitas = 1;
}

// 3. Crear/Actualizar la cookie (setcookie)
// Recordad: nombre, valor, expiración (time() + segundos)
setcookie('visitas', $visitas, time()+ 3600);
// 4. Imprimir el mensaje de "Esta es su visita nº X"
echo "Esta es su visita nº " . $visitas;
?>