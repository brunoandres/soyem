<?php
$page = 'contabilidad';
$subpage = 'cuentas';
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Contabilidad</title>
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
 <script LANGUAGE="JavaScript">
function Validar1(form)
{
  if (form.rubro.value == "")
  { alert("Por favor ingrese al rubro"); form.rubro.focus(); return; }

  
   if (form.cuenta.value == "")
  { alert("Por favor ingrese la cuenta"); form.cuenta.focus(); return; }
  
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
  window.alert("El rubro se sgrego con exito");
</SCRIPT>';
  }
    if ($_GET['mostrar']==2){
  echo '<SCRIPT>
  window.alert("La cuenta se sgrego con exito");
</SCRIPT>';
  }
  ?>
 <link type="text/css" media="screen" rel="stylesheet" href="colorbox.css" />
		<script type="text/javascript" src="colorbox/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="colorbox/jquery.colorbox.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				
				$(".example6").colorbox({iframe:true, innerWidth:700, innerHeight:420});
				
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
<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
<div id="contanido">

<div id="cuerpo">


<?php include("recortes/menu_cont.php"); ?>
  <form action="agrega_rubro.php" method="post">
    <div class="subt"> Agregar Rubros: </div>
	<div class="etiqueta">Rubro:</div>
    <input name="rubro" type="text" class="p_input" id="rubro" />
    
    <div class="etiqueta">Titulo:</div>
        <select name="titulo" class="p_input" id="titulo">
  <option selected="selected"></option>
  <option>Activo</option>
  <option>Pasivo</option>
   <option>Patrimonio Neto</option>
  <option>Cuentas Positivas</option>
   <option>Cuentas Negativas</option>
    </select>
	<div>
        <label>
	<input type="button" name="Submit" value="Agregar Rubro" onClick="Validar(this.form)"/>
	</label>
	</div>
  </form>
  <?php
  if ($_GET['error']==1){
  echo '<div class="error">El usuario ingresado ya existe.</div>';
  }
  ?>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
      <th>Rubro</th>
	  <th>Titulo</th>
      <th>modificar</th>
      <th>quitar</th>
    </tr>
	<?php
	$u=mysql_query("select * from con_rubros");
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>
      <td>'.$au['rubro'].'</td>
	    <td>'.$au['titulo'].'</td>';
if($_SESSION["seccion"]=='administrador'){
  echo '
    <td><a href="modificar_rubro.php?id_rubro='.$au['id_rubro'].'" class="example6">Modificar</a></td>';
    
      echo '<td><a href="quitar_rubro.php?id_rubro='.$au['id_rubro'].'" title="Quitar este usuario" onclick="return confirmar(';
	   echo "'¿Está seguro que desea quitar este rubro?'";
	  echo ')" >Quitar</a></td></tr>';
    }else{
      echo '<td>--</td></tr>';
    } 
     

	}
	?>
  </table>
  <hr />
   <form action="agrega_cuentas.php" method="post">
    <div class="subt"> Agregar Cuentas: </div>
	<div class="etiqueta">Cuenta:</div>
    <input name="cuenta" type="text" class="p_input" id="cuenta" />
    
    <div class="etiqueta">Rubro:</div>
        <select name="rubro" class="p_input" id="rubro">
  <option selected="selected"></option>
  <?php
  $q_rubros = mysql_query("select * from con_rubros order by rubro asc");
  for($r=0; $r<mysql_num_rows($q_rubros); $r++){
  $a_rubros = mysql_fetch_array($q_rubros);
  echo '<option value="'.$a_rubros['id_rubro'].'">'.$a_rubros['rubro'].' ('.$a_rubros['titulo'].')</option>';
  }
  ?>
    </select>
	<div>
        <label>
	<input type="button" name="Submit" value="Agregar Cuenta" onClick="Validar1(this.form)"/>
	</label>
	</div>
  </form>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
      <th>Cuenta</th>
      <th>Rubro</th>
	    <th>Titulo</th>
      <th>modificar</th>
      <th>quitar</th>
    </tr>
	<?php
	$uu=mysql_query("select * from cuentas INNER JOIN con_rubros on cuentas.id_rubro = con_rubros.id_rubro");
	for ($j = 0; $j < mysql_num_rows($uu); $j = $j +1){
	$auu=mysql_fetch_array($uu);
    echo'<tr>
	<td>'.$auu['cuenta'].'</td>
      <td>'.$auu['rubro'].'</td>
	    <td>'.$auu['titulo'].'</td>';
      if($_SESSION["seccion"]=='administrador'){
        echo '
    <td><a href="#">Modificar</a></td>';
    

      echo '<td><a href="quitar_cuenta.php?id_cuentas='.$auu['id_cuentas'].'" title="Quitar esta cuenta" onclick="return confirmar(';
	   echo "'¿Está seguro que desea quitar esta cuenta?'";
	  echo ')" >Quitar</a></td>
    </tr>';
    }else{

      echo '<td>--</td></tr>';
      

    }
     
	}
	?>
  </table>

</div>











  </div>
</body>
</html>
