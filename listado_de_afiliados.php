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
<script language="javascript">
function pagoOnChange(sel) {
      if (sel.value=="Familiares"){
           divC = document.getElementById("nFamiliares");
           divC.style.display = "block";

           divT = document.getElementById("nAfiliados");
           divT.style.display = "none";

      }else{

           divC = document.getElementById("nFamiliares");
           divC.style.display="none";

           divT = document.getElementById("nAfiliados");
           divT.style.display = "block";
      }
}
function pagoOnChange2(sel) {
      if (sel.value==""){
           divD = document.getElementById("nAfiliados1");
           divD.style.display = "none";

      }else{

           divD = document.getElementById("nAfiliados1");
           divD.style.display="block";
      }
}
function pagoOnChange3(sel) {
      if (sel.value==""){
           divE = document.getElementById("nAfiliados2");
           divE.style.display = "none";

      }else{

           divE = document.getElementById("nAfiliados2");
           divE.style.display="block";
      }
}
function pagoOnChange1(sel) {
      if (sel.value==""){
           divF = document.getElementById("nFamiliares1");
           divF.style.display = "none";

      }else{

           divF = document.getElementById("nFamiliares1");
           divF.style.display="block";
      }
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
<div class="barri"><b><a href="nuevo_afiliado.php">Nuevo Afiliado</a> - <a href="listado_afiliados.php">Buscar Afiliado</a></b></div>
<form method="post" action="lista.php">
<div class="subt"> Elementos a listar: </div>
<div class="etiqueta">Personas a listar:</div>
  <label>
  <SELECT NAME="dat0" onChange="pagoOnChange(this)" class="p_input">
  				<OPTION></OPTION>
              <OPTION VALUE="Afiliados">Afiliados</OPTION>
              <OPTION VALUE="Familiares">Familiares</OPTION> 
			 
           </SELECT>
  </label>
   <div id="nFamiliares" style="display:none;">
   <div class="etiqueta">Caracteristicas:</div>
           <SELECT NAME="dat1" onChange="pagoOnChange1(this)" class="p_input">
  				<OPTION></OPTION>
              <OPTION VALUE="Activos">Activos</OPTION>
              <OPTION VALUE="No Activos">No Activos</OPTION> 
			  <OPTION VALUE="Todos">Todos</OPTION>
           </SELECT>
		   <div id="nFamiliares1" style="display:none;">
		    <div class="etiqueta">Incluir los campos:</div>
		   <input name="nombre" type="checkbox" value="si" checked="checked" />Nombre 
		   <input name="documento" type="checkbox" value="si" checked="checked" />Documento 
		   <input name="tipo" type="checkbox" value="si" />Tipo 
		   <input name="nacimiento" type="checkbox" value="si" />Fecha de Nacimiento 
		   <div class="etiqueta">Ordenar por:</div>
		   <SELECT NAME="orden1" class="p_input">
  				<OPTION></OPTION>
              <OPTION VALUE="nacimiento">Fecha de Nacimiento</OPTION>
              <OPTION VALUE="nombre">Nombre</OPTION> 
			  <OPTION VALUE="documento">Documento</OPTION>
           </SELECT>
		   <input type="submit" name="accion" value="Listar"/>
		   </div>
      </div>
      <div id="nAfiliados" style="display:none;">
	  <div class="etiqueta">Caracteristicas:</div>
          <SELECT NAME="dat2" onChange="pagoOnChange2(this)" class="p_input">
  				<OPTION></OPTION>
              <OPTION VALUE="Activos">Activos</OPTION>
              <OPTION VALUE="No Activos">No Activos</OPTION> 
			  <OPTION VALUE="Todos">Todos</OPTION>
           </SELECT>
		   <div id="nAfiliados1" style="display:none;">
		   <div class="etiqueta">Caracteristicas:</div>
		   <SELECT NAME="dat3" onChange="pagoOnChange3(this)" class="p_input">
  				<OPTION></OPTION>
              <OPTION VALUE="Jubilados">Jubilados</OPTION>
              <OPTION VALUE="No Jubilados">No Jubilados</OPTION> 
			  <OPTION VALUE="Todos">Todos</OPTION>
           </SELECT>
		   <div id="nAfiliados2" style="display:none;">
		   <div class="etiqueta">Incluir los campos:</div>
		   <input name="legajo" type="checkbox" value="si" checked="checked" />Legajo  
		   <input name="nombre" type="checkbox" value="si" checked="checked" />Nombre 
		   <input name="documento" type="checkbox" value="si" checked="checked" />Documento 
		   <input name="domicilio" type="checkbox" value="si" />Domicilio 
		   <input name="telefono" type="checkbox" value="si" />Tel�fono 
		   <input name="correo" type="checkbox" value="si" />Correo 
		   <input name="nacimiento" type="checkbox" value="si" />Fecha de Nacimiento 
		   <input name="afiliacion" type="checkbox" value="si" />Fecha de Afiliaci�n 
		   <input name="socioos" type="checkbox" value="si" />Socio de OS 
		   <input name="ipross" type="checkbox" value="si" />Nro IPROSS 
		   <input name="sector" type="checkbox" value="si" />Sector 
		   <input name="vencimiento" type="checkbox" value="si" />Vencimiento del Carnet 
		   <div class="etiqueta">Ordenar por:</div>
		   <SELECT NAME="orden" class="p_input">
  				<OPTION></OPTION>
              <OPTION VALUE="legajo">Legajo</OPTION>
              <OPTION VALUE="nombre">Nombre</OPTION> 
			  <OPTION VALUE="documento">Documento</OPTION>
           </SELECT>
		   <input type="submit" name="accion" value="Listar"/>
		   </div>
		   </div>
      </div>
  
  
  
  
  <div>
        <label>
	
	</label><input type="hidden" name="act" value="si" />
	</div>
</form>
<hr />
<?php
if ($_POST['act']=="si" and (!empty($_POST['busc']) or !empty($_POST['leg']))){
	if (!empty($_POST['busc'])){
	$busq = $_POST['busc'];
	$filtro = '(nombre like ("%'.$busq.'%"))';
	$sql = "select * from afiliado where ".$filtro." order by nombre asc";
	$que = mysql_query($sql);
	$nn = mysql_num_rows($que);
	echo "Se ebcontraron ".$nn." coicidencias con la busqueda <font color='ff0000'>".$busq."</font>"; 
 	} else {
	$busq = $_POST['leg'];
	$filtro = '(legajo = '.$busq.')';
	$sql = "select * from afiliado where ".$filtro;
	$que = mysql_query($sql);
	$nn = mysql_num_rows($que);
	echo "Se ebcontraron ".$nn." coicidencias con el legajo <font color='ff0000'>".$busq."</font>";
	}
	echo '<table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
      <th>Nombre</th>
	  <th>Documento</th>
      <th>Activo</th>
	  <th>Legajo</th>
      <th>Ver</th>
    </tr>';
	for ($i=0; $i<$nn; $i++){
	$dat=mysql_fetch_array($que);
	echo '<tr>
      <td>'.$dat{'nombre'}.'</td>
	  <td>'.$dat{'documento'}.'</td>
      <td>'.$dat{'activo'}.'</td>
	  <td>'.$dat{'legajo'}.'</td>
      <td><a href="datos_afiliado.php?clave='.$dat{'clave'}.'" title="ver mas datos de '.$dat{'nombre'}.'">Ver</a></td>
    </tr>';
	}
	echo '</table>';
}
?>


</div>
  </div>
</body>
</html>
