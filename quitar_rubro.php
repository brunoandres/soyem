<?php
include ("conecta.php");
include ("auditoria.php");

$id_rubro = $_GET['id_rubro'];
$query = "delete from con_rubros where id_rubro = '$id_rubro'";
mysql_query($query);
auditar($query);
header ("location: cuentas.php");
exit();
?>