<?php

class Bicicleta {

    private $id;
    private $coordx;
    private $coordy;
    private $bateria;
    private $operativa;

    public function __construct($id, $coordx, $coordy, $bateria, $operativa){
        $this->id = $id;
        $this->coordx = $coordx;
        $this->coordy = $coordy;
        $this->bateria = $bateria;
        $this->operativa = $operativa;
    }

    public function __get($prop){
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }

    public function __set($prop, $valor){
        if (property_exists($this, $prop)) {
            $this->$prop = $valor;
        }
    }

    public function __toString(){
        return "Bici $this->id (batería: $this->bateria%)";
    }

    public function distancia($x, $y){
        return sqrt( pow($this->coordx - $x, 2) + pow($this->coordy - $y, 2) );
    }

}

?>