<?php
include("secure3.php");
include("conecta.php");
$id_pagos = $_GET['id_pagos'];
$data =  mysql_fetch_array(mysql_query("select * from pagos where id_pagos = '$id_pagos'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/select2.css">
<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
} 
</script>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.fecha.value == "")
  { alert("Por favor la fecha del pago"); form.fecha.focus(); return; }
   
   if (form.empresa.value == "")
  { alert("Por favor ingrese el destinatario del pago"); form.empresa.focus(); return; }
  
   if (form.importe.value == "")
  { alert("Por favor ingrese el importe del pago"); form.importe.focus(); return; }
  
   if (form.factura.value == "")
  { alert("Por favor ingrese la factura a pagar"); form.factura.focus(); return; }
  
  if (form.detalle.value == "")
  { alert("Por favor ingrese el detalle del pago"); form.detalle.focus(); return; }
  
  if (form.forma.value == "")
  { alert("Por favor ingrese la froma de pago"); form.forma.focus(); return; }
  
  if (form.forma.value == "cheque" & form.cuenta_banco.value == "")
  { alert("Por favor ingrese la cuenta bancaria"); form.cuenta_banco.focus(); return; }
  
   if (form.forma.value == "cheque" & form.nro_cheque.value == "")
  { alert("Por favor ingrese el nro de cheque"); form.nro_cheque.focus(); return; }
  
    if (form.cuenta_contable.value == "")
  { alert("Por favor ingrese la cuenta contable a asignar el pago"); form.cuenta_contable.focus(); return; }
  
 form.submit();
}
function banco(form)
{
  if (form.forma.value == "cheque")
  { 
  form.cuenta_banco.disabled=false;
  form.nro_cheque.disabled=false;
   } else {
    form.cuenta_banco.disabled=true;
	form.cuenta_banco.value="";
	 form.nro_cheque.disabled=true;
	form.nro_cheque.value="";
   }
   
}
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
<div id="cubierta">
<div id="cuerpo">
  <h1>
  <?php
  if($_GET['ac']=='nuevo'){
  echo 'Nuevo Pago:';
  } else {
   echo 'Modificando Pago';
  }
  ?> </h1>
 <form action="modifica_pago.php" method="post">  
 <div class="etiqueta">Fecha:</div>
<?php
	if (!empty($data['fecha_pago'])){
	$fe = substr($data['fecha_pago'],8,2).'/'.substr($data['fecha_pago'],5,2).'/'.substr($data['fecha_pago'],0,4);
	}
	?>
 <input name="fecha" type="text" class="p_input" id="fecha" value="<?php echo $fe; ?>" size="12" placeholder="Seleccione una fecha" autocomplete="off" readonly />	
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1          ,
        singleClick    :" true"       // show all years in drop-down boxes (instead of every other year as default)
    });
</script> 
<div class="etiqueta">Destinatario:</div>
<select name="empresa" class="p_input select2" id="empresa">
		<?php
		$cc = $data['empresa_pago'];
		$ccu = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa='$cc'"));
		?>
  <option selected="selected" value="<?php echo $data['empresa_pago']; ?>"><?php echo $ccu['nombre']; ?></option>
  <?php
  $qc = mysql_query("select * from empresas order by nombre asc");
  for ($z=0; $z<mysql_num_rows($qc);$z++){
  $ac = mysql_fetch_array($qc);
  echo '<option value="'.$ac['clave_empresa'].'">'.$ac['nombre'].'</option>';
  }
  ?>
  </select>
  <div class="etiqueta">Importe:</div>
    <input name="importe" type="number" class="p_input"  id="importe" min="0" step="0.1" value="<?php echo $data['importe_pago']; ?>" />
	 <div class="etiqueta">Factura:</div>
    <input name="factura" type="text" class="p_input"  id="factura" value="<?php echo $data['factura_pago']; ?>" />
	 <div class="etiqueta">Detalle:</div>
	<textarea name="detalle" cols="20" rows="3" class="p_input" id=""><?php echo $data['detalle_pago']; ?></textarea>
	<div class="etiqueta">Froma de pago:</div>
	<select name="forma" class="p_input"  id="forma" onChange="banco(this.form)">
	<option selected="selected" value="<?php echo $data['forma_pago']; ?>"><?php echo $data['forma_pago']; ?></option>
	<option value="caja chica">caja chica</option>
	<option value="contado">contado</option>
	<option value="cheque">cheque</option>
	<option value="pendiente">pendiente</option>
	</select>
	<div class="etiqueta">Cuenta:</div>
	<select name="cuenta_banco"class="p_input"  id="cuenta_banco" disabled="disabled">
	<option selected="selected" value="<?php echo $data['cuenta_banco']; ?>"><?php echo $data['cuenta_banco']; ?></option>
	<option value="Banco Credicoop">Banco Credicoop</option>
	<option value="Banco Patagonia">Banco Patagonia</option>
	</select>
	<div class="etiqueta">Cheque Nro:</div>
    <input name="nro_cheque" type="text" class="p_input"  id="nro_cheque" value="<?php echo $data['cheque_pago']; ?>" disabled="disabled" />
	<div class="etiqueta">Cuenta contable asociada:</div>
    <?php
	  if($_GET['ac'] !='nuevo'){
	$t_cu = "select * from cuentas where id_cuentas=".$data['cuenta_contable_pago'];
	$cucu = mysql_fetch_array(mysql_query($t_cu));
	}
	?>
	<select name="cuenta_contable"class="p_input"  id="cuenta_contable">
	<option selected="selected" value="<?php echo $data['cuenta_contable_pago']; ?>"><?php echo $cucu['cuenta']; ?></option>
	<?php
	$q_sr = mysql_query("select * from con_rubros where titulo = 'Cuentas Negativas'");
	for ($sr=0; $sr<mysql_num_rows($q_sr); $sr++){
	$a_sr=mysql_fetch_array($q_sr);
		$id_rubro=$a_sr['id_rubro'];
		$q_cue = mysql_query("select * from cuentas where id_rubro = '$id_rubro'");
		for ($src=0; $src<mysql_num_rows($q_cue); $src++){
		$a_cue = mysql_fetch_array($q_cue);
	echo '<option value="'.$a_cue['id_cuentas'].'">'.$a_cue['cuenta'].'</option>';
	}}
	?>
	</select>
        <div><label>
	<input type="button" name="Submit" value="Guardar Pago" onClick="Validar(this.form)"/>
	</label></div>
	    <input name="id_us" type="hidden" id="id_us" value="<?php echo $_SESSION['usuario']; ?>" />
	    <input name="id_pagos" type="hidden" id="id_pagos" value="<?php echo $id_pagos; ?>" />
		

  </form>
  </div>

</div>
<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script src="js/select2.full.min.js"></script>
</body>
</html>
