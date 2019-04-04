<?php
include("../conecta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Ejercicios Contables</title>
<link href="../estilos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../colorbox/jquery-1.3.2.js"></script>
<style type="text/css">
body {
	background: #fff;
}
.quita_acc {
	line-height: 24px;
	font-weight: bold;
	text-transform: uppercase;
	color: #FFF;
	background-color: #F00;
	text-align: center;
	width: 220px;
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
	width: 220px;
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
	
	<h3>Va a colocar a este afiliado entre los que solo pueden pedir prestamos POR PLANILLA DE DESCUENTO.</h3>

	<form action="" method="post" style="margin-top:20px;">
	<input type="submit" value="colocar" name="accion" class="quita_acc">
<input type="submit" value="no colocar" name="accion" class="noquita_acc">
<input type="hidden" name="clave" value="<?php echo $_GET['clave']; ?>">
</form>
<?php
} else {
	if($_POST['accion']=="colocar"){
	$clave = $_GET['clave'];
		mysql_query("insert into solo_descuento (sd_afiliado) values ('$clave')");
	}
	echo ' <script type="text/javascript">
parent.jQuery.fn.colorbox.close();
	</script>';
	
}
	?>
</body>
</html>