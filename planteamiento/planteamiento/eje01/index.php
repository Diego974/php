<?php
session_start();
include_once 'funciones.php';
$msg = "";
$numRandom = Rand(1,50);

if (isset($_SESSION['dni'])) {

    if (isset($_GET['orden'])) {
        if ($_GET['orden'] == 'salir') {
            $fich = fopen("clientes.csv", "w");
            file_put_contents("clientes.csv", $_SESSION['puntos'], FILE_APPEND);
            
            // ALMACENAR LOS PUNTOS EN FICHERO Y CERRAR LA SESION
            
            // MOSTRAR VISTA DE INICIAL
            include 'vistas/login.php';
            exit();
        }

        if ($_GET['orden'] == 'continuar' && $_SESSION['puntos'] > 0) {
            // CAMBIAR LOS  PUNTOS DE LA SESION CON VALORES ALEATORIA
            $_SESSION['puntos'] += $numRandom;
            if ($_SESSION['puntos'] <= 0) {
                $_SESSION['puntos'] = 0;
            }
        }
    } 
    include 'vistas/puntos.php';
}




if ($_SERVER['REQUEST_METHOD'] == "GET" && !isset($_SESSION['dni'])) {
        include 'vistas/login.php';
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!isset($_SESSION['nombre'])){
        include 'vistas/login.php';
    }
    // PROCESAR FORMULARIO LOGIN
    // COMPROBAR QUE LOS PUNTOS SON NUMERICOS
    // COMPROBAR QUE DNI Y LA CLAVE SON CORRECTOS
    // SI NO ES CORRECTO MOSTRAR EL LOGIN CON UN 
    // MENSAJE DE ACCESO
    // ANOTAR PUNTOS Y DNI EN AL SESSION Y MOSTRAR LA VISTA DE PUNTOS
    $nuevosPuntos = $_POST['puntos'];
    if ($_POST['puntos'] / 2 != 0){
        $msg = "Tienes que introducir un número";
        echo $msg;
        $_SESSION['dni'] = $_POST['dni'];
        $_SESSION['puntos'] = $_POST['puntos'];
    }
    
   if ($_SERVER['REQUEST_METHOD'] == "GET") {

    include "vistas/login.php";
}

else {

    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $clavehash = $_POST['clavehash'];
    $puntos = $_POST['puntos'];
    
    if (validarCliente($dni, $clavehash)) {

        $_SESSION['dni'] = $dni;
        $_SESSION['puntos'] = $puntos;
        $_SESSION['tiempo'] = time() + 600;
        validarCliente($dni, $clavehash);
        anotarPuntos($dni, $puntos);
        include "vistas/puntos.php";
    }
    else {
        $msg = "Nombre y Contraseña incorrectos";
        include "vistas/login.php";
        echo "Acceso denegado";
    }
     $_SESSION['dni'] = "000007";
     $_SESSION['puntos'] = 333;
     include 'vistas/puntos.php';
    }
}