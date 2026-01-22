<?php
// Inicializamos la variable mensaje vacía para evitar errores
$msg = ""; 

// Verificamos PRIMERO si se ha enviado el formulario.
// La forma más robusta es verificar el método de la petición.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ahora que sabemos que es POST, es seguro leer las variables
    // Usamos htmlspecialchars para seguridad básica (evitar que te inyecten código HTML/JS)
    $nombre = htmlspecialchars($_POST['nombre']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    
    $msg = "Gracias " . $nombre . ", hemos recibido tu mensaje: " . $mensaje;

} else {
    // Si entran por GET (URL directa), entra aquí
    $msg = "Error, acceso no permitido.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Procesar Datos</title>
</head>

<body>
    <h1><?php echo $msg; ?></h1>

    <a href="Contacto.html">Volver</a>
</body>

</html>