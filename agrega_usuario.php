<?php
include ("conecta.php");
$usuario = $_POST['usuario'];
$pass = md5($_POST['pass']);
$funcion = $_POST['funcion'];
$seccion = $_POST['seccion'];
$cant = mysql_num_rows(mysql_query("select * from usuarios where usuario='$usuario'"));
if ($cant > 0){
header ("location: listado_usuarios.php?error=1");
} else {
mysql_query("insert into usuarios (usuario,clave,funcion,seccion) values ('$usuario','$pass','$funcion','$seccion')");
mysql_close($conn);
include ("conecta1.php");
mysql_query("insert into usuarios (usuario,pass,funcion,seccion) values ('$usuario','$pass','$funcion','$seccion')");
mysql_close($conn);
header ("location: listado_usuarios.php?mostrar=1");

}
exit();
?>