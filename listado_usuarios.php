<?php
$page = 'usuarios';
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
include("funciones_grales.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Usuarios</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
  <script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.usuario.value == "")
  { alert("Por favor ingrese al usuario"); form.usuario.focus(); return; }
  /*
  if (form.correo.value == "")
  { alert("Por favor correo electronico"); form.correo.focus(); return; }

  if (form.correo.value.indexOf('@', 0) == -1 ||
      form.correo.value.indexOf('.', 0) == -1)
  { alert("Direccion de e-mail invalida"); form.correo.focus(); return; }
  */

   if (form.pass.value == "")
  { alert("Por favor ingrese la contrase�a"); form.pass.focus(); return; }


   if (form.pass1.value == "")
  { alert("Por favor ingrese la confirmaci�n de la contrase�a"); form.pass1.focus(); return; }

   if (form.pass.value != form.pass1.value)
  { alert("Las contrase�as no coinciden"); form.pass1.focus(); return; }

   if (form.funcion.value == "")
  { alert("Por favor defina la funcion del usuario"); form.funcion.focus(); return; }

 form.submit();
}

</script>
<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
}
</script>
<?php
  if ($_GET['mostrar']==1){
  echo '<SCRIPT>
  window.alert("El usuario se sgrego con exito");
</SCRIPT>';
  }
  ?>
 <link type="text/css" media="screen" rel="stylesheet" href="colorbox.css" />
		<script type="text/javascript" src="colorbox/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="colorbox/jquery.colorbox.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements

				$(".example6").colorbox({iframe:true, innerWidth:700, innerHeight:440});

				  $().bind('cbox_closed',function() {
      location.reload(true);
   });

				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
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
<?php include 'footer.php'; ?>
<div id="contanido">

<div id="cuerpo">


<h1>Listado de usuarios: </h1>
  <form action="agrega_usuario.php" method="post">
    <div class="subt"> Agregar Usuario: </div>
	<div class="etiqueta">Usuario:</div>
    <input name="usuario" type="text" class="p_input" id="usuario" autocomplete="off" placeholder="recomendado apellido.nombre"/>

	<div class="etiqueta">Contrase&ntilde;a:</div>
    <input name="pass" type="password" class="p_input" id="pass" placeholder="minimo seis caracteres"/>

	<div class="etiqueta">Confirme Contrase&ntilde;a:</div>
    <input name="pass1" type="password" class="p_input" id="pass1" placeholder="minimo seis caracteres" />
    <div class="etiqueta">Tipo:</div>
        <select name="funcion" class="p_input" id="funcion">
  <option selected="selected"></option>
  <?php
  $qtu = mysql_query("select * from tipos_usuarios");
    while ($atu = mysql_fetch_array($qtu)) {
      echo '<option value="'.$atu['tu_id'].'">'.$atu['tu_name'].'</option>';
    }
  ?>

    </select>
	<div class="etiqueta">Seccion:</div>
	<select name="seccion" class="p_input" id="seccion">
	 <option selected="selected"></option>
	 <?php
$qseg=mysql_query("SELECT seccion FROM secciones");
while($rseg=mysql_fetch_row($qseg))
	{
		echo "<option value='".$rseg[0]."'>".$rseg[0]."</option>";
	}
	?>
    </select>
	<div>
  <br>
        <label>
	<input type="button" name="Submit" value="Guardar Datos" onClick="Validar(this.form)"/>
	</label>
  <br>
	</div>
  </form>
  <br>
  <?php
  if ($_GET['error']==1){
  echo '<div class="error">El usuario ingresado ya existe.</div>';
  }
  ?>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
      <th>usuario</th>
	  <th>tipo</th>
	  <th>seccion</th>
      <th>modificar</th>
      <th>quitar</th>
    </tr>
	<?php
	$u=mysql_query("select * from usuarios");
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>
      <td>'.$au['usuario'].'</td>
	    <td>'.BuscaRegistro("tipos_usuarios","tu_id",$au['funcion'],"tu_name").'</td>
		<td>'.$au['seccion'].'</td>
		<td><a href="modificar_usuario.php?id_us='.$au['id_us'].'" class="example6">Modificar</a></td>';
     echo '<td><a href="quitar_usuario.php?id_us='.$au['id_us'].'" title="Quitar este usuario" onclick="return confirmar(';
	   echo "'�Est� seguro que desea quitar este usuario?'";
	  echo ')" >Quitar</a></td>
    </tr>';
	}
	?>
  </table>
</div>











  </div>
</body>
</html>
