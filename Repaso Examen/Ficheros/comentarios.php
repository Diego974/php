<?php
// Definimos el nombre del archivo
$archivo = "historial.txt";

// 1. ESCRIBIR (Si se envía el formulario)
if (isset($_POST['enviar'])) {
    // Recogemos el texto y le añadimos un salto de línea (PHP_EOL)
    $nuevoComentario = $_POST['comentario'] . "\n";
    
    // file_put_contents(archivo, contenido, MODO)
    // FILE_APPEND es VITAL: añade al final sin borrar lo anterior
    file_put_contents($archivo, $nuevoComentario, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Libro de Visitas</title>
</head>

<body>
    <h1>Deja tu comentario</h1>

    <form action="" method="POST">
        <label>Comentarios:</label><br>
        <textarea name="comentario" rows="4" cols="50" required></textarea><br>
        <input type="submit" name="enviar" value="Publicar">
    </form>

    <hr>

    <h2>Historial de comentarios:</h2>
    <?php
    // 2. LEER (Mostrar lo que hay en el fichero)
    
    // Primero comprobamos si el archivo existe para evitar errores
    if (file_exists($archivo)) {
        // Leemos todo el contenido de golpe
        $contenido = file_get_contents($archivo);
        
        // nl2br convierte los saltos de línea (\n) en etiquetas HTML <br>
        echo nl2br($contenido);
    } else {
        echo "<i>Todavía no hay comentarios. Sé el primero.</i>";
    }
    ?>
</body>

</html>