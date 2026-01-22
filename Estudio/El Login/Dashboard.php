<?php
//session_start();
if (!isset($_COOKIE['cookie'])){
    header("Location: Index.php");
    exit(); // Agregado: detiene el código si no hay cookie
}
/*
if(!isset($_SESSION['usuario'])){
    header("Location: Index.php");
    exit();
} */
if(isset($_POST['borrar'])){
    // $usuario = $_SESSION['usuario'];
    $usuario = $_COOKIE['cookie'];
    $datos = file("Usuarios.txt");
    $fich = fopen("Usuarios.txt", 'w');
    foreach($datos as $linea){
        $usuario_cortado = explode(";", $linea);
        /* if ($usuario_cortado[0] != $_SESSION['usuario']){
            fwrite($fich, $linea);
        } */
        
        // AQUI EL CAMBIO: trim() para quitar el salto de línea invisible y comparar bien
        if (trim($usuario_cortado[0]) != $_COOKIE['cookie']){
            fwrite($fich, $linea);
        }
    }
    fclose($fich);
    // session_destroy();
    
    // Recomendado: Matar la cookie aquí también para que te eche al instante
    setcookie("cookie", "", time() - 100);

    header("Location: Index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Privado</title>
</head>

<body>
    <h1>Bienvenido al sistema</h1>
    <p>Hola, <strong><?php echo $_COOKIE['cookie']; // echo $_SESSION['usuario']; ?></strong></p>
    <hr>
    <a href="Logout.php">Cerrar Sesión (Salir)</a>
    <form action="" method="POST">
        <input type="submit" value="Borrar Usuario" name="borrar">
    </form>
</body>

</html>