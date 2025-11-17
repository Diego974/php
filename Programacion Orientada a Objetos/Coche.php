<?php
class Coche {
    private $matricula;
    protected $precio;
    public $estado;

    function __construct(string $matricula){
        $this -> matricula = $matricula;
        $this -> precio = $precio;
        $this -> estado = $estado;
    }
    function __toString(){
        return "INFO".$this -> matricula. ": ".$this -> precio;
    }
    function fijarprecio(int $precionuevo){
        $this -> precio = $precionuevo;
    }

    function mostrarInfo():string{
        return $this -> matricula. ": ". $this -> precio;
    }
}

$c1 = new Coche("3492XRS");
// Para acceder a un atributo se utiliza una flecha (->)
$c1 -> estado = false;
$c1 -> fijarprecio(4000);
echo "\n" .$c1 -> mostrarInfo();
echo $c1;
unset($c1);
echo "\n fin de programa.";
?>