<?php
include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Nuevo Afiliado</title>
<link rel="stylesheet" href="jquery/jquery.ui.all.css">

<script src="jquery/jquery-1.4.4.js"></script>
	<script src="jquery/jquery.ui.core.js"></script>
	<script src="jquery/jquery.ui.widget.js"></script>
	<script src="jquery/jquery.ui.position.js"></script>
	<script src="jquery/jquery.ui.autocomplete.js"></script>
	
	<script>
	$(function() {
		var availableTags = [
		<?php
   $fa_tx = "select * from afiliado order by nombre asc";
  $qfa = mysql_query($fa_tx);
  for($ea=0;$ea<mysql_num_rows($qfa);$ea++){
  $afa = mysql_fetch_array($qfa);
  echo '"'.$afa['nombre'].' ('.$afa['legajo'].') ('.$afa['documento'].') ['.$afa['clave'].']",';
  }
  
  ?>
			
		];
		$( "#tags" ).autocomplete({
			source: availableTags
		});
	});
	</script>




<link href="estilos.css" rel="stylesheet" type="text/css" />
		
		<script language="JavaScript">

  <link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>
 <script LANGUAGE="JavaScript">
function Validar(form)
{
  
   if (form.monto.value == "")
  { alert("Por favor ingrese el monto del reintegro"); form.monto.focus(); return; }
   
   if (form.tipo.value == "")
  { alert("Por favor defina tipo de reintegro"); form.tipo.focus(); return; }
  
    if (form.m_pago.value == "")
  { alert("Por favor ingrese el modo de pago"); form.m_pago.focus(); return; }
  
   if (form.m_pago.value == "Efectivo" && form.origen.value == "")
  { alert("Por favor ingrese el origen de los fondos del prestamo"); form.origen.focus(); return; }
  
  if (form.m_pago.value == "Cheque" && form.cuenta_banco.value=="")
  { alert("Por favor ingrese la cuenta bancaria del cheque"); form.cuenta_banco.focus(); return; }
  
   if (form.m_pago.value == "Cheque" && form.nro_cheque.value=="")
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
    if (form.m_pago.value == "IPROSS")
  { 
  form.cuenta_banco.disabled=true;
  form.nro_cheque.disabled=true;
  form.origen.disabled=true;
   } 
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
<div class="barri"><b><a href="reintegros.php" title="Buscar un afiliado">Reintegros</a> - <a href="listado_de_afiliados.php" title="Armar listado de afiliados">Armar listados</a></b></div>
<?php
$p_id_ben_int = $_GET['p_afiliado'];
$clave = substr($p_id_ben_int,(strpos($p_id_ben_int, '[')+1),(strpos($p_id_ben_int, ']')-strpos($p_id_ben_int, '['))-1);
$nro_af = mysql_num_rows(mysql_query("select * from afiliado where clave ='$clave'"));
$dat_af = mysql_fetch_array(mysql_query("select nombre, documento from afiliado where clave ='$clave'"));
if ($nro_af == 0 ){
?>
<form method="get" action="nuevo_reintegro.php">
<div class="subt"> Nuevo Reintegro: </div>
<div class="etiqueta">Afiliado:</div>
<input id="tags" name="p_afiliado" class="p_input"/><input type="submit" name ="cont" value="Elegir" />


</form>
<?php
} else {

?>
<?php
$p_id_ben_int = $_GET['p_afiliado'];
$clave = substr($p_id_ben_int,(strpos($p_id_ben_int, '[')+1),(strpos($p_id_ben_int, ']')-strpos($p_id_ben_int, '['))-1);
$dat_af = mysql_fetch_array(mysql_query("select nombre, documento from afiliado where clave ='$clave'"));
?>
<div class="subt"> Nuevo Reintegro para <?php echo $dat_af['nombre']; ?> </div>

<form method="get" action="nuevo_reintegro.php">



  <div class="etiqueta">Tipo:</div>
  <select name="tipo" class="p_input" onchange="submit()">
  <?php
  $txt_bt = "select * from reintegros_li where id_re_li ='".$_GET['tipo']."'";
  $dat_bt = mysql_fetch_array(mysql_query($txt_bt));
  ?>
  <option value="<?php echo $dat_bt['id_re_li']; ?>" selected="selected"><?php echo $dat_bt['descripcion']; ?></option>
  <?php
   $fp_tx = "select * from reintegros_li";
  $qfp = mysql_query($fp_tx);
  echo '<option value=""></option>';
  for($e=0;$e<mysql_num_rows($qfp);$e++){
  $afp = mysql_fetch_array($qfp);
  echo '<option value="'.$afp['id_re_li'].'">'.$afp['descripcion'].'</option>';
  }
  ?>
  </select>
  <input type="hidden" name="p_afiliado" value="<?php echo $_GET['p_afiliado']; ?>">
 </form>
 <?php
 if (!empty($_GET['tipo'])){
 ?>
<form method="post" action="agrega_reintegro.php">
<input type="hidden" name="afiliado" value="<?php echo $clave; ?>">
<input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>">
<div class="etiqueta">Proveedor:</div>
<?php

switch ($_GET['tipo']) {

case 1:
echo "<b>IPROSS</b>";
break;

case 2:
$txt_ru = mysql_query("select * from empresas where ru_salud ='FA'");
echo '<select name="proveedor" class="p_input">';
	for ($p=0; $p<mysql_num_rows($txt_ru); $p++){
	$a_ru = mysql_fetch_array($txt_ru);
	echo '<option value="'.$a_ru['clave_empresa'].'">'.$a_ru['nombre'].'</option>';
	}
echo '</select>';
break;

}
?>

<div class="etiqueta">Monto:</div>
  <input name="monto" type="text" class="p_input" id="monto" value="<?php echo $_GET['monto']; ?>" />
<input type="hidden" name="id_us" value="<?php echo $_SESSION['usuario']; ?>">



  <div class="etiqueta">Forma de Pago:</div>
  <select name="m_pago" class="p_input" onChange="tipo_op(this.form)">
  <option value=""></option>
  <option value="Cheque">Cheque</option>
  <option value="Efectivo">Efectivo</option>
 
  </select>
  
  

  <div class="etiqueta">Origen:</div>
   <select name="origen" class="p_input" disabled="disabled">
  <option value=""></option>
  <option value="1">Tesoreria</option>
	<option value="2">Caja Chica</option>
  </select>
  
   <div class="etiqueta">Cuenta Banco:</div>
   <select name="cuenta_banco" class="p_input" disabled="disabled">
  <option value=""></option>
  <option value="G">Banco Credicoop</option>
	<option value="A">Banco Patagonia</option>
  </select>
  
    <div class="etiqueta">Nro de cheque:</div>
  <input name="nro_cheque" type="text" class="p_input" id="nro_cheque" disabled="disabled" />


  <div class="etiqueta">Observaciones:</div>
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"></textarea>
<div>
        <label>
	<input type="button" name="Submit" value="Agregar" onClick="Validar(this.form)"/>
	</label>
</div>
</form>
<?php
}
}
?>
</div>
  </div>
</body>
</html>
