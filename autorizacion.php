<?php
include("secure1.php");
include("conecta.php");
include("convertir.php");
include ("funciones_grales.php");
$clave_prestamo = $_GET['clave_prestamo'];
$dat = mysql_fetch_array(mysql_query("select * from prestamos where clave_prestamo='$clave_prestamo'"));
$clave_prestamo_calc = $clave_prestamo - $dat['cuota'] + 1;
$provee = $dat['proveedor'];
$dat_p = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$provee'"));
$afi = $dat['afiliado'];
$dat_a = mysql_fetch_array(mysql_query("select * from afiliado where clave='$afi'"));
$montoT = $dat['num_cuotas']*$dat['monto'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimir Autorizacion Debito</title>
<link href="print.css" rel="stylesheet" type="text/css" /></head>

<body>
<div id="gral">
<div id="top">
<img src="iconos/logo_soyem.png" width="93" height="120" />
<div id="top_der">
<H1>SOYEM BARILOCHE</H1>
<H2>AUTORIZACION DE DEBITO SOBRE CAJA DE AHORRO</H2>

<?php echo substr($dat['fecha_prestamo'],8,2).' / '.substr($dat['fecha_prestamo'],5,2).' / '.substr($dat['fecha_prestamo'],0,4); ?>
</div>
<br clear="all" />
</div>
<div id="resto">
<div style="margin-top:10px; margin-bottom:10px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
Por medio de la presente se autoriza a la conducción del Sindicato de Obreros y Empleados Municipales (S.O.y E.M.) a debitar de mi caja de ahorro el importes y concepto que se detallan a continuación, por única vez. 
</div>
<div class="sub_iz1">
<p>Apellido y Nombre: <b><?php echo $dat_a['nombre']; ?></b></p>
<p>Nro de Legajo: <b><?php echo $dat_a['legajo']; ?></b></p>
</div>
<div class="sub_iz1">
<p>Documento Nro: <b><?php echo $dat_a['documento']; ?></b></p>
<p>Nro de CUIL: <b><?php echo $dat_a['cuil']; ?></b></p>
</div>
<br clear="all" /> 
</div>
<div>
<p>Importe:  <b>$ <?php echo total_prestamo($clave_prestamo_calc,$dat['num_cuotas']) ?>.-</b></p>
<p>Son Pesos:  <b> <?php echo convertirMonto(total_prestamo1($clave_prestamo_calc,$dat['num_cuotas'])); ?></b></p>
</div>
<div style="margin-top:30px">
<p>Banco:  <b> <?php echo $dat_a['banco']; ?></b></p>
<p>CBU:  <b> <?php echo $dat_a['cbu_bd']; ?></b></p>
</div>
<div style="margin-top:30px">
<p>Concepto: <b>Ayuda Social  
<?php
if ($dat['vale_pro'] != "X"){
?>
de Soyem 
<?php
} else {
?>
de Proveedor 
<?php
}
?>
por un importe de $ <?php echo total_prestamo($clave_prestamo_calc,$dat['num_cuotas']) ?>.- 
<!-- cheque -->
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] != "X" and $dat['turismo'] != "X"){
?>
en Forma de Cheque
<?php 
if ($dat['cuenta_banco'] == "G"){
?>
del Banco Credicoop 
<?php } else { ?>
del Banco Patagonia 
<?php
}
?>
 con Nro de Cheque <?php echo $dat['cheque_nro']; ?>
<?php
}
?>
<!-- fin cheque -->

<!-- turismo -->
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] != "X" and $dat['turismo'] == "X"){
?>
en Forma de Servicio de Turismo
<?php
}
?>
<!-- fin turismo -->







<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] == "X"){
?>
en Efectivo
<?php
}
?>
<?php
if ($dat['vale_pro'] == "X"){
?>
 del Proveedor <?php echo $dat_p['nombre']; ?>
<?php
}
?>
</b></p></div>

<div style="margin-top:30px; margin-bottom:100px;">
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr bgcolor="#CCCCCC">
	 <th>Cuota</th>
      <th>Total Cuotas</th>
	  <th>Vencimiento</th>
  
	   <th>Importe</th>
    
    </tr>
<?php
$cuo1 =  $clave_prestamo - $dat['cuota'];
$cuo2 =  $cuo1 + $dat['num_cuotas'];
$txt = "select * from prestamos where (clave_prestamo > ".$cuo1." and clave_prestamo <=".$cuo2.") order by clave_prestamo asc";
$q = mysql_query($txt);
for ($z=0; $z<mysql_num_rows($q); $z++){
$a= mysql_fetch_array($q);
echo '<tr>';
echo '<td>'.$a['cuota'].'</td>';
echo '<td>'.$dat['num_cuotas'].'</td>';
echo '<td>'.substr($a['vencimiento'],5,2).' - '.substr($a['vencimiento'],0,4).'</td>';
echo '<td>$ '.$a['monto'].'</td>';
echo '</tr>';
}
?>
</table>
</div>



