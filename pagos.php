<?php
$page = 'pagos';
include("secure3.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Pagos</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
} 
</script>

 <link type="text/css" media="screen" rel="stylesheet" href="colorbox.css" />
		<script type="text/javascript" src="colorbox/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="colorbox/jquery.colorbox.js"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				
				$(".example6").colorbox({iframe:true, innerWidth:750, innerHeight:700});
				
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
  <h1>Pagos: </h1>
 <div id="nuevo_a"><a href="nuevo_pago.php?ac=nuevo" class="example6">
 Nuevo Pago
  </a></div>
  <form action="pagos.php" method="get">
  
  <div id="filtros">
    <strong>  Filtrar por:</strong>
  <hr />
  Forma de pago:
   <select name="forma_pago" onchange="submit()">
  <?php
  echo "<option selected='selected' value='".$_GET['forma_pago']."'>".$_GET['forma_pago']."</option>";
  ?>
  <option value="caja">caja</option>
  <option value="caja chica">caja chica</option>
   <option value="cheque">cheque</option>
    <option value="pendiente">pendiente</option>
	<option value="">Todos</option>
  </select>
  
   Empresa:
   <select name="empresa_pago" onchange="submit()">
  <?php
  $pfp_tx = "select * from empresas where clave_empresa = ".$_GET['empresa_pago'];
  $pfp = mysql_fetch_array(mysql_query($pfp_tx));
  echo "<option selected='selected' value='".$_GET['empresa_pago']."'>".$pfp['nombre']."</option>";
  ?>
  <?php
   $fp_tx = "select * from empresas order by nombre asc";
  $qfp = mysql_query($fp_tx);
  echo '<option value="">Todos</option>';
  for($e=0;$e<mysql_num_rows($qfp);$e++){
  $afp = mysql_fetch_array($qfp);
  echo '<option value="'.$afp['clave_empresa'].'">'.$afp['nombre'].'</option>';
  }
  
  ?>
  </select>
  
<br />Fecha Desde:  <?php
   if (!empty($_GET['fecha_desde'])){
   echo '<input name="fecha_desde" id="fecha_desde" placeholder="Desde" value="'.$_GET['fecha_desde'].'" />';
   } else {
   echo '<input name="fecha_desde" id="fecha_desde" placeholder="Desde" />';
   }
   ?>
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_desde",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script> 
   Hasta: 
      <?php
   if ($_GET['fecha_hasta']>0){
   echo '<input name="fecha_hasta" id="fecha_hasta" placeholder="Hasta" value="'.$_GET['fecha_hasta'].'" />';
   } else {
   echo '<input name="fecha_hasta" id="fecha_hasta" placeholder="Hasta" />';
   }
   ?>
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha_hasta",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
    });
</script> 
   <input name="aplicar" type="submit" class="apli" value="Aplicar" />
  </div>
  
  
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
		
      <th>Fecha</th>
	  <th>Empresa</th>
	  <th>Importe</th>
	 <th>Factura</th>
      <th>Detalle</th>
      
      <th>Forma</th>
      <th>Modificar</th>
      <th>Quitar</th>
    </tr>
    </thead>
	<?php
	
$tam = 25; 


