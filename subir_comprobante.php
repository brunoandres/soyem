<?php
$page = 'contabilidad';
$subpage = 'subir_comprobante';
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
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
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
  		<form action="procesa_comprobante.php" method="POST" enctype="multipart/form-data">
    		<div class="subt">Cargar archivo de comprobantes</div>
				
				<div class="etiqueta"><strong>Mes Comprobante</strong></div>
					<select name="mes">
					<?php 
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					foreach ($meses as $key => $value) {?>
		

						<option value="<?php echo $key+1; ?>"><?php echo $value; ?></option>
					<?php } ?>
					</select>
	
				<div class="etiqueta"><strong>Año Comprobante</strong></div>
					<select name="anio">
					<?php 
					
					for ($i=2019; $i <= 2020 ; $i++) { ?>
		

						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
					</select>

				<div class="etiqueta"><strong>Fecha Comprobante</strong></div>
    				<input type="text" name="fecha_comprobante" class="p_input" id="fecha_comprobante" placeholder="Seleccione fecha comprobante" autocomplete="off" readonly>
						<script type="text/javascript">
						    Calendar.setup({
						        inputField     :    "fecha_comprobante",      // id of the input field
						        ifFormat       :    "%d/%m/%Y",       // format of the input field
						        showsTime      :    true,            // will display a time selector
						        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
						        singleClick    :    false,           // double-click mode
						        step           :    1  ,
						        singleClick    :    " true"                   // show all years in drop-down boxes (instead of every other year as default)
						    });
						</script>
				<div class="etiqueta"><strong>Saldo a la fecha</strong></div>
    				<input type ="number" step="0.01" name="saldo" class="p_input" id="saldo" placeholder="Ingrese el saldo a la fecha seleccionada">
    			<div class="etiqueta"><strong>Archivo Excel</strong></div>
    				<input type ="file" name="archivo" placeholder="Seleccione el archivo..."><br><br />
					<input type="submit" name="btnForm" value="Subir comprobante" />
  		</form>
</body>
</html>
