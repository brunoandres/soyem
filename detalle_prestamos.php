<?php
$page = 'prestamos';
include("secure3.php");
include("conecta.php");
include ("funciones_grales.php");
$funcion_r=$_SESSION['funcion'];
$clave_prestamo = $_GET['clave_prestamo'];
$data = mysql_fetch_array(mysql_query("select * from prestamos where clave_prestamo='$clave_prestamo'"));
$clave_prestamo_calc = $clave_prestamo - $data['cuota'] + 1;
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
<div class="barri">
<div class="actual_buto"><a href="prestamos.php" title="Ver prestamos">Listado de Prestamos</a></div>


<div class="actual_buto"><a href="nuevo_prestamo.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a></div><div class="actual_buto"><a href="listado_banco.php" title="armar listados de prestamos debito">Armar listado Banco</a></div>
<div class="actual_buto"><a href="listado_muni.php" title="armar listados de prestamos muni">Armar listado Muni</a></div>
<div class="actual_buto"><a href="veraz.php" title="ir al veraz">Veraz</a></div>
<br clear="all" />
</div>
  <h1>Datos del Prestamo <div class="nro_vale"><?php echo "Vale: ".$data['vale']; ?></div>
  <?php
if ($data['tipe_p'] == 'D'){
?>
(debito bancario)
<?php
} else {
?>
  (descuento planilla)
 <?php
}
?>

  </h1>
<div id="datos_af">
<?php
$vz_af = $d_afiliado['clave'];
	if (mysql_num_rows(mysql_query("select * from veraz where vz_af='$vz_af'")) > 0){
		?>
<div class="veraza">Este Afiliado esta en el Veraz</div>
<?php
	}
	?>
<?php
echo 'Nombre: <b>'.$d_afiliado['nombre'].'</b><br>';
echo 'Legajo: <b>'.$d_afiliado['legajo'].'</b><br>';
echo 'Documento: <b>'.$d_afiliado['documento'].'</b><br>';
echo 'Banco: <b>'.$d_afiliado['banco'].'</b><br>';
echo 'CBU: <b>'.$d_afiliado['cbu_bd'].'</b><br>';
echo 'CUIL: <b>'.$d_afiliado['cuil'].'</b><br>';
echo 'Proveedor: <b>'.$provee.'</b><br>';
echo 'Fecha de Otorgamiento: <b>'.substr($data['fecha_prestamo'],8,2).'/'.substr($data['fecha_prestamo'],5,2).'/'.substr($data['fecha_prestamo'],0,4).'</b><br>';
echo 'Cuotas: <b>'.$data['num_cuotas'].'</b> - ';
echo 'Importe Cuota: <b>$ '.$data['monto'].'</b> - ';
echo 'Total del Prestamo: <b>$ '.total_prestamo($clave_prestamo_calc,$data['num_cuotas']).'</b><br>';
if($provee == "Soyem" ){
	if($data['banco']=='X'){
	echo 'Prestamo en: <b>Cheque</b> Cuenta: <b></b> Cheque nro: <b>'.$data['cheque_nro'].'</b><br>';
	} else {
		if($data['turismo']!='X'){
				echo 'Prestamo en: <b>Efectivo</b><br>';
		} else {
				echo 'Prestamo <b>Turismo</b><br>';
		}

	}
}
echo 'Observaciones: <br><font color="009900">'.$data['observaciones'].'</font><br>';
?>
<div><div class="boton_pv"><a href="vale.php?vale=<?php echo $data['vale']; ?>&clave_prestamo=<?php echo $_GET['clave_prestamo']; ?>" target="_blank">Imprimir Vale</a></div>
<?php
if ($data['tipe_p'] == 'D'){
?>
<div class="boton_pv"><a href="autorizacion.php?clave_prestamo=<?php echo $clave_prestamo; ?>" target="_blank">Autoriza Debito</a></div>
<?php
}
?>
<div class="boton_pv"><a href="datos_banco.php?clave=<?php echo $clave; ?>" class="example6">Cambiar datos Banco</a></div>
<?php
if(EstaPlanilla($clave)==0){
	?>
<div class="boton_pv"><a href="recortes/solo_planilla.php?clave=<?php echo $clave; ?>" class="example6">Solo por Planilla</a></div>
<?php } ?>

