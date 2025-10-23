<?php
session_start();

print "<p> SESION02 El nombre es $_SESSION[nombre] </p>";
print $_SESSION["contador"];
$_SESSION["contador"]++;
if ($_SESSION["contador"] == 10){
    unset($_SESSION["contador"]);
}
?>