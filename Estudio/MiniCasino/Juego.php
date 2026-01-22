<?php
session_start();
$mensaje = "";

// 1. SEGURIDAD
if (!isset($_SESSION['dinero_inicial'])){
    header('Location: Index.php');
    exit();
}

// --- CORRECCIÓN CLAVE AQUÍ ---
// Calculamos el dinero SIEMPRE, no solo cuando se apuesta.
// Esto sirve para mostrarlo en el HTML y para validar la apuesta después.

if (isset($_SESSION['dinero'])){
    $dinero = $_SESSION['dinero'];
} else{
    // Si es la primera vez, cogemos el inicial
    $dinero = $_SESSION['dinero_inicial'];
}
// -----------------------------


// 2. LÓGICA DEL JUEGO (Al recibir el POST 'apostar')
if (isset($_POST['apostar'])) {
    $apuesta = (int)$_POST['cantidad']; // (int) para seguridad
    $tipo = $_POST['tipo_apuesta']; 

    // A. Comprobar si la apuesta es válida
    // Usamos la variable $dinero que ya calculamos arriba
    if($apuesta > 0 && $apuesta <= $dinero){
        
        $random = random_int(0,100);
        
        // Verificamos si es par
        if($random % 2 == 0){
            $es_par = true;
        } else {
            $es_par = false;
        }

        // Comparamos
        if( ($tipo == "par" && $es_par == true) || ($tipo == "impar" && $es_par == false) ){
            $dinero += $apuesta;
            $mensaje = "GANASTE!!! Salió el $random";
        } else {
            $dinero -= $apuesta;
            $mensaje = "PERDISTE!!! Salió el $random";
        }

        // Guardamos el nuevo valor en la sesión
        $_SESSION['dinero'] = $dinero;

    } else {
        $mensaje = "Error: Cantidad no válida o saldo insuficiente";
    }
}
?>

<!DOCTYPE html>
<html>

<body>
    <h3>Dispone de: <?php echo $dinero; ?> </h3>

    <p style="color:red; font-weight:bold;"><?php echo $mensaje; ?></p>

    <form method="POST">
        Cantidad: <input type="number" name="cantidad"><br>

        <input type="radio" name="tipo_apuesta" value="par" checked> Par
        <input type="radio" name="tipo_apuesta" value="impar"> Impar<br>

        <button type="submit" name="apostar">Apostar</button>

        <a href="logout.php">Abandonar el Casino</a>
    </form>
</body>

</html>