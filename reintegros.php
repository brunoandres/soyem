<?php
include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Reintegros</title>
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
<div class="barri"><b><a href="nuevo_reintegro.php" title="Agregar un nuevo reintegro">Nuevo Reintegro </a> - <a href="#" title="armar listados de afiliados">Armar listados</a></b></div>
<h1>Listado de Reintegros </h1>

 <table id="example" class="display" cellspacing="0" width="100%">
				<thead>
    <tr>
	 <th>Fecha</th>
      <th>Nombre</th>
	  <th>Legajo</th>
     
	  <th>Tipo</th>
	  
	   <th>Importe</th>
	   <th>Pago</th>
      <th>Ver</th>
	  <th>Quitar</th>
    </tr>
    </thead>
     <tbody>
	<?php
	$tam = 50; 



	$sq = "select * from reintegros order by fecha_rei desc";
	
	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	$clave = $dat['legajo_rei'];
	$id_re_li = $dat['id_re_li'];
	$d_afiliado = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$clave'"));
	$d_pres = mysql_fetch_array(mysql_query("select * from reintegros_li where id_re_li = '$id_re_li'"));
	echo '<tr>
      <td>'.substr($dat{'fecha_rei'},8,2).'/'.substr($dat{'fecha_rei'},5,2).'/'.substr($dat{'fecha_rei'},0,4).'</td>
	  <td>'.$d_afiliado{'nombre'}.'</td>
      <td>'.$d_afiliado{'legajo'}.'</td>
	  <td>'.$d_pres['descripcion'].'</td>';
	 
	 
	   echo '<td align="right">$ '.$dat['importe_rei'].'</td>';
	    echo '<td> '.$dat['m_pago'].'</td>';
	  echo '<td><a href="detalle_reintegros.php?id_reintegro='.$dat{'id_reintegro'}.'" title="ver detalles de este reintegro">Ver</a></td>
	  <td><a href="detalle_reintegros.php?id_reintegro='.$dat{'id_reintegro'}.'" title="Quitar este reintegro">Quitar</a></td>
    </tr>';
	}
	
?>
</tbody>
</table>

</div>
</div>
</body>
</html>
