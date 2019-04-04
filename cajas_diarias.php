<?php
$page = 'ingresos';
include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Cajas Diarias</title>
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
<script type="text/javascript">
function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();
var css = ventimp.document.createElement("link");
css.setAttribute("href", "estilos.css");
css.setAttribute("rel", "stylesheet");
css.setAttribute("type", "text/css");
ventimp.document.head.appendChild(css);
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
<div class="barri"><b><a href="ingresos.php" title="listado de recibos">Recibos</a> - <a href="cajas_diarias.php" title="Caja diaria">Caja Diaria</a></b></div>


<div class="subt"> Caja Diaria: </div> 
<form action="" method="get">
<div class="etiqueta">Fecha de la Caja</div>
<input type="text" name="fecha_caja" placeholder="elija la fecha de la caja" id="fecha_caja" class="p_input" />
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_caja",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div style="padding:5px"><input type="submit" name="enviar" value="ver caja" /></div>
</form>
</div>

<div id="para_print" style="padding:5px">
<?php
if (empty($_GET['fecha_caja'])){
	$fecha_caja = date("d-m-Y");
	$fecha_filtro = date("Y-m-d");
} else {
	$fecha_caja = $_GET['fecha_caja'];
	$fecha_filtro = substr($_GET['fecha_caja'],6,4).'-'.substr($_GET['fecha_caja'],3,2).'-'.substr($_GET['fecha_caja'],0,2);
}
?>
<table width="100%" cellpadding="5" cellspacing="0" border="1">
<tr>
<td colspan="6"><b>Caja Diaria del <?php echo $fecha_caja; ?></b></td>
</tr>
<tr>
<td bgcolor="#DDDDDD">Recibo</td>
<td bgcolor="#DDDDDD">Legajo</td>
<td bgcolor="#DDDDDD">Nombre</td>
<td bgcolor="#DDDDDD">Concepto</td>
<td bgcolor="#DDDDDD">Importe Efectivo</td>
<td bgcolor="#DDDDDD">Importe Cheque</td>
</tr>
<?php
$q_caja = mysql_query("select * from recibos INNER JOIN conceptos_recibos ON recibos.rec_concepto=conceptos_recibos.cr_id where (recibos.rec_fecha ='$fecha_filtro' and recibos.rec_anulado='N') order by recibos.rec_nro");
$imp_ef = 0;
$imp_ch = 0;
while($dat = mysql_fetch_array($q_caja)){

?>
<tr>
<td align="left"><?php echo $dat['rec_nro']; ?></td>
<td><?php echo $dat['rec_legajo']; ?></td>
<td><?php echo $dat['rec_nombre']; ?></td>
<td><?php echo $dat['cr_name']; ?></td>
<td align="right">$ <?php echo $dat['rec_importe_efectivo']; ?></td>
<td align="right">$ <?php echo $dat['rec_importe_cheque']; ?></td>
</tr>
<?php
$imp_ef = $imp_ef + $dat['rec_importe_efectivo'];
$imp_ch = $imp_ch + $dat['rec_importe_cheque'];
$total = $imp_ef + $imp_ch;
}
?>
<tr>
<td colspan="4"></td>
<td align="right"><b>$ <?php echo $imp_ef; ?></b></td>
<td align="right"><b>$ <?php echo $imp_ch; ?></b></td>
</tr>
<td colspan="4" align="right"><b> Total: </b></td>
<td colspan="2" align="right" bgcolor="#DDDDDD"><b>$ <?php echo $total; ?></b></td>
</tr>
</table>
</div>
<a href="javascript:imprSelec('para_print')">Imprimir Caja</a>

</div>
</body>
</html>
