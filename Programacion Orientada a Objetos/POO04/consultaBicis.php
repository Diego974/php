<?php
require_once("BiciElectrica.php");

function cargabicis() {
    $fp = fopen("Bicis.csv", "r");
    $lista = array();

    while ($fila = fgetcsv($fp)) {
        $bici = new Bicicleta($fila[0], $fila[1], $fila[2], $fila[3], $fila[4] == 1);
        $lista[] = $bici;
    }

    fclose($fp);
    return $lista;
}

function mostrartablabicis($tabla) {

    $html = "<table>";
    $html .= "<tr>
                <th>ID</th>
                <th>X</th>
                <th>Y</th>
                <th>Batería</th>
                <th>Operativa</th>
              </tr>";

    foreach ($tabla as $bici) {

        if ($bici->operativa) {

            $html .= "<tr>";
            $html .= "<td>{$bici->id}</td>";
            $html .= "<td>{$bici->coordx}</td>";
            $html .= "<td>{$bici->coordy}</td>";
            $html .= "<td>{$bici->bateria}%</td>";
            $html .= "<td>" . ($bici->operativa ? "Sí" : "No") . "</td>";
            $html .= "</tr>";
        }
    }

    $html .= "</table>";
    return $html;
}

function bicimascercana($x, $y, $tabla) {

    $minDist = PHP_FLOAT_MAX;
    $biciCercana = null;

    foreach ($tabla as $bici) {

        if ($bici->operativa) {

            $dist = $bici->distancia($x, $y);

            if ($dist < $minDist) {
                $minDist = $dist;
                $biciCercana = $bici;
            }
        }
    }

    return $biciCercana;
}


$tabla = cargabicis();
if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
    $biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MOSTRAR BICIS OPERATIVAS</title>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
    }
    </style>
</head>

<body>
    <h1> Listado de bicicletas operativas </h1>
    <?= mostrartablabicis($tabla); ?>

    <?php if (isset($biciRecomendada)) : ?>
    <h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
    <button onclick="history.back()"> Volver </button>

    <?php else : ?>
    <h2> Indicar su ubicación: </h2>
    <form>
        Coordenada X: <input type="number" name="coordx"><br>
        Coordenada Y: <input type="number" name="coordy"><br>
        <input type="submit" value=" Consultar ">
    </form>
    <?php endif ?>

</body>

</html>