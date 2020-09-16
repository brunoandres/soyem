<?php
$page = 'prestamos';
include("secure1.php");
include("conecta.php");
//include ("funciones_grales.php");
$seccion=$_SESSION['seccion'];
if ($seccion != 'Tesoreria') {
  header("location: ../afiliados/prestamos.php");
}
function total_prestamo($clave, $tot_cuotas){
  $tot = 0;
  for($i=0; $i<$tot_cuotas; $i++){
    $id_dat = $clave + $i;
    $txt = "select monto from prestamos where clave_prestamo = ".$id_dat;
    $a_dat = mysql_fetch_row(mysql_query($txt));
    $tot = $tot + $a_dat[0];
  }
  $tot = number_format($tot, 2, ',', '.');
  return $tot;
}
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
	$('#example').DataTable({
		"language": {
          "url": "spanish.json"
        }
	});
} );
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
<?php include 'footer.php'; ?>
<div id="contanido">
<div id="cuerpo">
<div class="barri">


  <div class="actual_buto"><a href="prestamos.php" title="listado de prestamos">Listado de Prestamos</a></div>
  <?php if ($seccion=='Tesoreria'): ?>
  <div class="actual_buto">Entre fechas</div>
  <?php endif ?>
  <div class="actual_buto"><a href="nuevo_prestamo.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a></div><div class="actual_buto"><a href="listado_banco.php" title="armar listados de prestamos debito">Armar listado Banco</a></div>
  <div class="actual_buto"><a href="listado_muni.php" title="armar listados de prestamos muni">Armar listado Muni</a></div>
  <div class="actual_buto"><a href="listado_muni.php" title="veraz">Veraz</a></div>
  <br clear="all" />
</div>
<h1>Filtrar Préstamos entre fechas</h1>

<form action="<?php echo $PHP_SELF; ?>" method="get">

	<div class="etiqueta">Fecha desde:</div>
    <input type="text" name="desde" class="p_input" value="<?php echo $_GET["desde"];?>" id="desde" placeholder="Seleccione fecha desde" autocomplete="off" readonly>
	<script type="text/javascript">
    Calendar.setup({
        inputField     :    "desde",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1  ,
        singleClick    :    " true"                   // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
    <div class="etiqueta">Fecha hasta:</div>
    <input tipe ="text" name="hasta" value="<?php echo $_GET["hasta"];?>" class="p_input" id="hasta" placeholder="Seleccione fecha hasta" autocomplete="off" readonly>
	<script type="text/javascript">
    Calendar.setup({
        inputField     :    "hasta",      // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1      ,
        singleClick    :    " true"          // show all years in drop-down boxes (instead of every other year as default)
    });
</script>

<input type="submit" value="Buscar" />
  </form>

<br>
 <table id="example" class="display" cellspacing="0" width="100%">
				<thead>
    <tr>
	 <th>Fecha Prestamo</th>
      <th>Nombre</th>
	  <th>Legajo</th>
      <th>Proveedor</th>
	  <th>Tipo</th>
      <th>Pago</th>
	  <th>Cuotas</th>
	   <th>Importe</th>
      <th>Ver</th>
    </tr>
    </thead>

            <tbody>
	<?php

	if (!empty($_GET["desde"]) && !empty($_GET["hasta"])) {
		$fecha_desde = $_GET["desde"];
		$fecha_hasta = $_GET["hasta"];

		$sq = "select * from prestamos INNER JOIN afiliado ON prestamos.afiliado = afiliado.clave where fecha_prestamo between '".$fecha_desde."' and '".$fecha_hasta."'
group by prestamos.vale order by prestamos.vencimiento desc";
	}else{
		$sq = "select * from prestamos INNER JOIN afiliado ON prestamos.afiliado = afiliado.clave   
group by prestamos.vale order by prestamos.vencimiento desc limit 1";
	}


	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	echo '<td>'.substr($dat['fecha_prestamo'],8,2).'/'.substr($dat['fecha_prestamo'],5,2).'/'.substr($dat['fecha_prestamo'],0,4).'</td>';
	echo '<td>'.$dat['nombre'].'</td>';
  echo '<td>'.$dat['legajo'].'</td>';
  $clave_empresa = $dat['proveedor'];
  $d_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
  if ($clave_empresa !=0){
  $empresa = $d_empresa['nombre'];
  } else {
  $empresa = '<b>SOYEM</b>';
  }
  switch ($dat['tipe_p']){
    case 'D':
    $ttip = "Debito Banco";
    break;
    
    case 'M':
    $ttip = "Descuento Planilla";
    break;
    
    case 'P':
    $ttip = "Prestamo salud";
    break;
  }
  echo '<td>'.$empresa.'</td>';
  echo '<td>'.$ttip.'</td>';

  
    if($dat['efectivo']=='X'){
    $resp = 'Efectivo';
    }
    if($dat['banco']=='X'){
    $resp = 'Cheque';
    }
    if($dat['vale_pro']=='X'){
    $resp = 'Proveedor';
    }
    if($dat['turismo']=='X'){
    $resp = 'Turismo';
    }
    echo '<td>'.$resp.'</td>';
    echo '<td>'.$dat['num_cuotas'].'</td>';
    echo '<td>'.total_prestamo($dat['clave_prestamo'],$dat['num_cuotas']).'</td>';
    
    

	  echo '<td><a href="detalle_prestamos.php?clave_prestamo='.$dat{'clave_prestamo'}.'" title="ver mas datos de '.$dat{'nombre'}.'">Ver</a></td>
	  
    </tr>';
	}

?></table>
</div>
</div>
</body>
</html>
