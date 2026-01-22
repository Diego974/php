<?php

class auth{
    function login($usuario, $contraseña){
        if (!is_readable("Usuarios.txt")){
            echo "No existe el fichero";
            return false;
        } else{
            $tlinea = file("Usuarios.txt");
           
            foreach($tlinea as $linea){
                $datos = explode(";", $linea);
                if(count($datos) >= 2){
                    $usuario_fich = trim($datos[0]);
                    $contraseña_fich = trim($datos[1]);
            
            
                if ($usuario == $usuario_fich && $contraseña == $contraseña_fich){
                    return true;
                    }
                }
            }
            return false;
        }
    }
}
?>