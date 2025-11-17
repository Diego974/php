<?php
class Persona2{
    private $nombre;
    private $edad;
    private $nota;

    function __construct(string $nombre, int $edad){
        $this -> nombre = $nombre;
        $this -> edad = $edad;
        $this -> nota = 7;
    }

    function getNombre(){
        return $this -> nombre;
    }

    function __get($atributo){
        if ($atributo == "nota"){
            return $this -> nota +1;
            } else {
                return $this -> $atributo;
            }
        }
}
$p = new Persona2("Pepe", 45);

echo $p -> getnombre(). "\n";
echo $p -> nota. "\n";
echo $p -> nombre. "\n";