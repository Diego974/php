<?php
session_start();

if (isset($_POST['enviar'])){
    $_SESSION['usuario'] = $_POST['nombre'];
    setcookie('color', $_POST['color'], time() + 3600);
    header('Location: perfil.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <form action="" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required> <br><br>

        <label>Color favorito:</label>
        <input type="text" name="color" required> <br><br>

        <input type="submit" name="enviar" value="Entrar">
    </form>
</body>

</html>