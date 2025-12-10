<?php

include "dat/Cliente.php";
$fichero = fopen("dat/clientes.csv", "r");
$valores = fgetcsv($fichero);
/**
 *  Lee el fichero de clientes y lo carga en un Array de objetos clientes
 *  @return array - tabla asociativa con clave dni.
 */

function cargarTablaClientes (): array {
    $tclientes = [];
    
     // COMPLETAR
    for ($i = 0; $i < $fichero; $i++){
        $fichero = fopen("dat/clientes.csv", "w");
    foreach ($fichero as $valores){
        fputcsv($fichero, $tclientes); 
    }
    fclose($fichero);
        }
    }

/**
 * Escribe la tabla de objectos clientes en el fichero csv
 * @param  $tabla - array de objectos
 */

function salvarTablaClientes(array $tabla){
    
    $fich = fopen('dat/clientes.csv','w');
    // COMPLETAR
    for ($i = 0; $i < $fich; $i++){
        $fich = fopen("dat/clientes.csv", "w");
    foreach ($fichero as $valores){
        fputcsv($tclientes, $fich); 
    }
    fclose($fich);
        }
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
    $fichero = fopen("clientes.csv", "r");
    if ($fichero) { 
        while ($valores = fgetcsv($fichero)) { 
            if ($valores[0] == $dni && password_verify($clave, $valores[2])) {
                return true;
            }
        }
        fclose($fichero); 
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
    $tablaCli = cargarTablaClientes();
    // COMPLETAR
    if($valores[0] = $dni){
        $_SESSION['puntos'] = $puntos;
        return true;  
    }
    return false;
}