<?php
$page = 'afiliados';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Listado de Afiliados</title>
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
</div>

<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
<div id="contanido">
<div id="cuerpo">
<div class="barri"><b><a href="nuevo_afiliado.php" title="Agregar un nuevo afiliado">Nuevo Afiliado</a> - <a href="listado_de_afiliados.php" title="armar listados de afiliados">Armar listados</a></b></div>
<form method="post" action="<?php echo $PHP_SELF; ?>">
<div class="subt"> Buscar afiliados: </div>
<div class="etiqueta">Nombre o Apellido a buscar:</div>
  <input name="busc" type="text" class="p_input" id="busc" placeholder="Ingreso un nombre o apellido" autocomplete="off"/>
<div class="etiqueta">o Nro de Legajo:</div>
  <input name="leg" type="text" class="p_input" id="leg" placeholder="Ingrese un número de legajo" autocomplete="off"/>
<div>
        <label><br>
	<input type="submit" name="Submit" value="Buscar Datos"/>
	</label><input type="hidden" name="act" value="si" />
	</div>
</form>
<hr />
<?php
if ($_POST['act']=="si" and (!empty($_POST['busc']) or !empty($_POST['leg']))){
	if (!empty($_POST['busc'])){
	$busq = $_POST['busc'];
	$filtro = '(nombre like ("%'.$busq.'%"))';
	$sql = "select * from afiliado where ".$filtro." order by nombre asc";
	$que = mysql_query($sql);
	$nn = mysql_num_rows($que);
	echo "Se encontraron ".$nn." coincidencias con la búsqueda <font color='ff0000'>".$busq."</font>"; 
 	} else {
	$busq = $_POST['leg'];
	$filtro = '(legajo = '.$busq.')';
	$sql = "select * from afiliado where ".$filtro;
	$que = mysql_query($sql);
	$nn = mysql_num_rows($que);
	echo "Se encontraron ".$nn." coincidencias con el legajo <font color='ff0000'>".$busq."</font>";
	}
	echo '<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
      <th>Nombre</th>
	  <th>Documento</th>
      <th>Activo</th>
	  <th>Legajo</th>
      <th>Ver</th>
    </tr>';
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($que);
	echo '<tr>
      <td>'.$dat{'nombre'}.'</td>
	  <td>'.$dat{'documento'}.'</td>
      <td>'.$dat{'activo'}.'</td>
	  <td>'.$dat{'legajo'}.'</td>
      <td><a href="datos_afiliado.php?clave='.$dat{'clave'}.'" title="ver mas datos de '.$dat{'nombre'}.'">Ver</a></td>
    </tr>';
	}
	echo '</table>';
}
?>


</div>
</div>
</body>
</html>
