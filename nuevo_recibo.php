<?php
$page = 'ingresos';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Nuevo Recibo</title>
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
<div class="barri"><b><a href="ingresos.php" title="Buscar un afiliado">Recibos</a> - <a href="cajas_diarias.php" title="Armar listado de afiliados">Caja Diaria</a></b></div>

<form method="post" action="add_recibo.php">
<div class="subt"> Nuevo Recibo: </div>
<div class="etiqueta">Numero de Recibo:</div>
<input type="text" name="rec_nro_01" class="p_input_corto"/> - <input type="text" name="rec_nro_02" class="p_input_corto" autocomplete="off" /> Solo cifras significativas
<div class="etiqueta">Fecha:</div>
<input type="text" name="rec_fecha" class="p_input" id="rec_fecha" value="<?php echo date("d/m/Y"); ?>" readonly/>
 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "rec_fecha",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1    ,
        singleClick    :" true"             // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div class="etiqueta">Afiliado:</div>
<input id="tags" name="p_afiliado" class="p_input" onblur="Calcula(this.form)" placeholder="Ingrese una o más palabras para autocompletar..." />

<div class="etiqueta">Señor:</div>
<input type="text" name="rec_nombre" class="p_input" autocomplete="off" placeholder="Ingrese nombre..." />
<input type="hidden" name="rec_legajo"/>

<div class="etiqueta">Domicilio</div>
<input type="text" name="rec_domicilio" class="p_input" placeholder="Ingrese el domicilio..." />

<div class="etiqueta">Localidad</div>
<input type="text" name="rec_localidad" class="p_input" value="San Carlos de Bariloche"/>

<div class="etiqueta">CUIT</div>
<input type="text" name="rec_cuit_01" class="p_input_corto" maxlength="2"/> - <input type="text" name="rec_cuit_02" class="p_input_corto" maxlength="8"/> - <input type="text" name="rec_cuit_03" class="p_input_corto" maxlength="1"/>
<div class="etiqueta">IVA</div>

Responsable Inscripto: <input type="radio" name="rec_iva" value="Responsable Inscripto" />
| Responsable Monotributo: <input type="radio" name="rec_iva" value="Responsable Monotributo" />
| No Responsable: <input type="radio" name="rec_iva" value="No Responsable" />
| Exento: <input type="radio" name="rec_iva" value="Exento" />
| Consumidor Final: <input type="radio" name="rec_iva" value="Consumidor Final" />

<div class="etiqueta">Importe en Efectivo:</div>
<input type="number" step="0.1" name="rec_importe_efectivo" class="p_input"/> Ingresar solo los valores sin signo pesos
<div class="etiqueta">Importe en Cheque:</div>
<input type="number" step="0.1" name="rec_importe_cheque" class="p_input" onchange="tipo_op(this.form)"/> Ingresar solo los valores sin signo pesos
<div class="etiqueta">Banco:</div>
<input type="text" name="rec_banco" class="p_input" disabled="disabled"/>
<div class="etiqueta">Nro de Cheque:</div>
<input type="text" name="rec_cheque_nro" class="p_input" disabled="disabled"/>

<div class="etiqueta">Concepto:</div>
<select name="rec_concepto" class="p_input">
<option selected="selected"></option>
<?php
$qcr = mysql_query("select * from conceptos_recibos order by cr_name asc");
	while($acr = mysql_fetch_array($qcr)){
	echo '<option value="'.$acr['cr_id'].'">'.$acr['cr_name'].'</option>';
	}
?>
</select>
<div class="etiqueta">Detalles:</div>
<textarea name="rec_detalles" class="p_input" rows="6"></textarea>

<div>
<input type="button" name="enviar" value="Guardar / Imprimir" class="boton_form" onclick="Validar(form)"/>
</div>
<input type="hidden" name="id_us" value="<?php echo $_SESSION['usuario']; ?>" />
</form>


</div>
  </div>
</body>
</html>
