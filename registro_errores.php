<?php
$page = 'prestamos';
include("secure.php");
include("conecta.php");
include ("funciones_grales.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Listado de Afiliados</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').DataTable();
} );


	</script>
</head>

<body>
<?php
include("top_bar.php");
?>
<?php
include("menu.php");
?>
</div>
</div>
<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
<div id="contanido">
<div id="cuerpo">
<div class="barri">
<div class="actual_buto">Listado de Prestamos</div>


<div class="actual_buto"><a href="nuevo_prestamo.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a></div><div class="actual_buto"><a href="listado_banco.php" title="armar listados de prestamos debito">Armar listado Banco</a></div>
<div class="actual_buto"><a href="listado_muni.php" title="armar listados de prestamos muni">Armar listado Muni</a></div>
<div class="actual_buto"><a href="veraz.php" title="ir al veraz">Veraz</a></div>
<br clear="all" />
</div>
<h1>Registro de errores en Prestamos</h1>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
	<thead bgcolor="dddddd">
		<tr>
			<th>Legajo</th>
			<th>Nombre</th>
			<th>Fecha Prestamo</th>
			<th>Fecha Vencimiento</th>
			<th>Cuota</th>
			<th>Compara</th>
			<th>Ver</th>
		</tr>
	</thead>
	<tbody>
  <?php
  $tx = "SELECT * FROM prestamos WHERE vencimiento = '2017/04/01' AND pagado LIKE 'P'";
  		//$tx = "select * from prestamos where (pagado = 'P' and vencimiento =  '2017/04/01'))";
  		$query = mysql_query($tx);
  			while($a = mysql_fetch_array($query)){
  				$an_suma = floor((substr($a['fecha_prestamo'],5,2)+1 + $a['cuota'])/12);
  					if(substr($a['fecha_prestamo'],5,2)==12){
  							$fecha_in = (substr($a['fecha_prestamo'],0,4)+1).'/01/01';
  							$es_mes =  floor((((1 + $a['cuota'])/12) - floor((1 + $a['cuota'])/12))*12);
  								if ($es_mes == 0) {
  									$es_mes = 12;
  								}
  							$ven = (substr($a['fecha_prestamo'],0,4)+$an_suma).'/'.$es_mes.'/01';
  						} else {
  							$fecha_in = substr($a['fecha_prestamo'],0,4).'/'.(substr($a['fecha_prestamo'],5,2)+1).'/01';
  						$es_mes = floor(((((substr($a['fecha_prestamo'],5,2)+1) + $a['cuota'])/12) - floor ((((substr($a['fecha_prestamo'],5,2)+1) + $a['cuota']))/12))*12);
  								if ($es_mes == 0) {
  									$es_mes = 12;
  								}
  							$ven = (substr($a['fecha_prestamo'],0,4)+$an_suma).'/'.$es_mes.'/01';
  					}
  				if($a['vencimiento'] > $ven){
  					$vz_af = $a['afiliado'];
  					$tx1 = "select vz_id from veraz where vz_af = '$vz_af'";
  					$nnn = mysql_num_rows(mysql_query($tx1));
  					if ($nnn == 0){

  						$clave = $a['afiliado'];
  						$tx2 = "select * from afiliado where clave = '$clave'";
  						$aa = mysql_fetch_array(mysql_query($tx2));



  				echo '<tr>';
  					echo '<td>'.$aa['legajo'].'</td>';
  					echo '<td>'.$aa['nombre'].'</td>';
  					echo '<td>'.$a['fecha_prestamo'].'</td>';
  					echo '<td>'.$a['vencimiento'].'</td>';
  					echo '<td>'.$a['cuota'].'</td>';
  					echo '<td>'.$ven.'</td>';
  					echo '<td><a href="detalle_prestamos.php?clave_prestamo='.$a['clave_prestamo'].'">VER</a></td>';
  				echo '</tr>';
  			}

  			}
  			}
  ?>
</tbody>
</table>



 
</div>
</div>
</body>
</html>
