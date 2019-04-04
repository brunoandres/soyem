<?php
include("secure3.php");
include("conecta.php");
include ("funciones_grales.php");
$vale = $_GET['vale'];
$dat = mysql_fetch_array(mysql_query("select * from prestamos where vale='$vale'"));
$clave_prestamo_calc = $_GET['clave_prestamo'] - $dat['cuota'] + 1;
$provee = $dat['proveedor'];
$dat_p = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$provee'"));
$afi = $dat['afiliado'];
$dat_a = mysql_fetch_array(mysql_query("select * from afiliado where clave='$afi'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimir Vale</title>
<link href="print.css" rel="stylesheet" type="text/css" /></head>

<body>
<div id="gral">
<div id="top">
<img src="iconos/logo_soyem.png" width="93" height="120" />
<div id="top_der">
<H1>SOYEM BARILOCHE</H1>
<H2>VALE NRO. <?php echo $dat['vale']; ?></H2>
<H3>COMPROBANTE</H3>
<?php echo substr($dat['fecha_prestamo'],8,2).' / '.substr($dat['fecha_prestamo'],5,2).' / '.substr($dat['fecha_prestamo'],0,4); ?>
</div>
<br clear="all" />
</div>
<div id="resto">
<div class="sub_iz">
<p>Afiliado: <b><?php echo $dat_a['nombre']; ?></b></p>
<p>Legajo: <b><?php echo $dat_a['legajo']; ?></b></p>
</div>
<div class="sub_iz">
<?php
if ($dat['vale_pro'] != "X"){
	if ($dat['lena'] == "X"){
?>
<p>Tipo:<strong> Leña Soyem </strong></p>
<?php
	}
	if ($dat['proveduria'] == "X"){
		?>
		<p>Tipo:<strong> Proveduria Soyem </strong></p>
		<?php
	}
	if ($dat['proveduria'] != "X" && $dat['lena'] != "X"){
		?>
		<p>Tipo:<strong> Dinero Soyem </strong></p>
		<?php
	}
} else {
?>
<p>Tipo:<strong> Prestamo Proveedor </strong></p>
<?php
}
?>
<p>Importe:  <b>$ <?php echo total_prestamo($clave_prestamo_calc,$dat['num_cuotas']); ?>.-</b></p>
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] != "X"){
?>
<p>Forma:  <b>Cheque</b></p>
<?php 
if ($dat['cuenta_banco'] == "G"){
?>
<p>Banco:  <b>Banco Credicoop</b></p>
<?php } else { ?>
<p>Banco:  <b>Banco Patagonia</b></p>
<?php
}
?>
<p>Nro de Cheque :  <b><?php echo $dat['cheque_nro']; ?></b></p>
<?php
}
?>
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] == "X"){
?>
<p>Forma:  <b>Efectivo</b></p>
<?php
}
?>

<?php
if ($dat['vale_pro'] != "X" and $dat['lena'] == "X"){
?>
<p>Forma:  <b>Leña</b></p>
<?php
}
?>

<?php
if ($dat['vale_pro'] != "X" and $dat['proveduria'] == "X"){
?>
<p>Forma:  <b>Mercaderia</b></p>
<?php
}
?>






<?php
if ($dat['vale_pro'] == "X"){
?>
<p>Proveedor:  <b><?php echo $dat_p['nombre']; ?></b></p>
<?php
}
?>
</div>
<br clear="all" /> 
</div>
<div id="firma">
<hr />
Firma del Afiliado
</div>
<br clear="all" />


</div>

<hr />

<div id="gral">
<div id="top">
<img src="iconos/logo_soyem.png" width="93" height="120" />
<div id="top_der">
<H1>SOYEM BARILOCHE</H1>
<H2>VALE NRO. <?php echo $dat['vale']; ?></H2>
<H3>VALE</H3>
<?php echo substr($dat['fecha_prestamo'],8,2).' / '.substr($dat['fecha_prestamo'],5,2).' / '.substr($dat['fecha_prestamo'],0,4); ?>
</div>
<br clear="all" />
</div>
<div id="resto">
<div class="sub_iz">
<p>Afiliado: <b><?php echo $dat_a['nombre']; ?></b></p>
<p>Legajo: <b><?php echo $dat_a['legajo']; ?></b></p>
</div>
<div class="sub_iz">
<?php
if ($dat['vale_pro'] != "X"){
?>
<p>Tipo:<strong> Dinero Soyem </strong></p>
<?php
} else {
?>
<p>Tipo:<strong> Prestamo Proveedor </strong></p>
<?php
}
?>
<p>Importe:  <b>$ <?php echo total_prestamo($clave_prestamo_calc,$dat['num_cuotas']); ?>.-</b></p>
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] != "X"){
?>
<p>Forma:  <b>Cheque</b></p>
<?php 
if ($dat['cuenta_banco'] == "G"){
?>
<p>Banco:  <b>Banco Credicoop</b></p>
<?php } else { ?>
<p>Banco:  <b>Banco Patagonia</b></p>
<?php
}
?>
<p>Nro de Cheque :  <b><?php echo $dat['cheque_nro']; ?></b></p>
<?php
}
?>
<?php
if ($dat['vale_pro'] != "X" and $dat['efectivo'] == "X"){
?>
<p>Forma:  <b>Efectivo 
<?php
if ($dat['cuenta_motivo'] == 2){
echo '(Caja Chica)';
}
if ($dat['cuenta_motivo'] == 1){
echo '(Tesoreria)';
}
?>
</b></p>
<?php
}
?>
<?php
if ($dat['vale_pro'] == "X"){
?>
<p>Proveedor:  <b><?php echo $dat_p['nombre']; ?> </b>
<?php
if ($dat_p['es_salud'] == 'si'){
echo '(Salud)';
}
?>

</p>
<?php
}
?>
</div>
<br clear="all" /> 
</div>
<div id="firma">
<hr />
Por SOYEM
</div>
<br clear="all" />


</div>
<input type="button" value="Imprimir" onclick="javascript:window.print()" />
</body>
</html>
