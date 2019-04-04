<?php
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Empresas</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
				
				$(".example6").colorbox({iframe:true, innerWidth:700, innerHeight:520});
				
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
  <h1>Listado de Empresas: </h1>
  <div id="nuevo_a"><a href="nueva_empresa.php?ac=nuevo" class="example6">
 Nueva Empresa
  </a></div>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
		
      <th>Nombre</th>
	  <th>Tipo</th>
	    <th>Localidad</th>
	  <th>Dirección</th>
	 <th>Teléfono</th>
	 <th>Para<br />Prestamos</th>
	 <th>Para<br />Salud</th>
	 
      <th></th>
      
    </tr>
	<?php
	
	
	$sq = "select * from empresas order by nombre asc";
	$u=mysql_query($sq);
	$d=0;
	$h=0;
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>';
      
	    echo '<td><b>'.$au['nombre'].'</b></td>';
		echo '<td>'.$au['tipo'].'</td>';
		echo '<td>'.$au['localidad'].'</td>';
		echo '<td>'.$au['domicilio'].'</td>';
		echo '<td>'.$au['telefono'].'</td>';
		if ($au['es_pres']=='si'){
		echo '<td><span class="es_si"><a href="es_prestamo_pro.php?clave_empresa='.$au['clave_empresa'].'&es_pres=no" title="Haga clic para poner en no">'.$au['es_pres'].'</a></span></td>';
		} else {
		echo '<td><span class="es_no"><a href="es_prestamo_pro.php?clave_empresa='.$au['clave_empresa'].'&es_pres=si" title="Haga clic para poner en si">'.$au['es_pres'].'</a></span></td>';
		}
			if ($au['es_pres']=='si'){
				if ($au['es_salud']=='si'){
				echo '<td><span class="es_si"><a href="es_salud_pro.php?clave_empresa='.$au['clave_empresa'].'&es_salud=no" "Haga clic para poner en no">'.$au['es_salud'].'</a></span>';
					$q_r = mysql_query("select * from rubros_salud");
						for ($rs=0;$rs<mysql_num_rows($q_r);$rs++){
						$a_r = mysql_fetch_array($q_r);
						if ($a_r['rubro'] != $au['ru_salud']){
						echo '<span class="rubro_sal"><a href="mod_rubro_salud.php?clave_empresa='.$au['clave_empresa'].'&ru_salud='.$a_r['rubro'].'" title="es '.$a_r['descripcion'].'">'.$a_r['rubro'].'</a></span>';
						} else {
						echo '<span class="rubro_sal_si">'.$a_r['rubro'].'</span>';
						}
						}
				   echo   '</td>';
		} else {
		echo '<td><span class="es_no"><a href="es_salud_pro.php?clave_empresa='.$au['clave_empresa'].'&es_salud=si">'.$au['es_salud'].'</a></span></td>';
		}
		}
		else{
		echo '<td></td>';
		}
		echo '<td><a href="nueva_empresa.php?clave_empresa='.$au['clave_empresa'].'" class="example6"><img src="iconos/modificar.png" title="modificar datos de la empresa" border="0" /></a></td>
    </tr>';
	
	}
	?>
  </table>

  </div>
</div>
</body>
</html>
