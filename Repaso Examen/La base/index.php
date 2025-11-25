<?php
include_once "Clase_producto.php";

if (isset($_POST['mandar'])){
$nombreR = $_POST['nombre'];
$precioR = $_POST['precio'];

$producto1 = new Producto($nombreR, $precioR);
$producto1 -> mostrarDetalles();
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
    <form action="" method="POST">
        <label for="">Introduzca el nombre:</label>
        <input type="text" name="nombre"> <br> <br>
        <label for="">Introduzca el precio:</label>
        <input type="text" name="precio"> <br> <br>
        <input type="submit" name="mandar" value="Enviar Formulario" />
    </form>
</body>

</html>