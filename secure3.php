<?php
session_start(); 
if ($_SESSION["autenticado"] != "si" or ($_SESSION["funcion"] != "1" and $_SESSION["funcion"] != "4")) { 
	session_destroy();
    header("Location:index.php?error=3"); 
    exit(); 
}
?> 
