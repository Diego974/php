<?php
session_start();

$sessionKey = 'tarjeta_pago';

if (isset($_GET['nuevatarjeta'])) {
    $nueva = htmlspecialchars(trim($_GET['nuevatarjeta']), ENT_QUOTES, 'UTF-8');

    $_SESSION[$sessionKey] = $nueva;

    header("Location: pagosesion.php");
    exit;
}

$tarjeta_actual = null;
if (!empty($_SESSION[$sessionKey])) {
    $tarjeta_actual = htmlspecialchars($_SESSION[$sessionKey], ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Forma de pago (sesión)</title>
</head>
<body>
    <center>
        <?php if ($tarjeta_actual === null): ?>
            <h2>SU FORMA DE PAGO ACTUAL ES</h2>
            <p>(No hay ninguna tarjeta guardada en la sesión todavía)</p>
        <?php else: ?>
            <h2>SU FORMA DE PAGO ACTUAL ES</h2>
            <img src="imagenes/<?php echo $tarjeta_actual ?>.png" alt="<?php echo $tarjeta_actual ?>"/>
            <p>Tarjeta seleccionada: <strong><?php echo $tarjeta_actual ?></strong></p>
            <p><a href="pagosesion.php?nuevatarjeta=">Cambiar tarjeta</a></p>
        <?php endif; ?>

        <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO</h2>
        <p>
            <a href="pagosesion.php?nuevatarjeta=cashu"><img src="imagenes/cashu.png" alt="cashu" /></a>&ensp;
            <a href="pagosesion.php?nuevatarjeta=cirrus1"><img src="imagenes/cirrus1.png" alt="cirrus1" /></a>&ensp;
            <a href="pagosesion.php?nuevatarjeta=dinnersclub"><img src="imagenes/dinnersclub.png" alt="dinnersclub" /></a>&ensp;
            <a href="pagosesion.php?nuevatarjeta=mastercard1"><img src="imagenes/mastercard1.png" alt="mastercard1" /></a>&ensp;
            <a href="pagosesion.php?nuevatarjeta=paypal"><img src="imagenes/paypal.png" alt="paypal" /></a>&ensp;
            <a href="pagosesion.php?nuevatarjeta=visa1"><img src="imagenes/visa1.png" alt="visa1" /></a>&ensp;
            <a href="pagosesion.php?nuevatarjeta=visa_electron"><img src="imagenes/visa_electron.png" alt="visa_electron" /></a>
        </p>
    </center>
</body>
</html>
