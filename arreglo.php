<?php
	include("conecta.php");
	$q = mysql_query("SELECT * FROM  prestamos WHERE  fecha_prestamo >=  '2016-11-16' and num_cuotas > '1'");
	while ($a = mysql_fetch_array($q)){
		echo $a['fecha_prestamo'].' '.$a['clave_prestamo'].' '.$a['cuota'].' '.$a['num_cuotas'].' '.$a['monto'].' '.$a['vale'];
	
	
	echo '<br>';
	}
?>