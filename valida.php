<?php
include("conecta.php");
$usuario = $_POST['usuario'];
$pass =   md5($_POST['pass']);
if (empty($usuario) or empty($pass)){
header ("location: index.php?error=1");
exit();
} else {
	$uv = mysql_query("select * from usuarios where ((usuario='$usuario') and (clave='$pass'))");
	$nu = mysql_num_rows($uv);
	if ($nu==0){
	header("Location:index.php?error=2");
	exit();
	} else {
		$dat=mysql_fetch_array($uv);
		$funcion=$dat['funcion'];
		$seccion=$dat['seccion'];
		session_start();
		$_SESSION["autenticado"] = 'si';
		$_SESSION["usuario"] = $usuario; 
		$_SESSION["funcion"] = $funcion; 
		$_SESSION["seccion"] = $seccion; 
		switch ($funcion) {
			case 1:
				header("Location:listado_afiliados.php");
				break;
			case 2:
				header("Location:listado_afiliados.php");
				break;
			case 3:
				header("Location:contabilidad.php");
				break;
			case 4:
				header("Location:listado_afiliados.php");
				break;
		}
		exit();
	}
}
?>