<?php
include "conexion.php";
$mensaje = "";
$error = "";
if(isset($_POST['enviar'])){
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    // INSERT
    if (!empty($nombre) && !empty($cantidad) && !empty($precio)) { // Comprobamos que los campos no esten vacios
    $sql = "INSERT INTO piezas (nombre, precio, cantidad) VALUES (?,?,?)";
    $stmt = $conexion->prepare($sql);
    
    if($stmt -> execute([$nombre, $precio, $cantidad])){
        $mensaje = "Se ha guardado correctamente en la base de datos";
    }else{
        $error = "Error al guardar en la base de datos";
    }
    
    }else{
    $error = "Por favor, rellena todos los campos";
    }
}
if (isset($_POST['borrar'])){
    $id = $_POST['id_a_borrar']; // Esto funciona porque en el HTML hay un campo oculto que selecciona el id que quiere borrar
    $sql = "DELETE FROM piezas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    if ($stmt -> execute([$id])){
        $mensaje = "Se ha eliminado correctamente";
    } else{
        $error = "Error al eliminar";
    }
} 
// UPDATE
if(isset($_POST['accion'])){
    $id_accion = $_POST['id_accion'];
    $tipo_accion = $_POST['accion'];
    if($tipo_accion == "subir"){
        $sql = "UPDATE piezas SET precio = precio * 1.10 WHERE id = ?";
    } elseif($tipo_accion == "bajar"){
        $sql = "UPDATE piezas SET precio = precio * 0.90 WHERE id = ?";
    }

    $stmt = $conexion->prepare($sql);
    if ($stmt -> execute([$id_accion])){
        $mensaje ="Se ha actualizado correctamente";
    } else{
        $error = "No se ha actualizado correctamente";
    }
}

// SELECT
$sql = "SELECT * FROM piezas";
$stmt = $conexion->prepare($sql);
$stmt -> execute();

$piezas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Meto el resultado de la sentencia en un array $piezas
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;
    }

    .alert {
        padding: 10px;
        margin-bottom: 10px;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
    }
    </style>
</head>

<body>
    <h1>Gestión de Inventario</h1>

    <?php if($mensaje): ?>
    <div class="alert success"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <?php if($error): ?>
    <div class="alert error"><?php echo $error; ?></div>
    <?php endif; ?>

    <fieldset>
        <legend>Añadir Pieza Nueva</legend>
        <form action="" method="POST">
            Nombre: <input type="text" name="nombre">
            Cantidad: <input type="number" name="cantidad">
            Precio: <input type="number" step="0.01" name="precio">
            <input type="submit" value="Enviar" name="enviar">
        </form>
    </fieldset>

    <hr>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($piezas as $pieza): ?>
            <tr>
                <td><?php echo $pieza['id']; ?></td>
                <td><?php echo $pieza['nombre']; ?></td>
                <td><?php echo $pieza['precio']; ?> €</td>
                <td><?php echo $pieza['cantidad']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id_accion" value="<?php echo $pieza['id']; ?>">
                        <button type="submit" name="accion" value="subir" class="btn-subir">
                            +10%
                        </button>
                        <button type="submit" name="accion" value="bajar" class="btn-bajar">
                            -10%
                        </button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="id_a_borrar" value="<?php echo $pieza['id']; ?>">
                        <input type="submit" value="Eliminar" name="borrar">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>