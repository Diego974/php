<?php

include "dat/Cliente.php";

/**
 *  Lee el fichero de clientes y lo carga en un Array de objetos clientes
 *  @return array - tabla asociativa con clave dni.
 */

function cargarTablaClientes (): array {

    $tclientes = [];
     // COMPLETAR
    $archivo = fopen('clientes.csv', 'r');
    if ($archivo !== false){
        while(($linea = fgetcsv($archivo)) !== false){
            $datos[] = $linea;
            $objetoCliente = new Cliente($datos[0], $datos[1], $datos[2], $datos[3]);
            $tclientes[$datos[0]] = $objetoCliente;
            
        }
    }
    fclose($archivo);

    return $tclientes;

}

/**
 * Escribe la tabla de objectos clientes en el fichero csv
 * @param  $tabla - array de objectos
 */

function salvarTablaClientes(array $tabla){

    $fich = fopen('dat/clientes.csv','w');
    // COMPLETAR
    if ($fich !== false){
    foreach($tabla as $cliente){
        $aux = [$cliente -> dni, $cliente -> nombre, $cliente -> clavehash, $cliente -> puntos];
        fputcsv($fich, $aux);
        }
    }
    
    fclose($fich);

}

/**
 * Valida usuario y contraseña contra clientes.csv
 * @param string $dni DNI del cliente
 * @param string $clave Contraseña en texto plano
 * @return true Si el usuario y la contraseña son correctas
 */
function validarCliente($dni, $clave) :bool{
    
    $tablacli = cargarTablaClientes();
    // COMPLETAR
    if (isset($tablacli[$dni])){
        $cliente = $tablacli[$dni];
        if (password_verify($clave, $cliente->clavehash)) {
            return true; // Todo correcto
        }
    }
    return false;
}

/**
 * Anota los puntos logrados en la última partida 
 * @param string $dni DNI del cliente a modificar
 * @param int $puntos Puntos a almacenar
 * @return true si han anotado los datos
*/
function anotarPuntos($dni,$puntos): bool {
    $tablacli = cargarTablaClientes();
    // COMPLETAR
    if (isset($tablacli[$dni])){
        $cliente = $tablacli[$dni];
        $cliente -> puntos = $puntos;
        salvarTablaClientes($tablacli);
        return true;
    }
    return false;
}