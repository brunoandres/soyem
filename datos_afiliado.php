<?php
$page = 'afiliados';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
$clave = $_GET['clave'];
$data = mysql_fetch_array(mysql_query("select * from afiliado where clave='$clave' "));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Administrativo - Datos del Afiliado</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
 <link type="text/css" media="screen" rel="stylesheet" href="colorbox.css" />
		<script type="text/javascript" src="colorbox/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="colorbox/jquery.colorbox.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				
				$(".example6").colorbox({iframe:true, innerWidth:700, innerHeight:620});
				
				  $().bind('cbox_closed',function() {  
      location.reload(true); 
   }); 
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
		<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
} 
</script>
</head>

<body>
<?php
include("top_bar.php");
?>
<?php
include("menu.php");
?>
</div>
</div>
<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
<div id="contanido">
<div id="cuerpo">
<div class="barri"><b><a href="nuevo_afiliado.php" title="Agregar un nuevo afiliado">Nuevo Afiliado</a> - <a href="listado_de_afiliados.php" title="armar listados de afiliados">Armar listados</a> - <a href="listado_afiliados.php" title="Buscar a un afiliado">Buscar un afiliado</a></b></div>
<h1>Datos de <?php echo $data['nombre']; ?></h1>
<div id="datos_af">
<?php
echo 'Nombre: <b>'.$data['nombre'].'</b><br>';
echo 'Legajo: <b>'.$data['legajo'].'</b><br>';
echo 'CUIL: <b>'.$data['cuil'].'</b><br>';
echo 'Fecha de Nacimiento: <b>'.substr($data['nacimiento'],8,2).'/'.substr($data['nacimiento'],5,2).'/'.substr($data['nacimiento'],0,4).'</b><br>';
echo 'Edad: <b>';
if (substr($data['nacimiento'],5,2) < date("m")){
	echo (date("Y") - substr($data['nacimiento'],0,4));
	}
	if (substr($data['nacimiento'],5,2) > date("m")){
	echo (date("Y") - substr($data['nacimiento'],0,4)) - 1;
	}
	if (substr($data['nacimiento'],5,2) == date("m")){
		if(substr($data['nacimiento'],8,2) > date("d")){
	echo (date("Y") - substr($data['nacimiento'],0,4)) - 1;
	} else {
	echo (date("Y") - substr($data['nacimiento'],0,4));
	}
	}

echo '</b><br>';

echo 'Domicilio: <b>'.$data['domicilio'].'</b><br>';
echo 'Documento: <b>'.$data['documento'].'</b><br>';
echo 'Estado Civil: <b>'.$data['estado_civil'].'</b> ';
if ($data['estado_civil']=='casado'){
echo 'Obra social de esposo/a: <b>'.$data['os_esposa'].'</b> ';
	if ($data['os_esposa']=='si'){
	echo ' <b>'.$data['nom_os_esposa'].'</b> ';
	} 
} 
echo '<br>';
echo 'Teléfono: <b>'.$data['telefono'].'</b> Celular: <b>'.$data['celular'].'</b><br>';
echo 'Correo: <b>'.$data['correo'].'</b><br>';
echo 'Sector en el que trabaja: <b>'.$data['sector'].'</b><br>';
echo 'Categoria: <b>'.$data['categoria'].'</b> Antigüedad: <b>'.$data['antiguedad'].'</b><br>';
echo 'Coseguro: <b>'.$data['coseguro'].'</b>  ';
if ($data['coseguro']=='no'){
echo 'Motivo: <b>'.$data['motivo_coseguro'].'</b> ';
} 
echo '<br>';
echo 'Dona Sangre: <b>'.$data['dona_sangre'].'</b>  ';
if ($data['dona_sangre']=='si'){
echo 'Grupo y Factor: <b>'.$data['tipo_sangre'].'</b> ';
} 
echo '<br>';
echo 'Fecha de Afiliacion: <b>'.substr($data['afiliacion'],8,2).'/'.substr($data['afiliacion'],5,2).'/'.substr($data['afiliacion'],0,4).'</b><br>';
echo 'Es jubilado: <b>'.$data['jubilado'].'</b> - ';
echo 'Socio O.S.: <b>'.$data['socioos'].'</b> - ';
echo 'Nro IPROSS: <b>'.$data['ipross'].'</b><br>';
echo 'Activo: <b>'.$data['activo'].'</b><br>';
echo '<div style="background:#FFF; ">';
echo 'Banco: <b>'.$data['banco'].'</b><br>';
echo 'CBU Bsnco Nacion: <b>'.$data['cbu_bn'].'</b><br>';
echo 'CBU Banco de Destino: <b>'.$data['cbu_bd'].'</b><br>';
echo '</div>';
echo 'Sueldo que percibe: <b>'.$data['sueldo'].'</b><br>';
echo 'Vencimiento del carnet: <b>'.substr($data['vencimiento'],8,2).'/'.substr($data['vencimiento'],5,2).'/'.substr($data['vencimiento'],0,4).'</b><br>';
echo 'Sugerencias: <br><font color="009900">'.$data['sugerencias'].'</font><br>';
echo 'Observaciones: <br><font color="009900">'.$data['observaciones'].'</font><br>';
echo '<b>Actualizado el '.substr($data['f_actualiza'],8,2).'/'.substr($data['f_actualiza'],5,2).'/'.substr($data['f_actualiza'],0,4).'</b><br>';
?>
<p><a href="modifica_afiliado.php?clave=<?php echo $clave; ?>" class="example6" title="Modificar datos de este afiliado">Actualizar datos</a> - 

