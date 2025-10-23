<?php
session_start();
$_SESSION["cosa"] = 1;
echo $_SESSION["cosa"];
$_SESSION["cosa"]++;
$_SESSION['nombre'] = "Pepito Conejo";
$_SESSION["contador"] = 1;
print "<p> SESION01 El nombre es $_SESSION[nombre] </p>";
?>