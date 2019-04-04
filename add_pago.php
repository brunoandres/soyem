<?php
include("conecta.php");
$q = mysql_query ("select * from prestamos where (pagado = 'P' and monto > 0)");
	while($a = mysql_fetch_array($q)){
		$txt = "insert into pagos_prestamos (pp_clave, pp_importe) values ('".$a['clave_prestamo']."', '".$a['monto']."')";
		mysql_query($txt);
	}
echo "Listo..... ";
?>