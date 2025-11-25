<?php

/**
 * Checks if the provided username and password are valid.
 */
function accesoValido($username, $password): bool {
    // CORRECCIÓN 1: Usar $fichero consistentemente
    $fichero = fopen("usuarios.dat", "r");
    $resu = false;
    
    if ($fichero) { // Buena práctica: verificar si se abrió bien
        while ($valores = fgetcsv($fichero)) { // Usar $fichero, NO $fich
            if ($valores[0] == $username && password_verify($password, $valores[1])) {
                $resu = true;
                break;
            }
        }
        fclose($fichero); // Usar $fichero
    }
    return $resu;
}

/**
 * Records a new access for the given username.
 */
// CORRECCIÓN 2: Cambiado :int por :bool porque devuelves true/false
function anotarNuevoAcceso($username): bool { 
    
    $fichero = fopen("usuarios.dat", "r");
    $resu = false;
    $usuarios = [];
    
    if ($fichero) {
        while ($valores = fgetcsv($fichero)) { // Usar $fichero
            if ($valores[0] == $username) {
                $valores[2] = $valores[2] + 1;
                $resu = true;
            }
            $usuarios[] = $valores;
        }
        fclose($fichero); // Usar $fichero
    }

    if ($resu){
        volcarDatos($usuarios);
    }
    return $resu;
}

/**
 * Vuelca los datos del array de usuarios en el fichero
 */
function volcarDatos($tabla){
    // Este estaba bien, pero asegúrate de que la variable $fich sea consistente aquí dentro
    $fich = fopen("usuarios.dat", "w");
    foreach ($tabla as $valores){
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