<?php
if ($data['activo']=='si'){
	?>
<a href="baja_afiliado.php?clave=<?php echo $clave; ?>" onclick="return confirmar('�Est� seguro que desea dar de baja a este afiliado?')">Dar de Baja a este afiliado</a>
<?php
} else {
?>
<a href="baja_afiliado.php?clave=<?php echo $clave; ?>" onclick="return confirmar('�Est� seguro que desea Activar a este afiliado?')">Activar a este afiliado</a>
<?php
}
?>
</p>
<?php
if ($data['activo']=='no'){
echo '<b> Este afiliado no esta activo</b>';
}
?>
<?php
	if($data['jubilado']=='no' and $data['coseguro']!="si"){
			echo '<a href="pdf/tarjeta.php?clave='.$clave.'" title="imprimir tarjeta" target="blank" class="targeta">    Imprimir Tarjeta  ';
			$n_print = mysql_num_rows(mysql_query("select * from imp_tarjetas where (it_clave='$clave' and it_tar='4')"));
			if($n_print > 0){
			echo '<input type="checkbox" checked="checked" disabled>';
			}
			echo '</a>';
		/*	$txf= "select * from familiares where id_af=".$clave;
			if(mysql_num_rows(mysql_query($txf))>0){
				echo '<a href="pdf/tarjeta_familiares.php?clave='.$clave.'" title="imprimir tarjeta" target="blank" class="targeta">    Imprimir Tarjeta con lista de familiares  </a>';*/
			}
	if($data['jubilado']=='no' and $data['coseguro']=="si"){
			echo '<a href="pdf/tarjeta_ipross.php?clave='.$clave.'" title="imprimir tarjeta" target="blank" class="targeta">    Imprimir Tarjeta IPROSS ';
			$n_print1 = mysql_num_rows(mysql_query("select * from imp_tarjetas where (it_clave='$clave' and it_tar='1')"));
			if($n_print1 > 0){
			echo '<input type="checkbox" checked="checked" disabled>';
			}
			echo '</a>';
			$txf= "select * from familiares where id_af=".$clave." and activo='si'";
			if(mysql_num_rows(mysql_query($txf))>0){
				echo '<a href="pdf/tarjeta_familiares.php?clave='.$clave.'" title="imprimir tarjeta" target="blank" class="targeta">    Imprimir Tarjeta con lista de familiares  ';
				$n_print2 = mysql_num_rows(mysql_query("select * from imp_tarjetas where (it_clave='$clave' and it_tar='2')"));
			if($n_print2 > 0){
			echo '<input type="checkbox" checked="checked" disabled>';
			}
				echo '</a>';
	}}
	if($data['jubilado']=='si' and $data['s_ipross']!='si'){
			echo '<a href="pdf/tarjeta_jubilado.php?clave='.$clave.'" title="imprimir tarjeta jubilado" target="blank"  class="targeta">    Imprimir Tarjeta Jubilado  ';
			echo '</a>';
	}
	if($data['jubilado']=='si' and $data['s_ipross']=='si'){
			echo '<a href="pdf/tarjeta_jubilado_socio.php?clave='.$clave.'" title="imprimir tarjeta ipross" target="blank"  class="targeta">    Imprimir Tarjeta Jubilado    ';
			echo $n_print3 = mysql_num_rows(mysql_query("select * from imp_tarjetas where (it_clave='$clave' and it_tar='3')"));
			if($n_print3 > 0){
			echo '<input type="checkbox" checked="checked" disabled>';
			}
			echo '</a>';
				$txf= "select * from familiares where id_af=".$clave." and activo='si'";
			}
