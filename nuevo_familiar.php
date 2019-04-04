<?php
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
$clave = $_GET['clave'];
$dat = mysql_fetch_array(mysql_query("select * from afiliado where clave='$clave'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Nuevo Familiar</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
  
   if (form.nombre.value == "")
  { alert("Por favor ingrese el nombre"); form.nombre.focus(); return; }
  
 
   if (form.documento.value == "")
  { alert("Por favor ingrese el documento"); form.documento.focus(); return; }
  
  
   if (form.tipo.value == "")
  { alert("Por favor defina el tipo de parentezco"); form.tipo.focus(); return; }
  
 form.submit();
}
</script>
</head>

<body>
<div id="contanido">
<div id="cuerpo">
  <form method="post" action="agrega_familiar.php">
<div class="subt"> Nuevo Familiar de <?php echo $dat['nombre']; ?>: </div>
<div class="etiqueta">Apellido y Nombre:</div>
  <input name="nombre" type="text" class="p_input" id="nombre" />
  <div class="etiqueta">Nro de Documento:</div>
  <input name="documento" type="text" class="p_input" id="documento" />
   <div class="etiqueta">Fecha de Nacimiento:</div>
  <input name="nacimiento" type="text" class="p_input" id="nacimiento" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "nacimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div class="etiqueta">Estudios que cursa:</div>
  <label>
  <select name="estudio" class="p_input" id="estudio">
   <option selected="selected" value="<?php echo $data['estudio']; ?>">
   <?php 
   switch ($data['estudio']) {
    case 1:
        echo "Prescolar";
        break;
    case 2:
        echo "Primario";
        break;
    case 3:
        echo "Secundario";
        break;
	case 4:
        echo "Terciario";
        break;
	case 5:
        echo "Universitario";
        break;
}
   ?></option>
    <option value="1">Prescolar</option>
    <option value="2">Primario</option>
	<option value="3">Secundario</option>
	<option value="4">Terciario</option>
	<option value="5">Universitario</option>
  </select>
  </label>
  <div class="etiqueta">Capacidad diferente:</div>
  <label>
  <select name="discapacitado" class="p_input" id="discapacitado">
   <option selected="selected"><?php echo $data['discapacitado']; ?>
   </option>
    <option >si</option>
    <option >no</option>
  </select>
  </label>
  <div class="etiqueta">Tipo de parentezco:</div>
  <label>
  <select name="tipo" class="p_input" id="tipo">
   <option></option>
    <option>H</option>
    <option>C</option>
	<option>O</option>
  </select>
  </label>
   <input type="hidden" name="clave" value="<?php echo $clave; ?>" />
        <label>
	<input type="button" name="Submit" value="Agregar" onClick="Validar(this.form)"/>
	</label>
</div>
</form>
</div>
</div>
</body>
</html>
