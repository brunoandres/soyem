<?php
$page = 'contabilidad';
include("secure2.php");
include("conecta.php");
include("funciones_grales.php");
$funcion_r=$_SESSION['funcion'];
$id_cuentas = $_GET['id_cuentas'];
$data =  mysql_fetch_array(mysql_query("select * from cuentas where id_cuentas = '$id_cuentas'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalle mayor</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />

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
  <h1>
  <?php
  echo 'Detalle de cuenta: '.$data['cuenta'];
  ?> </h1>
   <form action="<?php echo $PHP_SELF; ?>" method="post">
   
	<div class="etiqueta">Desde:</div>
    <input type="text" name="desde" class="p_input" id="desde">
	<script type="text/javascript">
    Calendar.setup({
        inputField     :    "desde",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
    <div class="etiqueta">Hasta:</div>
    <input tipe ="text" name="hasta" class="p_input" id="hasta">
	<script type="text/javascript">
    Calendar.setup({
        inputField     :    "hasta",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<br>
<input type="submit" class="boton_form" value="Buscar" />
<br>
  </form>
 <?php
 if(isset($_POST['desde'])){
 	$desde = fecha_dev1($_POST['desde']);
 } else {
 	$desde = "1900-01-01";
 }
//echo $desde;
 if(isset($_POST['hasta'])){
 	$hasta = fecha_dev1($_POST['hasta']);
 } else {
 	$hasta = date("Y-m-d");
 }
 //echo $hasta;
 	$query_periodo = mysql_query("SELECT ejer_year FROM cont_ejercicios where ejer_estado = '0' order by ejer_year desc");
 		
 		?>
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
		
      <th>Fecha</th>
	  <th>Asiento</th>
	  <th>Debe</th>
	  <th>Haber</th>
      <th width="60%">Detalle</th>
      
    </tr>
	<?php
  $d=0;
  $h=0;

 	$sq = "select * from asientos where (cuenta =".$id_cuentas." and fecha >= '".$desde."' and fecha <= '".$hasta."') order by fecha desc";
// 	echo $sq;
	$u=mysql_query($sq);
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>
      <td>'.fecha_dev($au['fecha']).'</td>';
	    echo '<td>'.$au['nro'].'</td>
		<td align="right"> $ '.number_format($au['debe'],2,",",".").'</td>
		<td align="right"> $ '.number_format($au['haber'],2,",",".").'</td>
		<td>'.$au['detalle'].'</td>
    </tr>';
	$d=$d+$au['debe'];
	$h=$h+$au['haber'];
	}

	while($dat_ejer = mysql_fetch_array($query_periodo)){
 			$ejer = "asientos_".$dat_ejer['ejer_year'];
 			$sqe_txt = "select * from ".$ejer." where (cuenta =".$id_cuentas." and fecha >= '".$desde."' and fecha <= '".$hasta."') order by fecha desc";
 			$sqe = mysql_query($sqe_txt);
 				while($aqe = mysql_fetch_array($sqe)){
 					echo'<tr>
					      <td>'.fecha_dev($aqe['fecha']).'</td>';
						    echo '<td>'.$aqe['nro'].'</td>
							<td align="right"> $ '.number_format($aqe['debe'],2,",",".").'</td>
							<td align="right"> $ '.number_format($aqe['haber'],2,",",".").'</td>
							<td>'.$aqe['detalle'].'</td>
					    </tr>';
					$d=$d+$aqe['debe'];
					$h=$h+$aqe['haber'];
 				}


 			//echo $ejer.'  ';
 		}
	?>
  </table>
  <div class = "resumen">
  <?php
  echo 'Total Debe = $ '.number_format($d,2,",",".");
  echo '<br>';
  echo 'Total Haber = $ '.number_format($h,2,",",".");

  $sal = $h - $d;
   if($d!=$h){
    echo '<h3 style="color:red;">Los importes no coinciden</h3>';
  }
  echo '<h3 style="color:red;">Saldo = $ '.number_format($sal,2,",",".").'</h3>';
  ?>
  </div>
  <div class = "resumen">
    <a href="print_libro.php?id_cuentas=<?php echo $id_cuentas; ?>" target="_blank">Preparar este libro para imprimir</a>  </div> 
</div>

</div>
</body>
</html>
