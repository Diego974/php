<?php
    $contadorintentos = 0;
    $contador6 = 0;
    $tiempoantes = microtime(true);
    $numAnterior = 0;
    do {
        $numero = random_int(1, 10);
        $contadorintentos++;
        if ($numero == 6) {
            // Hay un seis
            $contador6++;
        } else {
            // No hay seis
            $contador6 = 0;
        }
    } while ($contador6 < 3);
    // Calculo el tiempo que ha pasado
    $tiempoInvertido = microtime(true) - $tiempoantes;

    echo "Han salido tres 6 seguidos tras generar " . $contadorintentos . " números en " .
        ($tiempoInvertido * 1000) . " milisegundos.";
?>

    