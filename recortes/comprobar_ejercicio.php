<?php 
include("../conecta.php"); 
include ("../funciones_grales.php");
	$fecha = DevFecha($_GET['fecha_busca']);
	if($fecha > date("Y-m-d")){
		$resp = 1;
	}
	$es_ano = substr($fecha, 0, 4);
	$dat = mysql_fetch_array(mysql_query("select * from cont_ejercicios where ejer_year = '$es_ano'"));
	if($dat['ejer_estado']==0 or $es_ano < 2013){
			$resp = 2;
	}
	echo $resp;
?>