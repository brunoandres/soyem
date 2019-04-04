<?php
$page = 'afiliados';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Listado de Afiliados</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
<div class="barri"><b><a href="nuevo_afiliado.php" title="Agregar un nuevo afiliado">Nuevo Afiliado</a> - <a href="listado_de_afiliados.php" title="armar listados de afiliados">Armar listados</a></b></div>
<?php
/* afiliados */
if ($_POST['dat0']=="Afiliados"){
$det .= " Afiliados ";
$j= 0;
$pq = "Select "; 
	if($_POST['legajo']=="si"){
	$pq .= "legajo,";
	$hh .='<th>Legajo</th>';
	$j = $j+1;
	}
	if($_POST['nombre']=="si"){
	$pq .= "nombre,";
	$hh .='<th>Bonbre</th>';
	$j = $j+1;
	}
	if($_POST['documento']=="si"){
	$pq .= "documento,";
	$hh .='<th>Documento</th>';
	$j = $j+1;
	}
	if($_POST['domicilio']=="si"){
	$pq .= "domicilio,";
	$hh .='<th>Domicilio</th>';
	$j = $j+1;
	}
	if($_POST['telefono']=="si"){
	$pq .= "telefono,";
	$hh .='<th>Telefono</th>';
	$j = $j+1;
	}
	if($_POST['correo']=="si"){
	$pq .= "correo,";
	$hh .='<th>Correo</th>';
	$j = $j+1;
	}
	if($_POST['nacimiento']=="si"){
	$pq .= "nacimiento,";
	$hh .='<th>F. de Nacim</th>';
	$j = $j+1;
	}
	if($_POST['afiliacion']=="si"){
	$pq .= "afiliacion,";
	$hh .='<th>F. de Afilia.</th>';
	$j = $j+1;
	}
	if($_POST['socioos']=="si"){
	$pq .= "socioos,";
	$hh .='<th>Es Socio OS</th>';
	$j = $j+1;
	}
	if($_POST['ipross']=="si"){
	$pq .= "ipross,";
	$hh .='<th>Nro Ipross</th>';
	$j = $j+1;
	}
	if($_POST['sector']=="si"){
	$pq .= "sector,";
	$hh .='<th>Sector</th>';
	$j = $j+1;
	}
	if($_POST['vencimiento']=="si"){
	$pq .= "vencimiento,";
	$hh .='<th>Venc. Carnet</th>';
	$j = $j+1;
	}
	$pq = substr($pq,0,strlen($pq)-1);
$pq .=" from afiliado";
if ($_POST['dat2'] != "Todos" or $_POST['dat3'] != "Todos"){
	$pq .=" where (";
		if($_POST['dat2'] == "Activos"){
		$pq .=" activo = 'si' ";
		$det .= " Activos ";
		}
		if($_POST['dat2'] == "No Activos"){
		$pq .=" activo = 'no' ";
		$det .= " No Activos ";
		}
		if ($_POST['dat3'] == 'Jubilados'){
			if ($_POST['dat2'] == "Todos"){
			$pq .=" jubilado = 'si' ";
			} else {
			$pq .=" and jubilado = 'si' ";
			}
			$det .= " Jubilados ";
		}
		if ($_POST['dat3'] == 'No Jubilados'){
			if ($_POST['dat2'] == "Todos"){
			$pq .=" jubilado = 'no' ";
			} else {
			$pq .=" and jubilado = 'no' ";
			}
			$det .= " No Jubilados ";
		}
	$pq .=")";
}
	if (!empty($_POST['orden'])){
	$pq .=" order by ".$_POST['orden'];
	}
}
/* fin de afiliados*/


