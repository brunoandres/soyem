<?php
session_start(); 
if ($_SESSION["autenticado"] != "si" and $_SESSION["funcion"] == "3") { 
    header("Location:index.php?error=3"); 
    exit(); 
}
?> 