<?php
include ("conecta.php");
include ("auditoria.php");

$clave_prestamo = $_GET['clave_prestamo'];
$dat = mysql_fetch_array(mysql_query("select * from prestamos_viviendas where clave_prestamo ='$clave_prestamo'"));
$afiliado = $dat['afiliado'];
$fecha_prestamo = $dat['fecha_prestamo'];
$query = "delete from prestamos_viviendas where (afiliado = '$afiliado' and fecha_prestamo = '$fecha_prestamo')";
mysql_query($query);
auditar($query);
header ("location: prestamos_viviendas.php");
exit();
?>