<?php
$host = 'localhost';
$db   = 'tienda';
$user = 'root';
$pass = ''; // En XAMPP suele ser vacío, en MAMP es 'root'

// 1. Configurar la cadena de conexión (DSN)
// Debe tener el formato: "mysql:host=...;dbname=..."
$dsn = "mysql:host=$host;dbname=$db";

try {
    // 2. Crear la instancia de PDO
    $pdo = new PDO($dsn, $user, $pass);
    
    // Configurar para que nos avise si hay errores SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Escribir la consulta SQL
    // Queremos nombre y precio de la tabla 'productos' donde el precio sea mayor que 100
    $sql = "SELECT nombre, precio FROM productos WHERE precio > 100";

    // 4. Preparar la sentencia
    $stmt = $pdo->prepare($sql);

    // 5. Ejecutar la sentencia
    $stmt->execute();

    // 6. Obtener los resultados
    // Usamos fetchAll para guardar todo en un array asociativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<body>
    <h1>Productos de Lujo (> 100€)</h1>
    <ul>
        <?php
        // 7. Recorrer los resultados con un foreach
        if (isset($resultados)) {
            foreach ($resultados as $producto) {
                // $producto es ahora un array como: ['nombre' => 'TV', 'precio' => 500]
                echo "<li>" . $producto['nombre'] . " - " . $producto['precio'] . "€</li>";
            }
        }
        ?>
    </ul>
</body>

</html>