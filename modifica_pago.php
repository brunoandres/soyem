<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="contanido">
<?php
include ("conecta.php");
include ("auditoria.php");
$id_us = $_POST['id_us'];
$id_pagos = $_POST['id_pagos'];
$fecha = substr($_POST['fecha'],6,4).'-'.substr($_POST['fecha'],3,2).'-'.substr($_POST['fecha'],0,2);
$cuenta_banco = ($_POST['cuenta_banco']);
$empresa = $_POST['empresa'];
$importe = $_POST['importe'];
$detalle = $_POST['detalle'];
$factura = $_POST['factura'];
$forma = $_POST['forma'];
$nro_cheque = $_POST['nro_cheque'];
$cuenta_contable = $_POST['cuenta_contable'];
$numero_transferencia = $_POST['numero_transferencia'];
$p_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$empresa'"));
$detalle1 = $detalle.' - Pago a: '.$p_empresa['nombre'].' - Factura: '.$factura;
if (empty($id_pagos)){
$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'] + 1;
if($forma=="pendiente" or $forma=="caja chica"){
	mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '$cuenta_contable', '$importe', '$detalle1', '$id_us', 'si')");
		if($forma=="pendiente"){
mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha', '36', '$importe', '$detalle1', '$id_us', 'si')");
}
if($forma=="caja chica"){
mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha', '2', '$importe', '$detalle1', '$id_us', 'si')");
}
	} else {
mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha', '$cuenta_contable', '$importe', '$detalle1', '$id_us', 'si')");
	if ($forma=="contado"){
mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '1', '$importe', '$detalle1', '$id_us', 'si')");
	}
	/*if ($forma=="caja chica"){
mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '2', '$importe', '$detalle1', '$id_us', 'si')");
	}*/
	if($forma=="cheque"){
		if($cuenta_banco=="Banco Credicoop"){
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '5', '$importe', '$detalle1', '$id_us', 'si')");
		} else {
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '6', '$importe', '$detalle1', '$id_us', 'si')");
		}
	}
}
$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'];
$query_pago = "insert into pagos (fecha_pago, cuenta_banco, importe_pago, detalle_pago, usuario_pago, factura_pago, empresa_pago, forma_pago, cheque_pago, cuenta_contable_pago, nro_as, numero_transferencia ) values ('$fecha', '$cuenta_banco', '$importe', '$detalle', '$id_us', '$factura', '$empresa', '$forma', '$nro_cheque', '$cuenta_contable', '$nro','$numero_transferencia')";
	mysql_query($query_pago);
auditar($query_pago);
echo "<p>se ingreso el pago en forma exitosa</p>";
echo '<p><a href="nuevo_pago.php">Realizar un nuevo pago</a></p>';
} else {
$t_pas = "select * from pagos where id_pagos=".$id_pagos;
$pas = mysql_fetch_array(mysql_query($t_pas));
$nro = $pas['nro_as'];
mysql_query("update asientos set fecha = '$fecha' where nro ='$nro'");
mysql_query("update asientos set detalle = '$detalle1' where nro ='$nro'");
$a_debe = mysql_fetch_array(mysql_query("select * from asientos where (nro='$nro' and debe > 0)"));
$id_a = $a_debe['id_a'];
mysql_query("update asientos set debe = '$importe' where id_a ='$id_a'");
	if ($forma=="contado"){
	mysql_query("update asientos set cuenta = '1' where id_a ='$id_a'");
	}
	if($forma=="cheque"){
		if($cuenta_banco=="Banco Credicoop"){
		mysql_query("update asientos set cuenta = '5' where id_a ='$id_a'");
		} else {
		mysql_query("update asientos set cuenta = '6' where id_a ='$id_a'");
		}
	}
	if($forma=="pendiente"){

	}
$a_haber = mysql_fetch_array(mysql_query("select * from asientos where (nro='$nro' and haber > 0)"));
$id_a = $a_debe['id_a'];
$query_update_asientos = "update asientos set haber = '$importe', cuenta = '$cuenta_contable' where id_a ='$id_a'";
mysql_query($query_update_asientos);
auditar($query_update_asientos);

$query_update = "update pagos set cuenta_contable_pago = '$cuenta_contable', fecha_pago = '$fecha', cuenta_banco = '$cuenta_banco', importe_pago = '$importe', detalle_pago = '$detalle', usuario_pago = '$id_us', factura_pago = '$factura', empresa_pago = '$empresa', forma_pago = '$forma', cheque_pago = '$nro_cheque', numero_transferencia = '$numero_transferencia' where id_a ='$id_a'";
mysql_query($query_update);
auditar($query_update);

/*mysql_query("update asientos set haber = '$importe' where id_a ='$id_a'");
mysql_query("update asientos set cuenta = '$cuenta_contable' where id_a ='$id_a'");

mysql_query("update pagos set cuenta_contable_pago = '$cuenta_contable' where id_pagos ='$id_pagos'");
mysql_query("update pagos set fecha_pago = '$fecha' where id_pagos ='$id_pagos'");
mysql_query("update pagos set cuenta_banco = '$cuenta_banco' where id_pagos ='$id_pagos'");
mysql_query("update pagos set importe_pago = '$importe' where id_pagos ='$id_pagos'");
mysql_query("update pagos set detalle_pago = '$detalle' where id_pagos ='$id_pagos'");
mysql_query("update pagos set usuario_pago = '$id_us' where id_pagos ='$id_pagos'");
mysql_query("update pagos set factura_pago = '$factura' where id_pagos ='$id_pagos'");
mysql_query("update pagos set empresa_pago = '$empresa' where id_pagos ='$id_pagos'");
mysql_query("update pagos set forma_pago = '$forma' where id_pagos ='$id_pagos'");
mysql_query("update pagos set cheque_pago = '$nro_cheque' where id_pagos ='$id_pagos'");
mysql_query("update pagos set numero_transferencia = '$numero_transferencia' where id_pagos ='$id_pagos'");*/

echo "<p>se modifico el pago en forma exitosa</p>";
echo '<p><a href="nuevo_pago.php">Realizar un nuevo pago</a></p>';
}

?>
</div>
</body>
</html>
