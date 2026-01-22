<?php
include_once "Producto.php";


/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 * VERSION 1:  las sentencias precompiladas ser crean en cada función
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
    
    public static function getModelo(){
        // Si no existe lo crea el acceso de a la BD
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton, se accede por getModelo
   
    private function __construct(){
        try {
            // Cambia DATABASE por "almacendb" y SERVER_DB por "localhost"
            $dsn = "mysql:host=localhost;dbname=almacendb;charset=utf8";
            
            // Nota: También tendrás que poner usuario y contraseña a mano abajo
            $this->dbh = new PDO($dsn, "root", ""); 
            
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }   
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;     // Cierro la conexión
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un array de objeto de Productos
    public function getProductos(): array {
        $tpro = [];
        
        // 1. Preparamos la consulta (He corregido el nombre de la variable para que tenga sentido)
        $stmt = $this->dbh->prepare("SELECT * FROM Productos WHERE stock_disponible > 10");
        
        // 2. Configuramos para que devuelva objetos de la clase Producto
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        
        // 3. Ejecutamos
        if ($stmt->execute()) {
            // CORRECCIÓN: Usamos fetchAll() directamente. 
            // Esto obtiene todas las filas y las mete en el array automáticamente.
            // No hace falta un bucle while.
            $tpro = $stmt->fetchAll();
        }
        
        // 4. Retornamos la variable correcta ($tpro)
        return $tpro;
    }
    
    // Devuelvo un usuario o false
    public function getUsuario (String $login) {
        $user = false;
        $stmt_usuario   = $this->dbh->prepare("select * from Usuarios where login=:login");
        $stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $stmt_usuario->bindParam(':login', $login);
        if ( $stmt_usuario->execute() ){
             // Solo hay un objeto
             if ( $obj = $stmt_usuario->fetch()){
                $user= $obj;
            }
        }
        return $user;
    }
    
    // UPDATE
    public function bajarprecios($tproductos): int {
        
        $stmt_modpro = $this->dbh->prepare("UPDATE Productos SET precio_actual = precio_actual * 0.9 WHERE producto_no = :producto_no");
        
        $numpro = 0;
        
        foreach($tproductos as $producto_no){
            // Asignamos el valor al marcador definido arriba
            $stmt_modpro->bindValue(':producto_no', $producto_no);
            
            // Ejecutamos
            if ($stmt_modpro->execute()) {
                // Solo contamos si la ejecución fue exitosa
                $numpro++; 
            }
        }
        
        return $numpro;
    }

    //INSERT
    public function addUsuario($user):bool{
        $stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        //$stmt_creauser->bindValue(1,$user->login);
        $stmt_creauser->execute( [$user->login, $user->nombre, $user->password, $user->comentario]);
        $resu = ($stmt_creauser->rowCount () == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $login):bool {
        $stmt_boruser = $this->dbh->prepare("delete from Usuarios where login =:login");
        $stmt_boruser->bindValue(':login', $login);
        $stmt_boruser->execute();
        $resu = ($stmt_boruser->rowCount () == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}