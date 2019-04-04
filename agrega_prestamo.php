<?php
include("conecta.php");
$afiliado = $_POST['afiliado'];
$cuil = $_POST['cuit'];
$banco = $_POST['banco'];
$cbu_bd = $_POST['cbu_bd'];


$fecha_prestamo = date("Y-m-d");
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
if ($_POST['tipo']=='Proveedor'){
$proveedor=$_POST['proveedor_pro'];
$vale_pro='X';
$efectivo = "";
$banco = "";
$cuenta_banco = "";
$cheque_nro = "";
}
if ($_POST['tipo']=='Soyem'){
$proveedor=0;
$vale_pro="";
	if ($_POST['m_pago']=='Efectivo'){
	$efectivo = 'X';
	$banco = "";
	$proveduria = "";
	$lena = "";
	$cuenta_banco = "";
	$cheque_nro = "";
	$cuenta_motivo = $_POST['origen'];	
	}
	if ($_POST['m_pago']=='Cheque'){
	$efectivo = "";
	$banco = 'X';
	$proveduria = "";
	$lena = "";
	$turismo = "";
	$cuenta_banco = $_POST['cuenta_banco'];
	$cheque_nro = $_POST['nro_cheque'];	
	}
	if ($_POST['m_pago']=='Proveduria'){
	$efectivo = "";
	$banco = "";
	$proveduria = "X";
	$lena = "";
	$turismo = "";
	}
	if ($_POST['m_pago']=='Leña'){
	$efectivo = "";
	$banco = "";
	$proveduria = "";
	$lena = "X";
	$turismo = "";
	}
	if ($_POST['m_pago']=='Turismo'){
	$efectivo = "";
	$banco = "";
	$proveduria = "";
	$lena = "";
	$turismo = "X";
	}
	
}
if ($_POST['tipo']=='Salud'){
$proveedor=$_POST['proveedor_sal'];
$vale_pro='X';
$efectivo = "";
$banco = "";
$cuenta_banco = "";
$cheque_nro = "";
}

$observaciones = $_POST['observaciones'];

$anio = date("Y");
$ttex = "select vale from prestamos where vale like '".$anio."%' order by vale desc";
$q_vale = mysql_query($ttex);
if (mysql_num_rows($q_vale)==0){
$vale = $anio."00001";
} else {
$ult_v = mysql_fetch_array(mysql_query("select vale from prestamos order by vale desc"));
$vale = $ult_v['vale']+1;
}

if($_POST['tipe_p']=="D"){
for ($s=1; $s<=$num_cuotas ;$s++){
$clave_prestamo = $clave_prestamo + 1;
mysql_query("insert into prestamos (afiliado, fecha_prestamo, clave_prestamo, cuota, num_cuotas, vencimiento, monto, efectivo, banco, cuenta_banco, cheque_nro, vale_pro, proveedor, cuotas_pro, vale, cuenta_motivo, banc, tipe_p, observaciones, turismo) values ('$afiliado', '$fecha_prestamo', '$clave_prestamo', '$s', '$num_cuotas', '$vencimiento', '$monto', '$efectivo', '$banco', '$cuenta_banco', '$cheque_nro', '$vale_pro', '$proveedor','1', '$vale', '$cuenta_motivo', 'si','D', '$observaciones', '$turismo')");
$mes = $mes + 1;
if ($mes > 12){
$mes = 1;
$ano = $ano + 1;
}
$vencimiento = $ano.'-'.$mes.'-01';
}
mysql_query("update afiliado set cbu_bd='$cbu_bd' where clave='$afiliado'");
mysql_query("update afiliado set cuil='$cuil' where clave='$afiliado'");
mysql_query("update afiliado set banco='$banco' where clave='$afiliado'");

$cc = 167;
}


if($_POST['tipe_p']=="M"){
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
}

