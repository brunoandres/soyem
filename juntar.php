<?php
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
include("funciones_grales.php");
$legajo = $_GET['legajo'];
//echo $legajo;
$first = mysql_fetch_array(mysql_query("SELECT clave FROM afiliado WHERE legajo = '$legajo' limit 1"));
$noclave = $first['clave'];
//echo '<br>'.$noclave;
$query_nf = mysql_query("SELECT clave FROM afiliado WHERE legajo = '$legajo' and clave != '$noclave'");
while($data_nf = mysql_fetch_array($query_nf)){
	$no_noclave = $data_nf['clave'];
	//echo '<br>'.$no_noclave;
	mysql_query("UPDATE familiares SET id_af = '$noclave' WHERE id_af = '$no_noclave'");
	mysql_query("UPDATE prestamos SET afiliado = '$noclave' WHERE afiliado = '$no_noclave'");
	mysql_query("UPDATE prestamos_viviendas SET afiliado = '$noclave' WHERE afiliado = '$no_noclave'");
	mysql_query("UPDATE reintegros SET legajo_rei = '$noclave' WHERE legajo_rei = '$no_noclave'");
	mysql_query("DELETE FROM afiliado WHERE clave = '$no_noclave'");
}
header("Location:duplicados.php");
exit();
?>