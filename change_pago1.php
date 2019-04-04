<?php
include("conecta.php");
include ("funciones_grales.php");
$clave_prestamo = $_GET['clave_prestamo'];
$data = mysql_fetch_array(mysql_query("select * from prestamos where clave_prestamo='$clave_prestamo'"));
$debe_cuota = $data['monto'] - total_pagos($clave_prestamo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 14px;
	color: #333;
	line-height: 20px;
}
.quita_acc {
	line-height: 24px;
	font-weight: bold;
	text-transform: uppercase;
	color: #FFF;
	background-color: #F00;
	text-align: center;
	width: 120px;
	margin-right: 10px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;	
}
.noquita_acc {
	line-height: 24px;
	font-weight: bold;
	text-transform: uppercase;
	color: #FFF;
	background-color: #0C0;
	text-align: center;
	width: 120px;
	margin-right: 10px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.p_input {
	font-size: 13px;
	padding: 5px;
	width: 500px;
	border: 1px solid #CCCCCC;
}
</style>
<script src="jquery/jquery-1.4.4.js"></script>
<script LANGUAGE="JavaScript">
function tipo_op(form)
{
  if (form.tipo_pago.value == "Efectivo")
  { 
  form.importe_pago.disabled=false;
   } 
   else 
  { 
	form.importe_pago.disabled=true;
   } 
   
}
</script>
</head>

<body>
<?php
if (empty($_POST['accion'])){
	?>
<form actio="" method="post">
<div class="pregunta">
<?php

	$preg ="Como cancelo esta cuota?";

echo $preg;
?>
</div>
<select name="tipo_pago" onChange="tipo_op(this.form)" class="p_input" >
<option>Efectivo</option>
<option>Debito</option>
<option>Planilla</option>
<option>Contraprestacion</option>
<option selected="selected"><?php echo $data['tipo_pago']; ?></option>
</select>
<br /> Monto a Cancelar: <b>Debe $ <?php echo $debe_cuota; ?> de la cuota y $ <?php echo total_deuda_prestamo($clave_prestamo); ?> del total del prestamo</b>
<br />
<input type="text" name="importe_pago" disabled="disabled" class="p_input" />
<br />
<input type="submit" value="Guardar" name="accion" class="noquita_acc">
</form>
<?php
} else {
	
	if ($_POST['accion']=="Guardar"){
		
		if(!empty($_POST['tipo_pago'])){
		$tipo_pago = $_POST['tipo_pago'];
		$monto = $data['monto'];
		if ($tipo_pago != "Efectivo"){
		mysql_query ("update prestamos set tipo_pago = '$tipo_pago' where clave_prestamo = '$clave_prestamo'");
		mysql_query ("update prestamos set pagado = 'P' where clave_prestamo = '$clave_prestamo'");
		
		mysql_query ("insert into pagos_prestamos (pp_clave, pp_importe) values ('$clave_prestamo', '$monto')");
		} else {
			$importe_pago = $_POST['importe_pago'];
			if ($importe_pago < $debe_cuota){
			mysql_query ("insert into pagos_prestamos (pp_clave, pp_importe) values ('$clave_prestamo', '$importe_pago')");		
			}
			if ($importe_pago == $debe_cuota){
			mysql_query ("insert into pagos_prestamos (pp_clave, pp_importe) values ('$clave_prestamo', '$importe_pago')");	
			mysql_query ("update prestamos set tipo_pago = '$tipo_pago' where clave_prestamo = '$clave_prestamo'");
		mysql_query ("update prestamos set pagado = 'P' where clave_prestamo = '$clave_prestamo'");
			}
		}
		}
		}
	
	echo ' <script type="text/javascript">
parent.$.fn.colorbox.close();
	</script>';
	
}
	?>
</body>
</html>