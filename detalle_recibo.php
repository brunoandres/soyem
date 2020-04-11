<?php
$page = 'contabilidad';
include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
$rec_id = $_GET['rec_id'];
$data_rec = mysql_fetch_array(mysql_query("select * from recibos INNER JOIN conceptos_recibos ON recibos.rec_concepto=conceptos_recibos.cr_id where recibos.rec_id = '$rec_id'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Detalle del Recibo</title>
<link rel="stylesheet" href="jquery/jquery.ui.all.css">
  <link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>
<script src="jquery/jquery-1.4.4.js"></script>
	<script src="jquery/jquery.ui.core.js"></script>
	<script src="jquery/jquery.ui.widget.js"></script>
	<script src="jquery/jquery.ui.position.js"></script>
	<script src="jquery/jquery.ui.autocomplete.js"></script>
	<?php
if (empty($_GET['p_afiliado'])){
?>
	<script>
	$(function() {
		var availableTags = [
		<?php
   $fa_tx = "select * from afiliado order by nombre asc";
  $qfa = mysql_query($fa_tx);
  for($ea=0;$ea<mysql_num_rows($qfa);$ea++){
  $afa = mysql_fetch_array($qfa);
  echo '"'.$afa['legajo'].' - '.$afa['nombre'].'",';
  }

  ?>

		];
		$( "#tags" ).autocomplete({
			source: availableTags
		});
	});
	</script>

<?php
}
?>


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
   if (form.rec_nro_02.value == "")
  { alert("Por favor ingrese el nro de recibo"); form.rec_nro_02.focus(); return; }

  if (form.rec_nombre.value == "")
  { alert("Por favor ingrese el nombre"); form.rec_nombre.focus(); return; }

   if (form.rec_iva.value == "")
  { alert("Por favor ingrese el tipo de IVA"); form.rec_iva.focus(); return; }


   if (form.rec_importe_efectivo.value == "" && form.rec_importe_cheque.value == "")
  { alert("Por favor ingrese el importe"); form.rec_importe_efectivo.focus(); return; }

   if (form.rec_concepto.value == "")
  { alert("Por favor ingrese el concepto asociado al recibo"); form.rec_concepto.focus(); return; }

   if (form.rec_importe_cheque.value != "" && (form.rec_banco.value == "" || form.rec_cheque_nro.value == ""))
  { alert("Ingrese el nro de cheque y el Banco correspondiente"); form.rec_banco.focus(); return; }
   /*
  if (form.tipo.value == "Proveedor" && form.proveedor.value == "")
  { alert("Por favor ingrese el proveedor"); form.proveedor.focus(); return; }

  if (form.tipo.value == "Soyem" && form.m_pago.value == "")
  { alert("Por favor ingrese el modo de pago"); form.m_pago.focus(); return; }

   if (form.tipo.value == "Soyem" && form.m_pago.value == "Efectivo" && form.origen.value == "")
  { alert("Por favor ingrese el origen de los fondos del prestamo"); form.origen.focus(); return; }

  if (form.tipo.value == "Soyem" && form.m_pago.value == "Cheque" && form.cuenta_banco.value=="")
  { alert("Por favor ingrese la cuenta bancaria del cheque"); form.cuenta_banco.focus(); return; }

   if (form.tipo.value == "Soyem" && form.m_pago.value == "Cheque" && form.nro_cheque.value=="")
  { alert("Por favor ingrese el nro de cheque"); form.nro_cheque.focus(); return; }
  */
 form.submit();
}
function Calcula(form){
	if(form.p_afiliado.value != ''){
	var pri_pos = form.p_afiliado.value.indexOf('-') - 1;
	var pri_pos1 = pri_pos + 3;
form.rec_nombre.value = form.p_afiliado.value.substring(pri_pos1);
form.rec_legajo.value = form.p_afiliado.value.substring(0,pri_pos);
	}
}
function tipo_op(form)
{
  if (form.rec_importe_cheque.value == "")
  {

  form.rec_banco.disabled=true;
  form.rec_cheque_nro.disabled=true;
   }
   if (form.rec_importe_cheque.value != "")
  {
 form.rec_banco.disabled=false;
  form.rec_cheque_nro.disabled=false;
   }

}

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
<div class="barri"><b><a href="ingresos.php" title="Buscar un afiliado">Recibos</a> - <a href="cajas_diarias.php" title="Caja diaria">Caja Diaria</a></b></div>


<div class="subt"> Detalle del Recibo: </div>
<?php
if($data_rec['rec_anulado']=='S'){
	  echo '<div class="anular">Anulado</div>';
	  }
	  ?>
<div style="width:300px; float:left">
<div class="etiqueta">Numero de Recibo:</div>
<b><?php echo $data_rec['rec_nro']; ?></b>
<div class="etiqueta">Fecha:</div>
<b><?php echo $data_rec['rec_fecha']; ?></b>


<div class="etiqueta">Señor:</div>
<b><?php echo $data_rec['rec_nombre']; ?></b>

<div class="etiqueta">Domicilio</div>
<b><?php echo $data_rec['rec_domicilio']; ?></b>

<div class="etiqueta">Localidad</div>
<b><?php echo $data_rec['rec_localidad']; ?></b>

<div class="etiqueta">CUIT</div>
<b><?php echo $data_rec['rec_cuit']; ?></b>
<div class="etiqueta">IVA</div>
<b><?php echo $data_rec['rec_iva']; ?></b>
</div>
<div style="width:600px; float:right">
<div class="etiqueta">Importe en Efectivo:</div>
<b>$ <?php echo $data_rec['rec_importe_efectivo']; ?></b>
<div class="etiqueta">Importe en Cheque:</div>
<b>$ <?php echo $data_rec['rec_importe_cheque']; ?></b>
<div class="etiqueta">Banco:</div>
<b><?php echo $data_rec['rec_banco']; ?></b>
<div class="etiqueta">Nro de Cheque:</div>
<b><?php echo $data_rec['rec_cheque_nro']; ?></b>
<div class="etiqueta">Importe Total:</div>
<b>$ <?php echo $data_rec['rec_importe']; ?></b>
<div class="etiqueta">Concepto:</div>
<b><?php echo $data_rec['cr_name']; ?></b>
<div class="etiqueta">Detalles:</div>
<b><?php echo $data_rec['rec_detalles']; ?></b>

</div>
<br clear="all" />
<table cellpadding="10">
<tr>
<?php
 echo '<td><a href="anular_recibo.php?rec_id='.$rec_id.'&vuelta=detalle_recibo.php?rec_id='.$rec_id.'" title="Anular este Recibo" class="anular" onclick="return confirmar(';
	   echo "'¿Está seguro que desea anular este recibo? Esta operación no se puede deshacer'";
	  echo ')" >';
	  if($data_rec['rec_anulado']=='N'){
	  echo 'Anular';
	  }
	  echo '</a></td>';
	  echo '<td><a href="pdf/recibo.php?rec_id='.$rec_id.'" target="blank" title="Imprimir este Recibo" class="imprimir" >';
	  if($data_rec['rec_anulado']=='N'){
	  echo 'Imprimir';
	  }
	  echo '</a></td>';
?>
</tr>
</table>
</div>
  </div>
</body>
</html>
