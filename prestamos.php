<?php
$page = 'prestamos';
include("secure3.php");
include("conecta.php");
include ("funciones_grales.php");
$funcion_r=$_SESSION['funcion'];
$seccion=$_SESSION['seccion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Listado de Afiliados</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" language="javascript">
		$(document).ready(function(){


				   $("#divbusc").on("keyup",Buscaloc);



   function Buscaloc (){

        if($("#divbusc").val().length>2){
						$("#ver_listado").show();
                  $.get("listado_prestamos.php",{busca: $("#divbusc").val()}, function(htmlexterno){
                      $("#ver_listado").html(htmlexterno);
                  });
					} else {
						$("#ver_listado").hide();
					}

      };

			});
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
<?php include 'footer.php'; ?>
<div id="contanido">
<div id="cuerpo">
<div class="barri">
<div class="actual_buto">Listado de Prestamos</div>
<?php if ($seccion=='Tesoreria'): ?>
	<div class="actual_buto"><a href="prestamos_filtro.php" title="listado de prestamos">Entre fechas</a></div>
<?php endif ?>

<div class="actual_buto"><a href="nuevo_prestamo.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a></div><div class="actual_buto"><a href="listado_banco.php" title="armar listados de prestamos debito">Armar listado Banco</a></div>
<div class="actual_buto"><a href="listado_muni.php" title="armar listados de prestamos muni">Armar listado Muni</a></div>
<div class="actual_buto"><a href="veraz.php" title="ir al veraz">Veraz</a></div>
<br clear="all" />
</div>
<h1>Listado de prestamos</h1>
 Buscar por legajo o nombre/apellido: <input type="text" name="busca" id="divbusc" class="p_input"><!-- | Exacta: <input type="checkbox" name="exacta" id="esexacta"> | Incluir Pagados: <input type="checkbox" name="pagados" id="espagado" value="1">-->

<div id="ver_listado" style="margin-top:20px; display: none;">


 </div>
 <div style="margin-top:20px;"><a href="registro_errores.php" target="blank">ver registro de errores</a></div>
</div>
</div>
</body>
</html>