<br clear="all" />

</div>
</div>
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
	 <th>Cuota</th>
      <th>Total Cuotas</th>
	  <th>Vencimiento</th>

	   <th>Importe</th>
       <th>Cancelado</th>
       <th>Estado</th>
    <th></th>
    </tr>
<?php
$cuo1 =  $clave_prestamo - $data['cuota'];
$cuo2 =  $cuo1 + $data['num_cuotas'];
$vale = $data['vale'];
$txt = "select * from prestamos where (vale='$vale') order by cuota asc";
$q = mysql_query($txt);
for ($z=0; $z<mysql_num_rows($q); $z++){
$a= mysql_fetch_array($q);
echo '<tr>';
echo '<td>'.$a['cuota'].'</td>';
echo '<td>'.$data['num_cuotas'].'</td>';
echo '<td>'.substr($a['vencimiento'],8,2).'-'.substr($a['vencimiento'],5,2).'-'.substr($a['vencimiento'],0,4).'</td>';
echo '<td>$ '.$a['monto'].'</td>';
echo '<td>$ '.total_pagos($a['clave_prestamo']).'</td>';
if ($a['pagado']=='I'){
?>

<td><div style="background:#900; color:#FFF; font-style:normal; text-align:center; display:inline; padding-left:5px; padding-right:5px;  font-weight: bold">Impago</div></td>
<td>
<?php
if ($funcion_r == 1){
	?>
<a href="change_pago1.php?clave_prestamo=<?php echo $a['clave_prestamo']; ?>" style="background:#090; color:#FFF; font-style:normal; text-align:center; display:inline; padding-left:5px; padding-right:5px;  font-weight: bold; text-decoration:none; margin-right:5px" title="poner como pagado" class="example6">P</a>
<?php
if($a['cuota'] != $data['num_cuotas']){
?>
<a href="change_pago.php?clave_prestamo=<?php echo $a['clave_prestamo']; ?>&cuota=<?php echo $a['cuota']; ?>&monto=<?php echo $a['monto']; ?>" style="background:#06C; color:#FFF; font-style:normal; text-align:center; display:inline; padding-left:5px; padding-right:5px;  font-weight: bold; text-decoration:none; margin-right:5px" title="pasar el monto a la soguiente cuota">>></a>
<?php
}
}
?>

</td>
<?php
}
if ($a['pagado']=='P'){
	?>
    <td><div style="background:#090; color:#FFF; font-style:normal; text-align:center; display:inline; padding-left:5px; padding-right:5px;  font-weight: bold">Pagado</div></td>
    <td>
    <?php
if ($funcion_r == 1){
	?>
    <a href="change_pago.php?clave_prestamo=<?php echo $a['clave_prestamo']; ?>&change=I&cuota=<?php echo $a['cuota']; ?>" style="background:#F30; color:#FFF; font-style:normal; text-align:center; display:inline; padding-left:8px; padding-right:8px;  font-weight: bold; text-decoration:none; margin-right:5px" title="poner como impago">I</a>
   <?php
}
	?>
	</td>
    <?php
}
echo '</tr>';
}
?>
</table>
<div>
<?php
if ($funcion_r == 1){
	?>
<div class="boton_pv"><a href="quitar_prestamo.php?clave_prestamo=<?php echo $clave_prestamo; ?>" class="example6">Quitar Prestamo</a></div>

<?php
if (mysql_num_rows(mysql_query("select * from veraz where vz_af='$vz_af'")) == 0){
	?>
<div class="boton_pv"><a href="poner_veraz.php?clave_prestamo=<?php echo $clave_prestamo; ?>" class="example6">Poner en el Veraz</a></div>
<?php
}
?>
<?php
}
?>
<br clear="all" />

</div>
</div>
</div>
</body>
</html>
