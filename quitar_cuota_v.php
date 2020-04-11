<?php
include ("conecta.php");
include ("auditoria.php");

$clave_prestamo = $_GET['clave_prestamo'];
$vuelve = $_GET['vuelve'];
$dat = mysql_fetch_array(mysql_query("select * from prestamos_viviendas where clave_prestamo ='$clave_prestamo'"));
$cuota = $dat['cuota'];
$num_cuotas = $dat['num_cuotas'];
/*
$num_cuotas = $dat['num_cuotas'];
$num_cuotas = $dat['num_cuotas'];
if ($dat['cuota'] != $dat['num_cuotas']){
$q = mysql_query("select * from prestamos_viviendas where ()");




}
*/
$query = "delete from prestamos_viviendas where (clave_prestamo = '$clave_prestamo')";
mysql_query($query);
auditar($query);

header ("Location: detalle_prestamos_v.php?clave_prestamo=$vuelve");
exit();
?>