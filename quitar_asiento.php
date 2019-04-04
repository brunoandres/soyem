<?php
include ("conecta.php");
$id_a = $_GET['id_a'];
mysql_query("delete from asientos where id_a = '$id_a'");
if ($_GET['vuelta']==1){
$nro = $_GET['nro'];
header ("location: asiento.php?nro=$nro");
} else {
header ("location: contabilidad.php");
}
exit();
?>