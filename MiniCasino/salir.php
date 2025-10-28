<?php
session_start();
$dinero = isset($_SESSION['dinero']) ? $_SESSION['dinero'] : 0;
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Gracias por jugar!!!</h1>
    <p>Su resultado final es de <?php echo $dinero ?>€</p>
</body>
</html>