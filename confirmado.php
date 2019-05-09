<?php
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Administrativo - Nuevo Familiar</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" media="all" href="calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="calendar-setup.js"></script>
</head>

<body>
<div id="contanido">
<div id="cuerpo">
<?php 
if($_GET['es']==1){
echo "El nuevo familiar se agrego con exito";
}
if($_GET['es']==2){
echo "El datos del familiar se modificaron con exito";
}
if($_GET['es']==3){
echo "El datos del afiliado se modificaron con exito";
}
if($_GET['es']==4){
echo "El seguimiento se agrego con exito";
}
if($_GET['es']==5){
echo "<h2 style='color:red;'>ERROR! El legajo ya existe</h2>";
}
if($_GET['es']==6){
echo "<h2 style='color:blue;'>Legajo no encontrado, deberia dar de alta al nuevo afiliado.</h2>";
}
if($_GET['es']==7){
echo "<h2 style='color:red;'>El documento ya está asociado al afiliado.</h2>";
}
?>
</div>
</div>
</body>
</html>
