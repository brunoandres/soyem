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
	<h1> Va a CERRAR el ejercicio <?php echo $_GET['ejer_year']; ?></h1>
	<h3>De esta manera se de por finalizado este ejercicio y NO pueden producirse nuevos asientos para este periodo.</h3>
	<div class="veraza">ESTA OPERACION NO SE PUEDE DESHACER </div>
	<form action="" method="post" style="margin-top:20px;">
	<input type="submit" value="cerrar ejercicio" name="accion" class="quita_acc">
<input type="submit" value="mantener abierto" name="accion" class="noquita_acc">
<input type="hidden" name="ejer_year" value="<?php echo $_GET['ejer_year']; ?>">
</form>
<?php
} else {
	echo '<img src="../iconos/carfa.gif">';
	if ($_POST['accion']=="cerrar ejercicio"){
		
			 $tabla="CREATE TABLE `asientos_".$_POST['ejer_year']."` (
  `id_a` int(9) NOT NULL,
  `nro` int(6) NOT NULL,
  `fecha` date NOT NULL,
  `cuenta` int(6) NOT NULL,
  `debe` decimal(12,2) NOT NULL,
  `haber` decimal(12,2) NOT NULL,
  `detalle` mediumblob NOT NULL,
  `id_us` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `activo` varchar(2) NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;"; 
		mysql_query($tabla);
		$tabla1="ALTER TABLE `asientos_".$_POST['ejer_year']."`
  ADD PRIMARY KEY (`id_a`);";
			mysql_query($tabla1);
		$es_year = $_POST['ejer_year'];
		
		$txt = "SELECT * FROM asientos where YEAR(fecha) = '$es_year'";
		$query = mysql_query($txt);
			while ($data = mysql_fetch_array($query)) {
		$txt1 = "INSERT INTO asientos_".$es_year." (id_a, nro, fecha, cuenta, debe, haber, detalle, id_us, activo) values ('".$data['id_a']."', '".$data['nro']."', '".$data['fecha']."', '".$data['cuenta']."', '".$data['debe']."', '".$data['haber']."', '".$data['detalle']."', '".$data['id_us']."', '".$data['activo']."')";		
					mysql_query($txt1);
		$fecha = date("Y-m-d");
		$ejer_us = $_GET['us'];
		mysql_query("update cont_ejercicios set ejer_dia_cierre = '$fecha' where ejer_year = '$es_year'");
		mysql_query("update cont_ejercicios set ejer_estado = '0' where ejer_year = '$es_year'");
		mysql_query("update cont_ejercicios set ejer_us = '$ejer_us' where ejer_year = '$es_year'");	
		mysql_query("delete from asientos where YEAR(fecha) = '$es_year'");

			}
			
		}
	
	echo ' <script type="text/javascript">
parent.jQuery.fn.colorbox.close();
	</script>';
	
}
	?>
</body>
</html>