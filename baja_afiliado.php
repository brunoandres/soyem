<?php
include("conecta.php");
$clave = $_GET['clave'];
	$verifica = mysql_fetch_array(mysql_query("SELECT activo FROM afiliado WHERE clave='$clave'"));
/*	echo $verifica['activo'];*/
	if($verifica['activo']=='si'){
mysql_query("update familiares set activo='no' where id_af='$clave'");
mysql_query("update afiliado set activo='no' where clave='$clave'");
} else {
	mysql_query("update familiares set activo='si' where id_af='$clave'");
mysql_query("update afiliado set activo='si' where clave='$clave'");
}
header("Location: datos_afiliado.php?clave=$clave");
exit();
?>