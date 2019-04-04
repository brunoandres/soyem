<?php
include("conecta.php");
$clave_prestamo = $_GET['clave_prestamo'];
$data =  mysql_fetch_array(mysql_query("select * from prestamos_viviendas where clave_prestamo = '$clave_prestamo'"));
$afiliado = $data['afiliado'];
$data_n =  mysql_fetch_array(mysql_query("select * from afiliado where clave = '$afiliado'"));
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

  <h1>Modificar Plan de <?php echo $data_n['nombre']; ?> </h1>
  
  <?php
  if ($_POST['accion'] != "1"){
  ?>
  <form action="mod_plan_v.php" method="post">
    <div class="etiqueta">Afiliado:</div>
	<select name="afiliado">
	<option selected="selected" value="<?php echo $afiliado; ?>"><?php echo $data_n['nombre']; ?></option>
	<?php
	$qa = mysql_query("select * from afiliado order by nombre asc");
	for ($s=0;$s<mysql_num_rows($qa);$s++){
	$aa = mysql_fetch_array($qa);
	echo '<option value="'.$aa['clave'].'">'.$aa['nombre'].'</option>';
	}
	?>
	
	</select>
   

        <label>
	<input name="submit" type="submit" id="envia" value="Guardar Cambios"/>
	</label>
	    <input name="clave_prestamo" type="hidden" id="clave_prestamo" value="<?php echo $clave_prestamo; ?>" />
		<input name="afiliado_ant" type="hidden" id="afiliado_ant" value="<?php echo $afiliado; ?>" />
		<input name="num_cuotas" type="hidden" id="num_cuotas" value="<?php echo $data['num_cuotas']; ?>" />
		<input name="accion" type="hidden" value="1" />
	</div>
  </form>
   <?php
 } else {
 $max = $_POST['clave_prestamo'] + $_POST['num_cuotas'] + 1;
 $min = $_POST['clave_prestamo'] - $_POST['num_cuotas'] - 1;
 
 $t1 = "update prestamos_viviendas set afiliado = ".$_POST['afiliado']." where (clave_prestamo < ".$max." and clave_prestamo > ".$min." and afiliado = ".$_POST['afiliado_ant'].")";
 mysql_query($t1);
 
 ?>
  <div class="error">Los cambios se realizaron correctamente.</div>
  <?php
  }
  ?>
  
  </div>

</div>
</body>
</html>