?>
</div>
<h2>
Familiares de <?php
echo $data['nombre'];
?>
</h2>
<div class="bot_s"><a href="nuevo_familiar.php?clave=<?php echo $clave; ?>" class="example6" title="Agregar un familiar para este afiliado">Agregar un familiar</a></div>
<?php
$qf = mysql_query("select * from familiares where id_af='$clave'");
$nf = mysql_num_rows($qf);
if ($nf==0){
echo '<b>Sin familiares asociados</b>';
} else {
	for ($f=0; $f<$nf; $f++){
	$af = mysql_fetch_array($qf);
	if ($af['activo'] =='si'){
	echo '<div id="datos_fac">';
	} else {
	echo '<div id="datos_fa">';
	}
	echo 'Nombre: '.$af['nombre'].'<br>';
	echo 'Numero asociado: '.$af['nro'].'<br>';
	echo 'Relación: '.$af['tipo'].'<br>';
	echo 'Documento: '.$af['documento'].'<br>';
	echo 'Nacimiento: '.substr($af['nacimiento'],8,2).'/'.substr($af['nacimiento'],5,2).'/'.substr($af['nacimiento'],0,4).' - Edad: <b>';
	if (substr($af['nacimiento'],5,2) < date("m")){
	echo (date("Y") - substr($af['nacimiento'],0,4));
	}
	if (substr($af['nacimiento'],5,2) > date("m")){
	echo (date("Y") - substr($af['nacimiento'],0,4)) - 1;
	}
	if (substr($af['nacimiento'],5,2) == date("m")){
		if(substr($af['nacimiento'],8,2) > date("d")){
	echo (date("Y") - substr($af['nacimiento'],0,4)) - 1;
	} else {
	echo (date("Y") - substr($af['nacimiento'],0,4));
	}
	}
	echo '</b><br>';
	if (!empty($af['estudio'])){
	echo 'Estudios que cursa: <b>';
	   switch ($af['estudio']) {
    case 1:
        echo "Prescolar";
        break;
    case 2:
        echo "Primario";
        break;
    case 3:
        echo "Secundario";
        break;
	case 4:
        echo "Terciario";
        break;
	case 5:
        echo "Universitario";
        break;
}
echo '</b><br>';
	}
	if ($af['discapacitado']=='si'){
	echo '<b>Con Capacidades Diferentes</b><br>';
	
	}
	if ($af['activo'] =='si'){
	echo '<p><a href="modifica_familiar.php?id_fam='.$af['id_fam'].'&clave='.$clave.'" class="example6" title="Modificar datos de este familiar">Modificar datos</a> - ';
	echo '<a href="baja_familiar.php?id_fam='.$af['id_fam'].'&clave='.$clave.'" title="dar de baja e este familiar" onclick="return confirmar(';
	echo "'¿Está seguro que desea dar de baja a este familiar?'";
	  echo ')" >Dar de Baja a este familiar</a>';
	echo '</p>';
	} else {
	echo '<b>No activo</b>';
	}
	echo '</div>';
	}
	}
