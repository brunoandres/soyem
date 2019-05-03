<?php
$page = 'afiliados';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];


if (isset($_POST['enviar'])) {
  $legajo = $_POST['legajo'];
  $existe = mysql_num_rows(mysql_query("select legajo from afiliado where legajo=".$legajo));

  if (!$existe>0) {
    $nombre = $_POST['nombre'];
  $documento = $_POST['documento'];
  $domicilio = $_POST['domicilio'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $nacimiento = substr($_POST['nacimiento'],6,4).'-'.substr($_POST['nacimiento'],3,2).'-'.substr($_POST['nacimiento'],0,2);
  $afiliacion = substr($_POST['afiliacion'],6,4).'-'.substr($_POST['afiliacion'],3,2).'-'.substr($_POST['afiliacion'],0,2);
  $vencimiento = substr($_POST['vencimiento'],6,4).'-'.substr($_POST['vencimiento'],3,2).'-'.substr($_POST['vencimiento'],0,2);
  $ipross = $_POST['ipross'];
  $sector = $_POST['sector'];
  $sueldo = $_POST['sueldo'];
  $jubilado = $_POST['jubilado'];
  $socioos = $_POST['socioos'];
  $observaciones = $_POST['observaciones'];

  $cuil = $_POST['cuil'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'cuil' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD cuil VARCHAR(20)");
  }

  $estado_civil = $_POST['estado_civil'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'estado_civil' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD estado_civil VARCHAR(10)");
  }


  $os_esposa = $_POST['os_esposa'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'os_esposa' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD os_esposa VARCHAR(2)");
  }

  $nom_os_esposa = $_POST['nom_os_esposa'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'nom_os_esposa' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD nom_os_esposa VARCHAR(20)");
  }

  $celular = $_POST['celular'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'celular' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD celular VARCHAR(20)");
  }

  $categoria = $_POST['categoria'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'categoria' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD categoria VARCHAR(20)");
  }

  $antiquedad = $_POST['antiquedad'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'antiquedad' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD antiquedad VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci");
  }

  $coseguro = $_POST['coseguro'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'coseguro' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD coseguro VARCHAR(2)");
  }

  $motivo_coseguro = $_POST['motivo_coseguro'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'motivo_coseguro' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD motivo_coseguro VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_spanish_ci");
  }


  $dona_sangre = $_POST['dona_sangre'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'dona_sangre' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD dona_sangre VARCHAR(2)");
}


  $tipo_sangre = $_POST['tipo_sangre'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'tipo_sangre' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD tipo_sangre VARCHAR(20)");
  }


  $sugerencias = $_POST['sugerencias'];
  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'sugerencias' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD sugerencias BLOB ");
  }

  if (empty($_POST['f_actualiza'])){
  $f_actualiza= date("Y-m-d");
  } else {
  $f_actualiza = substr($_POST['f_actualiza'],6,4).'-'.substr($_POST['f_actualiza'],3,2).'-'.substr($_POST['f_actualiza'],0,2);
  }

  if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'f_actualiza' ")) != 1 ) {
  mysql_query("ALTER TABLE afiliado ADD f_actualiza DATE ");
}

  mysql_query("insert into afiliado (legajo, nombre, documento, domicilio, telefono, correo, nacimiento, afiliacion, vencimiento, ipross, sector, sueldo, jubilado, socioos, observaciones, cuil, estado_civil, os_esposa, nom_os_esposa, celular, categoria, coseguro, motivo_coseguro, dona_sangre, tipo_sangre, sugerencias, f_actualiza) values ('$legajo', '$nombre', '$documento', '$domicilio', '$telefono', '$correo', '$nacimiento', '$afiliacion', '$vencimiento', '$ipross', '$sector', '$sueldo', '$jubilado', '$socioos', '$observaciones', '$cuil', '$estado_civil', '$os_esposa', '$nom_os_esposa', '$celular', '$categoria', '$coseguro', '$motivo_coseguro', '$dona_sangre', '$tipo_sangre', '$sugerencias', '$f_actualiza')");
  $ult = mysql_fetch_array(mysql_query("select * from afiliado where (nombre = '$nombre' and documento='$documento' and legajo='$legajo')"));
  header ("Location:datos_afiliado.php?clave=".$ult['clave']);
  exit();
  } else {
    echo "<script>
    alert('El legajo $legajo ya existe');
    form.legajo.focus(); 
    </script>";
    
  }
  
} else {
  # code...
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
  function Validar(form){
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
    }else {
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
<form method="post">
<div class="subt"> Nuevo Afiliado: </div>
<div class="etiqueta">Legajo:</div>
  <input name="legajo" type="text" class="p_input" id="legajo" value="<?php echo $_POST['legajo']; ?>" autocomplete="off" />
<div class="etiqueta">Apellido y Nombre:</div>
  <input name="nombre" type="text" class="p_input" id="nombre" value="<?php echo $_POST['nombre']; ?>" autocomplete="off"  />
  <div class="etiqueta">CUIL:</div>
  <input name="cuil" type="text" class="p_input" id="cuil" value="<?php echo $_POST['cuil']; ?>" autocomplete="off" />
  <div class="etiqueta">Fecha de Nacimiento:</div>
  <input name="nacimiento" type="text" class="p_input" id="nacimiento" autocomplete="off" value="<?php echo $_POST['nacimiento']; ?>" readonly />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "nacimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1    ,
        singleClick    :" true"             // show all years in drop-down boxes (instead of every other year as default)
    });
