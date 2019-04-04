<?php
include("conecta.php");
$id_rubro = $_GET['id_rubro'];
$data =  mysql_fetch_array(mysql_query("select * from con_rubros where id_rubro = '$id_rubro'"));
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
  if (form.rubro.value == "")
  { alert("Por favor ingrese al rubro"); form.rubro.focus(); return; }
   
   if (form.titulo.value == "")
  { alert("Por favor ingrese el titulo"); form.titulo.focus(); return; }
    
 form.submit();
}

</script>

</head>

<body>
<div id="cubierta">
<div id="cuerpo">
  <h1>Modificar Rubro: </h1>
  <form action="modifica_rubro.php" method="post">
    <div class="etiqueta">Rubro:</div>
    <input name="rubro" type="text" class="p_input" id="rubro" value="<?php echo $data['rubro']; ?>" />
	
    <div class="etiqueta">Titulo:</div>
        <select name="titulo" class="p_input" id="titulo">
  <option selected="selected"><?php echo $data['titulo']; ?></option>
 <option>Activo</option>
  <option>Pasivo</option>
   <option>Patrimonio Neto</option>
  <option>Cuentas Positivas</option>
   <option>Cuentas Negativas</option>
    </select>
	<div>
        <label>
	<input type="button" name="Submit" value="Guardar Datos" onClick="Validar(this.form)"/>
	</label>
	    <input name="id_rubro" type="hidden" id="id_rubro" value="<?php echo $id_rubro; ?>" />
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
