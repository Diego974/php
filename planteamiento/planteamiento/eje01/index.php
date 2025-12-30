<?php
session_start();
include_once 'funciones.php';

$random = random_int(-50, 50);

if (isset($_SESSION['dni'])) {

    if (isset($_GET['orden'])) {
        if ($_GET['orden'] == 'salir') {

            // ALMACENAR LOS PUNTOS EN FICHERO Y CERRAR LA SESION
            // MOSTRAR VISTA DE INICIAL
            $archivo = fopen('clientes.csv', 'w');
            fputcsv($archivo, $_SESSION['puntos']);
            fclose('clientes.csv');
            exit();
        }
        if ($_GET['orden'] == 'continuar' && $_SESSION['puntos'] > 0) {
            // CAMBIAR LOS  PUNTOS DE LA SESION CON VALORES ALEATORIA
            $_SESSION['puntos'] += $random;
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
$nombre = $_POST['dni'];
$clave = $_POST['clave']; 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // PROCESAR FORMULARIO LOGIN
    if(is_numeric($_SESSION['puntos'])){
        $msg = "Los puntos son correctos";
    }else{
        $msg = "Los puntos no son numeros";
    }
    if ($_SESSION['dni'] == $nombre && $_SESSION['clave'] == $clave){
        $msg = "Bienvenido + $nombre";
    }else{
        $msg = "Credenciales incorrectas";
    }
    // COMPROBAR QUE LOS PUNTOS SON NUMERICOS
    // COMPROBAR QUE DNI Y LA CLAVE SON CORRECTOS
    // SI NO ES CORRECTO MOSTRAR EL LOGIN CON UN 
    // MENSAJE DE ACCESO
    // ANOTAR PUNTOS Y DNI EN EL SESSION Y MOSTRAR LA VISTA DE PUNTOS
   
     $_SESSION['dni'] = $nombre;
     $_SESSION['puntos'] = $_POST['puntos'];
     include 'vistas/puntos.php';
}