</script>

 
  <div class="etiqueta">Domicilio:</div>
  <input name="domicilio" type="text" class="p_input" id="domicilio" value="<?php echo $_POST['domicilio']; ?>" autocomplete="off" />
   <div class="etiqueta">Nro de Documento:</div>
  <input name="documento" type="text" class="p_input" id="documento" value="<?php echo $_POST['documento']; ?>" autocomplete="off" />
   <div class="etiqueta">Estado Civil:</div>
  <select name="estado_civil" class="p_input" id="estado_civil" onchange="casado1()">
  <!--<option value="<?php //echo $dat['estado_civil']; ?>" selected="selected"><?php //echo $dat['estado_civil']; ?></option>-->
  <option value="soltero" <?php if ($_POST['estado_civil']=='soltero') {
      echo "selected";
    } ?>>soltero</option>
  <option value="casado" <?php if ($_POST['estado_civil']=='casado') {
      echo "selected";
    } ?>>casado</option>
  <option value="viudo" <?php if ($_POST['estado_civil']=='viudo') {
      echo "selected";
    } ?>>viudo</option>
  <option value="divorciado" <?php if ($_POST['estado_civil']=='divorciado') {
      echo "selected";
    } ?>>divorciado</option>
  </select>
  <div class="etiqueta">Su esposa/o tiene obra social?:</div>
  <select name="os_esposa" class="p_input" id="os_esposa" onchange="casado2()">
  <!--<option value="<?php //echo $dat['os_esposa']; ?>" selected="selected"><?php //echo $dat['os_esposa']; ?></option>-->
  <option value="si" <?php if ($_POST['os_esposa']=='si') {
      echo "selected";
    } ?>>si</option>
  <option value="no" <?php if ($_POST['os_esposa']=='no') {
      echo "selected";
    } ?>>no</option>
  </select>

<div class="etiqueta">Obra social del esposa/o:</div>
  <input name="nom_os_esposa" type="text" class="p_input" id="nom_os_esposa" value="<?php echo $_POST['nom_os_esposa']; ?>" />
  <div class="etiqueta">Teléfono Fijo:</div>
  <input name="telefono" type="text" class="p_input" id="telefono" value="<?php echo $_POST['telefono']; ?>" />
   <div class="etiqueta">Teléfono Celular:</div>
  <input name="celular" type="text" class="p_input" id="celular" value="<?php echo $_POST['celular']; ?>" />
  <div class="etiqueta">Correo electronico:</div>
  <input name="correo" type="text" class="p_input" id="correo" value="<?php echo $_POST['correo']; ?>" />
  
  
  <div class="etiqueta">Sector donde trabaja:</div>
  <input name="sector" type="text" class="p_input" id="sector" value="<?php echo $_POST['sector']; ?>" autocomplete="off" />
