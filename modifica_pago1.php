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
$p_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$empresa'"));
$detalle1 = $detalle.' - Pago a: '.$p_empresa['nombre'].' - Factura: '.$factura;

$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'];

$nro = $nro +1;

mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha', '$cuenta_contable', '$importe', '$detalle1', '$id_us', 'si')");
	if ($forma=="contado"){
mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '1', '$importe', '$detalle1', '$id_us', 'si')");
	}
	if ($forma=="caja chica"){
mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '2', '$importe', '$detalle1', '$id_us', 'si')");
	}
	if($forma=="cheque"){
		if($cuenta_banco=="Banco Credicoop"){
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '5', '$importe', '$detalle1', '$id_us', 'si')");
		} else {
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '6', '$importe', '$detalle1', '$id_us', 'si')");
		}
		}




$t_pas = "select * from pagos where id_pagos=".$id_pagos;
$pas = mysql_fetch_array(mysql_query($t_pas));

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

echo "<p>se pago en forma exitosa la factura pendiente</p>";


?>
</div>
</body>
</html>