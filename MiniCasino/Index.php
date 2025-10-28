<?php
    session_start();
if (!isset($_COOKIE['nvisitas'])) {
    $nvisitas = 1;
} else {
    $nvisitas = $_COOKIE['nvisitas'] + 1;
}
setcookie('nvisitas', $nvisitas, time() + (30 * 24 * 3600));

if (isset($_SESSION['dinero']) && $_SESSION['dinero'] > 0) {
    header("Location: casino.php");
    exit;
}

if (isset($_POST['dinero'])) {
    $_SESSION['dinero'] = intval($_POST['dinero']);
    header("Location: casino.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casino</title>
</head>
<body>
    <h1>BIENVENIDO AL CASINO</h1>
    <h3>Esta es su <?php echo $nvisitas; ?>º visita.</h3>
    <form method="post" action="index.php">
        Introduzca el dinero con el que va a jugar: 
        <input type="number" name="dinero" id="dinero" required min="1">
        <input type="submit" value="Jugar">
    </form>
</body>
</html>
