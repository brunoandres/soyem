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
  <h1>
  <?php
  if (!empty($_GET['fecha_desde']) && !empty($_GET['fecha_hasta'])) {
    $desde = date('d/m/Y', strtotime($_GET['fecha_desde']));
    $hasta = date('d/m/Y', strtotime($_GET['fecha_hasta']));
    $msj = '<h3>Filtrando desde el '.$desde.' hasta el '.$hasta.'</h3>';
  }else{
    $desde = NULL;
    $hasta = NULL;
    $msj='<h3> Sin filtros de fechas!</h3>';
  }

  echo 'Detalle de cuenta: '.$data['cuenta'].$msj;
  ?> </h1>

<table id="detalle_mayor" class="display" cellspacing="0" width="100%">
  <thead>
    <tr>

      <th>Fecha</th>
      <th>Asiento</th>
	    <th width="10%">Debe</th>
	    <th width="10%">Haber</th>
      <th>Nro Cheque</th>
      <th>Detalle</th>
    </tr>
    </thead>
	<?php
  $d=0;
  $h=0;

  if (!empty($_GET['fecha_desde']) && !empty($_GET['fecha_hasta'])) {
    $fecha_desde = date('Y-m-d', strtotime($_GET['fecha_desde']));
    $fecha_hasta = date('Y-m-d', strtotime($_GET['fecha_hasta']));
    $sq = "select * from asientos where (cuenta =".$id_cuentas ." and fecha >= '$fecha_desde' and fecha <= '$fecha_hasta') order by fecha desc";
  }else{
    $sq = "select * from asientos where (cuenta =".$id_cuentas .") order by fecha desc";
  }

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

<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>

<script src="js/buttons/jquery-3.3.1.js"></script>
<script src="js/buttons/jquery.dataTables.min.js"></script>
<script src="js/buttons/dataTables.buttons.min.js"></script>
<script src="js/buttons/jszip.min.js"></script>
<script src="js/buttons/pdfmake.min.js"></script>
<script src="js/buttons/vfs_fonts.js"></script>
<script src="js/buttons/buttons.html5.min.js"></script>

<script type="text/javascript" src="jquery/moment.min.js"></script>
<script type="text/javascript" src="jquery/datetime-moment.js"></script>

<script type="text/javascript" language="javascript" class="init">

  $(document).ready(function() {
    $.fn.dataTable.moment( 'DD/MM/YYYY' );
    $('#detalle_mayor').DataTable( {
        dom: 'Bfrtip',
        "language": {
          "url": "spanish.json"
        },
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }
        ],
        "order": [[ 1, "asc" ]],
        "ordering": true,
        "pageLength": 100
    } );
} );
</script>
</html>
