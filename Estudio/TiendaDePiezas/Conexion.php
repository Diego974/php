<?php

    $user = "root";
    $password = "";
    $db = "TiendaPiezas";
    $host = "localhost";
    try{
    
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $conexion = New PDO($dsn, $user, $password);
    $conexion ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("No se ha podido conectar");
    }
?>