?>
<h2>
Historial de prestamos de <?php
echo $data['nombre'];
?></h2>
<div class="h_pres">
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
	 <th>Otorgamiento</th>
      <th>Proveedor</th>
	  <th>Tipo</th>
	  <th>Cuotas</th>
	   <th>Importe Cuota</th>
	   <th>Importe Total</th>
      <th>Ver</th>
    </tr>
	<?php
	$sq = "select * from prestamos where (afiliado=".$clave." and cuota='1') order by fecha_prestamo desc ";
	
	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	$clave = $dat['afiliado'];
	$clave_empresa = $dat['proveedor'];
	$d_afiliado = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$clave'"));
	$d_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
	if ($clave_empresa !=0){
	$empresa = $d_empresa{'nombre'};
	} else {
	$empresa = '<b>SOYEM</b>';
	}
	echo '<tr>
      <td>'.substr($dat{'fecha_prestamo'},8,2).'/'.substr($dat{'fecha_prestamo'},5,2).'/'.substr($dat{'fecha_prestamo'},0,4).'</td>
	  <td>'.$empresa.'</td>';
	  echo '<td>';
	  if($dat['efectivo']=='X'){
	  echo 'Efectivo';
	  }
	  if($dat['banco']=='X'){
	  echo 'Cheque';
	  }
	  if($dat['vale_pro']=='X'){
	  echo 'Proveedor';
	  }
	  echo '</td>';
	  echo '<td align="center">'.$dat['num_cuotas'].'</td>';
	   echo '<td align="right">$ '.$dat['monto'].'</td>';
	   echo '<td align="right">$ '.$dat['num_cuotas'] * $dat['monto'].'</td>';
	  echo '<td><a href="detalle_prestamos.php?clave_prestamo='.$dat{'clave_prestamo'}.'" title="ver mas datos de '.$dat{'nombre'}.'">Ver</a></td>
    </tr>';
	}
	
?>
<?php
	$sq = "select * from prestamos_old where (afiliado=".$clave.") group by fecha_prestamo,proveedor,num_cuotas order by vencimiento desc ";
	
	$q = mysql_query($sq);
	$nn = mysql_num_rows($q);
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($q);
	$clave = $dat['afiliado'];
	$clave_empresa = $dat['proveedor'];
	$d_afiliado = mysql_fetch_array(mysql_query("select * from afiliado where clave = '$clave'"));
	$d_empresa = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
	if ($clave_empresa !=0){
	$empresa = $d_empresa{'nombre'};
	} else {
	$empresa = '<b>SOYEM</b>';
	}
	echo '<tr>
     <td>'.substr($dat{'fecha_prestamo'},8,2).'/'.substr($dat{'fecha_prestamo'},5,2).'/'.substr($dat{'fecha_prestamo'},0,4).'</td>
	  <td>'.$empresa.'</td>';
	  echo '<td>';
	  if($dat['efectivo']=='X'){
	  echo 'Efectivo';
	  }
	  if($dat['banco']=='X'){
	  echo 'Cheque';
	  }
	  if($dat['vale_pro']=='X'){
	  echo 'Proveedor';
	  }
	  echo '</td>';
	  echo '<td align="center">'.$dat['num_cuotas'].'</td>';
	   echo '<td align="right">$ '.$dat['monto'].'</td>';
	   echo '<td align="right">$ '.$dat['num_cuotas'] * $dat['monto'].'</td>';
	  echo '<td></td>
    </tr>';
	}
	
?></table>
</div>



<h2>
Historial de seguimiento de <?php
echo $data['nombre'];
?></h2>
<div class="bot_s"><a href="nuevo_seguimiento.php?clave=<?php echo $clave; ?>" class="example6" title="Agregar una entrevista para este afiliado">Agregar Seguimiento</a></div>
<?php
$qs=mysql_query("select * from seguimiento_afiliado where clave = '$clave' order by id_seg desc");
$ns=mysql_num_rows($qs);
if ($ns == 0){
?>
<div class="seg">
<b>Este afiliado no tiene seguimientos</b>
</div>
<?php
} else {
	for ($s=0; $s<$ns;$s++){
	$as = mysql_fetch_array($qs);
?>
	<div class="seg">
El <?php echo $as['momento'].' - '.$as['usuario']; ?> escribio:<br />
<b><?php echo $as['asunto']; ?></b><br />
<?php echo $as['comentario']; ?>
</div>
	
<?php
	}
}
?>
</div>
  </div>
  <?php
  mysql_close($conn); 
  ?>

</body>
</html>
