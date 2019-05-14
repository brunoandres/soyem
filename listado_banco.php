<?php
$page = 'prestamos';
include("secure1.php");
include("conecta.php");
include("funciones_grales.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Listado para Banco</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
  if (form.fecha_deb.value == "")
  { alert("Por favor ingrese la fecha de debito"); form.fecha_deb.focus(); return; }
  
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
<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
<div id="contanido">
<div id="cuerpo">
  <div class="barri">
<div class="actual_buto"><a href="prestamos.php" title="Ver prestamos">Listado de Prestamos</a></div>


<div class="actual_buto"><a href="nuevo_prestamo.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a></div><div class="actual_buto">Armar listado Banco</div>
<div class="actual_buto"><a href="listado_muni.php" title="armar listados de prestamos muni">Armar listado Muni</a></div>
<div class="actual_buto"><a href="veraz.php" title="ir al veraz">Veraz</a></div>
<br clear="all" />
</div>

  <form method="post" action="<?php echo $PHP_SELF; ?>">
<div class="subt"> Crear listado para banco: </div>
<div class="etiqueta">Periodo a listar:</div>
   Mes: <select name="mes" id="mes" class="p_input_corto">
   <?php
   if (date("m")==12){
	   $mess = "1";
	   $aanio = date("Y")+1;
   } else {
	   $mess = date("m")+1;
	 $aanio = date("Y");
   }
   ?>
   <option selected="selected" value="<?php echo $mess; ?>"><?php echo $mess; ?></option>
   <?php
   $me =1;
   while ($me<13){
   echo '<option value="'.$me.'">'.$me.'</option>';
    $me++;
	}
	?>
  </select>
   Año: <select name="ano" id="ano" class="p_input_corto">
   <option selected="selected" value="<?php echo $aanio; ?>"><?php echo $aanio; ?></option>
   <?php
   $ye =2013;
   while ($ye<2030){
   echo '<option value="'.$ye.'">'.$ye.'</option>';
    $ye++;
	}
	?>
  </select>
<div class="etiqueta">Fecha de d&eacute;bito:</div>
  <input name="fecha_deb" type="text" class="p_input" id="fecha_deb" autocomplete="off" readonly=""/>
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_deb",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1      ,
        singleClick    :" true"          // show all years in drop-down boxes (instead of every other year as default)
    });
</script> 
  
  
  
<div style="margin-top:10px; margin-bottom:10px">
        <label>
	<input type="button" name="Submit" value="Generar txt" onClick="Validar(this.form)"/>
	</label><input type="hidden" name="act" value="si" />
	</div>
</form>
<hr />
<?php
if ($_POST['act']=="si"){
	
	//Creamos el archivo datos.txt
//ponemos tipo 'a' para a�adir lineas sin borrar
$ruta = "archivos_txt/".$_POST['mes']."-".$_POST['ano']."-banco-soyem.txt";
$tx12 = "insert into historial_expo_banco (exp_banc_mes, exp_banc_anio) values ('".$_POST['mes']."','".$_POST['ano']."')";
mysql_query ($tx12);
	if (file_exists($ruta)){
		unlink($ruta);
	}
$file=fopen($ruta,"a") or die("Problemas");
  //vamos a�adiendo el contenido
  if ($_POST['mes'] < 10){
	  $meso = '0'.$_POST['mes'];
  } else {
	  $meso = $_POST['mes'];
  }
	  
  $fecha_ven = $_POST['ano'].'-'.$meso.'-01';
 /* 
  $txt = "select *, SUM(prestamos.monto) as tot_monto from prestamos INNER JOIN afiliado ON prestamos.afiliado = afiliado.clave where (prestamos.vencimiento = '".$_POST['anio']."-".$_POST['mes']."-01' and prestamos.banc='si') group by prestamos.afiliado";
  $q = mysql_query ($txt);
  $n=1;
  while ($a = mysql_fetch_array($q)){
	$monto = floor(format_number_2($a['tot_monto'])*100);
	$monto = str_pad($monto,10,'0',STR_PAD_LEFT);
	$ref = str_pad('LEG'.$a['legajo'],15,' ',STR_PAD_RIGHT);
	if ($n<10){
		$nn = '0'.$n;
	} else {
		$nn = $n;
	}
  $string = substr($a['cbu_bd'],0,3).'51'.substr($_POST['fecha_deb'],8,2).substr($_POST['fecha_deb'],3,2).substr($_POST['fecha_deb'],0,2).'49400'.$a['cuil'].'           P'.$a['cbu_bd'].$monto.'33654587413DEBDIRECTO'.$ref;
  
  fputs($file,$string);
  fputs($file, PHP_EOL);
  $n++;
  }
  */
  
  $q = mysql_query ( "select *, SUM(monto) as tot_monto from prestamos where (vencimiento = '$fecha_ven' and banc='si' and pagado='I') group by afiliado");
  $n=1;
  while ($a = mysql_fetch_array($q)){
  	$p_clave = $a['afiliado'];
	$aa = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$p_clave'"));
	$monto = floor($a['tot_monto']*100);
	$monto = str_pad($monto,10,'0',STR_PAD_LEFT);
	$ref = str_pad('LEG'.$aa['legajo'],15,' ',STR_PAD_RIGHT);
	if ($n<10){
		$nn = '0'.$n;
	} else {
		$nn = $n;
	}
  $string = substr($aa['cbu_bd'],0,3).'51'.substr($_POST['fecha_deb'],8,2).substr($_POST['fecha_deb'],3,2).substr($_POST['fecha_deb'],0,2).'49400'.$aa['cuil'].'           P'.$aa['cbu_bd'].$monto.'33654587413DEBDIRECTO'.$ref;
  
  fputs($file,$string);
  fputs($file, PHP_EOL);
  $n++;
  }
  
  
  
  
  
  fclose($file);
  echo '<a href="'.$ruta.'" target="blank">Ver TXT </a>';
}
?>


</div>
  </div>
</body>
</html>
