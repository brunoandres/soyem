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
$clave_empresa = $_POST['clave_empresa'];
$nombre = ($_POST['nombre']);
$domicilio = $_POST['domicilio'];
$localidad = $_POST['localidad'];
$telefono = $_POST['telefono'];
$cuit = $_POST['cuit'];
$tipo = $_POST['tipo'];
if (empty($clave_empresa)){
	$query = "insert into empresas (nombre, domicilio, localidad, telefono, cuit, tipo ) values ('$nombre', '$domicilio', '$localidad', '$telefono', '$cuit', '$tipo')";
	mysql_query($query);
	auditar($query);
	
echo "<p>Se agrago la empresa forma correcto</p>";
echo '<p><a href="nueva_empresa.php">Ingrasar una nueva empresa</a></p>';
} else {

$query = "update empresas set nombre='$nombre', domicilio='$domicilio', localidad='$localidad', telefono='$telefono', tipo='$tipo' where clave_empresa='$clave_empresa'";
mysql_query($query);
auditar($query);
/*mysql_query("update empresas set nombre='$nombre' where clave_empresa='$clave_empresa'");
mysql_query("update empresas set domicilio='$domicilio' where clave_empresa='$clave_empresa'");
mysql_query("update empresas set localidad='$localidad' where clave_empresa='$clave_empresa'");
mysql_query("update empresas set telefono='$telefono' where clave_empresa='$clave_empresa'");
mysql_query("update empresas set tipo='$tipo' where clave_empresa='$clave_empresa'");*/

echo "<p>Se modifico la empresa forma correcto</p>";
echo '<p><a href="nueva_empresa.php">Ingrasar una nueva empresa</a></p>';
}

?>
</div>
</body>
</html>