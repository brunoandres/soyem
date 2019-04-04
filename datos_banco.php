<?php
include ("conecta.php");
$clave = $_GET['clave'];
$dat = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$clave' "));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 14px;
	color: #333;
	line-height: 20px;
}
.quita_acc {
	line-height: 24px;
	font-weight: bold;
	text-transform: uppercase;
	color: #FFF;
	background-color: #F00;
	text-align: center;
	width: 120px;
	margin-right: 10px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;	
}
.noquita_acc {
	line-height: 24px;
	font-weight: bold;
	text-transform: uppercase;
	color: #FFF;
	background-color: #0C0;
	text-align: center;
	width: 120px;
	margin-right: 10px;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.etiqueta {
	font-size: 13px;
	display: block;
	padding: 5px;
	margin-top: 5px;
}
.p_input {
	font-size: 13px;
	padding: 5px;
	width: 500px;
	border: 1px solid #CCCCCC;
}
</style>
<script LANGUAGE="JavaScript">
function Validar(form)
{
	 if (form.cuit.value == "")
  { alert("Por favor ingrese el cuit"); form.cuit.focus(); return; }
  
   if (form.banco.value == "")
  { alert("Por favor ingrese el banco"); form.banco.focus(); return; }
  
   if (form.cbu_bd.value == "")
  { alert("Por favor ingrese el CBU del afiliado"); form.cbu_bd.focus(); return; }
  
  if (form.cbu_bd.value.length < 22)
  { alert("Faltan numeros en el CBU del afiliado"); form.cbu_bd.focus(); return; }
  
   if (form.monto.value == "")
  { alert("Por favor ingrese el monto del prestamo"); form.monto.focus(); return; }
  
 
   if (form.cuotas.value == "")
  { alert("Por favor ingrese la cantidad de cuotas del prestamo"); form.cuotas.focus(); return; }
  
  
   if (form.tipo.value == "")
  { alert("Por favor defina tipo de prestamo a otorgar"); form.tipo.focus(); return; }
  
  if (form.tipo.value == "Proveedor" && form.proveedor_pro.value == "")
  { alert("Por favor ingrese el proveedor"); form.proveedor_pro.focus(); return; }
  
    if (form.tipo.value == "Salud" && form.proveedor_sal.value == "")
  { alert("Por favor ingrese el proveedor"); form.proveedor_sal.focus(); return; }
  
  if (form.tipo.value == "Soyem" && form.m_pago.value == "")
  { alert("Por favor ingrese el modo de pago"); form.m_pago.focus(); return; }
  
   if (form.tipo.value == "Soyem" && form.m_pago.value == "Efectivo" && form.origen.value == "")
  { alert("Por favor ingrese el origen de los fondos del prestamo"); form.origen.focus(); return; }
  
  if (form.tipo.value == "Soyem" && form.m_pago.value == "Cheque" && form.cuenta_banco.value=="")
  { alert("Por favor ingrese la cuenta bancaria del cheque"); form.cuenta_banco.focus(); return; }
  
   if (form.tipo.value == "Soyem" && form.m_pago.value == "Cheque" && form.nro_cheque.value=="")
  { alert("Por favor ingrese el nro de cheque"); form.nro_cheque.focus(); return; }
  
 form.submit();
}
function Calcula(form){
form.importe_cuota.value = form.monto.value / form.cuotas.value;
}
function tipo_op(form)
{
  if (form.m_pago.value == "Efectivo")
  { 

  form.cuenta_banco.disabled=true;
  form.nro_cheque.disabled=true;
  form.origen.disabled=false;
   } 
   if (form.m_pago.value == "Cheque")
  { 

  form.cuenta_banco.disabled=false;
  form.nro_cheque.disabled=false;
  form.origen.disabled=true;
   } 
   
}
</script>
</head>

<body>
<?php
if (empty($_POST['accion'])){
	?>
<form actio="" method="post">
<div class="pregunta">
<?php

	$preg ="Datos Bancarios de <b>".$dat['nombre']."</b>";

echo $preg;
?>
</div>
<div class="etiqueta">Cuit:</div>
 <input name="cuit" type="text" class="p_input" id="cuit" value="<?php echo $dat['cuil']; ?>" maxlength="11" />

<div class="etiqueta">Banco:</div>
 <select name="banco" class="p_input" id="banco" >
 <option selected="selected"><?php echo $dat['banco']; ?></option>
 <option>BANCO MACRO S.A.</option>
 <option>BANCO PATAGONIA</option>
 <option>DE LA NACION ARGENTINA</option>
 </select>
 
 <div class="etiqueta">CBU:</div>
 <input name="cbu_bd" type="text" class="p_input" id="cbu_bd" value="<?php echo $dat['cbu_bd']; ?>" maxlength="22" />



<div style="margin-top:20px">

<input type="submit" value="Modificar" name="accion" class="noquita_acc">
</div>
</form>
<?php
} else {
	
	$txt1 = "update afiliado set cbu_bd ='".$_POST['cbu_bd']."' where clave ='".$clave."'";
	mysql_query ($txt1);
	$txt2 = "update afiliado set banco ='".$_POST['banco']."' where clave ='".$clave."'";
	mysql_query ($txt2);
	$txt3 = "update afiliado set cuil ='".$_POST['cuit']."' where clave ='".$clave."'";
	mysql_query ($txt3);
		
		
		
		
	
	echo ' <script type="text/javascript">
parent.$.fn.colorbox.close();
	</script>';
	
}
	?>
</body>
</html>