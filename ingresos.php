<?php
$page = 'ingresos';
include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Ingresos</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/shCore.css">
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>


	
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <script type="text/javascript">
		$(document).ready(function() {
					$('.fancybox').fancybox();
			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});	
			  $(".fancybox").fancybox({
        afterClose  : function() { 
            window.location.reload();
        }
    });
});
	</script>
   
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="js/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#ingresos').DataTable();
} );


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
<div class="barri"><b><a href="nuevo_recibo.php" title="Agregar un nuevo afiliado">Nuevo Recibo </a> - <a href="cajas_diarias.php" title="Caja diaria">Caja Diaria</a></b></div>
<h1>Listado de Recibos</h1>
<form action="prestamos.php" method="get">






	<table id="ingresos" class="display" cellspacing="0" width="100%">
				<thead>
	 <th>Nro Recibo</th>
      <th>Fecha</th>
	  <th>Nombre</th>
      <th>Concepto</th>
	  
	
	   <th>Importe</th>
      <th>Ver</th>
	  <th>Quitar</th>
    </tr>
    </thead>
            
            <tbody>
	<?php
	$query = mysql_query("select * from recibos INNER JOIN conceptos_recibos ON recibos.rec_concepto = conceptos_recibos.cr_id order by recibos.rec_nro desc");
while ($dat = mysql_fetch_array($query)){
	echo '<tr>
	<td>'.$dat{'rec_nro'}.'</td>
      <td>'.substr($dat{'rec_fecha'},8,2).'/'.substr($dat{'rec_fecha'},5,2).'/'.substr($dat{'rec_fecha'},0,4).'</td>';
	  
      echo '<td>';
	  if($dat['rec_anulado']=='S'){
	  echo '<div class="anular">Anulado</div>';
	  }
	  echo $dat{'rec_nombre'}.'</td>
	  <td>'.$dat{'cr_name'}.'</td>';
	

	   echo '<td align="right">$ '.$dat['rec_importe'].'</td>';
	  echo '<td><a href="detalle_recibo.php?rec_id='.$dat{'rec_id'}.'" title="ver detalles del recibo '.$dat{'rec_nro'}.'" class="ver">Ver</a></td>
	  <td><a href="anular_recibo.php?rec_id='.$dat{'rec_id'}.'&vuelta=ingresos.php" title="Anular este Recibo" class="anular" onclick="return confirmar(';
	   echo "'�Est� seguro que desea anular eate recibo? Esta operacion no se puede deshacer'";
	  echo ')" >';
	  if($dat['rec_anulado']=='N'){
	  echo 'Anular';
	  }
	  echo '</a></td>
    </tr>';
	}
	
?> </tbody>
        </table>


</div>
</div>
</body>
</html>
