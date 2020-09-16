<?php
include("conecta.php");
include ("auditoria.php");

$afiliado = $_POST['afiliado'];
$fecha_prestamo = date("Y-m-d");
$p_clave = mysql_fetch_array(mysql_query("select * from prestamos_viviendas order by clave_prestamo desc"));
if (substr($p_clave['clave_prestamo'],0,4) == date("Y")){
$clave_prestamo = $p_clave['clave_prestamo'];
} else {
$clave_prestamo = date("Y").'00000';
}
$num_cuotas = $_POST['cuotas'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$vencimiento = $_POST['ano'].'-'.$_POST['mes'].'-01';
$monto = $_POST['monto_cuota'];
$vale = $_POST['vale'];
$observaciones = $_POST['observaciones'];

/* a agregar contabilidad*/
$id_us = $_POST['id_us'];
$dat_af = mysql_fetch_array(mysql_query("select * from afiliado where clave='$afiliado'"));
$importe_cv = $monto * $num_cuotas;
$detalle1 = "Venta de lote al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto;
$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'] + 1;

$query = "insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '119', '$importe_cv', '$detalle1', '$id_us', 'si')";
mysql_query($query);
auditar($query);

$query1 = "insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '120', '$importe_cv', '$detalle1', '$id_us', 'si')"; 
mysql_query($query1);
auditar($query1);

/* fin a agregar contabilidad*/

for ($s=1; $s<=$num_cuotas ;$s++){
$clave_prestamo = $clave_prestamo + 1;
$qry = "insert into prestamos_viviendas (afiliado, fecha_prestamo, clave_prestamo, cuota, num_cuotas, vencimiento, monto, vale, observaciones) values ('$afiliado', '$fecha_prestamo', '$clave_prestamo', '$s', '$num_cuotas', '$vencimiento', '$monto', '$vale', '$observaciones')";
mysql_query($qry);
auditar($qry);
$mes = $mes + 1;
if ($mes > 12){
$mes = 1;
$ano = $ano + 1;
}
$vencimiento = $ano.'-'.$mes.'-01';
}

$ult = mysql_fetch_array(mysql_query("select * from prestamos_viviendas order by clave_prestamo desc"));

header ("Location:detalle_prestamos_v.php?clave_prestamo=".$ult['clave_prestamo']);
exit();
?>