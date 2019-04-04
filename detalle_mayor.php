<?php
include("secure2.php");
include("conecta.php");
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
 
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
		
      <th>Fecha</th>
	  <th>Asiento</th>
	  <th>Debe</th>
	  <th>Haber</th>
      <th>Detalle</th>
      
    </tr>
	<?php
  $d=0;
  $h=0;
  
 	$sq = "select * from asientos where (cuenta =".$id_cuentas .") order by fecha desc";
	$u=mysql_query($sq);
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>
      <td>'.substr($au['fecha'],8,2).'/'.substr($au['fecha'],5,2).'/'.substr($au['fecha'],0,4).'</td>';
	    echo '<td>'.$au['nro'].'</td>
		<td> $ '.$au['debe'].'</td>
		<td> $ '.$au['haber'].'</td>
		<td>'.$au['detalle'].'</td>
    </tr>';
	$d=$d+$au['debe'];
	$h=$h+$au['haber'];
	}
	?>
  </table>
  <div class = "resumen">
  <?php
  echo 'Total Debe = $ '.$d;
  echo '<br>';
  echo 'Total Haber = $ '.$h;
   echo '<br>';
   $sal = $h - $d;
  echo 'Saldo = $ '.$sal;
  ?>
  </div>
  <div class = "resumen">
    <a href="print_libro.php?id_cuentas=<?php echo $id_cuentas; ?>" target="_blank">Preparar este libro para imprimir</a>  </div> 
</div>

</div>
</body>
</html>
