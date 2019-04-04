<?php
$page = 'contabilidad';
include("secure2.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
mysql_query("delete from asientos where activo='no'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Contabilidad</title>
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
  window.alert("La cuenta se agrego con exito");
</SCRIPT>';
  }
  ?>
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


<?php include("recortes/menu_cont.php"); ?>
  <form action="<?php echo $PHP_SELF; ?>" method="get">
    <div class="subt">Libro diario: </div>
	<div class="etiqueta">Libro desde:</div>
    <input type="text" name="desde" class="p_input" id="desde" placeholder="Seleccione fecha desde" autocomplete="off" readonly>
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
    <div class="etiqueta">Libro Hasta:</div>
    <input tipe ="text" name="hasta" class="p_input" id="hasta" placeholder="Seleccione fecha hasta" autocomplete="off" readonly>
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
<div class="etiqueta">Buscar texto:</div>
<input type="text" class="p_input" name="busc" id="busc" placeholder="Ingrese texto"/>
<input type="submit" class="boton_form" value="ver" />
  </form>
  <div id="nuevo_a"><a href="asiento.php?ac=nuevo">
 Nuevo asiento
  </a></div>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
		<th>Fecha</th>
      <th>Nro</th>
	  <th>Cuenta</th>
	  <th>Debe</th>
	  <th>Haber</th>
	  <th width=200>Detalle</th>
      <th>Modificar</th>
      <th>Quitar</th>
    </tr>
	<?php
	if (empty($_GET['desde']) and empty($_GET['busc'])){
	$desde = date("Y/m/d");
	} else {
	$desde = substr($_GET['desde'],6,4).'-'.substr($_GET['desde'],3,2).'-'.substr($_GET['desde'],0,2);
	}
	if (empty($_GET['hasta']) and empty($_GET['busc'])){
	$hasta = date("Y/m/d");
	} else {
	$hasta = substr($_GET['hasta'],6,4).'-'.substr($_GET['hasta'],3,2).'-'.substr($_GET['hasta'],0,2);
	}
	if (empty($_GET['busc'])){
	$sq = "select * from asientos INNER JOIN cuentas on asientos.cuenta = cuentas.id_cuentas where (asientos.fecha <='".$hasta."' and asientos.fecha >='".$desde."') group by asientos.nro order by asientos.id_a asc";
	} else {
	$sq = "select * from asientos INNER JOIN cuentas on asientos.cuenta = cuentas.id_cuentas where (asientos.detalle LIKE '%".$_GET['busc']."%' or asientos.detalle LIKE '%".strtoupper($_GET['busc'])."%') group by asientos.nro order by asientos.id_a asc";
	}
	$u=mysql_query($sq);
	$d=0;
	$h=0;
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
		$nro = $au['nro'];
		if(floor($nro/2) == ($nro/2)){
		$fon ="#FFFFFF";
		} else {
		$fon ="#EAF7C1";
		}
	$qa  = mysql_query("select * from asientos INNER JOIN cuentas on asientos.cuenta = cuentas.id_cuentas where (asientos.nro ='$nro') order by asientos.id_a asc");
	$na = mysql_num_rows($qa);
    
		for($t=0; $t<$na; $t++){
		$aa = mysql_fetch_array($qa);
		if ($t==0){
		echo  '<tr bgcolor="'.$fon.'"><td rowspan="'.$na.'">'.substr($au['fecha'],8,2).'/'.substr($au['fecha'],5,2).'/'.substr($au['fecha'],0,4).'</td>';
	    echo '<td rowspan="'.$na.'">'.$au['nro'].'</td>';
		echo '<td>'.$aa['cuenta'].'</td>
		<td> $ '.$aa['debe'].'</td>
		<td> $ '.$aa['haber'].'</td>';
		echo '<td rowspan="'.$na.'">'.$au['detalle'].'</td>
		<td rowspan="'.$na.'"><a href="asiento.php?nro='.$au['nro'].'">Modificar</a></td>';
     echo '<td rowspan="'.$na.'"><a href="quitar_asiento1.php?nro='.$nro.'" title="Quitar este asiento" onclick="return confirmar(';
	   echo "'�Est� seguro que desea quitar este asiento?'";
	  echo ')" >Quitar</a></td></tr>';
	  } else {
	  echo '<tr bgcolor="'.$fon.'"><td>'.$aa['cuenta'].'</td>
		<td> $ '.$aa['debe'].'</td>
		<td> $ '.$aa['haber'].'</td></tr>';
	  }
		}
		
  
	$d=$d+$au['debe'];
	$h=$h+$au['haber'];
	}
	?>
  </table>
  <div class = "resumen">
    <a href="print_caja.php?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>" target="_blank">Preparar este libro para imprimir</a>  </div>
  </div>
</div>
</body>
</html>
