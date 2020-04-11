<?php
include ("conecta.php");
$id_us = $_POST['id_us'];
$usuario = $_POST['usuario'];
$pass = md5($_POST['pass']);
$funcion = $_POST['funcion'];
$seccion = $_POST['seccion'];
mysql_query("update usuarios set usuario='$usuario' where id_us='$id_us'");
mysql_query("update usuarios set clave = '$pass' where id_us='$id_us'");
mysql_query("update usuarios set funcion = '$funcion' where id_us='$id_us'");
mysql_query("update usuarios set seccion = '$seccion' where id_us='$id_us'");
mysql_close($conn);
/*include ("conecta1.php");
mysql_query("update usuarios set usuario='$usuario' where id_us='$id_us'");
mysql_query("update usuarios set pass = '$pass' where id_us='$id_us'");
mysql_query("update usuarios set funcion = '$funcion' where id_us='$id_us'");
mysql_query("update usuarios set seccion = '$seccion' where id_us='$id_us'");
mysql_close($conn);*/
header ("location: confirmado_usuarios.php");
exit();
?>