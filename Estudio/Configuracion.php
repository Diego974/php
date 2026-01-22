<?php
$color_fondo = "white"; // Color por defecto

// 1. Comprobar si se ha enviado el formulario (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $color_elegido = $_POST['color'];
    
    // 2. Crear la Cookie
    // setcookie(nombre, valor, expiración)
    // Queremos que expire en 1 hora (time() + 3600 segundos)
    setcookie("bg_color", $color_elegido, time() + 3600);
    
    // Actualizamos la variable para verlo al momento
    $color_fondo = $color_elegido;
} 

// 3. Si NO hay POST, miramos si ya existe la cookie guardada de antes
elseif (isset($_COOKIE['bg_color'])) {
    $color_fondo = $_COOKIE['bg_color']; // Recuperar el valor de la cookie
}
?>

<!DOCTYPE html>
<html>

<body style="background-color: <?php echo $color_fondo; ?>;">

    <h1>Elige tu color de fondo</h1>

    <form method="post">
        <select name="color">
            <option value="white">Blanco</option>
            <option value="lightblue">Azul</option>
            <option value="lightgreen">Verde</option>
            <option value="lightgray">Gris</option>
        </select>
        <input type="submit" value="Guardar Preferencia">
    </form>

    <p>Si cierras el navegador y vuelves, recordaré este color por 1 hora.</p>
</body>

</html>