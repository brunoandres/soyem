<?php
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Empresas</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
  window.alert("La cuenta se sgrego con exito");
</SCRIPT>';
  }
  ?>
 <link type="text/css" media="screen" rel="stylesheet" href="colorbox.css" />
		<script type="text/javascript" src="colorbox/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="colorbox/jquery.colorbox.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements

				$(".example6").colorbox({iframe:true, innerWidth:850, innerHeight:600});

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


<div class="barri"><b><a href="contabilidad.php" title="Ver ocrear libros diarios">Libro Diario </a> -  <a href="mayor.php" title="Ver el libro mayor">Libro Mayor</a> -  <a href="cuentas.php" title="armar listados de cuantas">Cuentas</a></b></div>
  <h1>Libro Mayor </h1>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>

      <th>Cuenta</th>
	  <th>Debe</th>
	  <th>Haber</th>
	 <th>Saldo</th>
      <th>Ver</th>

    </tr>
	<?php


	$sq = "select * from cuentas order by cuenta asc";
	$u=mysql_query($sq);
	$d=0;
	$h=0;
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>';

	    echo '<td>'.$au['cuenta'].'</td>';
		$id_cuentas = $au['id_cuentas'];
		$debe_c = 0;
		$haber_c = 0;
		$qcc = mysql_query("select * from asientos where cuenta ='$id_cuentas'");
		for ($a=0; $a<mysql_num_rows($qcc); $a++){
		$acc = mysql_fetch_array($qcc);
		$debe_c = $debe_c + $acc['debe'];
		$haber_c = $haber_c + $acc['haber'];
		}
		echo '<td> $ '.$debe_c.'</td>
		<td> $ '.$haber_c.'</td>';
		$d = $d + $debe_c;
		$h = $h + $haber_c;
		$ssa = $haber_c - $debe_c;
		echo '<td> $ '.$ssa.'</td>
		<td><a href="detalle_mayor.php?id_cuentas='.$au['id_cuentas'].'">Ver Detalles</a></td>
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
  </div>

</div>
</body>
</html>
