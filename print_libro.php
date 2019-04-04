<?php
include("secure1.php");
include("conecta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimir libro</title>
<link href="print.css" rel="stylesheet" type="text/css" />
</head>

<body>

	<h1>
	  <?php
$funcion_r=$_SESSION['funcion'];
$id_cuentas = $_GET['id_cuentas'];
$data =  mysql_fetch_array(mysql_query("select * from cuentas where id_cuentas = '$id_cuentas'"));

	?>
	Libro Mayor de la cuenta: <?php echo $data['cuenta']; ?></h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" id="print">
    <tr>
		<th>Fecha</th>
	  <th>Asiento</th>
	  <th>Debe</th>
	  <th>Haber</th>
	  <th width="30%">Detalle</th>
    </tr>
	
	<?php
$d=0;
  $h=0;
  $q_pas = mysql_query("select * from cont_ejercicios where ejer_estado = 0");
  while($a_pas = mysql_fetch_array($q_pas)){
    $ano_pas = "asientos_".$a_pas['ejer_year'];
    $sq = "select * from ".$ano_pas." where (cuenta =".$id_cuentas .") order by fecha desc";
  $u=mysql_query($sq);
  for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
  $au=mysql_fetch_array($u);
    echo'<tr>
      <td>'.substr($au['fecha'],8,2).'/'.substr($au['fecha'],5,2).'/'.substr($au['fecha'],0,4).'</td>';
      echo '<td>'.$au['nro'].'</td>
    <td> $ '.$au['debe'].'</td>
    <td> $ '.$au['haber'].'</td>
    <td>'.$au['detalle'].'</td>
    </tr>';
  $d=$d+$au['debe'];
  $h=$h+$au['haber'];
  }
  }





	$sq = "select * from asientos where (cuenta =".$data['id_cuentas'] .") order by fecha desc";
$sq = "select * from asientos where (cuenta =".$id_cuentas .") order by fecha desc";
	$u=mysql_query($sq);
	
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
	if(floor($i/2) == ($i/2)){
		$fon ="#EEEEEE";
		} else {
		$fon ="#FFFFFF";
		}
    echo'<tr bgcolor="'.$fon.'">
      <td>'.substr($au['fecha'],8,2).'/'.substr($au['fecha'],5,2).'/'.substr($au['fecha'],0,4).'</td>';
	    echo '<td>'.$au['nro'].'</td>
		<td> $ '.$au['debe'].'</td>
		<td> $ '.$au['haber'].'</td>
		<td>'.$au['detalle'].'</td>
    </tr>';
	$d=$d+$au['debe'];
	$h=$h+$au['haber'];
	}

	?>
</table>

<?php

echo '<b> Debe: $ '.$d.' - Haber: $ '.$h.' - Saldo: $ '.($h-$d).'</b><br>';
?>

<input type="button" value="Imprimir" onclick="javascript:window.print()" />
</body>
</html>
