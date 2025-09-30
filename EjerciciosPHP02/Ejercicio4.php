<?php

// Generar números aleatorios y meterlos en un array
$numeros = array();
for ($i = 0; $i < 50; $i++) {
    $numeros[] = rand(1, 100);
}

// Calcular máximo, mínimo y media
$maximo = max($numeros);
$minimo = min($numeros);
$media = array_sum($numeros) / 50;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4 - Números Aleatorios</title>
    <style>
        table { border-collapse: collapse; margin: 20px 0; width: 350px; }
        th, td { border: 1px solid #333; padding: 8px; }
        th {
            background: #000;
            color: #fff;
            text-align: center;
            font-size: 1.1em;
        }
        td {
            text-align: right;
            font-size: 1em;
        }
        .titulo {
            background: #000;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th colspan="2" class="titulo">Generación de 50 valores aleatorios</th>
        </tr>
        <tr>
            <td> Mínimo </td>
            <td><?php echo $minimo; ?></td>
        </tr>
        <tr>
            <td> Máximo </td>
            <td><?php echo $maximo; ?></td>
        </tr>
        <tr>
            <td> Media </td>
            <td><?php echo round($media, 2); ?></td>
        </tr>
    </table>
</body>
</html>