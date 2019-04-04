<?php
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Datos del Prestamo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
		<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
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
  <div class="barri"><b><a href="nuevo_prestamo_v.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a> - <a href="#" title="armar listados de afiliados">Armar listados</a></b></div>
  <h1>Preparar listado  de Prestamos para Vivienda </h1>
  <div id="datos_af">
  <form action="expo.php" method="post">
  Mes y Año a listar: 
  <select name="mes">
  <option selected="selected" value="<?php echo date("m"); ?>"><?php echo date("m"); ?></option>
  <?php
  $m=1;
  while($m<13){
  	if($m < 10){
	echo '<option value="0'.$m.'">0'.$m.'</option>';
	} else {
  	echo '<option value="'.$m.'">'.$m.'</option>';
  }
  $m++;
  }
  ?>
  </select>
  <select name="anio">
  <option selected="selected" value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
  <?php
  $a=2013;
  while($a<2030){
  	
  	echo '<option value="'.$a.'">'.$a.'</option>';
  $a++;
  }
  ?>
  </select>
  <input type="submit" name="listar" value="Listar" />
  </form>
  
  </div>
  
  
  
  <p></p>
   <?php
  if($_GET['ex']=='1'){
  echo '<b> Se exportaron los datos en forma correcta <a href="back/exportar.txt">descargar</a></b>';
	}
  ?>
  <p> </p>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
	 <th>Mes</th>
      <th>Año</th>
	  <th>Archivo</th>
    
    </tr>
<?php
$txt = "select * from historial_expo order by id_ex desc";
$q = mysql_query($txt);
for ($z=0; $z<mysql_num_rows($q); $z++){
$a= mysql_fetch_array($q);
echo '<tr>';
echo '<td>'.$a['mes'].'</td>';
echo '<td>'.$a['anio'].'</td>';
echo '<td><a href="back/'.$a['archivo'].'">Bajar</a></td>';
echo '</tr>';
}
?>
</table>
</div>
</div>
</body>
</html>
