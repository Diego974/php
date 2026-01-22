<?php
// ACTIVAR REPORTES DE ERROR (Para ver si algo falla)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1. INCLUIR CONEXIÓN (Asegúrate de que conexion.php está en la misma carpeta)
require_once "conexion.php"; 

$mensaje_status = "";

// 2. PROCESAR EL FORMULARIO (GUARDAR)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $categoria = $_POST['categoria'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    if (!empty($nombre) && !empty($mensaje) && !empty($categoria)) {
        try {
            $sql_insert = "INSERT INTO sugerencias (nombre, categoria, mensaje) VALUES (:nombre, :categoria, :mensaje)";
            // Usamos la variable $conexion que viene de tu archivo conexion.php
            $stmt = $conexion->prepare($sql_insert);
            $resultado = $stmt->execute([
                ':nombre' => $nombre,
                ':categoria' => $categoria,
                ':mensaje' => $mensaje
            ]);

            if ($resultado) {
                header("Location: " . $_SERVER['PHP_SELF']); 
                exit;
            }
        } catch (PDOException $e) {
            $mensaje_status = "Error al guardar: " . $e->getMessage();
        }
    } else {
        $mensaje_status = "Por favor, rellena todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugerencias - AllGim</title>
    <link rel="icon" href="../images/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&family=Poppins:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/estiloSugerencias.css">
</head>

<body>

    <header>
        <button id="backButton" onclick="history.back()">&#8592; Atrás</button>
        <h1>Sugerencias para AllGim</h1>
        <p>Comparte tus ideas para mejorar nuestra página y ejercicios</p>
    </header>

    <div class="container">
        <div class="form-card">
            <h2 class="title-sugerencia">Envía tu sugerencia</h2>

            <?php if(!empty($mensaje_status)): ?>
            <p class="status-msg"><?php echo $mensaje_status; ?></p>
            <?php endif; ?>

            <form id="suggestionForm" method="POST" action="">

                <input type="text" id="name" name="nombre" placeholder="Nombre" required>

                <select id="category" name="categoria" required>
                    <option value="">Selecciona tipo de sugerencia</option>
                    <option value="Idea para la Web">Idea para la web</option>
                    <option value="Ejercicio">Ejercicio</option>
                    <option value="Otra sugerencia">Otro</option>
                </select>

                <textarea id="message" name="mensaje" rows="5" placeholder="Escribe tu sugerencia..." required
                    style="width: 100%; margin-top: 10px;"></textarea>

                <button type="submit" class="submit-button" style="margin-top: 15px;">Enviar Sugerencia</button>
            </form>
        </div>

        <h2 class="suggestions-title">Sugerencias recientes</h2>

        <div class="suggestions" id="suggestionsContainer">
            <?php
            // 3. MOSTRAR SUGERENCIAS
            try {
                $sql_select = "SELECT * FROM sugerencias ORDER BY fecha_registro DESC";
                $stmt = $conexion->query($sql_select); 
                
                if ($stmt->rowCount() > 0) {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $nombre_safe = htmlspecialchars($row["nombre"]);
                        $mensaje_safe = htmlspecialchars($row["mensaje"]);
                        $cat_safe = htmlspecialchars($row["categoria"]);
                        // Manejo de fecha seguro por si es NULL
                        $fecha = !empty($row["fecha_registro"]) ? date("d/m/Y", strtotime($row["fecha_registro"])) : date("d/m/Y");

                        echo "
                        <div class='suggestion-card'>
                            <div class='suggestion-header'>
                                <span><strong>$nombre_safe</strong></span>
                                <span class='tag'>$cat_safe</span>
                            </div>
                            <div class='suggestion-body'>
                                <p>$mensaje_safe</p>
                            </div>
                            <div style='text-align: right; font-size: 0.8em; opacity: 0.6; margin-top: 10px;'>
                                $fecha
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "<p style='color:white; text-align:center;'>Aún no hay sugerencias. ¡Sé el primero!</p>";
                }
            } catch (PDOException $e) {
                echo "<p style='color:red; text-align:center;'>Error al cargar sugerencias: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>