<?php

$db = "casino_db";
$host = "localhost";
$user = "root";
$password = "";

try{
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $conexion = new PDO( $dsn, $user, $password);
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    
    die("Error de conexion" . $e -> getMessage());
}
?>