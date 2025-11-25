<?php
class vehiculo{
    protected $marca;
    protected $modelo;
    protected $precio;

    public function __construct($marca, $modelo, $precio){
        $this -> marca = $marca;
        $this -> modelo = $modelo;
        $this -> precio = $precio;
    }

    public function getMarca() {
        return $this -> marca;
    }
    public function setMarca($marca) {
        $this -> marca = $marca;
    }

    public function getModelo(){
        return $this -> modelo;
    }
    public function setModelo($modelo){
        $this -> modelo = $modelo;
    }

    public function getPrecio(){
        return $this -> precio;
    }
    public function setPrecio($precio){
        $this -> precio = $precio;
    }

    function mostrarDetalles():string{
        return "Marca: " . $this -> marca . ", Modelo: " . $this -> modelo . ", Precio: " . $this -> precio . "€ <br>";
    }}
    $mercedes = new vehiculo("Mercedes", "A45", 50000);
    echo $mercedes -> mostrarDetalles();
    $Audi = new vehiculo("Audi", "A1", 25000);
    echo $Audi -> mostrarDetalles();

?>