<?php
// session_start();
// session_destroy();
setcookie("cookie", $usuario, time() - 100);
header("Location: Index.php");
exit();
?>