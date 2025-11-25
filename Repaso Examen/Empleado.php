<?php
// 1. CLASE PADRE (El molde básico)
class Empleado {
    // 'protected' significa: "Yo y mis hijos podemos tocar esto"
    protected $sueldo;

    // Constructor: Recibe el sueldo y lo guarda
    public function __construct($sueldo) {
        $this->sueldo = $sueldo;
    }

    // Método base
    public function calcularSueldo() {
        return $this->sueldo;
    }
}

// 2. CLASE HIJA (Hereda de Empleado)
// "Jefe TIENE TODO lo que tiene Empleado, y algo más"
class Jefe extends Empleado {
    
    private $bonus;

    // Constructor del Jefe: Necesita Sueldo (para el padre) y Bonus (para él)
    public function __construct($sueldo, $bonus) {
        // Truco pro: Llamamos al constructor del padre para que se encargue del sueldo
        parent::__construct($sueldo); 
        $this->bonus = $bonus;
    }

    // SOBRESCRITURA (Override)
    // Creamos una función con el MISMO nombre para cambiar su comportamiento
    public function calcularSueldo() {
        // Sumamos la propiedad del padre ($this->sueldo) + la nuestra ($this->bonus)
        return $this->sueldo + $this->bonus;
    }
}   

// --- PRUEBA (Para ver si funciona) ---
$jefazo = new Jefe(1000, 500); // Sueldo 1000, Bonus 500
echo "El sueldo total es: " . $jefazo->calcularSueldo(); // Debería dar 1500
?>
?>