<?php
$page = 'reintegros';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];

if ($_SESSION["usuario"] != "magui.galaz" and $_SESSION["usuario"] != "miryam.espeche" and $_SESSION["usuario"] != "sandra.quiñehual" and $_SESSION["usuario"] != "graciela.huen") { 
  header("Location:index.php?error=3"); 
  exit(); 
}

if (isset($_POST['nivel'])) {
	if ($_POST['nivel']=='PRIMARIA' or $_POST['nivel']=='JARDIN' or $_POST['nivel']=='SECUNDARIA') {
		$nivel = $_POST['nivel'];
		$sql =  "and kit = '$nivel'";
	}else{
		$sql = ' ';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Utiles Primaria</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').DataTable({
		"language": {
            "url": "spanish.json"
        	}
	});
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
<?php include 'footer.php'; ?>
<div id="contanido">
<div id="cuerpo">
<div class="barri"><b><a href="listado_utiles.php" title="Agregar un nuevo reintegro">Listado Utiles </a></b></div>
<h1 style="color:red;">Listado de Utiles a entregar </h1>

<form action="utiles_a_entregar.php" method="POST">
	<select name="nivel" id="">
		<option value="">Todos los niveles</option>
		<option value="JARDIN" selected>JARDIN</option>
		<option value="PRIMARIA">PRIMARIA</option>
		<option value="SECUNDARIA">SECUNDARIA</option>
	</select>
	<input type="submit" value="Seleccionar" />
</form>
<br />

 <table id="example" class="display" cellspacing="0" width="100%">
	<thead>
	    <tr>
	    	<th>Legajo</th>
	 		<th>Afiliado</th>
	      	<th>Nombre Familiar</th>
		  	<th>Kit a entregar</th>
		  	<th>Opciones</th>
	    </tr>
    </thead>
     <tbody>
	<?php

	$sq = "select legajo,kit,familiar as afiliado,nombre_familiar from v_utiles where not id_fam in (select id_familiar from legajos_utiles) $sql order by afiliado asc";

	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	
	echo '<tr>
      <td>'.$dat{'legajo'}.'</td>
	  <td>'.$dat{'afiliado'}.'</td>
      <td>'.$dat{'nombre_familiar'}.'</td>
	  <td>'.$dat['kit'].'</td>
	  <td><a href="listado_utiles.php?legajo='.$dat{'legajo'}.'">Agregar</a></td>';

	 
	 
	   echo '</tr>';
	}
	
?>
</tbody>
</table>

</div>
</div>
</body>
</html>
