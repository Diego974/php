<?php

class CuentaBancaria{
    private $titular;
    private $saldo;

    public function __construct(string $titular, int $saldo){
        $this -> titular = $titular;
        $this -> saldo = $saldo;
    }

    function depositar($cantidad){
        $this->saldo += $cantidad;
        return $this -> saldo; 
    }

    function retirar($cantidad){
        if ($cantidad > $this -> saldo){
            echo "No puedes retirar más dinero del que tienes en el banco!!!";
        } else{
            $this -> saldo -= $cantidad;
        }
        return $this -> saldo;
    }

    function verInfo(){
        return "Señor/a " . $this -> titular . ", su saldo actual es " . $this -> saldo;
    }
}

$miCuenta = new CuentaBancaria("Pepe", 500);
echo $miCuenta -> verInfo();
echo $miCuenta -> depositar(200);
echo $miCuenta -> retirar(1000);
echo $miCuenta -> retirar (100);
?>