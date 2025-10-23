<?php

$cookieName = 'tarjeta_pago';
$mensaje = "";

if (isset($_GET['nuevatarjeta']) && $_GET['nuevatarjeta'] !== '') {
    $nueva = htmlspecialchars(trim($_GET['nuevatarjeta']), ENT_QUOTES, 'UTF-8');

    $expire = time() + 30 * 24 * 60 * 60;

    setcookie($cookieName, $nueva, $expire, "/");

    $mensaje = "Tarjeta $nueva seleccionada";
    $tarjeta_actual = $nueva;
} elseif (isset($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] !== '') {
    $tarjeta_actual = htmlspecialchars($_COOKIE[$cookieName], ENT_QUOTES, 'UTF-8');
} else {
    $tarjeta_actual = null;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Forma de pago (cookie)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
        }
        h2 {
            color: #333;
        }
        img.tarjeta {
            width: 100px;
            height: auto;
            margin: 6px;
            transition: transform 0.2s;
            cursor: pointer;
        }
        img.tarjeta:hover {
            transform: scale(1.1);
        }
        .seleccion-actual {
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 5px #999;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php if (!empty($mensaje)): ?>
        <script>alert("<?php echo $mensaje; ?>");</script>
    <?php endif; ?>

    <center>
        <h2>SELECCIONE UNA NUEVA TARJETA DE CRÉDITO</h2>

        <?php if ($tarjeta_actual): ?>
            <div class="seleccion-actual">
                <p><strong>Su forma de pago actual es:</strong></p>
                <img src="imagenes/<?php echo $tarjeta_actual; ?>.png" alt="<?php echo $tarjeta_actual; ?>" class="tarjeta">
            </div>
        <?php endif; ?>

        <p>
            <a href="pagocookie.php?nuevatarjeta=cashu"><img src="imagenes/cashu.png" alt="cashu" class="tarjeta" /></a>
            <a href="pagocookie.php?nuevatarjeta=cirrus1"><img src="imagenes/cirrus1.png" alt="cirrus1" class="tarjeta" /></a>
            <a href="pagocookie.php?nuevatarjeta=dinnersclub"><img src="imagenes/dinnersclub.png" alt="dinnersclub" class="tarjeta" /></a>
            <a href="pagocookie.php?nuevatarjeta=mastercard1"><img src="imagenes/mastercard1.png" alt="mastercard1" class="tarjeta" /></a>
            <a href="pagocookie.php?nuevatarjeta=paypal"><img src="imagenes/paypal.png" alt="paypal" class="tarjeta" /></a>
            <a href="pagocookie.php?nuevatarjeta=visa1"><img src="imagenes/visa1.png" alt="visa1" class="tarjeta" /></a>
            <a href="pagocookie.php?nuevatarjeta=visa_electron"><img src="imagenes/visa_electron.png" alt="visa_electron" class="tarjeta" /></a>
        </p>
    </center>
</body> 
</html>