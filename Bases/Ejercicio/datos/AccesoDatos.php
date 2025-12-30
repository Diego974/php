<?php
include_once "Cliente.php";
include_once "Pedido.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 * VERSION 2: El contructor crea las sentencias precompiladas
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt_usuarios = null;
    private $stmt_usuario  = null;
    private $stmt_boruser  = null;
    private $stmt_moduser  = null;
    private $stmt_creauser = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".etienda.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo las consultas de golpe y no las emulo.
        $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        try {
        $this->stmt_usuarios  = $this->dbh->prepare("select * from Usuarios");
        $this->stmt_usuario   = $this->dbh->prepare("select * from Usuarios where login=:login");
        $this->stmt_boruser   = $this->dbh->prepare("delete from Usuarios where login =:login");
        $this->stmt_moduser   = $this->dbh->prepare("update Usuarios set nombre=:nombre, password=:password, comentario=:comentario where login=:login");
        $this->stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        } catch ( PDOException $e){
            echo " Error al crear la sentencias ".$e->getMessage();
            exit();
        }
    
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->stmt_usuarios = null;
            $obj->stmt_usuario  = null;
            $obj->stmt_boruser  = null;
            $obj->stmt_moduser  = null;
            $obj->stmt_creauser = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un array de objetos de Pedidos
    public function getPedidos ($codigo):array {
        $tpro = [];
        $stmt_productos = $this->dbh->prepare("select * from pedidos where cod_cliente = :cod_cliente");
        $stmt_productos = setFetchMode(PDO::FETCH_CLASS, 'Pedido');
        $stmt_productos->bindParam(':cod_cliente', $codigo);
        if ( $stmt_productos->execute() ){
            $tpro = $stmt_productos->fetchAll();
            }
            return $tpro;
        }
    
    // Devuelvo un usuario o false
    public function getCliente (String $nombre, String $clave) {
        $cli = false;
        
        $stmt_cliente = $this->dbh->prepare("select * from clientes where nombre =? and :clave =?");
        $stmt_cliente = setFetchMode(PDO::FETCH_CLASS, 'Pedido');
        $stmt_cliente ->bindParam(1, $cod_cliente);
        $stmt_cliente ->bindParam(2, $clave);
        if ( $stmt_cliente->execute() ){
            $tpro = $stmt_productos->fetchAll();
            }
            return $tpro;
        }
    
    // UPDATE
    public function incrementarVeces($cod_cliente):bool{
      $stmt_modcli = $this->dbh->prepare ("update clientes set veces = veces +1 where cod_cliente= :cod:cliente");
      $stmt_modcli -> bindValue(':cod_cliente', $cod_cliente);
        
        $this->stmt_modcli->execute();
        $resu = ($this->stmt_moduser->rowCount () == 1);
        return $resu;
    }
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}