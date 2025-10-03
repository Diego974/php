<?php
define ('PIEDRA1',  "&#x1F91C;");
define ('PIEDRA2',  "&#x1F91B;");
define ('TIJERAS',  "&#x1F596;");
define ('PAPEL',    "&#x1F91A;");

$opciones = [
    'piedra' => PIEDRA1,
    'papel' => PAPEL,
    'tijeras' => TIJERAS
];


$jugador1 = array_rand($opciones);
$jugador2 = array_rand($opciones);


if ($jugador1 === $jugador2) {
    $resultado = "¡Empate !";
} elseif (
    ($jugador1 === 'piedra' && $jugador2 === 'tijeras') ||
    ($jugador1 === 'papel' && $jugador2 === 'piedra') ||
    ($jugador1 === 'tijeras' && $jugador2 === 'papel')
) {
    $resultado = "Ha ganado el jugador 1";
} else {
    $resultado = "Ha ganado el jugador 2";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Piedra, papel, tijera!</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fafafa; }
        .container { background: #fff; margin: 20px auto; padding: 20px; max-width: 400px;}
        h1 { font-size: 2em; margin-bottom: 0.2em; }
        .jugadores { font-weight: bold; margin-bottom: 0.5em; }
        .emojis { font-size: 5em; display: flex; justify-content: center; gap: 40px; margin-bottom: 0.5em; }
        .resultado { font-size: 1.5em;}
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Piedra, papel, tijera!</h1>
        <div class="sub">Actualice la página para mostrar otra partida.</div>
        <div class="jugadores">
            <span>Jugador 1</span>
            &nbsp;&nbsp;&nbsp;
            <span>Jugador 2</span>
        </div>
        <div class="emojis">
            <span><?php echo $opciones[$jugador1]; ?></span>
            <span><?php echo $opciones[$jugador2]; ?></span>
        </div>
        <div class="resultado"><?php echo $resultado; ?></div>
    </div>
</body>
</html>