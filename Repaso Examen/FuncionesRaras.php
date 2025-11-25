<?php
$contacto = [
    "nombre" => "juan alberto",
    "email" => "juan@test.com",
    "tfno" => "600123456"
];

// --- FUNCIÓN 1: Estética (Tema 4) ---
// Objetivo: Que "juan alberto" se convierta en "Juan Alberto".
// Pista: Hay una función nativa para esto, NO uses un bucle.
function ponerBonito($texto) {
    // TEMA 4: Función que pone en Mayúscula la Inicial de Cada Palabra
    return ucw($texto);
}

// --- FUNCIÓN 2: Array a String (Tema 4) ---
// Objetivo: Convertir el array en: "juan alberto;juan@test.com;600123456"
// Pista: Es la contraria a 'explode'.
function prepararLinea($arrayDatos) {
    // TEMA 4: Unir elementos de un array con un "pegamento" (";")
    return implode(";", $arrayDatos);
}

// --- FUNCIÓN 3: Guardado Seguro (Tema 6) ---
// Objetivo: Guardar en 'agenda.txt' añadiendo al final.
function guardarEnAgenda($lineaTexto) {
    // Añadimos el salto de línea al final para que no se peguen los contactos
    $textoFinal = $lineaTexto . "\n";
    
    // TEMA 6: Escribir en fichero.
    // El tercer parámetro es VITAL para no borrar a los contactos anteriores.
    file_put_contents("agenda.txt", $textoFinal, FILE_APPEND);
}

// --- EJECUCIÓN ---
$contacto['nombre'] = ponerBonito($contacto['nombre']); // "Juan Alberto"
$lineaCSV = prepararLinea($contacto);                   // "Juan Alberto;juan@..."
guardarEnAgenda($lineaCSV);                             // Lo guarda
?>