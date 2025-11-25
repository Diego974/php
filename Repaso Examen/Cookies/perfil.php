<?php
session_start();

if (!isset($_SESSION['usuario'])){
    echo "Acceso denegado<br><br>";
    echo "<a href='login.php'>Volver al login</a>";
    exit();
} 

$nombre = $_SESSION['usuario'];

if(isset($_COOKIE['color'])) {
    $fondo = $_COOKIE['color'];
} else {
    $fondo = 'black';
}

echo "<style>body{ background-color: " . $fondo . "; }</style>";

echo "<h1>Hola " . $nombre . "</h1>";
echo "<a href='login.php'>Cerrar Sesión</a>";
?>