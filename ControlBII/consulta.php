<?php

require_once "Producto.php";
require_once "AccesoDatos.php";

$ac = AccesoDatos::getModelo();
$tproductos = $ac -> getProductos();

if (isset($_POST["orden"]) && isset($_POST["tproductos"])){
    $ac -> bajarprecios($_POST["tproductos"]);
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
    <h1>BAJAR PRECIOS</h1>
    //-- INCLUIR EN EL FORMULARIO
    <form method="POST">
        <table border="1">
            <?php  foreach ($tproductos as $pro): ?>
            <tr>
                <td><input type="checkbox" name="tproductos[]" value="<?=$pro->producto_no ?>"></td>
                <td><?=$pro->producto_no ?></td>
                <td><?=$pro->descripcion  ?></td>
                <td><?=$pro->stock_disponible ?></td>
                <td><?=$pro->precio_actual ?></td>
            <tr>
                <?php endforeach; ?>
        </table>
        <input type="submit" name="orden" value="ACTUALIZAR">
    </form>
</body>

</html>