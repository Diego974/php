<?php 
include_once 'util.php';
session_start();

$mensaje="";
if (!isset($_SESSION['usuario']) && !isset($_POST['orden'])){
    include_once 'vistas/acceso.php';
    die();
}

if ($_POST['orden'] ==  "entrar" ){
    // Campos de usuario y contraseña rellenos
    if (empty ($_REQUEST['username']) || empty ($_REQUEST['password'])){
        $mensaje = " Debe rellenar los campos";
        include_once 'vistas/acceso.php';
        die();
    } else{
        if (userOK($_REQUEST['username'], $_REQUEST['password'])){
            $_SESSION['usuario'] = $_REQUEST['username'];
            include_once 'vistas/cambiarcontra.php';
        } else{
            $mensaje = " Usuario y contraseña no válidos";
            include_once 'vistas/acceso.php';
        }
    }
    // con valores correctos
    // Actualizo variable de sesión
    // Si falla muestro acceso.php
    include_once 'vistas/cambiarcontra.php';
 
}

if ($_POST['orden'] ==  "cambiar" ){
    // Comprobar que los campos están llenos
    // Se cambiar si la contraseña antigua es correcta
    // Y las nuevas contraseñas son iguales sino volvemos
    // a mostrar cambiarcontra y cerramos la sesión
    // si falla muestro cambiarcontra.php
    include_once 'vistas/resultado.php';
  
}
    