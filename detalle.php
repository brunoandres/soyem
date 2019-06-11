<?php
$page = 'contabilidad';
$subpage = 'ejercicios';
include("secure1.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
mysql_query("delete from asientos where activo='no'");
if(!isset($_GET['fecha'])){
	header('location:ejercicios.php');
}else{
	$fecha = $_GET['fecha'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8"/>
<title>Sistema Administrativo - Detalle Ejercicios Contables</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
} 
</script>




 <link type="text/css" media="screen" rel="stylesheet" href="colorbox.css" />
		<script type="text/javascript" src="colorbox/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="colorbox/jquery.colorbox1.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				
				$(".example6").colorbox({iframe:true, innerWidth:950, innerHeight:520});
				
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


<?php include("recortes/menu_cont.php"); ?>
 <h3>Detalle de Ejercicios Contables</h3>
 <input type="hidden" id="valor" value="<?php echo $fecha; ?>" />

<table id="example" class="display" cellspacing="0" width="100%">
	<thead>
    <tr>
  		<th>Nro</th>
      <th>Fecha</th>
  	  <th>Cuenta</th>
  	  <th>Debe</th>
  	  <th>Haber</th>
  	  <th>Activo</th>
    </tr>
  </thead>

</table>
	
  </div>
</div>

<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script>

  <script>

	//Script server side processing
    $(document).ready(function(){
      
    	var valor = $("#valor").val();
      $.fn.dataTable.moment( 'DD/MM/YYYY' );
        $.fn.dataTable.moment('L');
        var dataTable = $('#example').DataTable({
            "pageLength":100,
            "processing": true,
            "serverSide":true,
            "ajax":{
              url:"fetch_detalle_ejercicios.php",
              type:"post",
              data:{
              	valor : valor
              }
            },
            "order": [[ 1, "asc" ]],
            "ordering": true, 
            "language": {
            "url": "spanish.json"
        	}
        });
    });
</script>
</body>
</html>