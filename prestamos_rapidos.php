<?php
$page = 'prestamos_rapidos';
include("secure.php");
include("conecta.php");
include ("funciones_grales.php");
$funcion_r=$_SESSION['funcion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Administrativo - Listado de Afiliados</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/select2.css">
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
// ajax busca nombre y clave
		$("#legajo").keyup(function() {
			var tam = $( "#legajo" ).val().length;
			if(tam > 2){
				var legajo = $( "#legajo" ).val();
				$.get("busca_rapido.php", {blegajo: legajo}, function(htmlexterno){
					var datab = htmlexterno.split("|");
   $("#nombre_afiliado").val(datab[0]);
   $("#clave").val(datab[1]);
    	});
			}
		});
	  
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
<div id = "pos"><a href="../soyem_resoluciones/mis_proyectos.php" title="Ir a Resoluciones">ir a Resoluciones</a></div>
<div id="contanido">
<div id="cuerpo">
<div class="barri">
<div class="actual_buto">Prestamos Rapidos</div>


<div class="actual_buto"><a href="nuevo_prestamo.php" title="Agregar un nuevo afiliado">Nuevo Prestamo </a></div><div class="actual_buto"><a href="listado_banco.php" title="armar listados de prestamos debito">Armar listado Banco</a></div>
<div class="actual_buto"><a href="listado_muni.php" title="armar listados de prestamos muni">Armar listado Muni</a></div>
<div class="actual_buto"><a href="veraz.php" title="ir al veraz">Veraz</a></div>
<br clear="all" />
</div>
<h1>Prestamos Rapidos</h1>
<form method="get" action="">
 Seleccione la empresa a listar: <select name="empre" id="divbusc" class="p_input select2" onchange="this.form.submit()">
 	<option></option>
	<?php
		$qe = mysql_query("select * from empresas where ru_salud != '' order by nombre asc");
			while($ae = mysql_fetch_array($qe)){
				echo '<option value="'.$ae['clave_empresa'].'">'.$ae['nombre'].'</option>';
			}
	?>
 	</select>
	
	
 </form>
 <?php
 	if(isset($_GET['empre'])){
 		$clave_empresa = $_GET['empre'];
		$hoy = date("Y-m-d");
 		$ae = mysql_fetch_array(mysql_query("select * from empresas where clave_empresa = '$clave_empresa'"));
 		$q_vales = mysql_query("select * from prestamos INNER JOIN afiliado ON prestamos.afiliado = afiliado.clave where prestamos.proveedor = '$clave_empresa' and prestamos.fecha_prestamo = '$hoy'");
 		?>
		<form id="rapido" method="post" action="agrega_rapido.php"style="padding:10px;">
		<h3> Nuevo prestamo de la empresa <?php echo $ae['nombre']; ?></h3>
		<p>Legajo <input id = "legajo" type="text" class="p_input_corto" autocomplete="off">
		Nombre <input id="nombre_afiliado" type="text" class="p_input" disabled>
		<input id="clave" name="clave" type="hidden">
		<input id="empresa" name="empresa" type="hidden" value="<?php echo $_GET['empre']; ?>">
		Importe <input type="number" name="monto" class="p_input_corto" min="0" step="0.10" autocomplete="off"></p>
		<p> Cuotas <select name="cuotas" class="p_input_corto" id="cuotas" >
<option value="<?php echo $_GET['cuotas']; ?>" selected="selected"><?php echo $_GET['cuotas']; ?></option>
<?php
$i=1;
while($i<101){
echo '<option value="'.$i.'">'.$i.'</option>';
$i++;
}
?>
</select> 
   Comienza a pagar el
Mes: <select name="mes" id="mes" class="p_input_corto">
 <?php
 
 $a_meses = mysql_fetch_array(mysql_query("select * from historial_expo_banco order by exp_banc_id desc"));

	 $es_mes = date("m");
 
 
 
 
	if ($es_mes<12){
		$mmes = $es_mes+1;
		$a_anio = date("Y");
	} else {
		if ($es_mes==12){
			$mmes = 1;
			$a_anio = date("Y")+1;
		} 
	}
	
	?>
   <option selected="selected" value="<?php echo $mmes; ?>"><?php echo $mmes; ?></option>
   <?php
   $me =1;
   while ($me<13){
   echo '<option value="'.$me.'">'.$me.'</option>';
    $me++;
	}
	?>
  </select>
   A&ntilde;o: <select name="ano" id="ano" class="p_input_corto">
   <option selected="selected" value="<?php echo $a_anio; ?>"><?php echo $a_anio; ?></option>
   <?php
   $ye =date("Y");
   $tope = $ye + 10;
   while ($ye<$tope){
   echo '<option value="'.$ye.'">'.$ye.'</option>';
    $ye++;
	}
	?>
  </select>
		<button type="submit">Agregar</button>
		</form>
<div id="listado_vales">
	<h2> Ingresar los vales de <?php echo $ae['nombre']; ?></h2>
	
	<table cellpadding="5" cellspacing="0" border="1" width="100%">
	<thead>
		<tr bgcolor="eeeeee">
			<th>Afiliado</th>
			<th>Legajo</th>
			<th>Fecha Prestamo</th>
			<th>Cuota</th>
			<th>Cuotas</th>
			<th>Importe</th>
			<th>Estado</th>
			<th>Ver</th>
		</tr>
	</thead>
	<tbody>
		<?php
			while($a_vales = mysql_fetch_array($q_vales)){
				echo '<tr>';
				echo '<td>'.$a_vales['nombre'].'</td>';
				echo '<td>'.$a_vales['legajo'].'</td>';
				echo '<td>'.$a_vales['fecha_prestamo'].'</td>';
				echo '<td>'.$a_vales['cuota'].'</td>';
				echo '<td>'.$a_vales['num_cuotas'].'</td>';
				echo '<td>$ '.$a_vales['monto'].'</td>';
				echo '<td>'.$a_vales['pagado'].'</td>';
				echo '<td><a href="detalle_prestamos.php?clave_prestamo='.$a_vales['clave_prestamo'].'"> Ver</a></td>';
				echo '</tr>';
			}
		?>
	</tbody>
	</table>
</div>
<?php
 	}
?>
<div id="ver_listado" style="margin-top:20px; display: none;">


 </div>
 
</div>
</div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>
<script src="js/select2.full.min.js"></script>
</body>
</html>
