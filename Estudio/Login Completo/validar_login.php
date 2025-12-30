<?php
// 1. PRIMERA LÍNEA OBLIGATORIA
// Sin esto, el "sello de la mano" (sesión) no funciona.
session_start();   // [Hueco A]

// ... (aquí iría la comprobación de usuario y contraseña) ...

if ($usuario_valido) {

    // Aquí ponemos el sello (Sesión) -> Esto ya os lo dí hecho antes
    $_SESSION['usuario'] = "admin";

    // 2. EL EXTRA: CHECKBOX "RECORDARME"
    // Si el usuario marcó el checkbox... creamos la cookie.
    if (isset($_POST['recordar'])) {

        // Función para crear la cookie
        // (nombre, valor, tiempo)
        setcookie("login_cookie", "admin", time() + 3600); // [Hueco B]
    }

    header("Location: panel.php");
}
?>