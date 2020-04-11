<?php
$page = 'contabilidad';
$subpage = 'ejercicios';
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
mysql_query("delete from asientos where activo='no'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8"/>
<title>Sistema Administrativo - Ejercicios Contables</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
  $(document).ready(function() {

    $('#ejercicios').DataTable({
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



<!--
 <link type="text/css" media="screen" rel="stylesheet" href="colorbox.css" />
		<script type="text/javascript" src="colorbox/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="colorbox/jquery.colorbox1.js"></script>
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
		<link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />-->

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
 <h3>Ejercicios Contables</h3>

	<?php
		$txt = "SELECT YEAR(fecha) FROM asientos group by YEAR(fecha) order by YEAR(fecha)";
		$query = mysql_query($txt);
			while ($data = mysql_fetch_array($query)) {
				$year = $data['YEAR(fecha)'];
				$nn = mysql_num_rows(mysql_query("select * from cont_ejercicios where ejer_year = '$year'"));
				if($nn == 0){
					mysql_query("insert into cont_ejercicios (ejer_year) values ('$year')");
				}
			}
	?>





  <table id="ejercicios" class="display" cellspacing="0" width="100%">
  	<thead>
    <tr>
	  <th>Año</th>
      <th>Estado</th>
	  <th>Cierre</th>
	  <th>Usuario</th>
	  <th>Cerrar</th>
    </tr>
    </thead>
    <?php
    	$txt1 = "SELECT * FROM cont_ejercicios order by ejer_year";
		$query1 = mysql_query($txt1);
			while ($data1 = mysql_fetch_array($query1)) {
				$anio = $data1['ejer_year'];
				echo '<tr>';
					echo '<td>'.$anio.'</td>';
						if($data1['ejer_estado']==0){
							$estado = '<div class ="ejercicio_cerrado">CERRADO</div>';
							$cierre = $data1['ejer_dia_cierre'];
							$ejer_us = $data1['ejer_us'];

							$link = '<a href="detalle.php?fecha='.$anio.'"><button>Ver detalle</button></a>';

						} else {
							$estado = '<div class ="en_ejercicio">EN EJERCICIO</div>';
							$cierre = "";
							$ejer_us = "";
							$link ='<a href="recortes/cerrar_ejercicio.php?ejer_year='.$data1['ejer_year'].'&us='.$_SESSION['usuario'].'" class="example6" id="cerrarejercicio">Cerrar Ejercicio</a>';
						}
						echo '<td>'.$estado.'</td>';
						echo '<td>'.$cierre.'</td>';
					echo '<td>'.$ejer_us.'</td>';
					echo '<td align="center">'.$link.'</td>';
				echo '</tr>';
			}
			?>
	</table>

  </div>
</div>
</body>
</html>