if($_POST['tipe_p']=="P"){
	$proveedor=$_POST['proveedor_sal'];
for ($s=1; $s<=$num_cuotas ;$s++){
$clave_prestamo = $clave_prestamo + 1;
mysql_query("insert into prestamos (afiliado, fecha_prestamo, clave_prestamo, cuota, num_cuotas, vencimiento, monto, efectivo, banco, cuenta_banco, cheque_nro, vale_pro, proveedor, cuotas_pro, vale, cuenta_motivo, banc, tipe_p, observaciones) values ('$afiliado', '$fecha_prestamo', '$clave_prestamo', '$s', '$num_cuotas', '$vencimiento', '$monto', '', '', '', '', 'X', '$proveedor','1', '$vale', '$cuenta_motivo', 'no','P', '$observaciones')");
$mes = $mes + 1;
if ($mes > 12){
$mes = 1;
$ano = $ano + 1;
}
$vencimiento = $ano.'-'.$mes.'-01';
}

$txt_coseguro = "insert into coseguros (clave_afiliado, clave_empresa, co_monto) values('$afiliado','$proveedor','".$_POST['monto_coseguro']."')";
mysql_query($txt_coseguro);
$cc = 154;
}



$ult = mysql_fetch_array(mysql_query("select * from prestamos order by clave_prestamo desc"));


/* a agregar contabilidad*/
if ($_POST['ant_2015']!='si'){
$montot = $monto * $num_cuotas;
$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'] + 1;
$id_us = $_POST['id_us'];
$dat_af = mysql_fetch_array(mysql_query("select * from afiliado where clave='$afiliado'"));
if($_POST['tipe_p']!="P"){
if ($_POST['tipo']=='Salud'){
		$dat_pro = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$proveedor'"));
		$detalle1 = "Prestamo al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto." del proveedor de salud ".$dat_pro['nombre'];
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '36', '$montot', '$detalle1', '$id_us', 'si')");
		}

if ($_POST['tipo']=='Proveedor'){
		$dat_pro = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$proveedor'"));
		$detalle1 = "Prestamo al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto." del proveedor ".$dat_pro['nombre'];
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '36', '$montot', '$detalle1', '$id_us', 'si')");
}

if ($_POST['tipo']=='Soyem'){
	
	if ($_POST['m_pago']=='Proveduria'){
	$detalle1 = "Prestamo de Proveduria al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto;
	mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
	mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '180', '$montot', '$detalle1', '$id_us', 'si')");
	}
	
	if ($_POST['m_pago']=='Leña'){
	$detalle1 = "Prestamo de Leña al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto;
	mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
	mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '95', '$montot', '$detalle1', '$id_us', 'si')");
	}
	
	if ($_POST['m_pago']=='Efectivo'){
	
	if ($_POST['origen']==1){
		$detalle1 = "Prestamo en efectivo (Tesoreria) al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto;
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '1', '$montot', '$detalle1', '$id_us', 'si')");
		}
	if ($_POST['origen']==2){
		$detalle1 = "Prestamo en efectivo (Caja Chica) al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto;
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '2', '$montot', '$detalle1', '$id_us', 'si')");
		}
		
		
	}
	if ($_POST['m_pago']=='Cheque'){
		if($_POST['cuenta_banco']=='G'){
			$detalle1 = "Prestamo en cheque al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto." cuenta del Banco Credicoop cheque nro ".$_POST['nro_cheque'];
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '5', '$montot', '$detalle1', '$id_us', 'si')");
		}
		if($_POST['cuenta_banco']=='A'){
		$detalle1 = "Prestamo en cheque al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto." cuenta del Banco Patagonia cheque nro ".$_POST['nro_cheque'];
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '6', '$montot', '$detalle1', '$id_us', 'si')");
		}
	}
	if ($_POST['m_pago']=='Turismo'){
					$detalle1 = "Prestamo para TURISMO al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto;
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '59', '$montot', '$detalle1', '$id_us', 'si')");
	}
}

} else {
	
	$dat_pro = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$proveedor'"));
		$detalle1 = "Prestamo al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " cuotas ".$num_cuotas." de $ ".$monto." del proveedor de salud ".$dat_pro['nombre'];
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '$cc', '$montot', '$detalle1', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_prestamo', '159', '$montot', '$detalle1', '$id_us', 'si')");
		
		
		$nro1 = $nro+1;
		
		$fecha_prestamo1 = date("Y-m-d");
		
		$detalle11 = "Coseguro del afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " de $ ".$_POST['monto_coseguro']." del proveedor de salud ".$dat_pro['nombre'];
		$m_c = $_POST['monto_coseguro'];
		
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro1', '$fecha_prestamo1', '75', '$m_c', '$detalle11', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro1', '$fecha_prestamo1', '159', '$m_c', '$detalle11', '$id_us', 'si')");
		
}
}
/* fin a agregar contabilidad*/





header ("Location:detalle_prestamos.php?clave_prestamo=".$ult['clave_prestamo']);
exit();
?>