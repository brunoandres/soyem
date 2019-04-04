<?php
include ("conecta.php");
$clave_prestamo = $_GET['clave_prestamo'];
$dat = mysql_fetch_array(mysql_query("select * from prestamos INNER JOIN afiliado ON prestamos.afiliado = afiliado.clave where prestamos.clave_prestamo = '$clave_prestamo' "));
$clave = $dat['clave'];
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
</style>
</head>

<body>
<?php
if (empty($_POST['accion'])){
	?>
<form action="" method="post">
<div class="pregunta">
<?php

	$preg ="Desea poner en el VERAZ a <b>".$dat['nombre']."</b>?";

echo $preg;
?>
</div>
<input type="submit" value="Poner" name="accion" class="quita_acc">
<input type="submit" value="No Poner" name="accion" class="noquita_acc">
</form>
<?php
} else {
	
	if ($_POST['accion']=="Poner"){
		
		
		mysql_query ("insert into veraz (vz_af, vz_pres) values ('$clave','$clave_prestamo')");
		
		
		
		}
	
	echo ' <script type="text/javascript">
parent.$.fn.colorbox.close();
	</script>';
	
}
	?>
</body>
</html>