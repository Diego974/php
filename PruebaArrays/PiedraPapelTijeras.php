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

$resultado = '';
$jugador = '';
$maquina = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jugador = $_POST['jugada'];
    $jugadaMaquina = array_rand($opciones);
    $maquina = $jugadaMaquina;

    // Lógica del juego
    if ($jugador === $maquina) {
        $resultado = "Empate";
    } elseif (
        ($jugador === 'piedra' && $maquina === 'tijeras') ||
        ($jugador === 'papel' && $maquina === 'piedra') ||
        ($jugador === 'tijeras' && $maquina === 'papel')
    ) {
        $resultado = "¡Ganaste!";
    } else {
        $resultado = "Perdiste";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Piedra, Papel o Tijeras</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 40px; }
        .emoji { font-size: 3em; }
        .resultado { font-size: 1.5em; margin-top: 20px; }
        button { font-size: 1.2em; margin: 10px; padding: 10px 20px; }
    </style>
</head>
<body>
    <h1>Piedra, Papel o Tijeras</h1>
    <form method="post">
        <button type="submit" name="jugada" value="piedra"><?php echo PIEDRA1; ?> Piedra</button>
        <button type="submit" name="jugada" value="papel"><?php echo PAPEL; ?> Papel</button>
        <button type="submit" name="jugada" value="tijeras"><?php echo TIJERAS; ?> Tijeras</button>
    </form>
</body>
</html>