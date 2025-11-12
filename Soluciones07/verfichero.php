<?php
$contenido = "";
if (isset($_GET['fichero'])) {
    $nombrefichero = $_GET['fichero'];
    if (is_readable($nombrefichero)) {
        $tlinea = file($nombrefichero);
        $cont = 1;
        $contenido = "<pre><code>";
        foreach ($tlinea as $linea) {
            // Escapar HTML para evitar que se ejecute el código PHP del archivo
            $contenido .= $cont . ": " . htmlspecialchars($linea);
            $cont++;
        }
        $contenido .= "</code></pre>";
        $contenido .= "<p>Nº de líneas: " . ($cont - 1) . "</p>";
        $contenido .= "<p>Nº de caracteres: " . filesize($nombrefichero) . "</p>";
    } else {
        $contenido = "El fichero no es legible o no existe";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Fichero</title>
</head>

<body>
    <h1>Ver Fichero</h1>

    <?php if ($contenido): ?>
    <?= $contenido ?>
    <?php else: ?>
    <form>
        Fichero a mostrar: <input type="text" name="fichero">
    </form>
    <?php endif; ?>
</body>

</html>