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
  

  if (form.legajo.value == "")
  { alert("Por favor ingrese el legajo"); form.legajo.focus(); return; }

  
   if (form.nombre.value == "")
  { alert("Por favor ingrese el nombre"); form.nombre.focus(); return; }
  
  if (form.sexo.value == "")
  { alert("Por favor seleccione una opción."); form.sexo.focus(); return; }
  
  if (form.cuil.value == "")
  { alert("Por favor ingrese el cuil"); form.cuil.focus(); return; }

   if (form.documento.value == "")
  { alert("Por favor ingrese el documento"); form.documento.focus(); return; }
  
  //valido al menos un telefono de contacto
  if ((form.telefono.value == "" && form.celular.value == "")) {
    alert("Por favor ingrese al menos un teléfono de contacto, puede ser un fijo o un celular."); form.telefono.focus(); return;
  }
  
   if (form.domicilio.value == "")
  { alert("Por favor defina el domicilio"); form.domicilio.focus(); return; }

if (form.sector.value == "")
    { alert("Por favor defina el sector donde trabaja."); form.sector.focus(); return; }
  
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
<div id="contanido">
<div id="cuerpo">
  <form method="post" action="mod_afiliado.php">
<div class="subt"> Modificando datos de  <?php echo $dat['nombre']; ?>: </div>
<div class="etiqueta">Legajo:</div>
  <input name="legajo" type="text" class="p_input" id="legajo" value="<?php echo $dat['legajo']; ?>" autocomplete="off"/>
<div class="etiqueta">Apellido y Nombre:</div>
  <input name="nombre" type="text" class="p_input" id="nombre" value="<?php echo $dat['nombre']; ?>" autocomplete="off"/>

  <div class="etiqueta">Sexo:</div>
  <select name="sexo" class="p_input" id="sexo">
  <option value="M" <?php if ($dat['sexo']=='M') {
      echo "selected";
    } ?>>Masculino</option>
  <option value="F" <?php if ($dat['sexo']=='F') {
      echo "selected";
    } ?>>Femenino</option>
  <option value="Otro" <?php if ($dat['sexo']=='Otro') {
      echo "selected";
    } ?>>Sin especificar</option>
  </select>
  
  <div class="etiqueta">CUIL:</div>
  <input name="cuil" type="number" class="p_input" id="cuil" value="<?php echo $dat['cuil']; ?>" autocomplete="off"/>
   <div class="etiqueta">Fecha de Nacimiento:</div>
  <input name="nacimiento" type="text" class="p_input" id="nacimiento" value="<?php echo substr($dat['nacimiento'],8,2).'/'.substr($dat['nacimiento'],5,2).'/'.substr($dat['nacimiento'],0,4); ?>"/>
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "nacimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1     ,
        singleClick    :" true"              // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div class="etiqueta">Domicilio:</div>
  <input name="domicilio" type="text" class="p_input" id="domicilio" value="<?php echo $dat['domicilio']; ?>" autocomplete="off"/>
  <div class="etiqueta">Nro de Documento:</div>
  <input name="documento" type="text" class="p_input" id="documento" value="<?php echo $dat['documento']; ?>" autocomplete="off"/>
  <div class="etiqueta">Estado Civil:</div>
  <select name="estado_civil" class="p_input" id="estado_civil" onchange="casado1()">
  <option value="<?php echo $dat['estado_civil']; ?>" selected="selected"><?php echo $dat['estado_civil']; ?></option>
  <option value="soltero">Soltero</option>
  <option value="casado">Casado</option>
  <option value="viudo">Viudo</option>
  <option value="divorciado">Divorciado</option>
  </select>
  <div class="etiqueta">Su esposa/o tiene obra social?:</div>
  <select name="os_esposa" class="p_input" id="os_esposa" onchange="casado2()">
  
  <option value="si" <?php if ($_POST['os_esposa']=='si') {
      echo "selected";
    } ?>>si</option>
  <option value="no" <?php if ($_POST['os_esposa']=='no') {
      echo "selected";
    } ?>>no</option>
  </select>

