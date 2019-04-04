<?php
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
</body>
<div class="h_pres">
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
	 <th>Otorgamiento</th>
      <th>Proveedor</th>
	  <th>Tipo</th>
	  <th>Cuotas</th>
	   <th>Importe Cuota</th>
	   <th>Importe Total</th>
	    
      <th>Ver</th>
    </tr>
	<?php
	$sq = "select * from prestamos where (afiliado=".$_GET['afiliado'].") group by fecha_prestamo,proveedor,num_cuotas order by vencimiento desc ";
	
	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	$clave = $dat['afiliado'];
	$clave_empresa = $dat['proveedor'];
	$d_afiliado = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$clave'"));
	$d_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
	if ($clave_empresa !=0){
	$empresa = $d_empresa{'nombre'};
	} else {
	$empresa = '<b>SOYEM</b>';
	}
	echo '<tr>
      <td>'.substr($dat{'fecha_prestamo'},8,2).'/'.substr($dat{'fecha_prestamo'},5,2).'/'.substr($dat{'fecha_prestamo'},0,4).'</td>
	  <td>'.$empresa.'</td>';
	  echo '<td>';
	  if($dat['efectivo']=='X'){
	  echo 'Efectivo';
	  }
	  if($dat['banco']=='X'){
	  echo 'Cheque';
	  }
	  if($dat['vale_pro']=='X'){
	  echo 'Proveedor';
	  }
	  echo '</td>';
	  echo '<td align="center">'.$dat['num_cuotas'].'</td>';
	   echo '<td align="right">$ '.$dat['monto'].'</td>';
	   echo '<td align="right">$ '.$dat['num_cuotas'] * $dat['monto'].'</td>';
	
	  echo '<td><a href="detalle_prestamos.php?clave_prestamo='.$dat{'clave_prestamo'}.'" title="ver mas datos de '.$dat{'nombre'}.'" target="_blanck" >Ver</a></td>
    </tr>';
	}
	
?>
<?php
	$sq = "select * from prestamos_old where (afiliado=".$_GET['afiliado'].") group by fecha_prestamo,proveedor,num_cuotas order by vencimiento desc ";
	
	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	$clave = $dat['afiliado'];
	$clave_empresa = $dat['proveedor'];
	$d_afiliado = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$clave'"));
	$d_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
	if ($clave_empresa !=0){
	$empresa = $d_empresa{'nombre'};
	} else {
	$empresa = '<b>SOYEM</b>';
	}
	echo '<tr>
      <td>'.substr($dat{'fecha_prestamo'},8,2).'/'.substr($dat{'fecha_prestamo'},5,2).'/'.substr($dat{'fecha_prestamo'},0,4).'</td>
	  <td>'.$empresa.'</td>';
	  echo '<td>';
	  if($dat['efectivo']=='X'){
	  echo 'Efectivo';
	  }
	  if($dat['banco']=='X'){
	  echo 'Cheque';
	  }
	  if($dat['vale_pro']=='X'){
	  echo 'Proveedor';
	  }
	  echo '</td>';
	  echo '<td align="center">'.$dat['num_cuotas'].'</td>';
	   echo '<td align="right">$ '.$dat['monto'].'</td>';
	    echo '<td align="right">$ '.$dat['num_cuotas'] * $dat['monto'].'</td>';
	  echo '<td></td>
    </tr>';
	}
	
?></table>
</div>
</html>
