<?php
include ("conecta.php");
if (empty($_POST['rec_nro_01'])){
	$rec_nro_01 = '0001';
} else {
$rec_nro_01 = str_pad($_POST['rec_nro_01'],4,'0',STR_PAD_LEFT);
}
$rec_nro = $rec_nro_01.'-'.str_pad($_POST['rec_nro_02'],8,'0',STR_PAD_LEFT);
$rec_fecha = substr($_POST['rec_fecha'],6,4).'/'.substr($_POST['rec_fecha'],3,2).'/'.substr($_POST['rec_fecha'],0,2);
$nro_sw = mysql_num_rows(mysql_query("select * from  recibos where (rec_nro = '$rec_nro' and rec_fecha='$rec_fecha')"));
if ($nro_sw==0){

$rec_nombre = $_POST['rec_nombre'];
$rec_legajo = $_POST['rec_legajo'];
$rec_domicilio = $_POST['rec_domicilio'];
$rec_localidad = $_POST['rec_localidad'];
if (!empty($_POST['rec_cuit_02']) and !empty($_POST['rec_cuit_01']) and !empty($_POST['rec_cuit_03'])){
$rec_cuit = $_POST['rec_cuit_01'].'-'.$_POST['rec_cuit_02'].'-'.$_POST['rec_cuit_03'];
}
$rec_iva = $_POST['rec_iva'];
$rec_importe_efectivo = $_POST['rec_importe_efectivo'];
$rec_importe_cheque = $_POST['rec_importe_cheque'];
$rec_importe = $rec_importe_efectivo + $rec_importe_cheque; 
$rec_concepto = $_POST['rec_concepto'];
$rec_detalles = $_POST['rec_detalles'];
$rec_banco = $_POST['rec_banco'];
$rec_cheque_nro = $_POST['rec_cheque_nro'];

mysql_query("insert into recibos (rec_nro, rec_fecha, rec_nombre, rec_legajo, rec_domicilio, rec_localidad, rec_cuit, rec_iva, rec_importe, rec_concepto, rec_detalles, rec_importe_efectivo, rec_importe_cheque, rec_cheque_nro, rec_banco) values ('$rec_nro', '$rec_fecha', '$rec_nombre', '$rec_legajo', '$rec_domicilio', '$rec_localidad', '$rec_cuit', '$rec_iva', '$rec_importe','$rec_concepto', '$rec_detalles', '$rec_importe_efectivo', '$rec_importe_cheque', '$rec_cheque_nro', '$rec_banco')");

$p_ult = mysql_fetch_array(mysql_query("select * from recibos order by rec_id desc"));
$rec_id = $p_ult['rec_id'];

$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'] + 1;
$id_us = $_POST['id_us'];
$conc = mysql_fetch_array(mysql_query("select * from conceptos_recibos where (cr_id = '$rec_concepto')"));
$conc_cuenta = $conc['cr_cuenta'];

	if ($rec_importe_efectivo>0){
		
		$detalle = "Ingreso por recibo ".$rec_nro." del dia ".$rec_fecha. " del señor ".$rec_nombre." en efectivo $ ".$rec_importe_efectivo." en concepto de ".$conc['cr_name'];
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$rec_fecha', '1', '$rec_importe_efectivo', '$detalle', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$rec_fecha', '$conc_cuenta', '$rec_importe_efectivo', '$detalle', '$id_us', 'si')");
	}
	if ($rec_importe_cheque>0){
		
		if ($rec_importe_efectivo>0){
			$nro++;
		}
		$detalle = "Ingreso por recibo ".$rec_nro." del dia ".$rec_fecha. " del señor ".$rec_nombre." en cheque $ ".$rec_importe_cheque." nro cheque ".$rec_cheque_nro." banco ".$rec_banco." en concepto de ".$conc['cr_name'];
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$rec_fecha', '85', '$rec_importe_cheque', '$detalle', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$rec_fecha', '$conc_cuenta', '$rec_importe_cheque', '$detalle', '$id_us', 'si')");
	}
}
header("Location: detalle_recibo.php?rec_id=$rec_id");
exit();
?>