<?php
$page = 'prestamos';
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Veraz</title>
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


<div class="actual_buto"><a href="prestamos.php" title="listado de prestamos">Listado de Prestamos</a></div>
<div class="actual_buto"><a href="nuevo_prestamo.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a></div><div class="actual_buto"><a href="listado_banco.php" title="armar listados de prestamos debito">Armar listado Banco</a></div>
<div class="actual_buto"><a href="listado_muni.php" title="armar listados de prestamos muni">Armar listado Muni</a></div>
<div class="actual_buto">Veraz</div>
<br clear="all" />
</div>
<h1>Veraz</h1>
  




 <table id="example" class="display" cellspacing="0" width="100%">
				<thead>
    <tr>
	 <th>Fecha</th>
      <th>Afiliado</th>
      <th>Ver Prestamo</th>
	  <th>Sacar del Veraz</th>
    </tr>
    </thead>
            
            <tbody>
	<?php
	
	$sq = "select * from veraz INNER JOIN afiliado ON veraz.vz_af = afiliado.clave order by veraz.vz_date asc ";
	
	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	echo '<td>'.$dat['vz_date'].'</td>';
	echo '<td>'.$dat['nombre'].'</td>';
	
	  echo '<td><a href="detalle_prestamos.php?clave_prestamo='.$dat{'vz_pres'}.'" title="ver mas datos de '.$dat{'nombre'}.'">Ver</a></td>
	  <td><a href="sacar_veraz.php?vz_id='.$dat{'vz_id'}.'" title="Sacar del veraz">Sacar del Veraz</a></td>
    </tr>';
	}
	
?></table>
</div>
</div>
</body>
</html>
