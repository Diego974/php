    <?php 
    // Crear página que simule un calculadora sencilla, mediante un único archivo 02.php 
    // que mostrará un formularios con dos campos numéricos y 4 botones con los 4 tipos 
    // de operaciones + - * /  posibles. Se incluirá también 3 controles de tipo radio que 
    // indicarán como queremos que se muestre el resultado en decimal, binario o hexadecimal.
    //
    // El programa php debe comprobar que se han recibido los dos valores numéricos y 
    // detectará el error de intento de división por cero. Mostrará el resultado calculado 
    // según el formato elegido. Por omisión se mostrará en decimal.

    // FUNCIONES AUXILIARES

    function operar($val1,$val2,$operacion):float {
    
        switch($operacion){
            case '+': return $val1 + $val2;
            case '-': return $val1 - $val2;
            case '*': return $val1 * $val2;
            case '/': 
                if($val2 != 0) return $val1 / $val2;
                else return "No es un número"; 
            default: return 0;
}
    }

    function imprimirConFormato($formato,$valor)
    {
        if (is_nan($valor)) return "Error: Division por cero";
        switch($formato) {
            case 'bin': return decbin((int)$valor);
            case 'hex': return dechex((int)$valor);
            default:return $valor;
        }
    }

    // Si fuera por POST podia chequear $_SERVER['REQUEST_METHOD'] == 'POST'

    if (isset($_GET["operacion"])) {
        $num1 = $_REQUEST['num1'];
        $num2 = $_REQUEST['num2'];
        $operacion = $_REQUEST['operacion'];
        $formato = $_REQUEST['formato'];
        if (is_numeric($num1) && is_numeric($num2)) {
        $resultado = operar((float)$num1, (float)$num2, $operacion);
        $msg = imprimirConFormato($formato, $resultado);
    } else {
        $msg = "Introduce dos números válidos";
    }
        
    }
    require_once ("02vista.php");
    ?>