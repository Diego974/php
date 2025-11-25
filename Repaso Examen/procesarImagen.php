<?php
require_once 'Ejercicio1.1.php';
session_start();

function verificarImagen(){
    if (!isset($_FILES['imagen'])){
        echo "No se ha subido la imagen";
        exit;
    }
    $imagenActual = $_FILES['imagen']['tmp_name'];
    $imagenReal = $_FILES['imagen']['name'];
    $ruta = "uploads/" . $imagenReal;

    if (move_uploaded_file($imagenActual, $ruta)){
        echo "La imagen se ha guardado correctamente en " . $ruta;
    } else{
        echo "La imagen no se ha guardado correctamente.";
    }
}
?>