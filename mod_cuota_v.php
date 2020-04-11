<?php
include("conecta.php");
include ("auditoria.php");

$clave_prestamo = $_GET['clave_prestamo'];
$data =  mysql_fetch_array(mysql_query("select * from prestamos_viviendas where clave_prestamo = '$clave_prestamo'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.cuota.value == "")
  { alert("Por favor ingrese el nro de cuota"); form.cuota.focus(); return; }
   
   if (form.vencimiento.value == "")
  { alert("Por favor ingrese la fecha de vencimiento"); form.vencimiento.focus(); return; }
  
 
   if (form.monto.value == "")
  { alert("Por favor ingrese el monto de la cuota"); form.monto.focus(); return; }
  
 form.submit();
}

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
<div id="cubierta">
<div id="cuerpo">

  <h1>Modificar Cuota: </h1>
  
  <?php
  if ($_POST['accion'] != "1"){
  ?>
  <form action="mod_cuota_v.php" method="post">
    <div class="etiqueta">Cuota:</div>
    <input name="cuota" type="text" class="p_input" id="cuota" value="<?php echo $data['cuota']; ?>" />
	<div class="etiqueta">Vencimiento:</div>
    <input name="vencimiento" type="text" class="p_input" id="vencimiento" value="<?php echo substr($data['vencimiento'],8,2).'-'.substr($data['vencimiento'],5,2).'-'.substr($data['vencimiento'],0,4); ?>" />
	 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "vencimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script> 
	<div class="etiqueta">Monto:</div>
    <input name="monto" type="text" class="p_input" id="monto" value="<?php echo $data['monto']; ?>" />
	
	
        <label>
	<input name="envia" type="button" id="envia" onClick="Validar(this.form)" value="Guardar Cambios"/>
	</label>
	    <input name="clave_prestamo" type="hidden" id="clave_prestamo" value="<?php echo $clave_prestamo; ?>" />
		<input name="accion" type="hidden" value="1" />
	</div>
  </form>
   <?php
 } else {
 $t1 = "update prestamos_viviendas set cuota = ".$_POST['cuota']." where clave_prestamo =".$_POST['clave_prestamo'];
 mysql_query($t1);
 auditar($t1);

  $t2 = "update prestamos_viviendas set monto = ".$_POST['monto']." where clave_prestamo =".$_POST['clave_prestamo'];
 mysql_query($t2);
  auditar($t2);

  $t3 = "update prestamos_viviendas set vencimiento = '".substr($_POST['vencimiento'],6,4)."/".substr($_POST['vencimiento'],3,2)."/".substr($_POST['vencimiento'],0,2)."' where clave_prestamo =".$_POST['clave_prestamo'];
 mysql_query($t3);
 auditar($t3);
 
 
 ?>
  <div class="error">Los cambios se realizaron correctamente.</div>
  <?php
  }
  ?>
  
  </div>

</div>
</body>
</html>
