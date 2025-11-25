<?php

// --- CLASE PADRE ---
class Producto {
    protected $titulo; // Propiedad protected

    public function __construct($titulo) {
        $this->titulo = $titulo;
    }

    public function getDetalles() {
        return "Producto: " . $this->titulo;
    }
} // <--- AQUÍ SE CIERRA LA CLASE PADRE. FIN.


// --- CLASE HIJA ---
// TEMA 7: Define que Libro extiende de Producto
class Libro extends Producto {
    
    private $paginas;

    // El constructor recibe TODO lo necesario (titulo y paginas)
    public function __construct($titulo, $paginas) {
        
        // 1. Llamamos al constructor del padre para que se ocupe del título
        parent::__construct($titulo);
        
        // 2. Nos ocupamos nosotros de las páginas
        $this->paginas = $paginas;
    }

    // Sobrescribimos el método
    public function getDetalles() {
        // Devuelve el string combinado
        return "Libro: " . $this->titulo . " con " . $this->paginas . " páginas";
    }
} 


// --- PRUEBA ---
$miLibro = new Libro("Harry Potter", 300);
echo $miLibro->getDetalles();
?>