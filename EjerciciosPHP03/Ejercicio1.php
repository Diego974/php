
<?php
$numeros = array();
for ($i = 0; $i < 20; $i++) {
    $numeros[] = rand(1, 10);
}

function obtenerMinimo($array) {
    return min($array);
}

function obtenerMaximo($array) {
    return max($array);
}

function numeroMasRepetido($array) {
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tabla de los números del array</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Minimo</th>
            <th>Maximo</th>
            <th>Numero que más se repite</th>
            <th>Array completo</th>
        </tr>
        <tr>
            <td><?php echo obtenerMinimo($numeros); ?></td>
            <td><?php echo obtenerMaximo($numeros); ?></td>
            <td><?php echo numeroMasRepetido($numeros); ?></td>
            <td>
                <?php
                foreach ($numeros as $numero) {
                    echo $numero . " ";
                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>

