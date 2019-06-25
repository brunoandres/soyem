<?php
include ("conecta.php");
include ("auditoria.php");
$nro = $_GET['nro'];
$query="delete from asientos where nro = '$nro'";
mysql_query($query);
auditar($query);
header ("location: contabilidad.php");
exit();
?>
