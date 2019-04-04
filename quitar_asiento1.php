<?php
include ("conecta.php");
$nro = $_GET['nro'];
mysql_query("delete from asientos where nro = '$nro'");
header ("location: contabilidad.php");
exit();
?>