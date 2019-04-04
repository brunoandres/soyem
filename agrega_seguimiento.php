<?php
include("conecta.php");
$asunto = $_POST['asunto'];
$comentario = $_POST['comentario'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
mysql_query("insert into seguimiento_afiliado (asunto, comentario, usuario, clave) values ('$asunto', '$comentario', '$usuario', '$clave')");
header ("Location:confirmado.php?es=4");
exit();
?>