<?php
    require_once 'procesarImagen.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="procesarImagen.php" method="post" enctype="multipart/form-data">
        <label for="">Selecciona una foto </label>
        <input type="file" id="imagen" name="imagen">
    </form>
</body>

</html>