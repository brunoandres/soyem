<?php
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Nuevo Afiliado</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
 <link type="text/css" media="screen" rel="stylesheet" href="colorbox.css" />
		<script type="text/javascript" src="colorbox/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="colorbox/jquery.colorbox.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				
				$(".example6").colorbox({iframe:true, innerWidth:800, innerHeight:600});
				
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
		<script language="JavaScript">

  <link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>
 <script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.afiliado.value == "")
  { alert("Por favor ingrese el afiliado"); form.afiliado.focus(); return; }

  
   if (form.monto_cuota.value == "")
  { alert("Por favor ingrese el monto del prestamo"); form.monto.focus(); return; }
  
 
   if (form.cuotas.value == "")
  { alert("Por favor ingrese la cantidad de cuotas del prestamo"); form.cuotas.focus(); return; }
  
    
 form.submit();
}
function Calcula(form){
form.importe_total.value = form.monto_cuota.value * form.cuotas.value;
}


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
<div class="barri"><b><a href="prestamos.php" title="Buscar un afiliado">Prestamos</a> - <a href="listado_prestamos_v.php" title="Armar listado de afiliados">Armar listados</a></b></div>
<form method="get" action="nuevo_prestamo_v.php" onchange="submit()">
<div class="subt"> Nuevo Prestamo para vivienda: </div>
<div class="etiqueta">Afiliado:</div>
  <select name="afiliado" class="p_input">
<?php
  $pfa_tx = "select * from afiliado where clave = ".$_GET['afiliado'];
  $pfa = mysql_fetch_array(mysql_query($pfa_tx));
  echo "<option selected='selected' value='".$_GET['afiliado']."'>".$pfa['nombre']."</option>";
  ?>
  <?php
   $fa_tx = "select * from afiliado where activo = 'si' order by nombre asc";
  $qfa = mysql_query($fa_tx);
  for($ea=0;$ea<mysql_num_rows($qfa);$ea++){
  $afa = mysql_fetch_array($qfa);
  echo '<option value="'.$afa['clave'].'">'.$afa['nombre'].'</option>';
  }
  
  ?>
</select>
</form>
<?php
if (!empty($_GET['afiliado'])){
?>
<div class="bot_s"><a href="historial_prestamos.php?afiliado=<?php echo $_GET['afiliado']; ?>" class="example6" title="Ver historial de prestamos de este afiliado">Historial de Prestamos</a></div>
<?php
}
?>
<form method="post" action="agrega_prestamo_v.php">
<input type="hidden" name="afiliado" value="<?php echo $_GET['afiliado']; ?>">
<div class="etiqueta">Monto Cuota:</div>
  <input name="monto_cuota" type="text" class="p_input" id="monto_cuota" />
  <div class="etiqueta">Cuotas:</div>
<select name="cuotas" class="p_input" id="cuotas" onChange="Calcula(this.form)">
<option value=""></option>
<?php
$i=1;
while($i<101){
echo '<option value="'.$i.'">'.$i.'</option>';
$i++;
}
?>
</select> 
  <div class="etiqueta">Importe Total:</div>
  <input name="importe_total" type="text" class="p_input" id="importe_total" disabled="disabled" />
   <div class="etiqueta">Nro de Vale:</div>
  <input name="vale" type="text" class="p_input" id="vale"/>
  <div class="etiqueta">Comienza a cancelar:</div>
 Mes: <select name="mes" id="mes" class="p_input_corto">
   <option selected="selected" value="<?php echo date("m")+1; ?>"><?php echo date("m")+1; ?></option>
   <?php
   $me =1;
   while ($me<13){
   echo '<option value="'.$me.'">'.$me.'</option>';
    $me++;
	}
	?>
  </select>
   Año: <select name="ano" id="ano" class="p_input_corto">
   <option selected="selected" value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
   <?php
   $ye =2013;
   while ($ye<2021){
   echo '<option value="'.$ye.'">'.$ye.'</option>';
    $ye++;
	}
	?>
  </select>
  <div class="etiqueta">Observaciones:</div>
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"></textarea>
<div>
<input name="id_us" type="hidden" id="id_us" value="<?php echo $_SESSION['usuario']; ?>" />
        <label>
	<input type="button" name="Submit" value="Agregar" onClick="Validar(this.form)"/>
	</label>
</div>
</form>
</div>
  </div>
</body>
</html>
