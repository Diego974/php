<?php

class Coche
{
    // Definir los atributos
    private $modelo;
    private $distanciaTotal;
    private $distanciaParcial;
    private $motor;
    private $velocidad;
    private $velocidadMax;
    private $contadorFallos;
    
    // Completar los métodos
    
    function __construct ( string $modelo, int $velocidadMax){
        $this->modelo = $modelo;
        $this->velocidadMax = $velocidadMax;
        $this->distanciaTotal = 0;
        $this->distanciaParcial = 0;
        $this->motor = false;
        $this->velocidad = 0;
        $this->contadorFallos = 0;
    }
    
    public function arrancar():bool{
        if ($this->motor) {
            $this->infoError("El coche ya está arrancado.");
            return false;
        }
        
        $this->motor = true;
        return true;
    }
    
    public function parar():bool{ 
        if (!$this->motor) {
            $this->infoError("El coche ya está parado.");
            return false;
        }
        
        $this->motor = false;
        $this->velocidad = 0;
        $this->distanciaParcial = 0;
        return true;
    }
    
    public function acelera( int $cantidad):bool{
        if (!$this->motor) {
            $this->infoError("El motor está apagado. No se puede acelerar.");
            return false;
        }

        $this->velocidad += $cantidad;
        
        if ($this->velocidad > $this->velocidadMax){
            $this->velocidad = $this->velocidadMax;
            $this->infoError("Se ha alcanzado y limitado la velocidad máxima.");
        }
        return true;
    }
    
    public function frena ( int $cantidad):bool{
        if (!$this->motor) {
            $this->infoError("El motor está apagado. No se puede frenar.");
            return false;
        }
        
        if ($this->velocidad == 0){
            $this->infoError("El coche ya está detenido.");
            return false;
        }
        
        $this->velocidad -= $cantidad;
        
        if ($this->velocidad < 0) {
            $this->velocidad = 0;
        }
        return true;
    }
    
    public function recorre ():bool{
        if (!$this->motor) {
            $this->infoError("El motor está apagado. No se puede recorrer distancia.");
            return false;
        }
        
        $this->distanciaParcial += $this->velocidad;
        $this->distanciaTotal += $this->velocidad;
        return true;
    }
    
    public function info():string{
        $estadoMotor = $this->motor ? "Arrancado" : "Parado";

        return " El modelo es: " . $this->modelo . "<br>" . 
               "La velocidad actual es: " . $this->velocidad . "<br>" . 
               "El estado del motor es: " . $estadoMotor . "<br>" . 
               "Los kilometros parciales recorridos son: " . $this->distanciaParcial . "<br>" . 
               "Los kilometros totales recorridos son: " . $this->distanciaTotal. "<br>";
    }
    
    public function getKilometros():int{
        return $this->distanciaParcial;
    }
    
    public function getDistanciaTotal():int{
        return $this->distanciaTotal;
    }

    private function infoError( string $mensaje):void{
        $this->contadorFallos++;
        echo "Error en {$this->modelo}: $mensaje. Fallos: {$this->contadorFallos}<br>";
    } 
}