<?php
include ("conecta.php");
include ("auditoria.php");

$id_cuentas = $_GET['id_cuentas'];
$query = "delete from cuentas where id_cuentas = '$id_cuentas'";
mysql_query($query);
auditoria($query);

header ("location: cuentas.php");
exit();
?>