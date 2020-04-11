<?php
include ("conecta.php");
include ("auditoria.php");

$id_us = $_GET['id_us'];
$query = "delete from usuarios where id_us = '$id_us'";
mysql_query($query);
auditar($query);
mysql_close($conn);
/*include ("conecta1.php");
mysql_query("delete from usuarios where id_us = '$id_us'");
mysql_close($conn);
header ("location: listado_usuarios.php");*/
exit();
?>
