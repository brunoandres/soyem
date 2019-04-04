<?php 
include("conecta.php"); 
include ("funciones_grales.php");
$resp ="";
$resp .= '<table id="lista_prestamos" cellspacing="0" cellpadding="5" width="100%">
				<thead>
    <tr>
	 <th>Fecha Prestamo</th>
      <th>Nombre</th>
	  <th>Legajo</th>
      <th>Proveedor</th>
	  <th>Tipo</th>
      <th>Pago</th>
	  <th>Cuotas</th>
	   <th>Importe</th>
      <th>Ver</th>
	  
    </tr>
    </thead>
            
            <tbody>';

	if($_GET['pagado'] !=1){
		$filtro .= "prestamos.pagado = 'I' and ";
	}
	if($_GET['exacto'] ==1){
		$filtro .= "(afiliado.nombre = '".$_GET['busca']."' or afiliado.legajo = '".$_GET['busca']."')";
	} else {
			$filtro .= "(afiliado.nombre like '%".$_GET['busca']."%' or afiliado.legajo like '%".$_GET['busca']."%')";
	}
	$sq = "select * from prestamos INNER JOIN afiliado ON prestamos.afiliado = afiliado.clave where (".$filtro.") group by prestamos.vale order by prestamos.vencimiento desc limit 200 ";
	
	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	$clave = $dat['afiliado'];
	$clave_empresa = $dat['proveedor'];
	$d_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
	if ($clave_empresa !=0){
	$empresa = $d_empresa['nombre'];
	} else {
	$empresa = '<b>SOYEM</b>';
	}
	switch ($dat['tipe_p']){
		case 'D':
		$ttip = "Debito Banco";
		break;
		
		case 'M':
		$ttip = "Descuento Planilla";
		break;
		
		case 'P':
		$ttip = "Prestamo salud";
		break;
	}
	$resp .= '<tr>
      <td>'.substr($dat['fecha_prestamo'],8,2).'/'.substr($dat['fecha_prestamo'],5,2).'/'.substr($dat['fecha_prestamo'],0,4).'</td>
	  <td>'.$dat['nombre'].'</td>
      <td>'.$dat['legajo'].'</td>
	  <td>'.$empresa.'</td>
	  <td>'.$ttip.'</td>';
	  $resp .= '<td>';
	  if($dat['efectivo']=='X'){
	  $resp .= 'Efectivo';
	  }
	  if($dat['banco']=='X'){
	  $resp .= 'Cheque';
	  }
	  if($dat['vale_pro']=='X'){
	  $resp .= 'Proveedor';
	  }
	  if($dat['turismo']=='X'){
	  $resp .= 'Turismo';
	  }
	  $resp .= '</td>';
	  $resp .= '<td align="center">'.$dat['num_cuotas'].'</td>';
	   $resp .= '<td align="right">$ '.total_prestamo($dat['clave_prestamo'],$dat['num_cuotas']).'</td>';
	  $resp .= '<td><a href="detalle_prestamos.php?clave_prestamo='.$dat['clave_prestamo'].'" title="ver mas datos de '.$dat{'nombre'}.'">Ver</a></td>
	<!--  <td><a href="quitar_prestamo.php?clave_prestamo='.$dat['clave_prestamo'].'" class="example6" title="Quitar prestamo">Quitar</a></td> -->
    </tr>';
	}
	$resp .= '</table>';
	echo $resp;
?>