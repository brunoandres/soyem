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
  if (form.legajo.value == "")
  { alert("Por favor ingrese el legajo"); form.legajo.focus(); return; }

  
   if (form.nombre.value == "")
  { alert("Por favor ingrese el nombre"); form.nombre.focus(); return; }
  
 
   if (form.documento.value == "")
  { alert("Por favor ingrese el documento"); form.documento.focus(); return; }
  
  
   if (form.domicilio.value == "")
  { alert("Por favor defina el domicilio"); form.domicilio.focus(); return; }
  
 form.submit();
}
</script>
<script LANGUAGE="JavaScript">
 function casado1(){
 if (document.getElementById("estado_civil").value == "casado"){
 document.getElementById("os_esposa").disabled = false;
 } else {
  document.getElementById("os_esposa").disabled = true;
  document.getElementById("nom_os_esposa").disabled = true;
 }
 }
 function casado2(){
 if (document.getElementById("os_esposa").value == "si"){
 document.getElementById("nom_os_esposa").disabled = false;
 } else {
  document.getElementById("nom_os_esposa").disabled = true;
 }
 }
 
  function casado3(){
 if (document.getElementById("coseguro").value == "no"){
 document.getElementById("motivo_coseguro").disabled = false;
 } else {
  document.getElementById("motivo_coseguro").disabled = true;
 }
 }
 
   function casado4(){
 if (document.getElementById("dona_sangre").value == "si"){
 document.getElementById("tipo_sangre").disabled = false;
 } else {
  document.getElementById("tipo_sangre").disabled = true;
 }
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
<div class="barri"><b><a href="listado_afiliados.php" title="Buscar un afiliado">Buscar Afiliado</a> - <a href="listado_de_afiliados.php" title="Armar listado de afiliados">Armar listados</a></b></div>
<form method="post" action="#">
<div class="subt"> Nuevo Afiliado: </div>
<div class="etiqueta">Legajo:</div>
  <input name="legajo" type="text" class="p_input" id="legajo" />
<div class="etiqueta">Apellido y Nombre:</div>
  <input name="nombre" type="text" class="p_input" id="nombre" />
  <div class="etiqueta">CUIL:</div>
  <input name="cuil" type="text" class="p_input" id="cuil" value="<?php echo $dat['cuil']; ?>" />
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

 
  <div class="etiqueta">Domicilio:</div>
  <input name="domicilio" type="text" class="p_input" id="domicilio" />
   <div class="etiqueta">Nro de Documento:</div>
  <input name="documento" type="text" class="p_input" id="documento" />
   <div class="etiqueta">Estado Civil:</div>
  <select name="estado_civil" class="p_input" id="estado_civil" onchange="casado1()">
  <option value="<?php echo $dat['estado_civil']; ?>" selected="selected"><?php echo $dat['estado_civil']; ?></option>
  <option value="soltero">soltero</option>
  <option value="casado">casado</option>
  <option value="viudo">viudo</option>
  <option value="divorciado">divorciado</option>
  </select>
  <div class="etiqueta">Su esposa/o tiene obra social?:</div>
  <select name="os_esposa" class="p_input" id="os_esposa" onchange="casado2()">
  <option value="<?php echo $dat['os_esposa']; ?>" selected="selected"><?php echo $dat['os_esposa']; ?></option>
  <option value="si">si</option>
  <option value="no">no</option>
  </select>

<div class="etiqueta">Obra social del esposa/o:</div>
  <input name="nom_os_esposa" type="text" class="p_input" id="nom_os_esposa" value="<?php echo $dat['nom_os_esposa']; ?>" />
  <div class="etiqueta">Teléfono Fijo:</div>
  <input name="telefono" type="text" class="p_input" id="telefono" />
   <div class="etiqueta">Teléfono Celular:</div>
  <input name="celular" type="text" class="p_input" id="celular" value="<?php echo $dat['celular']; ?>" />
  <div class="etiqueta">Correo electronico:</div>
  <input name="correo" type="text" class="p_input" id="correo" />
  
  
  <div class="etiqueta">Sector donde trabaja:</div>
  <input name="sector" type="text" class="p_input" id="sector" value="<?php echo $dat['sector']; ?>" />
<div class="etiqueta">Categoria:</div>
  <input name="categoria" type="text" class="p_input" id="categoria" value="<?php echo $dat['categoria']; ?>" />
  <div class="etiqueta">Antiqüedad:</div>
  <input name="antiquedad" type="text" class="p_input" id="antiquedad" value="<?php echo $dat['antiquedad']; ?>" />
  
   <div class="etiqueta">Afiliado al coseguro:</div>
  <select name="coseguro" class="p_input" id="coseguro" onchange="casado3()">
  <option value="<?php echo $dat['coseguro']; ?>" selected="selected"><?php echo $dat['coseguro']; ?></option>
  <option value="si">si</option>
  <option value="no">no</option>
  </select>
  
  <div class="etiqueta">Porque no esta afiliado al coseguro?:</div>
  <textarea name="motivo_coseguro" rows="4" class="p_input" id="motivo_coseguro"><?php echo $dat['motivo_coseguro']; ?></textarea>
 
   <div class="etiqueta">Dona sangre?:</div>
  <select name="dona_sangre" class="p_input" id="dona_sangre" onchange="casado4()">
  <option value="<?php echo $dat['dona_sangre']; ?>" selected="selected"><?php echo $dat['dona_sangre']; ?></option>
  <option value="si">si</option>
  <option value="no">no</option>
  </select>
  <div class="etiqueta">Grupo y Factor:</div>
  <input name="tipo_sangre" type="text" class="p_input" id="tipo_sangre" value="<?php echo $dat['tipo_sangre']; ?>" />
  
  
  <div class="etiqueta">Fecha de afiliacion:</div>
  <input name="afiliacion" type="text" class="p_input" id="afiliacion" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "afiliacion",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>

    <div class="etiqueta">Vencimiento del Carnet:</div>
  <input name="vencimiento" type="text" class="p_input" id="vencimiento" />
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

  <div class="etiqueta">Nro de IPROSS:</div>
  <input name="ipross" type="text" class="p_input" id="ipross" />
  <div class="etiqueta">Sueldo:</div>
<input name="sueldo" type="text" class="p_input" id="sueldo" />
  <div class="etiqueta">Es Jubilado:</div>
  <label>
  <select name="jubilado" class="p_input" id="jubilado">
   <option></option>
    <option>si</option>
    <option>no</option>
  </select>
  </label>
   <div class="etiqueta">Es Socio:</div>
  <label>
  <select name="socioos" class="p_input" id="socioos">
   <option></option>
    <option>si</option>
    <option>no</option>
  </select>
  </label>
    <div class="etiqueta">Sugerencias:</div>
  <textarea name="sugerencias" rows="4" class="p_input" id="sugerencias"><?php echo $dat['sugerencias']; ?></textarea>
  <div class="etiqueta">Observaciones:</div>
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"></textarea>
   <div class="etiqueta">Fecha de Actualización:</div>
  <input name="f_actualiza" type="text" class="p_input" id="f_actualiza" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_actualiza",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div>
        <label>
	<input type="button" name="Submit" value="Agregar"/>
	</label>
</div>
</form>
</div>
  </div>
 
</body>
</html>