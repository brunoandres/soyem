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
  
   if (form.asunto.value == "")
  { alert("Por favor ingrese el asunto del seguimiento"); form.asunto.focus(); return; }
  
 
   if (form.comentario.value == "")
  { alert("Por favor ingrese el comentario"); form.comentario.focus(); return; }
  
 form.submit();
}
</script>
</head>

<body>
<div id="contanido">
<div id="cuerpo">
  <form method="post" action="agrega_seguimiento.php">
<div class="subt"> Nuevo Seguimiento de <?php echo $dat['nombre']; ?>: </div>
<div class="etiqueta">Asunto:</div>
  <input name="asunto" type="text" class="p_input" id="asunto" />
  <div class="etiqueta">Comentario:</div>
  <textarea name="comentario" rows="4" class="p_input" id="comentario"></textarea>
  
   <input type="hidden" name="clave" value="<?php echo $clave; ?>" />
   <input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario']; ?>" />
        <label>
	<input type="button" name="Submit" value="Agregar" onClick="Validar(this.form)"/>
	</label>
</div>
</form>
</div>
</div>
</body>
</html>
