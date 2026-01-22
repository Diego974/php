<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$db   = 'tienda';
$user = 'root';
$pass = ''; 
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // --- AGREGAR (C) ---
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['titulo'])) {
        $sql_insert = "INSERT INTO tareas (titulo) VALUES (:titulo)";
        $stmt = $pdo->prepare($sql_insert);
        $stmt->execute([':titulo' => $_POST['titulo']]);
    }

    // --- BORRAR (D) ---
    if (isset($_GET['borrar'])) {
        $id_borrar = $_GET['borrar'];
        $sql_delete = "DELETE FROM tareas WHERE id = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->execute([':id' => $id_borrar]);
        header("Location: tareas.php");
        exit();
    }

    // --- COMPLETAR (U) --- 
    // ¡CORREGIDO!
    if (isset($_GET['completar'])){
        $id_completar = $_GET['completar'];
        $sql_update = "UPDATE tareas SET completada = 1 WHERE id = :id";
        $stmt = $pdo->prepare($sql_update);
        $stmt->execute([':id' => $id_completar]);
        header("Location: tareas.php");
        exit();
    }

    // --- LEER (R) ---
    $sql_leer = "SELECT * FROM tareas ORDER BY id DESC";
    $stmt = $pdo->query($sql_leer);
    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Tareas</title>
</head>

<body>
    <h1>Hola, <?php echo $_SESSION['user']; ?></h1>
    <a href="logout.php">Cerrar Sesión</a>

    <div style="margin-top: 20px; background: #f0f0f0; padding: 10px;">
        <form method="post">
            <label>Nueva Tarea:</label>
            <input type="text" name="titulo" required>
            <input type="submit" value="Añadir">
        </form>
    </div>

    <h3>Lista Pendiente:</h3>
    <ul>
        <?php foreach ($tareas as $t): ?>
        <?php 
                $estilo = ($t['completada'] == 1) ? 'text-decoration: line-through; color: gray;' : ''; 
            ?>

        <li style="<?php echo $estilo; ?>">
            <?php echo $t['titulo']; ?>

            <?php if($t['completada'] == 0): ?>
            <a href="tareas.php?completar=<?php echo $t['id']; ?>" style="color:green; margin-left:10px;">[Hecho]</a>
            <?php endif; ?>

            <a href="tareas.php?borrar=<?php echo $t['id']; ?>" style="color:red; margin-left:5px;">[Borrar]</a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>