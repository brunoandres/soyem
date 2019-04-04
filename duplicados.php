<?php
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
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
		
      <th>Legajos</th>
	  <th>Afiliados</th>
	  <th>Juntar</th>
      
    </tr>
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
</div>
</div>
</body>
</html>
