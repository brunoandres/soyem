<?php
include("conecta.php");
$txt = "select * from prestamos_viviendas where vencimiento = '".$_POST['anio']."-".$_POST['mes']."-01'";
$qr= mysql_query($txt);
if (file_exists('back/exportar.txt')){
unlink ('back/exportar.txt');
}
$f = fopen("back/exportar(".$_POST['anio']."-".$_POST['mes'].").txt","w"); 
$contenido .= "Legajo"."\t".str_pad("Nombre",35," ",STR_PAD_RIGHT)."\t\t"."Cuotas"."\t"."Nro_Cuota"."\t"."Importe"."\r\n";
  for ($a=0; $a < mysql_num_rows($qr); $a = $a + 1){
  $aqr = mysql_fetch_array($qr);
  $tt = "select * from afiliado where clave = ".$aqr['afiliado'];
  $aff = mysql_fetch_array(mysql_query($tt));
  $contenido .= str_pad($aff['legajo'],6,' ',STR_PAD_RIGHT)."\t".str_pad(substr($aff['nombre'],0,30),35," ",STR_PAD_RIGHT)."\t\t".str_pad($aqr['num_cuotas'],6," ",STR_PAD_RIGHT)."\t".str_pad($aqr['cuota'],9," ",STR_PAD_RIGHT)."\t".str_pad($aqr['monto'],7," ",STR_PAD_RIGHT)." \r\n";
  }
  /*
  $contenido = utf8_encode($contenido);
  */
  fwrite($f,$contenido); 
	fclose($f); 
	$txtx = "insert into historial_expo (mes, anio, archivo) values (".$_POST['mes'].",".$_POST['anio'].",'exportar(".$_POST['anio']."-".$_POST['mes'].").txt')";
	mysql_query($txtx);
	header("location: listado_prestamos_v.php");
	exit();
  ?>