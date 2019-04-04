<?php
function total_prestamo($clave, $tot_cuotas){
	$tot = 0;
	for($i=0; $i<$tot_cuotas; $i++){
		$id_dat = $clave + $i;
		$txt = "select monto from prestamos where clave_prestamo = ".$id_dat;
		$a_dat = mysql_fetch_row(mysql_query($txt));
		$tot = $tot + $a_dat[0];
	}
	$tot = number_format($tot, 2, ',', '.');
	return $tot;
}
function TotalDeudaAfiliado($clave){
	$txt = "select monto from prestamos where afiliado = '".$clave."' and pagado = 'I'";
	$query = mysql_query($txt);
	$tot = 0;
	while ($dat = mysql_fetch_array($query)){
		$tot = $tot + $dat['monto'];
	}
	$dato = '<div class="veraza_tot">Este Afiliado tiene prestamos impagos por $ '.$tot.'</div>';
	return $dato;
}
function Veraza($clave){
	if (mysql_num_rows(mysql_query("select * from veraz where vz_af='$clave'")) > 0){
		$tot = '<div class="veraza">Este Afiliado esta en el Veraz</div>';
	}
	return $tot;
}
function total_prestamo1($clave1, $tot_cuotas1){
	$tot1 = 0;
	for($i=0; $i<$tot_cuotas1; $i++){
		$id_dat1 = $clave1 + $i;
		$txt1 = "select monto from prestamos where clave_prestamo = ".$id_dat1;
		$a_dat1 = mysql_fetch_row(mysql_query($txt1));
		$tot1 = $tot1 + $a_dat1[0];
	}

	return $tot1;
}
function total_pagos($clave_pres){
	$tot_pago = 0;
	$qq = mysql_query("select pp_importe from pagos_prestamos where pp_clave='$clave_prestamo'");
	for($j=0; $j<mysql_num_rows($qq); $j++){
		$aa = mysql_fetch_row($qq);
		$tot_pago = $tot_pago + $aa[0];
	}

	return $tot_pago;
}

function total_deuda_prestamo($clave_pres){
	$tot_pago = 0;
	$tot_monto = 0;
	$dat_pres = mysql_fetch_array(mysql_query("select * from prestamos where clave_prestamo = '$clave_pres'"));
	$ini = $dat_pres['clave_prestamo'] - $dat_pres['cuota'] + 1;
	$tope = $ini + $dat_pres['num_cuotas'];
	for($k=$ini; $k<$tope; $k++){
		$ndat = mysql_fetch_array(mysql_query("select * from prestamos where clave_prestamo = '$k'"));
		if ($ndat['pagado']=="I") {
		$tot_monto = $tot_monto + $ndat['monto'];
	$qq = mysql_query("select pp_importe from pagos_prestamos where pp_clave='$k'");
	for($j=0; $j<mysql_num_rows($qq); $j++){
		$aa = mysql_fetch_row($qq);
		$tot_pago = $tot_pago + $aa[0];
	}
	}
	}
	$tot_deuda = $tot_monto - $tot_pago;
	return $tot_deuda;
}
function format_number_2 ($num){
	$num = (floor($num * 100)/100);
return $num;
}

function EstaPlanilla ($id){
	$tx = "select * from solo_descuento where sd_afiliado = ".$id;
	$nn = mysql_num_rows(mysql_query($tx));
	return $nn;
}
function VerazaEP($clave){
	if (mysql_num_rows(mysql_query("select * from solo_descuento where sd_afiliado='$clave'")) > 0){
		$tot = '<div class="veraza_sd">Este Afiliado solo puede recibir prestamos por Planilla de Descuento</div>';
	}
	return $tot;
}
function fecha_dev1 ($fecha){
	$fecha = substr($fecha,6,4).'/'.substr($fecha,3,2).'/'.substr($fecha,0,2);
	return $fecha;
}
function fecha_dev ($fecha){
	$fecha = substr($fecha,8,2).'/'.substr($fecha,5,2).'/'.substr($fecha,0,4);
	return $fecha;
}
function BuscaRegistro ($tabla, $valor_id, $valor, $campo){
		$txt_q = "select ".$campo." from ".$tabla." where ".$valor_id."='".$valor."' LIMIT 1";
		$result = mysql_query ($txt_q);
		$ddat = mysql_fetch_array ($result);
		return utf8_encode ($ddat[$campo]);
	}
?>