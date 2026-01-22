<?php

// ---------------------------------------------------------
// 1. LA CLASE (El Plano / Molde)
// ---------------------------------------------------------
class CuentaBancaria {

    // PROPIEDADES (Las variables que tendrá cada cuenta)
    public $nombreTitular;
    public $saldo;
    public $tipoDeCuenta;

    // EL CONSTRUCTOR (La función mágica)
    // Se ejecuta AUTOMÁTICAMENTE cuando haces "new CuentaBancaria()"
    // Sirve para configurar la cuenta nada más nacer.
    public function __construct($nombre, $tipo, $saldoInicial = 0) {
        // $this significa "ESTE objeto que se está creando ahora mismo"
        $this->nombreTitular = $nombre;
        $this->tipoDeCuenta = $tipo;
        $this->saldo = $saldoInicial;
    }

    // MÉTODO: DEPOSITAR
    public function depositar($cantidad) {
        // Sumamos al saldo de ESTA cuenta
        $this->saldo = $this->saldo + $cantidad; 
        echo "<p>✅ " . $this->nombreTitular . " ha ingresado " . $cantidad . "€. Nuevo saldo: " . $this->saldo . "€</p>";
    }

    // MÉTODO: RETIRAR
    public function retirar($cantidad) {
        // Primero comprobamos si tiene dinero suficiente
        if ($this->saldo >= $cantidad) {
            $this->saldo = $this->saldo - $cantidad;
            echo "<p>💸 " . $this->nombreTitular . " ha retirado " . $cantidad . "€. Quedan: " . $this->saldo . "€</p>";
        } else {
            echo "<p style='color:red'>❌ Error: " . $this->nombreTitular . " intenta retirar " . $cantidad . "€ pero solo tiene " . $this->saldo . "€.</p>";
        }
    }

    // MÉTODO: MOSTRAR INFORMACIÓN
    public function mostrarInfo() {
        echo "<div style='border:1px solid black; padding:10px; margin:5px;'>";
        echo "<strong>Titular:</strong> " . $this->nombreTitular . "<br>";
        echo "<strong>Tipo:</strong> " . $this->tipoDeCuenta . "<br>";
        echo "<strong>Saldo Actual:</strong> " . $this->saldo . "€";
        echo "</div>";
    }
}

// ---------------------------------------------------------
// 2. EL PROGRAMA PRINCIPAL (Usando los objetos)
// ---------------------------------------------------------

echo "<h1>Banco Digital PHP</h1>";

// PASO 1: Creamos los objetos (Instanciamos la clase)
// Fíjate que al hacer 'new', le pasamos los datos que pide el __construct
$cuenta1 = new CuentaBancaria("Ana", "Corriente", 100);
$cuenta2 = new CuentaBancaria("Carlos", "Ahorro"); // Saldo por defecto será 0

echo "<h3>--- Operaciones ---</h3>";

// PASO 2: Usamos los métodos
// Ana ingresa dinero
$cuenta1->depositar(50); 

// Carlos intenta sacar dinero que no tiene (Debería dar error)
$cuenta2->retirar(20);

// Ana saca dinero (Debería funcionar)
$cuenta1->retirar(20);

echo "<h3>--- Estado Final ---</h3>";

// PASO 3: Vemos cómo han quedado
$cuenta1->mostrarInfo();
$cuenta2->mostrarInfo();

?>