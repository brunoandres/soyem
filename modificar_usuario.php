<?php
include("conecta.php");
$id_us = $_GET['id_us'];
$data =  mysql_fetch_array(mysql_query("select * from usuarios where id_us = '$id_us'"));
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
  if (form.usuario.value == "")
  { alert("Por favor ingrese al usuario"); form.usuario.focus(); return; }
   
   if (form.pass.value == "")
  { alert("Por favor ingrese la contraseña"); form.pass.focus(); return; }
  
 
   if (form.pass1.value == "")
  { alert("Por favor ingrese la confirmación de la contraseña"); form.pass1.focus(); return; }
  
   if (form.pass.value != form.pass1.value)
  { alert("Las contraseñas no coinciden"); form.pass1.focus(); return; }
  
   if (form.funcion.value == "")
  { alert("Por favor defina la funcion del usuario"); form.funcion.focus(); return; }
  
 form.submit();
}

</script>

</head>

<body>
<div id="cubierta">
<div id="cuerpo">
  <h1>Modificar Usuario: </h1>
  <form action="modifica_usuario.php" method="post">
    <div class="etiqueta">Usuario:</div>
    <input name="usuario" type="text" class="p_input" id="usuario" value="<?php echo $data['usuario']; ?>" />
	recomendado apellido.nombre
	<div class="etiqueta">Contrase&ntilde;a:</div>
    <input name="pass" type="password" class="p_input" id="pass" />
    minimo seis caracteres
	<div class="etiqueta">Confirme Contrase&ntilde;a:</div>
    <input name="pass1" type="password" class="p_input" id="pass1" />
    <div class="etiqueta">Tipo:</div>
        <select name="funcion" class="p_input" id="funcion">
        <?php
        $funcion = $data['funcion'];
        $dat_fun = mysql_fetch_array(mysql_query("select tu_name from tipos_usuarios where tu_id = '$funcion'"))
        ?>
  <option selected="selected" value="<?php echo $funcion; ?>"><?php echo $dat_fun['tu_name']; ?></option>
  <?php
  $qtu = mysql_query("select * from tipos_usuarios");
    while ($atu = mysql_fetch_array($qtu)) {
      echo '<option value="'.$atu['tu_id'].'">'.$atu['tu_name'].'</option>';
    }
  ?>
    </select>
	<div class="etiqueta">Seccion:</div>
	<select name="seccion" class="p_input" id="seccion">
	 <option selected="selected" value="<?php echo $data['seccion']; ?>"><?php echo $data['seccion']; ?></option>
	<?php
$qseg=mysql_query("SELECT seccion FROM secciones");
while($rseg=mysql_fetch_row($qseg))
	{
		echo "<option value='".$rseg[0]."'>".$rseg[0]."</option>";
	}	
	?>
    </select>
	<div>
        <label>
	<input type="button" name="Submit" value="Guardar Datos" onClick="Validar(this.form)"/>
	</label>
	    <input name="id_us" type="hidden" id="id_us" value="<?php echo $id_us; ?>" />
	</div>
  </form>
   <?php
  if ($_GET['error']==1){
  echo '<div class="error">El usuario ingresado ya existe.</div>';
  }
  ?>
  
  </div>

</div>
</body>
</html>