/* todos 
if ($_POST['dat0']=="Todos"){
$det .= " Todos ";
$j= 0;
$pq = "Select "; 
	if($_POST['legajo']=="si"){
	$pq .= "legajo,";
	$hh .='<th>Legajo</th>';
	$j = $j+1;
	}
	if($_POST['nombre']=="si"){
	$pq .= "nombre,";
	$hh .='<th>Bonbre</th>';
	$j = $j+1;
	}
	if($_POST['documento']=="si"){
	$pq .= "documento,";
	$hh .='<th>Documento</th>';
	$j = $j+1;
	}
	if($_POST['domicilio']=="si"){
	$pq .= "domicilio,";
	$hh .='<th>Domicilio</th>';
	$j = $j+1;
	}
	if($_POST['telefono']=="si"){
	$pq .= "telefono,";
	$hh .='<th>Telefono</th>';
	$j = $j+1;
	}
	if($_POST['correo']=="si"){
	$pq .= "correo,";
	$hh .='<th>Correo</th>';
	$j = $j+1;
	}
	if($_POST['nacimiento']=="si"){
	$pq .= "nacimiento,";
	$hh .='<th>F. de Nacim</th>';
	$j = $j+1;
	}
	if($_POST['afiliacion']=="si"){
	$pq .= "afiliacion,";
	$hh .='<th>F. de Afilia.</th>';
	$j = $j+1;
	}
	if($_POST['socioos']=="si"){
	$pq .= "socioos,";
	$hh .='<th>Es Socio OS</th>';
	$j = $j+1;
	}
	if($_POST['ipross']=="si"){
	$pq .= "ipross,";
	$hh .='<th>Nro Ipross</th>';
	$j = $j+1;
	}
	if($_POST['sector']=="si"){
	$pq .= "sector,";
	$hh .='<th>Sector</th>';
	$j = $j+1;
	}
	if($_POST['vencimiento']=="si"){
	$pq .= "vencimiento,";
	$hh .='<th>Venc. Carnet</th>';
	$j = $j+1;
	}
	$pq = substr($pq,0,strlen($pq)-1);
$pq .=" from afiliado INNER JOIN familiares ON afiliado.clave=familiares.id_af ";
if ($_POST['dat2'] != "Todos" or $_POST['dat3'] != "Todos"){
	$pq .=" where (";
		if($_POST['dat2'] == "Activos"){
		$pq .=" afiliado.activo = 'si' ";
		$det .= " Activos ";
		}
		if($_POST['dat2'] == "No Activos"){
		$pq .=" afiliado.activo = 'no' ";
		$det .= " No Activos ";
		}
		if ($_POST['dat3'] == 'Jubilados'){
			if ($_POST['dat2'] == "Todos"){
			$pq .=" afiliado.jubilado = 'si' ";
			} else {
			$pq .=" and afiliado.jubilado = 'si' ";
			}
			$det .= " Jubilados ";
		}
		if ($_POST['dat3'] == 'No Jubilados'){
			if ($_POST['dat2'] == "Todos"){
			$pq .=" afiliado.jubilado = 'no' ";
			} else {
			$pq .=" and afiliado.jubilado = 'no' ";
			}
			$det .= " No Jubilados ";
		}
	$pq .=")";
}
	if (!empty($_POST['orden'])){
	$pq .=" order by afiliado.".$_POST['orden'];
	}
}

fin de todos */

/* familiares */
if ($_POST['dat0']=="Familiares"){
$det .= " Familiares ";
$j= 0;
$pq = "Select "; 
	if($_POST['tipo']=="si"){
	$pq .= "tipo,";
	$hh .='<th>Tipo</th>';
	$j = $j+1;
	}
	if($_POST['nombre']=="si"){
	$pq .= "nombre,";
	$hh .='<th>Bonbre</th>';
	$j = $j+1;
	}
	if($_POST['documento']=="si"){
	$pq .= "documento,";
	$hh .='<th>Documento</th>';
	$j = $j+1;
	}
	if($_POST['domicilio']=="si"){
	$pq .= "domicilio,";
	$hh .='<th>Domicilio</th>';
	$j = $j+1;
	}
	if($_POST['telefono']=="si"){
	$pq .= "telefono,";
	$hh .='<th>Telefono</th>';
	$j = $j+1;
	}
	if($_POST['correo']=="si"){
	$pq .= "correo,";
	$hh .='<th>Correo</th>';
	$j = $j+1;
	}
	if($_POST['nacimiento']=="si"){
	$pq .= "nacimiento,";
	$hh .='<th>F. de Nacim</th>';
	$j = $j+1;
	}
	if($_POST['afiliacion']=="si"){
	$pq .= "afiliacion,";
	$hh .='<th>F. de Afilia.</th>';
	$j = $j+1;
	}
	if($_POST['socioos']=="si"){
	$pq .= "socioos,";
	$hh .='<th>Es Socio OS</th>';
	$j = $j+1;
	}
	if($_POST['ipross']=="si"){
	$pq .= "ipross,";
	$hh .='<th>Nro Ipross</th>';
	$j = $j+1;
	}
	if($_POST['sector']=="si"){
	$pq .= "sector,";
	$hh .='<th>Sector</th>';
	$j = $j+1;
	}
	if($_POST['vencimiento']=="si"){
	$pq .= "vencimiento,";
	$hh .='<th>Venc. Carnet</th>';
	$j = $j+1;
	}
	$pq = substr($pq,0,strlen($pq)-1);
$pq .=" from familiares";
if ($_POST['dat1'] != "Todos"){
	$pq .=" where (";
		if($_POST['dat1'] == "Activos"){
		$pq .=" activo = 'si' ";
		$det .= " Activos ";
		}
		if($_POST['dat1'] == "No Activos"){
		$pq .=" activo = 'no' ";
		$det .= " No Activos ";
		}
	$pq .=")";
}
	if (!empty($_POST['orden1'])){
	$pq .=" order by ".$_POST['orden1'];
	}
}
/* fin de familiares*/



$pqu = mysql_query($pq);
$npq = mysql_num_rows($pqu);
echo '<div class="subt">Esta lista tiene '.$npq.' datos de '.$det.': </div>';
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
      <?php
	  echo $hh;
	  ?>
    </tr>
	<?php
	for ($i=0; $i<$npq; $i++){
	$da = mysql_fetch_row($pqu);
	echo '<tr>';
		for($ii=0; $ii<$j; $ii++){
		echo '<td>'.$da[$ii].'</td>';
		}
	echo '</tr>';
	}
	?>
	</table>


</div>
  </div>
</body>
</html>
