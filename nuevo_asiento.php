<?php
include("secure1.php");
include("conecta.php");
$id_a = $_GET['id_a'];
$data =  mysql_fetch_array(mysql_query("select * from asientos where id_a = '$id_a'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
} 
</script>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.fecha.value == "")
  { alert("Por favor la fecha del asiento"); form.fecha.focus(); return; }
   
   if (form.cuenta.value == "")
  { alert("Por favor ingrese la cuenta del asiento"); form.cuenta.focus(); return; }
  
 
   if (form.debe.value == "" & form.haber.value == "")
  { alert("Por favor ingrese el importe en el debe o haber"); form.debe.focus(); return; }
  
  
 form.submit();
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
  echo 'Nuevo Asiento:';
  } else {
   echo 'Modificando Asiento:';
  }
  ?> </h1>
 <form action="modifica_asiento.php" method="post">  
 <table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th width="10%">Fecha:</th>
    <th width="7%">Cuenta:</th>
    <th width="12%">Debe:</th>
    <th width="12%">Haber:</th>
	<th width="59%">Detalle:</th>
  </tr><?php
	if (!empty($data['fecha'])){
	$fe = substr($data['fecha'],8,2).'/'.substr($data['fecha'],5,2).'/'.substr($data['fecha'],0,4);
	}
	?>
  <tr>
    <td valign="top"><input name="fecha" type="text" id="fecha" value="<?php echo $fe; ?>" size="12" />	
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script></td>
    <td valign="top"> <select name="cuenta" id="cuenta">
		<?php
		$cc = $data['cuenta'];
		$ccu = mysql_fetch_array(mysql_query("select * from cuentas where id_cuentas='$cc'"));
		?>
  <option selected="selected" value="<?php echo $data['cuenta']; ?>"><?php echo $ccu['cuenta']; ?></option>
  <?php
  $qc = mysql_query("select * from cuentas order by cuenta asc");
  for ($z=0; $z<mysql_num_rows($qc);$z++){
  $ac = mysql_fetch_array($qc);
  echo '<option value="'.$ac['id_cuentas'].'">'.$ac['cuenta'].'</option>';
  }
  ?>
    </select></td>
    <td valign="top"><input name="debe" type="text"  id="debe" value="<?php echo $data['debe']; ?>" size="15" /></td>
    <td valign="top"> <input name="haber" type="text"  id="haber" value="<?php echo $data['haber']; ?>" size="15" /></td>
	 <td valign="top"><textarea name="detalle" cols="20" rows="3" id=""><?php echo $data['detalle']; ?></textarea></td>
  </tr>
</table>	
        <label>
	<input type="button" name="Submit" value="Guardar Asiento" onClick="Validar(this.form)"/>
	</label>
	    <input name="id_us" type="hidden" id="id_us" value="<?php echo $_SESSION['usuario']; ?>" />
	    <input name="id_a" type="hidden" id="id_a" value="<?php echo $id_a; ?>" />
		<input name="nro" type="hidden" id="nro" value="<?php echo $_GET['nro']; ?>" />

  </form>
   <?php
  if (!empty ($_GET['nro'])){
  ?>
   <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
		<th>Fecha</th>
		<th>Nro</th>
      <th>Cuenta</th>
	  <th>Debe</th>
	  <th>Haber</th>
	  <th width=300>Detalle</th>
      <th>Modificar</th>
      <th>Quitar</th>
    </tr>
	<?php
	$sq = "select * from asientos INNER JOIN cuentas on asientos.cuenta = cuentas.id_cuentas where (asientos.nro =".$_GET['nro'].") order by asientos.id_a asc";
	$u=mysql_query($sq);
	$d=0;
	$h=0;
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>
      <td>'.substr($au['fecha'],8,2).'/'.substr($au['fecha'],5,2).'/'.substr($au['fecha'],0,4).'</td>';
	    echo '<td>'.$au['nro'].'</td>
		<td>'.$au['cuenta'].'</td>
		<td> $ '.$au['debe'].'</td>
		<td> $ '.$au['haber'].'</td>
		<td>'.$au['detalle'].'</td>
		<td><a href="nuevo_asiento.php?id_a='.$au['id_a'].'&nro='.$au['nro'].'">Modificar</a></td>';
     echo '<td><a href="quitar_asiento.php?id_a='.$au['id_a'].'&vuelta=1&nro='.$au['nro'].'" title="Quitar este usuario" onclick="return confirmar(';
	   echo "'¿Está seguro que desea quitar este asiento?'";
	  echo ')" >Quitar</a></td>
    </tr>';
	$d=$d+$au['debe'];
	$h=$h+$au['haber'];
	}
	?>
  </table>
  <div class = "resumen">
  <?php
  echo 'Total Debe = $ '.$d;
  echo '<br>';
  echo 'Total Haber = $ '.$h;
   echo '<br>';
   $sal = $h - $d;
  echo 'Saldo = $ '.$sal;
  ?>
  </div>
  <?php
  }
  ?>

</div>
</body>
</html>
