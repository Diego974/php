<?php

/**
 * Checks if the provided username and password are valid.
 */

function cargarTabla():array{
    $tuser = [];
    $fich = fopen("usuarios.dat" , "r");
    $resu = false;
    while ($valores = fgetcsv($fich)){
        $usr = new Usuario($valores[0], valores[1], valores[2]);
        $tuser[] = $usr;
    }
    fclose($fich);
    return $tuser;
}
function accesoValido($username, $password): bool {
   $tablauser = cargarTabla();
   foreach($tablauser as $usr){
    if ($usr -> name == $username && password_verify($password, $user -> clave)){
        return true;      
    }
   }
   return false;
}

/**
 * Records a new access for the given username.
 */
// CORRECCIÓN 2: Cambiado :int por :bool porque devuelves true/false
function anotarNuevoAcceso($username): bool { 
    $tablauser = cargarTabla();
    $salvar = false;
   foreach($tablauser as $usr){
    if ($usr -> name == $username ){
        $usr -> acceso = $usr -> acceso +1;
        $salvar = true;
        }
    }

    if ($salvar){
        volcarDatos($tablauser);
    }
    return $salvar;
}

/**
 * Vuelca los datos del array de usuarios en el fichero
 */
function volcarDatos($tabla){
    // Este estaba bien, pero asegúrate de que la variable $fich sea consistente aquí dentro
    $fich = fopen("usuarios.dat", "w");
    foreach ($tabla as $usuario){
        $valores = [$usr -> nombre, $usr -> clave, $usr -> acceso];
        fputcsv($fich, $valores); 
    }
    fclose($fich);
}

/**
 * Registers a user with a given username and time.
 */
function registra($username, $time) {
    $ip = $_SERVER['REMOTE_ADDR']; 
    $nombre = $username;
    // CORRECCIÓN 3: 'H' mayúscula para formato 24h
    $tiempo = date("d-m-Y H:i", $time); 
    $linea = $ip . ", " . $nombre . ", " . $tiempo . "\n";

    // Usar __DIR__ asegura que se guarde en la carpeta correcta
    $resu = @file_put_contents(__DIR__ . "/registro.log", $linea, FILE_APPEND);

    return $resu;
}