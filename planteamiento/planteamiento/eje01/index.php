<?php
session_start();
include_once 'funciones.php'; // Incluimos las funciones que ya terminasteis

// --------------------------------------------------------------------------
// 1. CONTROL DE BLOQUEO (COOKIE) [cite: 12]
// Comprobar si existe la cookie de bloqueo. Si existe, mensaje y cortar.
// --------------------------------------------------------------------------
if (isset($_COOKIE['bloqueado'])) {
    // COMPLETAR: Imprimir un mensaje diciendo que espere 10 min y usar die() o exit();
    die("Has salido de la aplicacion, vuelve a entrar en 10 minutos");
}

$msg = ""; // Variable para guardar mensajes de error del login

// --------------------------------------------------------------------------
// 2. GESTIÓN DE SESIÓN INICIADA (Usuario ya dentro) 
// --------------------------------------------------------------------------
if (isset($_SESSION['dni'])) {

    // Verificamos si han pulsado algún botón (orden) 
    if (isset($_GET['orden'])) {
        
        // --- CASO A: ORDEN 'salir' [cite: 11, 12, 22] ---
        if ($_GET['orden'] == 'salir') {
            // COMPLETAR:
            // 1. Llamar a vuestra función anotarPuntos($dni, $puntos) para guardar en el CSV.
            anotarPuntos($_SESSION['$dni'], $_SESSION['$puntos']);
            // 2. Crear la cookie 'bloqueado' con valor 1 y duración 10 minutos (time() + 600).
            setcookie('bloqueado', 1, time() + 600);
            // 3. Destruir la sesión actual.
            session_destroy();
            // 4. Redirigir a index.php o cortar ejecución.
            header("Location: index.php");
        }

        // --- CASO B: ORDEN 'continuar' (Jugar) [cite: 9, 10] ---
        if ($_GET['orden'] == 'continuar') {
            // COMPLETAR:
            // 1. Comprobar si tiene más de 0 puntos en la sesión.
            if ($_SESSION['puntos'] > 0){
            // 2. Si tiene puntos:
            //    - Generar random (-50 a 50).
            $random = random_int(-50, 50);
            //    - Sumarlo a la variable de sesión $_SESSION['puntos'].
            $_SESSION['puntos'] += $random;
            //    - Si el resultado es menor que 0, forzarlo a 0.
            if ($_SESSION['puntos'] < 0){
                $_SESSION['puntos'] = 0;
            }
            }else {
            $msg = "No tienes puntos bby, no puedes jugar";
            }
        }
    }
    
    // Si tiene sesión, SIEMPRE mostramos la vista de puntos y terminamos aquí
    include 'vistas/puntos.php'; 
    exit(); 
}

// --------------------------------------------------------------------------
// 3. PROCESAR LOGIN (FORMULARIO POST) [cite: 13, 15]
// Si llegamos aquí es que NO hay sesión. Miramos si han enviado el formulario.
// --------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Recogemos los datos del formulario
    $dni = $_POST['dni'];
    $clave = $_POST['clave'];
    $puntos_iniciales = $_POST['puntos']; // [cite: 14]

    // COMPLETAR LAS VALIDACIONES:
    
    // A) Si $puntos_iniciales NO es numérico[cite: 18]:
    //    -> Guardar mensaje de error en $msg.
    if (!is_numeric($puntos_iniciales)){
        $msg = "Los puntos no son numericos";
    }
    // B) Si es numérico, llamar a validarCliente($dni, $clave)[cite: 19, 21]:
    //    -> Si devuelve true (Login OK):
    //       1. Guardar $dni y $puntos_iniciales en variables de $_SESSION.
    //       2. Redirigir a 'index.php' con header("Location: index.php") para entrar limpio.
    else{
        if (validarCliente($dni, $clave) == true){
            $_SESSION['dni'] = $dni;
            $_SESSION['puntos'] = $puntos_iniciales;
            header('Location: index.php');
        }{
            // C) Si devuelve false (Credenciales mal):
            //    -> Guardar mensaje de error en $msg.
            $msg = "Credenciales erroneas";
        }
        
    }
    
}

// --------------------------------------------------------------------------
// 4. VISTA DE LOGIN (Por defecto) [cite: 6]
// --------------------------------------------------------------------------
include 'vistas/login.php';
?>