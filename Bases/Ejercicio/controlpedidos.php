<?php
include_once "datos/AccesoDatos.php";
include_once "datos/Cliente.php";
include_once "datos/Pedido.php";

$nombre = $_GET["nombre"];
$clave = $_GET["clave"];

$ac = AccesoDatos::getModelo();
$cli = $ac -> getCliente($nombre, $clave);
if ($cli) {
    $tpedidos = $ac -> getPedidos($cli -> cod_cliente);
    $ac -> incrementarVeces($cli -> cod_cliente);
    echo "  Mostrando los pedidos del cliente". $cli -> $cod_cliente . " Total = ". count($tpedidos);
    //include "vistas/vistapedidos.php";
}else{
    echo "  No se encuentra";
}
?>