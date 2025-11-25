<?php

class Producto{
    private $nombre;
    private $precio;
    
    function __construct($nombre, $precio){
        $this -> nombre = $nombre;
        $this -> precio = $precio;
    }
    function mostrarDetalles(){
        echo ("Objeto: " . $this -> nombre . " Precio: ". $this -> precio);
    }
}

?>