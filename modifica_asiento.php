<?php
include ("conecta.php");
include ("auditoria.php");
$id_us = $_POST['id_us'];
$id_a = $_POST['id_a'];
$fecha = substr($_POST['fecha'],6,4).'-'.substr($_POST['fecha'],3,2).'-'.substr($_POST['fecha'],0,2);
$cheque = $_POST['cheque'];
$cuenta = ($_POST['cuenta']);
$debe = $_POST['debe'];
$haber = $_POST['haber'];
$id_tipo_comprobante = $_POST['tipo_comprobante'];
$comprobante = $_POST['comprobante'];

if (empty($debe)) {
	$debe = '0.00';
}
elseif (empty($haber)) {
	$haber = '0.00';
}

$detalle = $_POST['detalle'];
$nro = $_POST['nro'];
if (empty($_POST['fecha']) and empty($_POST['detalle'])){
$pf = mysql_fetch_array(mysql_query("select * from asientos where nro = '$nro'"));
$fecha = $pf['fecha'];
$detalle = $pf['detalle'];
}
if (empty($id_a)){
	if(empty($nro)){
		$nnro = mysql_num_rows(mysql_query("select * from asientos"));
		if($nnro==0){
		$nro = 1;
		} else {
		$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
		$nro = $nnro['nro'] + 1;
		}
	}
	$query = "insert into asientos (fecha,cuenta,debe,haber,detalle,id_us,nro,cheque,id_tipo_comprobante,comprobante) values ('$fecha','$cuenta','$debe','$haber','$detalle','$id_us','$nro','$cheque',$id_tipo_comprobante,'$comprobante')";
mysql_query($query);
auditar($query);

header ("location: asiento.php?nro=$nro&ac=nuevo");
} else {
//query para auditar asiento
$query="update asientos set fecha='$fecha', cuenta='$cuenta',debe='$debe', haber='$haber', detalle='$detalle', cheque='$cheque',id_tipo_comprobante=$id_tipo_comprobante, comprobante='$comprobante' where id_a='$id_a'";
mysql_query("update asientos set fecha='$fecha' where id_a='$id_a'");
mysql_query("update asientos set cuenta='$cuenta' where id_a='$id_a'");
mysql_query("update asientos set debe='$debe' where id_a='$id_a'");
mysql_query("update asientos set haber='$haber' where id_a='$id_a'");
mysql_query("update asientos set detalle='$detalle' where id_a='$id_a'");
mysql_query("update asientos set cheque='$cheque' where id_a='$id_a'");
mysql_query("update asientos set id_tipo_comprobante=$id_tipo_comprobante where id_a='$id_a'");
mysql_query("update asientos set comprobante='$comprobante' where id_a='$id_a'");
auditar($query);
header ("location: asiento.php?nro=$nro");
}
exit();
?>
