<?php
$archivo = 'notas.txt';

function agregarNota($ruta, $texto) {
    // 1. Abrir el archivo. 
    // Queremos añadir al final, así que usamos el modo 'append'.
    // ¿Qué letra va aquí? ('w', 'r', o 'a')
    $handle = fopen($ruta, 'a'); 
    
    if ($handle) {
        // Escribimos el texto y un salto de línea (PHP_EOL)
        fwrite($handle, $texto . PHP_EOL);
        
        // 2. Cerrar el archivo para guardar cambios
        fclose($handle);
    }
}

// Si envían el formulario, guardamos la nota
if (isset($_POST['mi_nota'])) {
    agregarNota($archivo, $_POST['mi_nota']);
}
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Bloc de Notas</h2>
    <form method="post">
        <input type="text" name="mi_nota" placeholder="Escribe algo..." required>
        <button type="submit">Guardar</button>
    </form>

    <hr>

    <h3>Notas guardadas:</h3>
    <?php
    if (file_exists($archivo)) {
        // 3. Leer todo el contenido del archivo de golpe
        $contenido = file_get_contents($archivo);
        
        // nl2br convierte los saltos de línea de texto en <br> de HTML
        echo nl2br($contenido);
    }
    ?>
</body>

</html>