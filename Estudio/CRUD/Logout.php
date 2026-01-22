<?php
// logout.php

// 1. IMPORTANTE: Aunque vayamos a salir, necesitamos recuperar la sesión actual primero
// ¿Qué función usamos siempre al principio?
session_start();

// 2. Destruir todos los datos de la sesión (borra el archivo de sesión en el servidor)
session_destroy();

// 3. Redirigir al usuario al login
header("Location: login.php");
exit();
?>