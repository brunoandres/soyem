<?php
include ("conecta.php");
$id_rubro = $_GET['id_rubro'];
mysql_query("delete from con_rubros where id_rubro = '$id_rubro'");
header ("location: cuentas.php");
exit();
?>