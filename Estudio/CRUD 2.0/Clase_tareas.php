<?php
class GestorTareas {
    private $pdo;

    public function __construct($host, $db, $user, $pass) {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        try {
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Recibe el título limpio y lo inserta
    public function agregarTarea($titulo) {
        $sql = "INSERT INTO tareas (titulo) VALUES (:titulo)";
        $stmt = $this->pdo->prepare($sql);
        // Usamos la variable $titulo que entra por paréntesis, no $_POST
        $stmt->execute([':titulo' => $titulo]);
    }

    // Recibe el ID y actualiza
    public function completarTarea($id) {
        $sql = "UPDATE tareas SET completada = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        // Usamos la variable $id que entra por paréntesis, no $_GET
        $stmt->execute([':id' => $id]);
    }

    // Recibe el ID y borra
    public function borrarTarea($id) {
        $sql = "DELETE FROM tareas WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Hace el SELECT y devuelve el Array de datos (NO HTML)
    public function obtenerTareas() {
        $sql = "SELECT * FROM tareas ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        // Retornamos los datos para que el index_poo.php decida cómo pintarlos
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>