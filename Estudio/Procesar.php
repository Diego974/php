<?php
// Recibimos el nombre y la edad del formulario
$nombre_sucio = $_POST['nombre']; // El usuario escribió: "  <Juan>  "
$edad_sucia   = $_POST['edad'];   // El usuario escribió: "18" 

// 1. LIMPIEZA DE ESPACIOS
// Queremos quitar los espacios en blanco del principio y del final.
// La función se llama "recortar" en inglés.
$nombre_sin_espacios = trim($nombre_sucio); // [Hueco 1] -> Quedaría "<Juan>"

// 2. SEGURIDAD (ANTI-XSS)
// Queremos desactivar las etiquetas HTML (como < y >) para que no sean código.
// Esta es la función larga y famosa que convierte "chars" especiales.
$nombre_seguro =htmlspecialchars($nombre_sin_espacios); // [Hueco 2] -> Quedaría "&lt;Juan&gt;"

// 3. VALIDACIÓN DE TIPO
// Antes de guardar, comprobamos si la edad ES UN NÚMERO válido.
if (is_numeric($edad_sucia)) { // [Hueco 3]
    echo "Datos aceptados: $nombre_seguro tiene $edad_sucia años.";
} else {
    echo "Error: La edad debe ser un número.";
}
?>