<?php
	include ("conecta.php");
	mysql_query ("update prestamos set pagado = 'P' where (vencimiento < '2017-05-01' and tipe_p='D')");
	echo "Listo";
?>