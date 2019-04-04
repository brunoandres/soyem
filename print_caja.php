<?php
include("secure2.php");
include("conecta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimir Caja</title>
<link href="print.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<h1>
	  <?php
	if (empty($_GET['desde'])){
	$desde = date("Y/m/d");
	} else {
	$desde = $_GET['desde'];
	}
	if (empty($_GET['hasta'])){
	$hasta = date("Y/m/d");
	} else {
	$hasta = $_GET['hasta'];
	}
	?>
	Caja diaria desde: <?php echo substr($_GET['desde'],8,2).'/'.substr($_GET['desde'],5,2).'/'.substr($_GET['desde'],0,4); ?>
 hasta: <?php echo substr($_GET['hasta'],8,2).'/'.substr($_GET['hasta'],5,2).'/'.substr($_GET['hasta'],0,4); ?>  </h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" id="print">
    <tr>
		<th>Fecha</th>
      <th>Nro</th>
	  <th>Cuenta</th>
	  <th>Debe</th>
	  <th>Haber</th>
	  <th width="30%">Detalle</th>
    </tr>
	
	<?php
	$sq = "select * from asientos INNER JOIN cuentas on asientos.cuenta = cuentas.id_cuentas where (asientos.fecha <='".$hasta."' and asientos.fecha >='".$desde."') group by asientos.nro order by asientos.id_a asc";
	$u=mysql_query($sq);
	$d=0;
	$h=0;
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
		$nro = $au['nro'];
		if(floor($nro/2) == ($nro/2)){
		$fon ="#FFFFFF";
		} else {
		$fon ="#EEEEEE";
		}
	$qa  = mysql_query("select * from asientos INNER JOIN cuentas on asientos.cuenta = cuentas.id_cuentas where (asientos.nro ='$nro') order by asientos.id_a asc");
	$na = mysql_num_rows($qa);
    
		for($t=0; $t<$na; $t++){
		$aa = mysql_fetch_array($qa);
		if ($t==0){
		echo  '<tr bgcolor="'.$fon.'"><td rowspan="'.$na.'">'.substr($au['fecha'],8,2).'/'.substr($au['fecha'],5,2).'/'.substr($au['fecha'],0,4).'</td>';
	    echo '<td rowspan="'.$na.'">'.$au['nro'].'</td>';
		echo '<td>'.$aa['cuenta'].'</td>
		<td> $ '.$aa['debe'].'</td>
		<td> $ '.$aa['haber'].'</td>';
		echo '<td rowspan="'.$na.'">'.$au['detalle'].'</td>';
     
	  } else {
	  echo '<tr bgcolor="'.$fon.'"><td>'.$aa['cuenta'].'</td>
		<td> $ '.$aa['debe'].'</td>
		<td> $ '.$aa['haber'].'</td></tr>';
	  }
		}
		
  
	$d=$d+$au['debe'];
	$h=$h+$au['haber'];
	}
	?>
</table>
<input type="button" value="Imprimir" onclick="javascript:window.print()" />
</body>
</html>
