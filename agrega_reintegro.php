<?php
include("conecta.php");
include ("auditoria.php");

$legajo_rei = $_POST['afiliado'];
$fecha_rei = date("Y-m-d");
$p_clave = mysql_fetch_array(mysql_query("select * from reintegros order by clave_reintegro desc"));
if (substr($p_clave['clave_reintegro'],0,4) == date("Y")){
$clave_reintegro = $p_clave['clave_reintegro']+1;
} else {
$clave_reintegro = date("Y").'00001';
}
$id_re_li = $_POST['tipo'];
$importe_rei = $_POST['monto'];
$m_pago = $_POST['m_pago'];
$origen = $_POST['origen'];
$cuenta_banco = $_POST['cuenta_banco'];
$nro_cheque = $_POST['nro_cheque'];
$observaciones = $_POST['observaciones'];

$query = "insert into reintegros (legajo_rei, fecha_rei, clave_reintegro, id_re_li, importe_rei, m_pago, origen, cuenta_banco, nro_cheque, observaciones) values ('$legajo_rei', '$fecha_rei', '$clave_reintegro', '$id_re_li','$importe_rei', '$m_pago', '$origen', '$cuenta_banco', '$nro_cheque', '$observaciones')";
mysql_query($query);
auditar($query);
/* obtener el ultimo */

$ult = mysql_fetch_array(mysql_query("select * from reintegros order by id_reintegro desc"));



/* parte de asientos */
$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'] + 1;
$id_us = $_POST['id_us'];
$dat_af = mysql_fetch_array(mysql_query("select * from afiliado where clave='$legajo_rei'"));
$dat_rei = mysql_fetch_array(mysql_query("select * from reintegros_li where id_re_li='$id_re_li'"));

if ($_POST['m_pago']=='IPROSS'){
		
		$detalle1 = "Reintegro al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " de $ ".$importe_rei." por IPROSS con motivo ".$dat_rei['descripcion'];
		$query_ipross = "insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_rei', '75', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_ipross);
		auditar($query_ipross);

		$query_ipross1 = "insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_rei', '121', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_ipross1);
		auditar($query_ipross1);
		}

	if ($_POST['m_pago']=='Efectivo'){
	
	if ($_POST['origen']==1){
		$detalle1 = "Reintegro en efectivo (Tesoreria) al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " de $ ".$importe_rei." con motivo ".$dat_rei['descripcion'];

		$query_origen = "insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_rei', '75', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_origen);	
		auditar($query_origen);

		$query_origen1 = "insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_rei', '1', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_origen1);
		auditar($query_origen1);
		}
	if ($_POST['origen']==2){
		$detalle1 = "Reintegro en efectivo (Caja Chica) al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " de $ ".$importe_rei." con motivo ".$dat_rei['descripcion'];

		$query_origen_2 = "insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_rei', '75', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_origen_2);
		auditar($query_origen_2);

		$query_origen_2_1 = "insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_rei', '2', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_origen_2_1);
		auditar($query_origen_2_1);
		}
		
		
	}
	if ($_POST['m_pago']=='Cheque'){
		if($_POST['cuenta_banco']=='G'){
			$detalle1 = "Reintegro en cheque al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " de $ ".$importe_rei." cuenta del Banco Credicoop cheque nro ".$_POST['nro_cheque']." con motivo ".$dat_rei['descripcion'];
		$query_tipo_g = "insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_rei', '75', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_tipo_g);	
		auditar($query_tipo_g);

		$query_tipo_g1 = "insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_rei', '5', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_tipo_g1);
		auditar($query_tipo_g1);
		}
		if($_POST['cuenta_banco']=='A'){
		$detalle1 = "Reintegro en cheque al afiliado ".$dat_af ['nombre']." legajo ".$dat_af ['legajo']. " de $ ".$importe_rei." cuenta del Banco Patagonia cheque nro ".$_POST['nro_cheque']." con motivo ".$dat_rei['descripcion'];

		$query_tipo_a = "insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha_rei', '75', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_tipo_a);
		auditar($query_tipo_a);

		$query_tipo_a1 = "insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha_rei', '6', '$importe_rei', '$detalle1', '$id_us', 'si')";
		mysql_query($query_tipo_a1);
		auditar($query_tipo_a1);
		}
	}

/* fin de asientos  */



header ("Location:detalle_reintegros.php?id_reintegro=".$ult['id_reintegro']);
exit();

?>