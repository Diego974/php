<?php
// login.php

// 1. Iniciar el manejo de sesiones (IMPORTANTE: Esto debe ir siempre al principio)
session_start();

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['user'];
    $pass = $_POST['password'];

    // 2. Comprobar credenciales (usuario: admin, clave: 1234)
    if ($usuario === "admin" && $pass === "1234") {
        
        // 3. Guardar el nombre de usuario en la sesión
        // Pista: Se usa la superglobal $_SESSION con una clave, por ejemplo 'usuario_logueado'
        $_SESSION['user'] = $usuario;
        
        // 4. Redirigir al usuario a 'panel.php'
        header("Location: panel.php");
        exit();
    } else {
        $mensaje = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form method="post">
        Usuario: <input type="text" name="user"><br>
        Clave: <input type="password" name="password"><br>
        <input type="submit" value="Entrar">
    </form>
    <p style="color:red;"><?php echo $mensaje; ?></p>
</body>

</html>