<div id="firma">
<hr />
Firma del Afiliado
</div>
<br clear="all" />


</div>


<div style="page-break-before: always;"> </div>











<div id="gral">
<div id="top">
<img src="iconos/logo_soyem.png" width="93" height="120" />
<div id="top_der">
<H1>SOYEM BARILOCHE</H1>
<H2>AUTORIZACION DE DEBITO SOBRE CAJA DE AHORRO</H2>

<?php echo substr($dat['fecha_prestamo'],8,2).' / '.substr($dat['fecha_prestamo'],5,2).' / '.substr($dat['fecha_prestamo'],0,4); ?>
</div>
<br clear="all" />
</div>
<div id="resto">
<div style="margin-top:10px; margin-bottom:10px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
Por medio de la presente se autoriza a la conducción del Sindicato de Obreros y Empleados Municipales (S.O.y E.M.) a debitar de mi caja de ahorro el importes y concepto que se detallan a continuación, por única vez. 
</div>
<div class="sub_iz1">
<p>Apellido y Nombre: <b><?php echo $dat_a['nombre']; ?></b></p>
<p>Nro de Legajo: <b><?php echo $dat_a['legajo']; ?></b></p>
</div>
<div class="sub_iz1">
<p>Documento Nro: <b><?php echo $dat_a['documento']; ?></b></p>
<p>Nro de CUIL: <b><?php echo $dat_a['cuil']; ?></b></p>
</div>
<br clear="all" /> 
</div>
<div>
<p>Importe:  <b>$ <?php echo total_prestamo($clave_prestamo_calc,$dat['num_cuotas']) ?>.-</b></p>
<p>Son Pesos:  <b> <?php echo convertirMonto(total_prestamo1($clave_prestamo_calc,$dat['num_cuotas'])); ?></b></p>
</div>
<div style="margin-top:30px">
<p>Banco:  <b> <?php echo $dat_a['banco']; ?></b></p>
<p>CBU:  <b> <?php echo $dat_a['cbu_bd']; ?></b></p>
</div>
<div style="margin-top:30px">
<p>Concepto: <b>Ayuda Social  
<?php
if ($dat['vale_pro'] != "X"){
?>
de Soyem 
<?php
} else {
?>
de Proveedor 
<?php
}
?>
por un importe de $ <?php echo total_prestamo($clave_prestamo_calc,$dat['num_cuotas']) ?>.- 
<!-- cheque -->
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] != "X" and $dat['turismo'] != "X"){
?>
en Forma de Cheque
<?php 
if ($dat['cuenta_banco'] == "G"){
?>
del Banco Credicoop 
<?php } else { ?>
del Banco Patagonia 
<?php
}
?>
 con Nro de Cheque <?php echo $dat['cheque_nro']; ?>
<?php
}
?>
<!-- fin cheque -->

<!-- turismo -->
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] != "X" and $dat['turismo'] == "X"){
?>
en Forma de Servicio de Turismo
<?php
}
?>
<!-- fin turismo -->
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] == "X"){
?>
en Efectivo
<?php
}
?>
<?php
if ($dat['vale_pro'] == "X"){
?>
 del Proveedor <?php echo $dat_p['nombre']; ?>
<?php
}
?>
</b></p></div>

<div style="margin-top:30px; margin-bottom:100px;">
<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr bgcolor="#CCCCCC">
	 <th>Cuota</th>
      <th>Total Cuotas</th>
	  <th>Vencimiento</th>
  
	   <th>Importe</th>
    
    </tr>
<?php
$cuo1 =  $clave_prestamo - $dat['cuota'];
$cuo2 =  $cuo1 + $dat['num_cuotas'];
$txt = "select * from prestamos where (clave_prestamo > ".$cuo1." and clave_prestamo <=".$cuo2.") order by clave_prestamo asc";
$q = mysql_query($txt);
for ($z=0; $z<mysql_num_rows($q); $z++){
$a= mysql_fetch_array($q);
echo '<tr>';
echo '<td>'.$a['cuota'].'</td>';
echo '<td>'.$dat['num_cuotas'].'</td>';
echo '<td>'.substr($a['vencimiento'],5,2).' - '.substr($a['vencimiento'],0,4).'</td>';
echo '<td>$ '.$a['monto'].'</td>';
echo '</tr>';
}
?>
</table>
</div>



<div id="firma">
<hr />
Firma Por SOyEm
</div>
<br clear="all" />


</div>
<input type="button" value="Imprimir" onclick="javascript:window.print()" />
</body>
</html>
