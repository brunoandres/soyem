<?php
include("conecta.php");
include ("auditoria.php");

$clave = $_GET['clave'];
$verifica = mysql_fetch_array(mysql_query("SELECT activo FROM afiliado WHERE clave='$clave'"));
/*	echo $verifica['activo'];*/
if($verifica['activo']=='si'){
	$query_familiares = "update familiares set activo='no' where id_af='$clave'";
	$exec_uno = mysql_query($query_familiares);
	$query_afiliados = "update afiliado set activo='no' where clave='$clave'";
	$exec_dos = mysql_query($query_afiliados);

	if ($exec_uno && $exec_dos) {
		auditar($query_familiares);
		auditar($query_afiliados);
	}

}else {
	$query_familiares = "update familiares set activo='si' where id_af='$clave'";
	$exec_uno = mysql_query($query_familiares);
	$query_afiliados = "update afiliado set activo='si' where clave='$clave'";
	$exec_dos = mysql_query($query_afiliados);

	if ($exec_uno && $exec_dos) {
		auditar($query_familiares);
		auditar($query_afiliados);
	}
}
header("Location: datos_afiliado.php?clave=$clave");
exit();
?>