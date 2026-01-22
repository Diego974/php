<?php
session_start();
include "Auth.php";

$error = "";

if (isset($_POST['blogin'])){
    
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
    $miAuth = new auth();
    if ($miAuth->login($usuario, $contraseña)){
            // $_SESSION['usuario'] = $usuario;
            // $_SESSION['contraseña'] = $contraseña;
            setcookie("cookie", $usuario, time() + 30);
            header("Location: dashboard.php");
            exit();
        } else{
            $error = "Datos incorrectos";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if($error != "") { echo "<p style='color:red'>$error</p>"; } ?>
    <form method="POST" action="">
        Nombre: <input type="text" name="usuario">
        Contraseña: <input type="text" name="contraseña">
        <input type="submit" value="Enviar" name="blogin">
        <a href="Registrar.php">Registrar Usuario</a>
    </form>
</body>

</html>