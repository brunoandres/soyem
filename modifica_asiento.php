<?php
include ("conecta.php");
$id_us = $_POST['id_us'];
$id_a = $_POST['id_a'];
$fecha = substr($_POST['fecha'],6,4).'-'.substr($_POST['fecha'],3,2).'-'.substr($_POST['fecha'],0,2);
$cheque = $_POST['cheque'];
$cuenta = ($_POST['cuenta']);
$debe = $_POST['debe'];
$haber = $_POST['haber'];
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
mysql_query("insert into asientos (fecha,cuenta,debe,haber,detalle,id_us,nro,cheque) values ('$fecha','$cuenta','$debe','$haber','$detalle','$id_us','$nro','$cheque')");
header ("location: asiento.php?nro=$nro&ac=nuevo");
} else {
mysql_query("update asientos set fecha='$fecha' where id_a='$id_a'");
mysql_query("update asientos set cuenta='$cuenta' where id_a='$id_a'");
mysql_query("update asientos set debe='$debe' where id_a='$id_a'");
mysql_query("update asientos set haber='$haber' where id_a='$id_a'");
mysql_query("update asientos set detalle='$detalle' where id_a='$id_a'");
header ("location: asiento.php?nro=$nro");
}
exit();
?>