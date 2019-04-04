<?php
include("conecta.php");
if (!empty($_GET['change'])){

	$chan = $_GET['change'];
	$clave = $_GET['clave_prestamo'];
	mysql_query("UPDATE prestamos set pagado='$chan' where clave_prestamo='$clave'");
	$clave_pre = $_GET['clave_prestamo'] - $_GET['cuota'] + 1;
} else {
			$clave = $_GET['clave_prestamo'];
		
		$sigui = $clave + 1;
		$a_mon = mysql_fetch_row(mysql_query("select monto from prestamos where clave_prestamo='$sigui'"));
		
		
		$monto_nuevo = floatval($_GET['monto'] + $a_mon[0]);
		mysql_query("UPDATE prestamos SET monto='$monto_nuevo' WHERE clave_prestamo='$sigui'");
		

	

	mysql_query("UPDATE prestamos set pagado='P' where clave_prestamo='$clave'");
	mysql_query("UPDATE prestamos set monto='0' where clave_prestamo='$clave'");

	$clave_pre = $_GET['clave_prestamo'] - $_GET['cuota'] + 1;
	
}
header("Location: detalle_prestamos.php?clave_prestamo=$clave_pre");
exit();
?>