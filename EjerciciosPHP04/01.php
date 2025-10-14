<?php
$tusuarios = [
    'pepe' => '1234',
    'luis' => '5678',
    'admin' => 'admin'
];
$usuario = $_POST["nombre"];
$clave = $_POST["clave"];

if ($tusuarios[$usuario] == $clave)
?>