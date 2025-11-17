<?php
class persona2 {

    private $nombre;
    private $edad;
    private $nota;

    function __construct(string $nombre, int $edad) {

        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->nota = 7;
    }

    function __get($atributo) {

        if ($atributo == "nota") {

            return ($this->nota <= 10) ? $this->nota + 1 : 10;
        } 
        
        else {

            return "--->" . $this->$atributo;
        }
    }

    function __set($name, $value) {

        if (property_exists($this, $name)) {

            if ($name == "nota") {

                if ($value <= 10) {

                    $this->nota = $value;
                    //$this->$name = $value;
                } 
                
                else {

                    $this->$name = $value;
                }
            } 
            
            else {

                echo "El atributo " . $name . " no esta definido";
            }
        }
    }
}

$p = new persona2("Pepe", 45);

echo $p->nombre . "\n";
echo $p->nota . "\n";

$p->nombre = "Pepito Pérez";
$p->nota = 10;
$p->nota = 14;

?>