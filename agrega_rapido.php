<?php
include("conecta.php");
$afiliado = $_POST['clave'];
$empresa = $_POST['empresa'];
$monto = $_POST['monto'];
$cuotas = $_POST['cuotas'];
$fecha_prestamo = date("Y-m-d");
if(!empty($afiliado) and !empty($empresa) and !empty($monto) and !empty($cuotas)){
	$p_clave = mysql_fetch_array(mysql_query("select * from prestamos order by clave_prestamo desc"));
	if (substr($p_clave['clave_prestamo'],0,4) == date("Y") or substr($p_clave['clave_prestamo'],0,4) == 2017){
	$clave_prestamo = $p_clave['clave_prestamo'];
	} else {
	$clave_prestamo = date("Y").'00001';
	}
	$num_cuotas = $_POST['cuotas'];
	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	$vencimiento = $_POST['ano'].'-'.$_POST['mes'].'-01';
	$monto = $_POST['monto'] / $num_cuotas;
	$proveedor=$_POST['empresa'];
	$vale_pro='X';
	$efectivo = "";
	$banco = "";
	$proveduria = "";
	$lena = "";
	$turismo = "";
	$observaciones = "";
	$cuenta_banco = "";
	$cheque_nro = "";
	
	
	$anio = date("Y");
	$ttex = "select vale from prestamos where vale like '".$anio."%' order by vale desc";
	$q_vale = mysql_query($ttex);
	if (mysql_num_rows($q_vale)==0){
	$vale = $anio."00001";
	} else {
	$ult_v = mysql_fetch_array(mysql_query("select vale from prestamos order by vale desc"));
	$vale = $ult_v['vale']+1;
	}
	
	for ($s=1; $s<=$num_cuotas ;$s++){
	$clave_prestamo = $clave_prestamo + 1;
	mysql_query("insert into prestamos (afiliado, fecha_prestamo, clave_prestamo, cuota, num_cuotas, vencimiento, monto, efectivo, banco, proveduria, lena, turismo, cuenta_banco, cheque_nro, vale_pro, proveedor, cuotas_pro, vale, cuenta_motivo, banc, tipe_p, observaciones) values ('$afiliado', '$fecha_prestamo', '$clave_prestamo', '$s', '$num_cuotas', '$vencimiento', '$monto', '$efectivo', '$banco', '$proveduria', '$lena', '$turismo', '$cuenta_banco', '$cheque_nro', '$vale_pro', '$proveedor','1', '$vale', '$cuenta_motivo', 'no','M', '$observaciones')");
	$mes = $mes + 1;
	if ($mes > 12){
	$mes = 1;
	$ano = $ano + 1;
	}
	$vencimiento = $ano.'-'.$mes.'-01';
	}

	$cc = 154;
	
	$ult = mysql_fetch_array(mysql_query("select * from prestamos order by clave_prestamo desc"));
	
	//inicia contabilidad
	$montot = $monto * $num_cuotas;
	$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
	$nro = $nnro['nro'] + 1;
	$id_us = $_POST['id_us'];
	$dat_af = mysql_fetch_array(mysql_query("select * from afiliado where clave='$afiliado'"));
	
	
	$dat_pro = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$proveedor'"));
	$detalle1 = "Prestamo al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto." del proveedor de salud ".$dat_pro['nombre'];
		
	mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
	mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '36', '$montot', '$detalle1', '$id_us', 'si')");
	//fin contabilidad
	}
header("Location: prestamos_rapidos.php?empre=$empresa");
exit();
?>