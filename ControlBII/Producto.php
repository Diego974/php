<?php

class Producto{
    private $producto_no;
    private $descripcion;
    private $precio_actual;
    private $stock_disponible;
    
    function __get($name){
        if (property_exists($this,$name)){
            return $this -> $name;
        }
    }
    function __set($name, $value){
        if (property_exists($this,$name)){
             $this -> $name = $value;
        }
    }
}

?>