if (empty($_GET['pagina'])) { 
$inicio = 0; 
$pagina=1; 
} 
else { 
	$pagina=$_GET['pagina'];
$inicio = ($pagina - 1) * $tam; 
}

	if (empty($_GET['forma_pago']) and empty($_GET['empresa_pago']) and empty($_GET['fecha_desde']) and empty($_GET['fecha_hasta'])){
	
	$sq = "select * from pagos INNER JOIN empresas on pagos.empresa_pago=empresas.clave_empresa order by id_pagos desc limit " . $inicio . "," . $tam;
	
	$sq1 = "select * from pagos INNER JOIN empresas on pagos.empresa_pago=empresas.clave_empresa order by id_pagos desc ";
	
	} else {
	$sq .= "select * from pagos INNER JOIN empresas on pagos.empresa_pago=empresas.clave_empresa where ( ";
	$sq1 .= "select * from pagos INNER JOIN empresas on pagos.empresa_pago=empresas.clave_empresa where ( ";
		if (!empty($_GET['forma_pago'])){
		$sq .= "forma_pago='".$_GET['forma_pago']."' and ";
		$sq1 .= "forma_pago='".$_GET['forma_pago']."' and ";
		}
		if (!empty($_GET['empresa_pago'])){
		$sq .= "empresa_pago='".$_GET['empresa_pago']."' and ";
		$sq1 .= "empresa_pago='".$_GET['empresa_pago']."' and ";
		}
		if (!empty($_GET['fecha_desde'])){
		$sq .= "fecha_pago >= '".substr($_GET['fecha_desde'],6,4).'-'.substr($_GET['fecha_desde'],3,2).'-'.substr($_GET['fecha_desde'],0,2)."' and ";
		$sq1 .= "fecha_pago >= '".substr($_GET['fecha_desde'],6,4).'-'.substr($_GET['fecha_desde'],3,2).'-'.substr($_GET['fecha_desde'],0,2)."' and ";
		}
		if (!empty($_GET['fecha_hasta'])){
		$sq .= "fecha_pago <= '".substr($_GET['fecha_hasta'],6,4).'-'.substr($_GET['fecha_hasta'],3,2).'-'.substr($_GET['fecha_hasta'],0,2)."' and ";
		$sq1 .= "fecha_pago <= '".substr($_GET['fecha_hasta'],6,4).'-'.substr($_GET['fecha_hasta'],3,2).'-'.substr($_GET['fecha_hasta'],0,2)."' and ";
		}
	$sq .= " nro_as >0 ) order by id_pagos desc limit " . $inicio . "," . $tam;
	$sq1 .= " nro_as >0 ) order by id_pagos desc";
	}
	$u=mysql_query($sq);
	$d=0;
	$h=0;
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>';
      
	    echo '<td>'.substr($au['fecha_pago'],8,2).'/'.substr($au['fecha_pago'],5,2).'/'.substr($au['fecha_pago'],0,4).'</td>';
		echo '<td>'.$au['nombre'].'</td>';
		echo '<td>$ '.$au['importe_pago'].'</td>';
		echo '<td>'.$au['factura_pago'].'</td>';
		echo '<td>'.$au['detalle_pago'].'</td>';
		if ($au['forma_pago']=='cheque'){
		$forma = $au['forma_pago'].' '.$au['cheque_pago'].' - '.$au['cuenta_banco'];
		} else {
			if ($au['forma_pago']=='pendiente'){
			$forma = $au['forma_pago'].' <a href="nuevo_pago1.php?id_pagos='.$au['id_pagos'].'" class="example6">Pagar</a>';
			} else {
		$forma = $au['forma_pago'];
		}
		}
		echo '<td>'.$forma.'</td>';
		echo '<td><a href="nuevo_pago.php?id_pagos='.$au['id_pagos'].'" class="example6">Modificar</a></td>';
		echo '<td><a href="quitar_pagos.php?id_pagos='.$au['id_pagos'].'&nro_as='.$au['nro_as'].'" title="Quitar este pago" onclick="return confirmar(';
	   echo "'�Est� seguro que desea quitar este pago?'";
	  echo ')" >Quitar</a></td>
    </tr>';
	
	}
	?>
  </table>
  
  <div id="nave">
<?php
$top = (($pagina) * $tam );
$nt = mysql_num_rows(mysql_query($sq1));
$domain = $_SERVER['HTTP_HOST'];  
$url = "http://" . $domain . $_SERVER['REQUEST_URI'];
if($pagina >1){
$pagina = $_GET['pagina'] - 1; 
?>
    <a href="<?php echo $url; ?>&pagina=<?php echo $pagina; ?>" class="ant">Anterior</a>
  <?php
  }
  ?>
<?php
if($nt >$top){
if(empty($_GET['pagina'])){
$pagina = 2;
} else {
$pagina = $_GET['pagina'] + 1; 
}
?>
 
 
  
  <a href="<?php echo $url; ?>&pagina=<?php echo $pagina; ?>" class="sig">Siguiente</a>
  <?php
  }
  ?>
</div>
</form>
  </div>
</div>


<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" language="javascript" src="jquery/jquery.dataTables.js"></script>
  <script type="text/javascript" language="javascript" class="init">
  $(document).ready(function() {
  $('#example').DataTable();
} );


  </script>



</body>
</html>
