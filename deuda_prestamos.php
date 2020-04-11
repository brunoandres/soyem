<?php
$page = 'contabilidad';
$subpage = 'deuda_prestamo';
include("secure2.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
mysql_query("delete from asientos where activo='no'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Contabilidad</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
  $(document).ready(function() {

    $('#deuda_prestamos').DataTable({
      "language": {
          "url": "spanish.json"
        }
    });
} );
</script>

<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
}
</script>
<?php
  if ($_GET['mostrar']==1){
  echo '<SCRIPT>
  window.alert("El rubro se sgrego con exito");
</SCRIPT>';
  }
    if ($_GET['mostrar']==2){
  echo '<SCRIPT>
  window.alert("La cuenta se agrego con exito");
</SCRIPT>';
  }
  ?>

	<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements

				$(".example6").colorbox({iframe:true, innerWidth:950, innerHeight:520});

				  $().bind('cbox_closed',function() {
      location.reload(true);
   });

				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
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


<?php include("recortes/menu_cont.php"); ?>
<h1>Deuda por prestamos por planilla a un Año especifico </h1>
  <form action="<?php echo $PHP_SELF; ?>" method="post">
	<div class="etiqueta">Fecha de Corte:</div>
    <input type="text" name="corte" class="p_input" id="corte" autocomplete="off" readonly="" placeholder="Seleccione una fecha">
	<script type="text/javascript">
    Calendar.setup({
        inputField     :    "corte",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1        ,
        singleClick    :    " true"         // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<br>
<br>
    <button type="submit">Listar</button>
	</form>
	<br>
<br>
<?php
	if(isset($_POST['corte']) and !empty($_POST['corte'])){
		$corte = substr($_POST['corte'],6,4).'-'.substr($_POST['corte'],3,2).'-'.substr($_POST['corte'],0,2);
		?>
  <table id="deuda_prestamos" class="display" cellspacing="0" width="100%">
  	<thead>
    <tr>
	  <th>Fecha Prestamo</th>
      <th>Afiliado</th>
	  <th>Vencimiento</th>
	  <th>Importe</th>
	  <th>Deudor</th>
	  <th>Ver</th>
    </tr>
    </thead>
	<?php
	$query = mysql_query("SELECT * FROM prestamos where (fecha_prestamo <= '$corte' and tipe_p = 'M' and vencimiento > '$corte')");
	$tot_muni = 0;
	$tot_afi = 0;
	while ($data = mysql_fetch_array($query)){
		echo '<tr>';
		echo '<td>'.$data['fecha_prestamo'].'</td>';

		echo '<td>'.$data['afiliado'].'</td>';
		echo '<td>'.$data['vencimiento'].'</td>';
		echo '<td align="right"> $ '.$data['monto'].'</td>';
		if($data['pagado']=="P"){
			echo '<td>Municipio</td>';
			$tot_muni = $tot_muni + $data['monto'];
		} else {
			echo '<td>Afiliado</td>';
			$tot_afi = $tot_afi + $data['monto'];
		}
		echo '<td><a href="detalle_prestamos.php?clave_prestamo='.$data['clave_prestamo'].'" target="_blank">ver</a></td>';
		echo '</tr>';
	}
	?>
  </table>
  <div class = "resumen">
    Total Municipalidad: <?php echo $tot_muni; ?> - Total Afiliado <?php echo $tot_afi; ?>
  </div>
	<?php } ?>
</div>
</body>
</html>
