<?php

        $numero_aleatorio = rand(1,9);

        echo "Número generado $numero_aleatorio"."</br>";

        for ($i = 1; $i <= $numero_aleatorio; $i++) {

        $color = ($i %2 == 0) ? "blue" : "red";

        for ($j = 1; $j <= $i; $j++) {

            echo "<span style= 'color: $color'>$i</span>";
        }

        echo "</br>";

        }
        ?>