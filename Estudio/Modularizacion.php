    <?php
    /* EJERCICIO 1: MODULARIZACIÓN
    Completa las instrucciones de importación según las reglas del comentario.
    */

    // 1. IMPORTAR LIBRERÍA DE FUNCIONES ("funciones.php")
    // IMPORTANTE: Este archivo es CRÍTICO. Contiene la lógica del negocio.
    // Si no se encuentra, la ejecución debe DETENERSE (Fatal Error).
    require "funciones.php"; 


    // 2. IMPORTAR CABECERA ("cabecera.php")
    // Este archivo es visual. Si falla al cargar, queremos que salga una
    // ADVERTENCIA (Warning) pero que el resto de la página se intente mostrar.
    include_once "cabecera.php"; 

    ?>

    <main>
        <h1>Bienvenidos al Panel de Control</h1>
        <p>Aquí gestionaremos los datos del examen.</p>
    </main>

    <?php

    // 3. IMPORTAR PIE DE PÁGINA ("pie.php")
    // Mismo criterio que la cabecera: si falla, que no rompa toda la web.
    include_once "pie.php"; 

    ?>