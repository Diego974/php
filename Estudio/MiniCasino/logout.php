<?php
session_start();
include_once 'Conexion.php';
// 1. Guardar el dinero restante en una variable local antes de destruir la sesión
// 2. Destruir la sesión

$dineroFinal = $_SESSION['dinero'] ?? $_SESSION['dinero_inicial'] ?? 0; // ESTO ES COMO UN IF ELSE

/* 
if (isset($_SESSION['dinero'])) {
    Opción 1: Dinero acumulado
    $dineroFinal = $_SESSION['dinero']; 
} 
elseif (isset($_SESSION['dinero_inicial'])) {
    Opción 2: Si no jugaste, al menos tienes el inicial
    $dineroFinal = $_SESSION['dinero_inicial']; 
} 
else {
    Opción 3: Si no hay nada, 0
    $dineroFinal = 0; 
}
*/
try {
$sql = "INSERT into ranking (dinero) VALUES (:dinero)";
$stmt = $conexion->prepare($sql);
$stmt -> execute([':dinero' => $dineroFinal]);
} catch(PDOException $e){
    echo "Error al guardar:" . $e->getMessage();
}
session_destroy();
?>
<h1>Gracias por jugar</h1>
<p>Su resultado final es: <?php /* IMPRIMIR DINERO FINAL */ $dineroFinal ?> Euros</p>
<a href="index.php">Volver a jugar</a>