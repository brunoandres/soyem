<?php
$page = 'ingresos';
include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Ingresos</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/shCore.css">
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>

 <!-- datatable lib
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>-->


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
<?php include 'footer.php'; ?>
<div id="contanido">
<div id="cuerpo">
<div class="barri"><b><a href="nuevo_recibo.php" title="Agregar un nuevo afiliado">Nuevo Recibo </a> - <a href="cajas_diarias.php" title="Caja diaria">Caja Diaria</a></b></div>
<h1>Listado de Recibos</h1>

	<form action="prestamos.php" method="get">
		<table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nro Recibo</th>
			  		<th>Fecha</th>
			  		<th>Nombre</th>
			  		<th>Concepto</th>
			   		<th>Importe</th>
			        <th>Ver</th>
				    <th>Quitar</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
				    <th>Nro Recibo</th>
			  		<th>Fecha</th>
			  		<th>Nombre</th>
			  		<th>Concepto</th>
			   		<th>Importe</th>
			        <th>Ver</th>
				    <th>Quitar</th>
				</tr>
			</tfoot>
	</table>
</div>
</div>

<script>
	//Script server side processing
    $(document).ready(function(){
        var dataTable=$('#example').DataTable({
            "processing": true,
            "serverSide":true,
            "ajax":{
                url:"fetch_ingresos.php",
                type:"post"
            },
            "order": [[ 1, "desc" ]],
            "language": {
            "url": "spanish.json"
        	}
        });
    });
</script>

</body>
</html>
