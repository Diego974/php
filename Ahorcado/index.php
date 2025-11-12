<?php
require_once "funciones.php";
define ('MAXFALLOS' ,5);
session_start();       

// INICIO NO HAY PALABRA ELEGIDA
if (! isset($_SESSION['palabrasecreta'])) {
    $_SESSION['palabrasecreta'] = elegirPalabra();
    $_SESSION['letrasusuario'] = ""; // Inicialmente no tiene ninguna letra  
    $_SESSION['fallos'] = 0; // Inicialmente no hay ningún fallo
}

if(isset($_GET["letra"])){
    $letra = $_GET["letra"];
    if (comprobarLetra($letra,$_SESSION['palabrasecreta'])){
        $_SESSION['letrasusuario'] .= $letra;
    } else{
        $_SESSION['fallos'] ++;
        if ($_SESSION['fallos'] >= MAXFALLOS){
            $msg =" Superado el numeor de intentos:";
            session_destroy();
        }
    }
}
$palabraoculta = generaPalabraconHuecos($_SESSION["letrasusuario"], $_SESSION["palabrasecreta"]);

if ($palabraoculta == $_SESSION['palabrasecreta']){
    //Hemos ganado
    $msg = "Hemos ganado, buen trabajo!!!";
    //Actualizar cookie
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
    <?php $msg ?>
    PALABRA A ADIVINAR: <?= $_SESSION['palabrasecreta']?>
    PALABRA. <?= $palabraoculta ?><br>
    Has cometido <?= $_SESSION['fallos'] ?> fallos<br>
    <form>
        Introduce una letra:
        <input type="text" name="letra" size="1">
    </form>
</body>
</html>