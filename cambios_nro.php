<?php
include ("conecta.php");
	mysql_query("update asientos set cuenta = '180' where (cuenta = '178' and fecha > '2016-12-31')");
		
		echo 'listo';
?>