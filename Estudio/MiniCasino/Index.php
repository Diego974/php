<?php
session_start();
include 'contvisitas.php'; 
include 'Conexion.php';
// Incluye el contador de arriba
// Lógica al pulsar el botón "Entrar"
if (isset($_POST['dinero_inicial'])) {
    // 1. Guardar el dinero que viene del form en $_SESSION
    $_SESSION['dinero_inicial'] = $_POST['dinero_inicial']; 
    // 2. Redirigir a juego.php con header()
    header('Location: Juego.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<body>
    <h1>BIENVENIDO AL CASINO</h1>
    <form method="POST">
        Introduzca dinero: <input type="number" name="dinero_inicial" required>
        <button type="submit">Entrar</button>
    </form>
</body>

</html>