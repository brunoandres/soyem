<?php
include("conecta.php");
include("funciones_grales.php");
include ("auditoria.php");
$txt = "select *, SUM(prestamos.monto) as tot_monto from prestamos INNER JOIN afiliado ON prestamos.afiliado = afiliado.clave where (prestamos.vencimiento = '".$_POST['anio']."-".$_POST['mes']."-01' and prestamos.banc='no' and prestamos.pagado = 'I') group by prestamos.afiliado order by afiliado.nombre asc";
$qr= mysql_query($txt);
$txt1 = "select * from prestamos where (vencimiento = '".$_POST['anio']."-".$_POST['mes']."-01' and banc='no' and pagado = 'I')";
$qr1= mysql_query($txt1);

$txttxtx = "select * from historial_expo_muni where (mes = '".$_POST['mes']."' and anio = '".$_POST['anio']."')";


if($_POST['tipo']=="Listado definitivo"){
	$txt12 = "select * from historial_expo_muni where (mes = '".$_POST['mes']."' and anio = '".$_POST['anio']."' and archivo != '')";
	$nnn = mysql_num_rows(mysql_query($txt12));
	if($nnn > 0){
		header("location: listado_muni.php?error=1");
		exit();
	} else {
$f = fopen("back_muni/exportar(".$_POST['anio']."-".$_POST['mes'].")_prueba.dat","w"); 

$contenido .= "Legajo"."\t".str_pad("Nombre",35," ",STR_PAD_RIGHT)."\t\t"."Cuotas"."\t"."Nro_Cuota"."\t"."Importe"."\r\n";

$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'];

  $fecha = date("Y/m/d");
  $t_tot = 0;
  for ($a=0; $a < mysql_num_rows($qr); $a = $a + 1){
  $aqr = mysql_fetch_array($qr);
  $contenido .= str_pad($aqr['legajo'],6,' ',STR_PAD_RIGHT)."\t |".str_pad(substr($aqr['nombre'],0,30),35," ",STR_PAD_RIGHT)."\t\t |".str_pad($aqr['num_cuotas'],6," ",STR_PAD_RIGHT)."\t |".str_pad($aqr['cuota'],9," ",STR_PAD_RIGHT)."\t |".str_pad( format_number_2($aqr['tot_monto']) ,7," ",STR_PAD_RIGHT)." \r\n";
  $t_tot = $t_tot + $aqr['tot_monto'];
  }
  $contenido .= "Total: ".format_number_2($t_tot);
  
   for ($b=0; $b < mysql_num_rows($qr1); $b++){
  $aqr1 = mysql_fetch_array($qr1);
  $tt1 = "select * from afiliado where clave = ".$aqr1['afiliado'];
  $aff = mysql_fetch_array(mysql_query($tt1));
  $cla_ve = $aqr1['clave_prestamo'];
  mysql_query ("update prestamos set pagado ='P' where clave_prestamo = '$cla_ve'");
  $nro = $nro + 1;

  $detalle = "Cancelacion mediante planilla del prestamo al afiliado ".$aff ['nombre']." legajo ".$aff ['legajo']. " cuota ".$aqr1['cuota']." de $ ".$aqr1['monto'];
  
  $montot = $aqr1['monto'];
  
		
		///// parte a editar
		
		
	
		mysql_query("insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values ('$nro', '$fecha', '175', '$montot', '$detalle', '$id_us', 'si')");
		mysql_query("insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values ('$nro', '$fecha', '154', '$montot', '$detalle', '$id_us', 'si')");
 
  //// fin edicion
  
  }
   
  fwrite($f,$contenido); 
	fclose($f); 
	
	
	
	if (mysql_num_rows(mysql_query($txttxtx))==0){
	
	$txtx = "insert into historial_expo_muni (mes, anio, archivo, total) values (".$_POST['mes'].",".$_POST['anio'].",'exportar(".$_POST['anio']."-".$_POST['mes'].").dat','".$t_tot."')";
	mysql_query($txtx);
	auditar($txtx);
	
	} else {
		
		$txtx = "update historial_expo_muni set archivo = 'exportar(".$_POST['anio']."-".$_POST['mes'].").dat' where (mes = ".$_POST['mes']." and  anio = ".$_POST['anio'].")";
	mysql_query($txtx);
	auditar($txtx);
		
	}
	
	
	
	
	
	header("location: listado_muni.php");
	exit();
}} else {
		
		
		
		
		
		
		
$f = fopen("back_muni/borrador(".$_POST['anio']."-".$_POST['mes'].").txt","w"); 

$contenido .= "Legajo"."\t".str_pad("Nombre",35," ",STR_PAD_RIGHT)."\t\t"."Cuotas"."\t"."Nro_Cuota"."\t"."Importe"."\r\n";

$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'];

  $fecha = date("Y/m/d");
  $t_tot = 0;
  for ($a=0; $a < mysql_num_rows($qr); $a = $a + 1){
  $aqr = mysql_fetch_array($qr);
  $contenido .= str_pad($aqr['legajo'],6,' ',STR_PAD_RIGHT)."\t".str_pad(substr($aqr['nombre'],0,30),35," ",STR_PAD_RIGHT)."\t\t".str_pad($aqr['num_cuotas'],6," ",STR_PAD_RIGHT)."\t".str_pad($aqr['cuota'],9," ",STR_PAD_RIGHT)."\t".str_pad( format_number_2($aqr['tot_monto']) ,7," ",STR_PAD_RIGHT)." \r\n";
  $t_tot = $t_tot + $aqr['tot_monto'];
  }
  $contenido .= "Total: ".format_number_2($t_tot);
  fwrite($f,$contenido); 
	fclose($f); 
	if (mysql_num_rows(mysql_query($txttxtx))==0){
	$txtx = "insert into historial_expo_muni (mes, anio, borrador, total) values (".$_POST['mes'].",".$_POST['anio'].",'borrador(".$_POST['anio']."-".$_POST['mes'].").txt','".$t_tot."')";
	mysql_query($txtx);
	auditar($txtx);
	} else {
		$txtx = "update historial_expo_muni set borrador = 'borrador(".$_POST['anio']."-".$_POST['mes'].").txt' where (mes = ".$_POST['mes']." and  anio = ".$_POST['anio'].")";
	mysql_query($txtx);
	auditar($txtx);
		
	}
	
	header("location: listado_muni.php");
	exit();
	}
  ?>