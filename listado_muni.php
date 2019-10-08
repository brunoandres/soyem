<?php
$page = 'prestamos';
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - lidtado Muni</title>
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
  <div class="barri">
<div class="actual_buto"><a href="prestamos.php" title="Ver prestamos">Listado de Prestamos</a></div>


<div class="actual_buto"><a href="nuevo_prestamo.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a></div><div class="actual_buto"><a href="listado_banco.php" title="armar listados de prestamos debito">Armar listado Banco</a></div>
<div class="actual_buto">Armar listado Muni</div>
<div class="actual_buto"><a href="veraz.php" title="ir al veraz">Veraz</a></div>
<br clear="all" />
</div>
  <h1>Preparar listado  de Prestamos para enviar a la Municipalidad </h1>
  <div id="datos_af">
  <form action="expo_muni.php" method="post">
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
  $a_actual = date("Y");
  $a_tope = $a_actual + 20;
  while($a_actual<$a_tope){
  	
  	echo '<option value="'.$a_actual.'">'.$a_actual.'</option>';
  $a_actual++;
  }
  ?>
  </select>
  Tipo de archivo: 
  <select name="tipo">
  <option>Borrador</option>
  <option>Listado definitivo</option>
  </select>
   <input type="submit" name="listar" value="Crear" />

  </form>
  <div id="atencion">Solo se puede generar un único listado a la municipalidad por mes.</div>
  </div>
  
  
  
  <p></p>
   <?php
  if($_GET['error']=='1'){
  echo '<script>alert("Atención: el mes solicitado ya fue listado anteriormente.");</script>';
	}elseif ($_GET['error']=='2') {
    echo '<script>alert("Atención: error al abrir liquidación.");</script>';
  }
  ?>
  <p> </p>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
	 <th>Mes</th>
      <th>Año</th>
	  <th>Archivo definitivo</th>
	  <th>Archivo borrador</th>
	  <th>Total</th>
    <th>Opciones</th>
    </tr>
<?php
$txt = "select * from historial_expo_muni order by id_ex desc";
$q = mysql_query($txt);
for ($z=0; $z<mysql_num_rows($q); $z++){
$a= mysql_fetch_array($q);
echo '<tr>';
echo '<td>'.$a['mes'].'</td>';
echo '<td>'.$a['anio'].'</td>';

echo '<td>';
if ($a['archivo'] != ""){
echo '<a href="back_muni/'.$a['archivo'].'" target="_blank">Descargar archivo</a>';
}
echo '</td>';
echo '<td>';
if ($a['borrador']!= ""){
echo '<a href="back_muni/'.$a['borrador'].'" target="_blank">Descargar archivo</a>';
}
echo '</td>';
echo '<td> $ '.$a['total'].'</td>';
if ($_SESSION["seccion"]=='administrador' || $_SESSION["usuario"]=='cenergon') {
  echo "<td>
<form action='abrir_liquidacion_prestamos.php' method='POST'>
  <input type='hidden' name='mes' value='".$a['mes']."' />
  <input type='hidden' name='anio' value='".$a['anio']."' />
  <input type='submit' name='btnForm' value='Abrir Liquidación' onclick='return confirm(\"Confirma abrir liquidación?\");'>
</form>
</td>"
}else{
  echo "<td></td>";
}
;
echo '</tr>';
}
?>
</table>
</div>
</div>
</body>
</html>
