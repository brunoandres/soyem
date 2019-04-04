<?php
include ("conecta.php");
$id_cuentas = $_GET['id_cuentas'];
mysql_query("delete from cuentas where id_cuentas = '$id_cuentas'");
header ("location: cuentas.php");
exit();
?>