<div class="etiqueta">Categoria:</div>
  <input name="categoria" type="text" class="p_input" id="categoria" value="<?php echo $_POST['categoria']; ?>" autocomplete="off"/>
  <div class="etiqueta">Antigüedad:</div>
  <input name="antiquedad" type="text" class="p_input" id="antiquedad" value="<?php echo $_POST['antiquedad']; ?>" autocomplete="off" />
  
   <div class="etiqueta">Afiliado al coseguro:</div>
  <select name="coseguro" class="p_input" id="coseguro" onchange="casado3()">
  <!--<option value="<?php //echo $dat['coseguro']; ?>" selected="selected"><?php //echo $_POST['coseguro']; ?></option>-->
  <option value="si" <?php if ($_POST['coseguro']=='si') {
      echo "selected";
    } ?>>si</option>
  <option value="no" <?php if ($_POST['coseguro']=='no') {
      echo "selected";
    } ?>>no</option>
  </select>
  
  <div class="etiqueta">Porque no esta afiliado al coseguro?:</div>
  <textarea name="motivo_coseguro" rows="4" class="p_input" id="motivo_coseguro"><?php echo $_POST['motivo_coseguro']; ?></textarea>
 
   <div class="etiqueta">Dona sangre?:</div>
  <select name="dona_sangre" class="p_input" id="dona_sangre" onchange="casado4()">
  <!--<option value="<?php //echo $dat['dona_sangre']; ?>" selected="selected"><?php //echo $dat['dona_sangre']; ?></option>-->
  <option value="si" <?php if ($_POST['dona_sangre']=='si') {
      echo "selected";
    } ?>>si</option>
  <option value="no" <?php if ($_POST['dona_sangre']=='no') {
      echo "selected";
    } ?>>no</option>
  </select>
  <div class="etiqueta">Grupo y Factor:</div>
  <input name="tipo_sangre" type="text" class="p_input" id="tipo_sangre" value="<?php echo $_POST['tipo_sangre']; ?>" />
  
  
  <div class="etiqueta">Fecha de afiliacion:</div>
  <input name="afiliacion" type="text" class="p_input" id="afiliacion" value="<?php echo $_POST['afiliacion']; ?>" readonly/>
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "afiliacion",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1  ,
        singleClick    :" true"               // show all years in drop-down boxes (instead of every other year as default)
    });
</script>

    <div class="etiqueta">Vencimiento del Carnet:</div>
  <input name="vencimiento" type="text" class="p_input" id="vencimiento" value="<?php echo $_POST['vencimiento']; ?>" readonly />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "vencimiento",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1    ,
        singleClick    :" true"             // show all years in drop-down boxes (instead of every other year as default)
    });
</script>

  <div class="etiqueta">Nro de IPROSS:</div>
  <input name="ipross" type="text" class="p_input" id="ipross" value="<?php echo $_POST['ipross'] ?>" autocomplete="off"/>
  <div class="etiqueta">Sueldo:</div>
<input name="sueldo" type="text" class="p_input" id="sueldo" value="<?php echo $_POST['sueldo'] ?>" autocomplete="off"/>
  <div class="etiqueta">Es Jubilado:</div>
  <label>
  <select name="jubilado" class="p_input" id="jubilado">
   <option></option>
    <option <?php if ($_POST['jubilado']=='si') {
      echo "selected";
    } ?>>si</option>
    <option <?php if ($_POST['jubilado']=='no') {
      echo "selected";
    } ?>>no</option>
  </select>
  </label>
   <div class="etiqueta">Es Socio:</div>
  <label>
  <select name="socioos" class="p_input" id="socioos">
   <option></option>
    <option <?php if ($_POST['socioos']=='si') {
      echo "selected";
    } ?>>si</option>
    <option <?php if ($_POST['socioos']=='no') {
      echo "selected";
    } ?>>no</option>
  </select>
  </label>
    <div class="etiqueta">Sugerencias:</div>
  <textarea name="sugerencias" rows="4" class="p_input" id="sugerencias"><?php echo $_POST['sugerencias']; ?></textarea>
  <div class="etiqueta">Observaciones:</div>
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"><?php echo $_POST['observaciones']; ?></textarea>
   <div class="etiqueta">Fecha de Actualización:</div>
  <input name="f_actualiza" type="text" class="p_input" id="f_actualiza" value="<?php echo $_POST['f_actualiza'] ?>" readonly />
  <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_actualiza",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1      ,
        singleClick    :" true"           // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div>
        <label><br>
	<!--<input type="button" name="Submit" value="Agregar" onClick="Validar(this.form)"/>-->
  <input type="hidden" name="enviar" value="1">
  <input type="button" name="btn" value="Agregar" onclick="Validar(this.form)">
	</label>
</div>
</form>
</div>
  </div>
 
</body>
</html>