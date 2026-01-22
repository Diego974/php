<?php
$error = "";
$mensaje = "";

if (isset($_POST['registrar'])){
    
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // 1. VALIDACIÓN: Que no estén vacíos
    if (!empty($usuario) && !empty($contraseña)) {
        
        // 2. CONCATENACIÓN CORRECTA: Salto de línea SOLO al final
        $nuevoUsu = $usuario . ";" . $contraseña . PHP_EOL;

        // 3. Escribir
        $fich = fopen("Usuarios.txt", 'a');
        fwrite($fich, $nuevoUsu);
        fclose($fich);
        
        $mensaje = "Usuario registrado con éxito";
    } else {
        $error = "Por favor, rellena todos los campos";
    }

} else {
    // Código opcional si quieres hacer algo cuando cargan la página
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>

<body>
    <?php if($error != "") { echo "<p style='color:red'>$error</p>"; } ?>
    <?php if($mensaje != "") { echo "<p style='color:green'>$mensaje</p>"; } ?>

    <form method="POST" action="">
        Nombre: <input type="text" name="usuario" required>
        Contraseña: <input type="text" name="contraseña" required>
        <input type="submit" value="Registrar" name="registrar">
    </form>

    <br>
    <a href="index.php">Volver al Login</a>
</body>

</html>