<?php
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
$clave = $_GET['clave'];
$id_fam = $_GET['id_fam'];
$dat = mysql_fetch_array(mysql_query("select * from afiliado where clave='$clave'"));
$data = mysql_fetch_array(mysql_query("select * from familiares where id_fam='$id_fam'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  { alert("Por favor ingrese el nombre y apellido"); form.nombre.focus(); return; }
  
 
   if (form.documento.value == "")
  { alert("Por favor ingrese el documento"); form.documento.focus(); return; }

  if (form.nacimiento.value == "")
  { alert("Por favor ingrese la fecha de nacimiento"); form.nacimiento.focus(); return; }
  
  if (form.discapacitado.value == "")
  { alert("Por favor seleccione una opción"); form.discapacitado.focus(); return; }


   if (form.tipo.value == "")
  { alert("Por favor defina el tipo de parentezco"); form.tipo.focus(); return; }
  
 form.submit();
}
</script>
</head>

<body>
<div id="contanido">
<div id="cuerpo">
  <form method="post" action="mod_familiar.php">
<div class="subt"> Nuevo Familiar de <?php echo $dat['nombre']; ?>: </div>
<div class="etiqueta">Apellido y Nombre:</div>
  <input name="nombre" type="text" class="p_input" id="nombre" value="<?php echo $data['nombre']; ?>" />

  <div class="etiqueta">Sexo:</div>
  <select name="sexo" class="p_input" id="sexo">
  <option value="M" <?php if ($data['sexo']=='M') {
      echo "selected";
    } ?>>Masculino</option>
  <option value="F" <?php if ($data['sexo']=='F') {
      echo "selected";
    } ?>>Femenino</option>
  <option value="Otro" <?php if ($data['sexo']=='Otro') {
      echo "selected";
    } ?>>Sin especificar</option>
  </select>

  <div class="etiqueta">Nro de Documento:</div>
  <input name="documento" type="text" class="p_input" id="documento" value="<?php echo $data['documento']; ?>" />
   <div class="etiqueta">Fecha de Nacimiento:</div>
  <input name="nacimiento" type="text" class="p_input" id="nacimiento" autocomplete="off" value="<?php echo substr($data['nacimiento'],8,2).'/'.substr($data['nacimiento'],5,2).'/'.substr($data['nacimiento'],0,4); ?>" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "nacimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1     ,
        singleClick    :" true"           // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div class="etiqueta">Estudios cursados:</div>
  <label>
  <select name="estudio" class="p_input" id="estudio">
    <option value=""></option>
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
  <div class="etiqueta">¿Cursando actualmente?
    <label>
      <select name="cursando_actualmente" id="cursando_actualmente">
        <option value="1" <?php if ($data['cursando_actualmente']==1) {
          echo "selected";
        } ?>>Si</option>
        <option value="0" <?php if ($data['cursando_actualmente']==0) {
          echo "selected";
        } ?>>No</option>
      </select>
    </label>
  </div>
  <div class="etiqueta">Capacidad diferente:</div>
  <label>
  <select name="discapacitado" class="p_input" id="discapacitado">
   
   </option>
    <option value="si" <?php if ($data['discapacitado']=="si") {
      echo "selected";
    } ?>>si</option>
    <option value="no" <?php if ($data['discapacitado']=="no") {
      echo "selected";
    } ?>>no</option>
  </select>
  </label>

  <div class="etiqueta">Tipo de parentezco:</div>
  <label>
  <select name="tipo" class="p_input" id="tipo">
   
    <option value="H" <?php if ($data['tipo']=="H") {
      echo "selected";
    } ?>>Hijo/a</option>
    <option value="C" <?php if ($data['tipo']=="C") {
      echo "selected";
    } ?>>Cónyuge</option>
    <option value="O" <?php if ($data['tipo']=="O") {
      echo "selected";
    } ?>>Otro</option>
  </select>
  </label>
   <input type="hidden" name="id_fam" value="<?php echo $id_fam; ?>" />
        <label>
	<input type="button" name="Submit" value="Modificar" onClick="Validar(this.form)"/>
	</label>
</div>
</form>
</div>
</div>
</body>
</html>
