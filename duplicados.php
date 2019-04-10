<?php
$page = 'duplicados';
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Duplicados</title>
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
<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
</div>
<div id="contanido">

<div id="cuerpo">


<h1>Legajos duplicados en el Sistema: </h1>
<table id="example" class="display" cellspacing="0" width="100%">
	<thead>
    <tr>
		
      <th>Legajos</th>
	  <th>Afiliados</th>
	  <th>Juntar</th>
      
    </tr>
    </thead>
    <tbody>
 <?php
 	$query = mysql_query("SELECT legajo, nombre, clave, COUNT(legajo) as tot  FROM afiliado GROUP BY legajo");
 	while($data = mysql_fetch_array($query)){
 		if($data['tot']>1){
 			$legajo = $data['legajo'];
 			echo '<tr>';
 			echo '<td>'.$legajo.'</td>';
 				$afi="";
 				$query1 = mysql_query("SELECT legajo, nombre, clave  FROM afiliado WHERE legajo = '$legajo'");
 				while($data1 = mysql_fetch_array($query1)){
 					$afi .= $data1['nombre'].'  |  ';
 				}
 			echo '<td>'.$afi.'</td>';
 			echo '<td><a href="juntar.php?legajo='.$legajo.'">Juntar</a></td>';
 			echo '</tr>';
 		}
 	}
 	
 ?>
</tbody>
</div>
</div>
</body>
</html>
