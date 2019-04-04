<?php
include("conecta.php");
$q = mysql_query("select * from afiliado INNER JOIN cbu_banco ON afiliado.legajo = cbu_banco.bnc_legajo");
	while ($a = mysql_fetch_array($q)){
		$clave =$a['clave'];
		$bnc_banco =$a['bnc_banco'];
		$bnc_cbu_bn =$a['bnc_cbu_bn'];
		$bnc_cbu_bd =$a['bnc_cbu_bd'];
		echo $a['bnc_nombre'].' - '.$a['nombre'].'<br>';
		mysql_query("update afiliado set banco = '$bnc_banco' where clave='$clave'");
		mysql_query("update afiliado set cbu_bn = '$bnc_cbu_bn' where clave='$clave'");
		mysql_query("update afiliado set cbu_bd = '$bnc_cbu_bd' where clave='$clave'");
	}
?>