<div class="etiqueta">Obra social del esposa/o:</div>
  <input name="nom_os_esposa" type="text" class="p_input" id="nom_os_esposa" value="<?php echo $dat['nom_os_esposa']; ?>" autocomplete="off"/>

  <div class="etiqueta">Teléfono fijo:</div>
  <input name="telefono" type="number" class="p_input" id="telefono" value="<?php echo $dat['telefono']; ?>" autocomplete="off" placeholder="Ingrese un teléfono fijo válido"/>
  <div class="etiqueta">Teléfono Celular:</div>
  <input name="celular" type="number" class="p_input" id="celular" value="<?php echo $dat['celular']; ?>" autocomplete="off" placeholder="Ingrese un celular válido"/>
  <div class="etiqueta">Correo Electronico:</div>
  <input name="correo" type="email" class="p_input" id="correo" value="<?php echo $dat['correo']; ?>" autocomplete="off"/>
 <div class="etiqueta">Sector donde trabaja:</div>
  <input name="sector" type="text" class="p_input" id="sector" value="<?php echo $dat['sector']; ?>" autocomplete="off"/>
<div class="etiqueta">Categoria:</div>
  <input name="categoria" type="text" class="p_input" id="categoria" value="<?php echo $dat['categoria']; ?>" autocomplete="off"/>
  <div class="etiqueta">Antigüedad:</div>
  <input name="antiquedad" type="text" class="p_input" id="antiquedad" value="<?php echo $dat['antiquedad']; ?>" autocomplete="off"/>
  
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
  <input name="afiliacion" type="text" class="p_input" id="afiliacion" value="<?php echo substr($dat['afiliacion'],8,2).'/'.substr($dat['afiliacion'],5,2).'/'.substr($dat['afiliacion'],0,4); ?>" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "afiliacion",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1     ,
        singleClick    :" true"             // show all years in drop-down boxes (instead of every other year as default)
    });
</script>

    <div class="etiqueta">Vencimiento del Carnet:</div>
  <input name="vencimiento" type="text" class="p_input" id="vencimiento" value="<?php echo substr($dat['vencimiento'],8,2).'/'.substr($dat['vencimiento'],5,2).'/'.substr($dat['vencimiento'],0,4); ?>" />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "vencimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1        ,
        singleClick    :" true"          // show all years in drop-down boxes (instead of every other year as default)
    });
</script>

  <div class="etiqueta">Nro de IPROSS:</div>
  <input name="ipross" type="text" class="p_input" id="ipross" value="<?php echo $dat['ipross']; ?>" autocomplete="off"/>
  
  <div class="etiqueta">Sueldo:</div>
<input name="sueldo" type="text" class="p_input" id="sueldo" value="<?php echo $dat['sueldo']; ?>" autocomplete="off"/>
  <div class="etiqueta">Es Jubilado:</div>
  <label>
  <select name="jubilado" class="p_input" id="jubilado">
   <option selected="selected"><?php echo $dat['jubilado']; ?></option>
    <option>si</option>
    <option>no</option>
  </select>
  </label>
   <div class="etiqueta">Es Socio:</div>
  <label>
  <select name="socioos" class="p_input" id="socioos">
   <option selected="selected"><?php echo $dat['socioos']; ?></option>
    <option>si</option>
    <option>no</option>
  </select>
  </label>
  <div class="etiqueta">Sugerencias:</div>
  <textarea name="sugerencias" rows="4" class="p_input" id="sugerencias"><?php echo $dat['sugerencias']; ?></textarea>

  <div class="etiqueta">Observaciones:</div>
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"><?php echo $dat['observaciones']; ?></textarea>
<div>
 <div class="etiqueta">Fecha de Actualización:</div>
  <input name="f_actualiza" type="text" class="p_input" id="f_actualiza" value="<?php echo substr($dat['f_actualiza'],8,2).'/'.substr($dat['f_actualiza'],5,2).'/'.substr($dat['f_actualiza'],0,4); ?>" readonly/>
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_actualiza",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1       ,
        singleClick    :" true"           // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div>
        <label><br>
	<input type="button" name="Submit" value="Modificar" onClick="Validar(this.form)"/>
	</label>
	</div>
	<input type="hidden" name="clave" value="<?php echo $clave; ?>" />
</div>
</form>





</div>
</div>
</body>
</html>
