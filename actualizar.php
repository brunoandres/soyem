<?php
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Actuakizaciones</title>
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
<?php include 'footer.php'; ?>
</div>
<div id="contanido">

<div id="cuerpo">


<h1>Actualizar el sistema: </h1>
  <form action="<?php echo $PHP_SELF; ?>" method="post">
    <div class="subt"> Haga clic en actualizar para actualizar el sistema: </div>
	<div>
        <label>
	<input type="submit" name="accion" value="Actualizar"/>
	</label>
	</div>
  </form>
  <?php
  if ($_POST['accion']=="Actualizar"){
  set_time_limit(0);
  echo '<div class="error">comenzo el proceso de actualizacion.</div>';
  mysql_query("delete from tempo where soyem=0");
  $qt = mysql_query("select * from tempo");
  for ($i=0; $i<mysql_num_rows($qt); $i++){
  $at = mysql_fetch_array($qt);
  $tex1 = "select * from afiliado where legajo = ".$at['legajo'];
  $cla =mysql_num_rows(mysql_query($tex1));
  	if ($cla==0){
	if($at['os']==0){
	$os = 'no';
	} else {
	$os = 'si';
	}
	$tex2 = "insert into afiliado (legajo, nombre, sector, sueldo, s_ipross, tipo_empleado, socioos) values (".$at['legajo'].",'".$at['nombre']."','".$at['sector']."',".$at['sueldo'].",'no','".$at['tipo_empleado']."','".$os."')";
	mysql_query($tex2);
	echo "se agrego a ".$at['nombre']."<br>";
  	} else {
	$tex3 = "update afiliado set sector = '".$at['sector']."' where legajo = ".$at['legajo'];
	mysql_query($tex3);
	$tex4 = "update afiliado set sueldo = ".$at['sueldo']." where legajo = ".$at['legajo'];
	mysql_query($tex4);
	$tex5 = "update afiliado set tipo_empleado = '".$at['tipo_empleado']."' where legajo = ".$at['legajo'];
	mysql_query($tex5);
	echo "se actualizo a ".$at['nombre']."<br>";
	}
 	}
	mysql_query("TRUNCATE tempo");
	echo '<div class="error">fin de la actualizacion.</div>';
  }
  ?>
</div>
</div>
</body>
</html>
