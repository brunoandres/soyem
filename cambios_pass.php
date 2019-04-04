<?php
include ("conecta.php");
	$q = mysql_query("select * from usuarios");
		while($a = mysql_fetch_array($q)){
			$clave = md5($a['pass']);
			$id_us = $a['id_us'];
			mysql_query ("update usuarios set clave='$clave' where id_us = '$id_us'");
		}
		echo 'listo';
?>