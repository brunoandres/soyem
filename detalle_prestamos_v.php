<?php
$page = 'prestamos_viviendas';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
$clave_prestamo = $_GET['clave_prestamo'];
$data = mysql_fetch_array(mysql_query("select * from prestamos_viviendas where clave_prestamo='$clave_prestamo'"));
$clave = $data['afiliado'];
	$clave_empresa = $data['proveedor'];
	$d_afiliado = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$clave'"));
	if($data['proveedor']==0){
	$provee = "Soyem";
	} else {
	$d_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
	$provee = $d_empresa['nombre'];
	}
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
<?php include 'footer.php'; ?>
<div id="contanido">
<div id="cuerpo">
  <div class="barri"><b><a href="nuevo_prestamo_v.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a> - <a href="#" title="armar listados de afiliados">Armar listados</a></b></div>
  <h1>Datos del Prestamo Vivienda </h1>
  <div id="datos_af">
<?php
echo 'Nombre: <b>'.$d_afiliado['nombre'].'</b><br>';
echo 'Legajo: <b>'.$d_afiliado['legajo'].'</b><br>';
echo 'Documento: <b>'.$d_afiliado['documento'].'</b><br>';
echo 'Fecha de Otorgamiento: <b>'.substr($data['fecha_prestamo'],8,2).'/'.substr($data['fecha_prestamo'],5,2).'/'.substr($data['fecha_prestamo'],0,4).'</b><br>';
echo 'Cuotas: <b>'.$data['num_cuotas'].'</b> - ';
echo 'Importe Cuota: <b>$ '.$data['monto'].'</b> - ';
echo 'Total del Prestamo: <b>$ '.$data['monto']*$data['num_cuotas'].'</b><br>';
echo 'Observaciones: <br><font color="009900">'.$data['observaciones'].'</font><br>';
?>

<a href="mod_plan_v.php?clave_prestamo=<?php echo $clave_prestamo; ?>" class="example6">Modificar Plan

</a></div>
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
	 <th>Cuota</th>
      <th>Total Cuotas</th>
	  <th>Vencimiento</th>

	   <th>Importe</th>
	   <th>Modificar</th>
	   <th>Quitar cuota</th>

    </tr>
<?php
$cuo1 =  $clave_prestamo - $data['cuota'];
$cuo2 =  $cuo1 + $data['num_cuotas'];
$txt = "select * from prestamos_viviendas where (clave_prestamo >= ".$cuo1." and clave_prestamo <=".$cuo2.") order by clave_prestamo asc";
$q = mysql_query($txt);
for ($z=0; $z<mysql_num_rows($q); $z++){
$a= mysql_fetch_array($q);
echo '<tr>';
echo '<td>'.$a['cuota'].'</td>';
echo '<td>'.$data['num_cuotas'].'</td>';
echo '<td>'.substr($a['vencimiento'],8,2).'-'.substr($a['vencimiento'],5,2).'-'.substr($a['vencimiento'],0,4).'</td>';
echo '<td>$ '.$a['monto'].'</td>';
echo '<td align="center"><a href="mod_cuota_v.php?clave_prestamo='.$a{'clave_prestamo'}.'" class="example6">Modificar</a></td>';
echo '<td align="center"><a href="quitar_cuota_v.php?clave_prestamo='.$a{'clave_prestamo'}.'&vuelve='.$clave_prestamo.'" title="Quitar esta cuota del prestamo" onclick="return confirmar(';
	   echo "'�Est� seguro que desea quitar esta cuota del prestamo?'";
	  echo ')" >Quitar Cuota</a></td>';
echo '</tr>';
}
?>
</table>
</div>
</div>
</body>
</html>
