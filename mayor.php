<?php
$page = 'contabilidad';
$subpage = 'mayor';
include("secure2.php");
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
  window.alert("El rubro se agrego con exito");
</SCRIPT>';
  }
    if ($_GET['mostrar']==2){
  echo '<SCRIPT>
  window.alert("La cuenta se agrego con exito");
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
<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
<div id="contanido">

<div id="cuerpo">


<?php include("recortes/menu_cont.php"); ?>
  <h1>Libro Mayor </h1>
  <form method="post" action="" style="background:#EEEEEE; padding:10px; margin-bottom:10px">
  Desde: <input type="text" name="desde" id="desde" class="p_input_corto" value="<?php echo $_POST['desde']; ?>" autocomplete="off"/>
   <script type="text/javascript">
    Calendar.setup({
        inputField     :    "desde",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1    ,
        singleClick    :" true"            // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
  Hasta: <input type="text" name="hasta" id="hasta" class="p_input_corto" value="<?php echo $_POST['hasta']; ?>" autocomplete="off"/>
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "hasta",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1     ,
        singleClick    :" true"           // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
  <input type="submit" name="enviar" value="filtrar" />
  </form>
  <table id="mayor" class="display" cellspacing="0" width="100%">
  	<thead>
    	<tr>
	      <th>Cuenta</th>
		  <th>Debe</th>
		  <th>Haber</th>
	 	  <th>Saldo</th>
	      <th>Ver</th>
	      <th>Historial</th>    
    	</tr>
    </thead>
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
		if (empty($_POST['desde']) and empty($_POST['hasta'])){
		$qcc = mysql_query("select * from asientos where cuenta ='$id_cuentas'");
		}
		if (!empty($_POST['desde']) and empty($_POST['hasta'])){
		$desde = substr($_POST['desde'],6,4).'/'.substr($_POST['desde'],3,2).'/'.substr($_POST['desde'],0,2);
		$qcc = mysql_query("select * from asientos where (cuenta ='$id_cuentas' and fecha >= '$desde')");
		}
		if (empty($_POST['desde']) and !empty($_POST['hasta'])){
		$hasta = substr($_POST['hasta'],6,4).'/'.substr($_POST['hasta'],3,2).'/'.substr($_POST['hasta'],0,2);
		$qcc = mysql_query("select * from asientos where (cuenta ='$id_cuentas' and fecha <= '$hasta')");
		}
		if (!empty($_POST['desde']) and !empty($_POST['hasta'])){
		$hasta = substr($_POST['hasta'],6,4).'/'.substr($_POST['hasta'],3,2).'/'.substr($_POST['hasta'],0,2);
		$desde = substr($_POST['desde'],6,4).'/'.substr($_POST['desde'],3,2).'/'.substr($_POST['desde'],0,2);
		$qcc = mysql_query("select * from asientos where (cuenta ='$id_cuentas' and fecha <= '$hasta' and fecha >= '$desde')");
		}
		
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
		<td><a href="historico_mayor.php?id_cuentas='.$au['id_cuentas'].'">Ver Historico</a></td>
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
<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
<script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
  $(document).ready(function() {
  
    $('#mayor').DataTable({
    	"pageLength":50,
      	"language": {
          "url": "spanish.json"
        }
    });
} );
</script>
</body>
</html>
