<?php
include("conecta.php");
include ("auditoria.php");

$asunto = $_POST['asunto'];
$comentario = $_POST['comentario'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$query = "insert into seguimiento_afiliado (asunto, comentario, usuario, clave) values ('$asunto', '$comentario', '$usuario', '$clave')";
mysql_query($query);
auditar($query);
header ("Location:confirmado.php?es=4");
exit();
?>