<?php
include("secure1.php");
include("conecta.php");
$clave_empresa = $_GET['clave_empresa'];
$data =  mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
} 
</script>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.nombre.value == "")
  { alert("Por favor el nombre se la empresa"); form.nombre.focus(); return; }
   
   if (form.cuit.value == "")
  { alert("Por favor ingrese el cuit de la empresa"); form.cuit.focus(); return; }
  
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
  <h1>
  <?php
  if($_GET['ac']=='nuevo'){
  echo 'Nueva Empresa:';
  } else {
   echo 'Modificando Empresa:';
  }
  ?> </h1>
 <form action="modifica_empresa.php" method="post">  
 <div class="etiqueta">Nombre:</div>

 <input name="nombre" type="text" class="p_input" id="nombre" value="<?php echo $data['nombre']; ?>" />	
   
<div class="etiqueta">Domicilio:</div>
		 <input name="domicilio" type="text" class="p_input"  id="domicilio" value="<?php echo $data['domicilio']; ?>" />
  <div class="etiqueta">Localidad:</div>
    <input name="localidad" type="text" class="p_input"  id="localidad" value="<?php echo $data['localidad']; ?>" />
	 <div class="etiqueta">Telefono:</div>
    <input name="telefono" type="text" class="p_input"  id="telefono" value="<?php echo $data['telefono']; ?>" />
	 <div class="etiqueta">Cuit:</div>
	<input name="cuit" type="text" class="p_input"  id="cuit" value="<?php echo $data['cuit']; ?>" />
	<div class="etiqueta">Tipo de servicio:</div>
	<input name="tipo" type="text" class="p_input"  id="tipo" value="<?php echo $data['tipo']; ?>" />
        <div><label>
	<input type="button" name="Submit" value="Guardar Empresa" onClick="Validar(this.form)"/>
	</label></div>
	    <input name="id_us" type="hidden" id="id_us" value="<?php echo $_SESSION['usuario']; ?>" />
	    <input name="clave_empresa" type="hidden" id="clave_empresa" value="<?php echo $clave_empresa; ?>" />
		

  </form>
  </div>

</div>
</body>
</html>
