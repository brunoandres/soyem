<?php
$page = 'prestamos_viviendas';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Listado de Afiliados</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
} 
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>
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
<div class="barri"><b><a href="nuevo_prestamo_v.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a> - <a href="listado_prestamos_v.php" title="armar listados de afiliados">Armar listados</a></b></div>
<h1>Listado de prestamos para viviendas 2013 </h1>
<form action="prestamos_viviendas.php" method="get">
<div id="filtros">
    <strong>  Filtrar por:</strong>
  <hr />
  Afiliado:
<select name="afiliado" onchange="submit()">
<?php
  $pfa_tx = "select * from afiliado where clave = ".$_GET['afiliado'];
  $pfa = mysql_fetch_array(mysql_query($pfa_tx));
  echo "<option selected='selected' value='".$_GET['afiliado']."'>".$pfa['nombre']."</option>";
  ?>
  <?php
   $fa_tx = "select * from afiliado INNER JOIN prestamos_viviendas ON prestamos_viviendas.afiliado = afiliado.clave group by afiliado.clave order by afiliado.nombre asc";
  $qfa = mysql_query($fa_tx);
  echo '<option value="">Todos</option>';
  for($ea=0;$ea<mysql_num_rows($qfa);$ea++){
  $afa = mysql_fetch_array($qfa);
  echo '<option value="'.$afa['clave'].'">'.$afa['nombre'].'</option>';
  }
  
  ?>
</select>
<?php
  if(empty($_GET['fecha_desde'])){
  $fecha_desde = '01/'.date("m").'/'.date("Y");
  } else {
  $fecha_desde = $_GET['fecha_desde'];
  }
  ?>
<br />

Fecha Desde:  
<input name="fecha_desde" id="fecha_desde" placeholder="Desde" value="<?php echo $fecha_desde; ?>" />
  
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_desde",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script> 
   Hasta: 
      <?php
   if ($_GET['fecha_hasta']>0){
   echo '<input name="fecha_hasta" id="fecha_hasta" placeholder="Hasta" value="'.$_GET['fecha_hasta'].'" />';
   } else {
   echo '<input name="fecha_hasta" id="fecha_hasta" placeholder="Hasta" />';
   }
   ?>
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_hasta",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script> 
   <input name="aplicar" type="submit" class="apli" value="Aplicar" />
  </div>





<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
	 <th>Prox Vencimiento</th>
	 <th>Cuota</th>
      <th>Nombre</th>
	  <th>Documento</th>
      <th>Cuotas</th>
	   <th>Importe</th>
      <th>Ver</th>
	   <th>Quitar</th>
    </tr>
	<?php
	$tam = 50; 


if (empty($_GET['pagina'])) { 
$inicio = 0; 
$pagina=1; 
} 
else { 
	$pagina=$_GET['pagina'];
$inicio = ($pagina - 1) * $tam; 
}
	$desde = substr($fecha_desde,6,4).'-'.substr($fecha_desde,3,2).'-'.substr($fecha_desde,0,2);

	$sq .= "select * from prestamos_viviendas where (vencimiento >= '".$desde."' ";



if (!empty($_GET['fecha_hasta'])){
	$hasta = substr($_GET['fecha_hasta'],6,4).'-'.substr($_GET['fecha_hasta'],3,2).'-'.substr($_GET['fecha_hasta'],0,2);
	$sq .= "and vencimiento <= '".$hasta."' ";
	
}



if (!empty($_GET['afiliado'])){
	$afiliado = $_GET['afiliado'];
	$sq .= "and afiliado = '".$afiliado."' ";
	
}

	$sql = $sq.")";
	$sq .=" ) order by vencimiento asc limit " . $inicio . "," . $tam;
	
	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	$clave = $dat['afiliado'];
	$d_afiliado = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$clave'"));
	echo '<tr>
      <td>'.substr($dat{'vencimiento'},8,2).'/'.substr($dat{'vencimiento'},5,2).'/'.substr($dat{'vencimiento'},0,4).'</td>
	  <td>'.$dat{'cuota'}.'</td>
	  <td>'.$d_afiliado{'nombre'}.'</td>
      <td>'.$d_afiliado{'documento'}.'</td>';
	  echo '<td align="center">'.$dat['num_cuotas'].'</td>';
	   echo '<td align="right">$ '.$dat['monto'].'</td>';
	  echo '<td><a href="detalle_prestamos_v.php?clave_prestamo='.$dat{'clave_prestamo'}.'" title="ver mas datos de '.$dat{'nombre'}.'">Ver</a></td>
	  <td><a href="quitar_prestamo_v.php?clave_prestamo='.$dat{'clave_prestamo'}.'" title="Quitar este prestamo"onclick="return confirmar(';
	   echo "'�Est� seguro que desea quitar este prestamo?'";
	  echo ')" >Quitar Prestamo</a></td>
    </tr>'; 
	}
	
?></table>
<div id="nave">
<?php
$top = (($pagina) * $tam );
$nt = mysql_num_rows(mysql_query($sql));
$domain = $_SERVER['HTTP_HOST'];  
$url = "http://" . $domain . $_SERVER['REQUEST_URI'];
if($pagina >1){
$pagina = $_GET['pagina'] - 1; 
?>
    <a href="<?php echo $url; ?>&pagina=<?php echo $pagina; ?>" class="ant">Anterior</a>
  <?php
  }
  ?>
<?php
if($nt >$top){
if(empty($_GET['pagina'])){
$pagina = 2;
} else {
$pagina = $_GET['pagina'] + 1; 
}
?>
 
 
  
  <a href="<?php echo $url; ?>&pagina=<?php echo $pagina; ?>" class="sig">Siguiente</a>
  <?php
  }
  ?>
</div>
</div>
</form>
</div>
</body>
</html>
