<?php
include("secure1.php");
include("conecta.php");
include ("auditoria.php");
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
	$query1 = "UPDATE familiares SET id_af = '$noclave' WHERE id_af = '$no_noclave'";
	mysql_query($query1);
	auditar($query1);

	$query2 = "UPDATE prestamos SET afiliado = '$noclave' WHERE afiliado = '$no_noclave'";
	mysql_query($query2);
	auditar($query2);

	$query3 = "UPDATE prestamos_viviendas SET afiliado = '$noclave' WHERE afiliado = '$no_noclave'";
	mysql_query($query3);
	auditar($query3);

	$query4 = "UPDATE reintegros SET legajo_rei = '$noclave' WHERE legajo_rei = '$no_noclave'";
	mysql_query($query4);
	auditar($query4);

	$query5 = "DELETE FROM afiliado WHERE clave = '$no_noclave'";
	mysql_query($query5);
	auditar($query5);
}
header("Location:duplicados.php");
exit();
?>