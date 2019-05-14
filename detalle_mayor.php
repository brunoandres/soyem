<?php
$page = 'contabilidad';
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

  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
  $(document).ready(function() {
  
    $('#detalle_mayor').DataTable({
      "language": {
          "url": "spanish.json"
        },
        "pageLength": 100
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
<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
<div id="contanido">

<div id="cuerpo">
  <h1>
  <?php
  echo 'Detalle de cuenta: '.$data['cuenta'];
  ?> </h1>
 
<table id="detalle_mayor" class="display" cellspacing="0" width="100%">
  <thead>
    <tr>
		
      <th>Fecha</th>
      <th>Asiento</th>
	    <th>Debe</th>
	    <th>Haber</th>
      <th>Nro Cheque</th>
      <th>Detalle</th>   
    </tr>
    </thead>
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
    <td>'.$au['cheque'].'</td>
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

  if($d!=$h){
    echo '<h3 style="color:red;">Los importes no coinciden</h3>';
  }
   
  $sal = $h - $d;
  echo '<h3 style="color:red;">Saldo = $ '.$sal.'</h3>';
  ?>
  </div>
  <div class = "resumen">
    <a href="print_libro.php?id_cuentas=<?php echo $id_cuentas; ?>" target="_blank">Preparar este libro para imprimir</a>  </div> 
</div>

</div>
</body>
</html>
