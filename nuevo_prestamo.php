<?php
$page = 'prestamos';
include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
include ("funciones_grales.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
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
   $fa_tx = "select * from afiliado where activo = 'si' order by nombre asc";
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
			function pagoOnChange(sel) {
      if (sel.value=="Proveedor"){
           $("#prove").show();
           $("#salu").hide();
		    $("#soye").hide();
      }
	   if (sel.value=="Salud"){
           $("#prove").hide();
           $("#salu").show();
		    $("#soye").hide();
      }
	   if (sel.value=="Soyem"){
           $("#prove").hide();
           $("#salu").hide();
		    $("#soye").show();
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

   if (form.m_pago.value == "Le�s" || form.m_pago.value == "Proveduria")
  {

  form.cuenta_banco.disabled=true;
  form.nro_cheque.disabled=true;
  form.origen.disabled=true;
   }

}


function Validar1(form)
{

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

function Validar2(form)
{

   if (form.monto.value == "")
  { alert("Por favor ingrese el monto del prestamo"); form.monto.focus(); return; }


   if (form.cuotas.value == "")
  { alert("Por favor ingrese la cantidad de cuotas del prestamo"); form.cuotas.focus(); return; }


   if (form.monto_coseguro.value == "")
  { alert("Por favor ingrese el monto del coseguro"); form.monto_coseguro.focus(); return; }


    if (form.proveedor_sal.value == "")
  { alert("Por favor ingrese el proveedor"); form.proveedor_sal.focus(); return; }


 form.submit();
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


<div class="actual_buto">Nuevo Prestamo</div><div class="actual_buto"><a href="listado_banco.php" title="armar listados de prestamos debito">Armar listado Banco</a></div>
<div class="actual_buto"><a href="listado_muni.php" title="armar listados de prestamos muni">Armar listado Muni</a></div>
<div class="actual_buto"><a href="veraz.php" title="ir al veraz">Veraz</a></div>
<br clear="all" />
</div>

  <?php
  $p_id_ben_int = $_GET['p_afiliado'];
$clave = substr($p_id_ben_int,(strpos($p_id_ben_int, '[')+1),(strpos($p_id_ben_int, ']')-strpos($p_id_ben_int, '['))-1);
$nro_af = mysql_num_rows(mysql_query("select * from afiliado where clave ='$clave'"));
$dat_af = mysql_fetch_array(mysql_query("select * from afiliado where clave ='$clave'"));
if ($nro_af == 0 ){
?>
<form method="get" action="nuevo_prestamo.php" >
<div class="subt"> Nuevo Prestamo: </div>
<div class="etiqueta">Afiliado:</div>
<input id="tags" name="p_afiliado" class="p_input"/>

<div class="etiqueta">Tipo de Cancelación:</div>
<select name="tipe_p" class="p_input"/>
<option value="D">Debito por Banco</option>
<option value="M">Descuento por Planilla</option>
<option value="P">Prestamo y Coseguro</option>
</select>
<div style="margin-top: 10px; margin-bottom: 10px">
<input type="submit" name ="cont" value="Continuar" />
</div>

</form>
<?php
} else {
	if ($_GET['tipe_p'] == "D"){
?>

<div class="subt"> Nuevo Prestamo para <?php echo $dat_af['nombre']." (Debito Bancario)"; ?> </div>
<?php
	echo Veraza($clave);
  echo TotalDeudaAfiliado($clave);
	?>
<form method="post" action="agrega_prestamo.php">
<div class="etiqueta">Cuit:</div>
 <input name="cuit" type="text" class="p_input" id="cuit" value="<?php echo $dat_af['cuil']; ?>" maxlength="11" autocomplete="off" />

<div class="etiqueta">Banco:</div>
 <select name="banco" class="p_input" id="banco" >
 <option selected="selected"><?php echo $dat_af['banco']; ?></option>
 <option>BANCO MACRO S.A.</option>
 <option>BANCO PATAGONIA</option>
 <option>DE LA NACION ARGENTINA</option>
 </select>

 <div class="etiqueta">CBU:</div>
 <input name="cbu_bd" type="text" class="p_input" id="cbu_bd" value="<?php echo $dat_af['cbu_bd']; ?>" maxlength="22" />

<input type="hidden" name="afiliado" value="<?php echo $clave; ?>">
<input type="hidden" name="tipe_p" value="D">
<div class="etiqueta">Monto:</div>
  <input name="monto" type="number" step="0.1" class="p_input" id="monto" value="<?php echo $_GET['monto']; ?>" />
  <div class="etiqueta">Cuotas:</div>
<select name="cuotas" class="p_input" id="cuotas" onChange="Calcula(this.form)" >
<option value="<?php echo $_GET['cuotas']; ?>" selected="selected"><?php echo $_GET['cuotas']; ?></option>
<?php
$i=1;
while($i<101){
echo '<option value="'.$i.'">'.$i.'</option>';
$i++;
}
?>
</select>
  <div class="etiqueta">Importe cuota:</div>
  <input name="importe_cuota" type="text" class="p_input" id="importe_cuota" disabled="disabled" value="<?php if ($_GET['cuotas']>0) echo ($_GET['monto']/$_GET['cuotas']); ?>" />
  <div class="etiqueta">Tipo:</div>
  <select name="tipo" class="p_input" onChange="pagoOnChange(this)">
  <option value="<?php echo $_GET['tipo']; ?>" selected="selected"><?php echo $_GET['tipo']; ?></option>
  <option value="Proveedor">Proveedor</option>
  <option value="Soyem">Soyem</option>
  <option value="Salud">Salud</option>
  </select>
  <input type="hidden" name="p_afiliado" value="<?php echo $_GET['p_afiliado']; ?>">






  <div id="prove" style="display:none">


  <div class="etiqueta">Proveedor:</div>
  <select name="proveedor_pro" class="p_input">

  <?php
   $fp_tx = "select * from empresas where (es_pres = 'si' and es_salud='no') order by nombre asc";
  $qfp = mysql_query($fp_tx);
  echo '<option value=""></option>';
  for($e=0;$e<mysql_num_rows($qfp);$e++){
  $afp = mysql_fetch_array($qfp);
  echo '<option value="'.$afp['clave_empresa'].'">'.$afp['nombre'].'</option>';
  }

  ?>
  </select>

 </div>

 <div id="salu" style="display:none">

  <div class="etiqueta">Proveedor:</div>
  <select name="proveedor_sal" class="p_input">

  <?php
   $fp_tx = "select * from empresas where (es_pres = 'si' and es_salud='si') order by nombre asc";
  $qfp = mysql_query($fp_tx);
  echo '<option value=""></option>';
  for($e=0;$e<mysql_num_rows($qfp);$e++){
  $afp = mysql_fetch_array($qfp);
  echo '<option value="'.$afp['clave_empresa'].'">'.$afp['nombre'].'</option>';
  }

  ?>
  </select>

  </div>

 <div id="soye" style="display:none">

  <div class="etiqueta">Forma de entrega:</div>
  <select name="m_pago" class="p_input" onChange="tipo_op(this.form)">
  <option value=""></option>
  <option value="Cheque">Cheque</option>
  <option value="Efectivo">Efectivo</option>
  <option value="Turismo">Turismo</option>

  </select>

  <div id="efecto">

  <div class="etiqueta">Origen:</div>
   <select name="origen" class="p_input" disabled="disabled">
  <option value=""></option>
  <option value="1">Tesoreria</option>
	<option value="2">Caja Chica</option>
  </select>
  </div>
   <div id="checo">
   <div class="etiqueta">Cuenta Banco:</div>
   <select name="cuenta_banco" class="p_input" disabled="disabled">
  <option value=""></option>
  <option value="G">Banco Credicoop</option>
	<option value="A">Banco Patagonia</option>
  </select>

    <div class="etiqueta">Nro de cheque:</div>
  <input name="nro_cheque" type="text" class="p_input" id="nro_cheque" disabled="disabled" autocomplete="off" />
  </div>

</div>

  <div class="etiqueta">Comienza a cancelar:</div>
 Mes: <select name="mes" id="mes" class="p_input_corto">
 <?php

 $a_meses = mysql_fetch_array(mysql_query("select * from historial_expo_banco order by exp_banc_id desc"));

	 $es_mes = $a_meses['exp_banc_mes'];




	if ($es_mes<12){
		$mmes = $es_mes+1;
		$a_anio = date("Y");
	} else {
		if ($es_mes==12){
			$mmes = 1;
			$a_anio = date("Y")+1;
		}
	}

	?>
   <option selected="selected" value="<?php echo $mmes; ?>"><?php echo $mmes; ?></option>
   <?php
   $me =1;
   while ($me<13){
   echo '<option value="'.$me.'">'.$me.'</option>';
    $me++;
	}
	?>
  </select>
   Año: <select name="ano" id="ano" class="p_input_corto">
   <option selected="selected" value="<?php echo $a_anio; ?>"><?php echo $a_anio; ?></option>
   <?php
   $ye =2013;
   while ($ye<2021){
   echo '<option value="'.$ye.'">'.$ye.'</option>';
    $ye++;
	}
	?>
  </select>
  <div class="etiqueta">Observaciones:</div>
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"></textarea>
<div style="margin-top:10px; margin-bottom:10px">
        <label>
	<input type="button" name="Submit" value="Agregar" onClick="Validar(this.form)"/>
	</label>
</div>
</form>
<?php

	}

?>





<?php

	if ($_GET['tipe_p'] == "M"){
?>

<div class="subt"> Nuevo Prestamo para <?php echo $dat_af['nombre']." (Descuento Planilla)"; ?> </div>
<?php
  if (mysql_num_rows(mysql_query("select * from veraz where vz_af='$clave'")) > 0){
    ?>
<div class="veraza">Este Afiliado esta en el Veraz</div>
<?php
  }
  ?>
<form method="post" action="agrega_prestamo.php">

<input type="hidden" name="afiliado" value="<?php echo $clave; ?>">
<input type="hidden" name="tipe_p" value="M">
<!-- <input name="ant_2015" type="checkbox" value="si"/> Iniciado antes del 2015 -->
<div class="etiqueta">Monto:</div>
  <input name="monto" type="text" class="p_input" id="monto" value="<?php echo $_GET['monto']; ?>" />
  <div class="etiqueta">Cuotas:</div>
<select name="cuotas" class="p_input" id="cuotas" onChange="Calcula(this.form)" >
<option value="<?php echo $_GET['cuotas']; ?>" selected="selected"><?php echo $_GET['cuotas']; ?></option>
<?php
$i=1;
while($i<101){
echo '<option value="'.$i.'">'.$i.'</option>';
$i++;
}
?>
</select>
  <div class="etiqueta">Importe cuota:</div>
  <input name="importe_cuota" type="text" class="p_input" id="importe_cuota" disabled="disabled" value="<?php if ($_GET['cuotas']>0) echo ($_GET['monto']/$_GET['cuotas']); ?>" />
  <div class="etiqueta">Tipo:</div>
  <select name="tipo" class="p_input" onChange="pagoOnChange(this)">
  <option value="<?php echo $_GET['tipo']; ?>" selected="selected"><?php echo $_GET['tipo']; ?></option>
  <option value="Proveedor">Proveedor</option>
  <option value="Soyem">Soyem</option>
  <option value="Salud">Salud</option>
  </select>
  <input type="hidden" name="p_afiliado" value="<?php echo $_GET['p_afiliado']; ?>">






  <div id="prove" style="display:none">


  <div class="etiqueta">Proveedor:</div>
  <select name="proveedor_pro" class="p_input">

  <?php
   $fp_tx = "select * from empresas where (es_pres = 'si' and es_salud='no') order by nombre asc";
  $qfp = mysql_query($fp_tx);
  echo '<option value=""></option>';
  for($e=0;$e<mysql_num_rows($qfp);$e++){
  $afp = mysql_fetch_array($qfp);
  echo '<option value="'.$afp['clave_empresa'].'">'.$afp['nombre'].'</option>';
  }

  ?>
  </select>

 </div>

 <div id="salu" style="display:none">

  <div class="etiqueta">Proveedor:</div>
  <select name="proveedor_sal" class="p_input">

  <?php
   $fp_tx = "select * from empresas where (es_pres = 'si' and es_salud='si') order by nombre asc";
  $qfp = mysql_query($fp_tx);
  echo '<option value=""></option>';
  for($e=0;$e<mysql_num_rows($qfp);$e++){
  $afp = mysql_fetch_array($qfp);
  echo '<option value="'.$afp['clave_empresa'].'">'.$afp['nombre'].'</option>';
  }

  ?>
  </select>

  </div>

 <div id="soye" style="display:none">

  <div class="etiqueta">Forma de entrega:</div>
  <select name="m_pago" class="p_input" onChange="tipo_op(this.form)">
  <option value=""></option>
  <option value="Cheque">Cheque</option>
  <option value="Efectivo">Efectivo</option>
  <option value="Proveduria">Proveduria</option>
  <option value="Le�a">Le�a</option>
  <option value="Turismo">Turismo</option>
  </select>

  <div id="efecto">

  <div class="etiqueta">Origen:</div>
   <select name="origen" class="p_input" disabled="disabled">
  <option value=""></option>
  <option value="1">Tesoreria</option>
	<option value="2">Caja Chica</option>
  </select>
  </div>
   <div id="checo">
   <div class="etiqueta">Cuenta Banco:</div>
   <select name="cuenta_banco" class="p_input" disabled="disabled">
  <option value=""></option>
  <option value="G">Banco Credicoop</option>
	<option value="A">Banco Patagonia</option>
  </select>

    <div class="etiqueta">Nro de cheque:</div>
  <input name="nro_cheque" type="text" class="p_input" id="nro_cheque" disabled="disabled" />
  </div>

</div>


  <div class="etiqueta">Comienza a cancelar otros:</div>
 Mes: <select name="mes" id="mes" class="p_input_corto">

   <?php
   $a_meses_o = mysql_fetch_array(mysql_query("select * from historial_expo_muni order by id_ex desc"));

	 $es_mes_o = $a_meses_o['mes'];
	 $es_anio_o = $a_meses_o['anio'];




	if ($es_mes_o<12){
		$mmes_o = $es_mes_o+1;
		$a_anio = $es_anio_o;
	} else {
		if ($es_mes_o==12){
			$mmes_o = 1;
			$a_anio = $es_anio_o+1;
		}
	}
   ?>
      <option selected="selected" value="<?php echo $mmes_o; ?>"><?php echo $mmes_o; ?></option>



   <?php
   $me =1;
   while ($me<13){
   echo '<option value="'.$me.'">'.$me.'</option>';
    $me++;
	}
	?>
  </select>
   Año: <select name="ano" id="ano" class="p_input_corto">
   <option selected="selected" value="<?php echo $a_anio; ?>"><?php echo $a_anio; ?></option>
   <?php
   $ye =2013;
   while ($ye<2021){
   echo '<option value="'.$ye.'">'.$ye.'</option>';
    $ye++;
	}
	?>
  </select>
  <div class="etiqueta">Observaciones:</div>
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"></textarea>
<div style="margin-top:10px; margin-bottom:10px">
        <label>
	<input type="button" name="Submit" value="Agregar" onClick="Validar1(this.form)"/>
	</label>
</div>
</form>
<?php

	}

?>

<?php

	if ($_GET['tipe_p'] == "P"){
?>
<?php
  if (mysql_num_rows(mysql_query("select * from veraz where vz_af='$clave'")) > 0){
    ?>
<div class="veraza">Este Afiliado esta en el Veraz</div>
<?php
  }
  ?>
<div class="subt"> Nuevo Prestamo para <?php echo $dat_af['nombre']." (Prestamo y coseguro)"; ?> </div>

<form method="post" action="agrega_prestamo.php">

<input type="hidden" name="afiliado" value="<?php echo $clave; ?>">
<input type="hidden" name="tipe_p" value="P">
<div class="etiqueta">Monto del Prestamo:</div>
  <input name="monto" type="number" step="0.1" class="p_input" id="monto" value="<?php echo $_GET['monto']; ?>" placeholder="Ingrese el monto..."/>
  <div class="etiqueta">Cuotas:</div>
<select name="cuotas" class="p_input" id="cuotas" onChange="Calcula(this.form)" >
<option value="<?php echo $_GET['cuotas']; ?>" selected="selected"><?php echo $_GET['cuotas']; ?></option>
<?php
$i=1;
while($i<101){
echo '<option value="'.$i.'">'.$i.'</option>';
$i++;
}
?>
</select>
  <div class="etiqueta">Importe cuota:</div>
  <input name="importe_cuota" type="text" class="p_input" id="importe_cuota" disabled="disabled" value="<?php if ($_GET['cuotas']>0) echo ($_GET['monto']/$_GET['cuotas']); ?>" />








  <div class="etiqueta">Proveedor:</div>
  <select name="proveedor_sal" class="p_input">

  <?php
   $fp_tx = "select * from empresas where (es_pres = 'si' and es_salud='si') order by nombre asc";
  $qfp = mysql_query($fp_tx);
  echo '<option value=""></option>';
  for($e=0;$e<mysql_num_rows($qfp);$e++){
  $afp = mysql_fetch_array($qfp);
  echo '<option value="'.$afp['clave_empresa'].'">'.$afp['nombre'].'</option>';
  }

  ?>
  </select>





<?php
   if(date("m") < 12){
	   $mmes = date("m")+1;
	   $a_ani = date("Y");
	   } else {
		   $mmes = "1";
		   $a_ani = date("Y")+1;
	   }

   ; ?>


  <div class="etiqueta">Comienza a cancelar:</div>
 Mes: <select name="mes" id="mes" class="p_input_corto">
   <option selected="selected" value="<?php echo $mmes; ?>"><?php echo $mmes; ?></option>
   <?php
   $me =1;
   while ($me<13){
   echo '<option value="'.$me.'">'.$me.'</option>';
    $me++;
	}
	?>
  </select>
   Año: <select name="ano" id="ano" class="p_input_corto">
   <option selected="selected" value="<?php echo $a_ani; ?>"><?php echo $a_ani; ?></option>
   <?php
   $ye =2013;
   while ($ye<2021){
   echo '<option value="'.$ye.'">'.$ye.'</option>';
    $ye++;
	}
	?>
  </select>
  <div class="etiqueta">Monto del Coseguro:</div>
  <input name="monto_coseguro" type="number" step="0.1" class="p_input" id="monto_coseguro" value="<?php echo $_GET['monto']; ?>" placeholder="Ingrese el monto..." />

  <div class="etiqueta">Observaciones:</div>
  <textarea name="observaciones" rows="4" class="p_input" id="observaciones"></textarea>
<div style="margin-top:10px; margin-bottom:10px">
        <label>
	<input type="button" name="Submit" value="Agregar" onClick="Validar2(this.form)"/>
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
