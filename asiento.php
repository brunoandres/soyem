<?php
$page = 'contabilidad';
include("secure2.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];
$id_a = $_GET['id_a'];
$data =  mysql_fetch_array(mysql_query("select * from asientos where id_a = '$id_a'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Contabilidad</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/select2.css">
<script type="text/javascript" src="jquery/jquery-1.10.1.min.js"></script>

<script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );
} 
</script>
<?php
  if (empty ($_GET['nro'])){
  ?>
   <script type="text/javascript" language="javascript">
   $(document).ready(function(){

      $("#fecha").on("focusout",Buscaloc);
   $("#cuenta").on("change",Buscaloc);
   $("#debe").on("keypress",Buscaloc);
   $("#haber").on("keypress",Buscaloc);
   $("#boton_envia").on("mouseover",Buscaloc);

      function Buscaloc (){
            if($("#fecha").val() != ""){
            var es_fecha = $("#fecha").val();
            $.get("recortes/comprobar_ejercicio.php",{fecha_busca: es_fecha}, function(htmlexterno){
            
                      if(htmlexterno == 1 || htmlexterno == 2){
                          $("#alerta_fecha").show();
                          $("#boton_envia").attr('disabled', 'disabled');
                            if(htmlexterno == 1){
                                $("#alerta_fecha").text("no puede hacer un asiento con una fecha futura");
                            } else {
                                $("#alerta_fecha").text("La Fecha ingresada es incorrecta, corresponde a un Ejercicio cerrado");
                            }
                      } else {
                          $("#alerta_fecha").hide();
                          $("#boton_envia").removeAttr("disabled");
                      }
                  });
          }    
         
      };

    });
    </script>
  <script LANGUAGE="JavaScript">

function Validar(form)
{
  if (form.fecha.value == ""){ 
    alert("Por favor la fecha del asiento"); 
    form.fecha.focus(); 
    return; 
  }

  if (form.tipo_comprobante_conciliacion.value == "" && form.tipo_comprobante_varios.value == ""){ 
    alert("Por favor ingrese el tipo de comprobante"); 
    form.tipo_comprobante_conciliacion.focus(); 
    return; 
  }  

  if (form.comprobante.value == ""){ 
    alert("Por favor ingrese el número de comprobante"); 
    form.comprobante.focus(); 
    return; 
  }

  if (form.cuenta.value == ""){ 
    alert("Por favor ingrese la cuenta del asiento"); 
    form.cuenta.focus(); 
    return; 
  }
  
  if (form.debe.value == "" & form.haber.value == ""){ 
    alert("Por favor ingrese el importe en el debe o haber"); 
    form.debe.focus(); 
    return; 
  }
  
  if (form.detalle.value == ""){ 
    alert("Por favor ingrese el detalle del siento"); 
    form.detalle.focus(); 
    return; 
  }
  
 form.submit();
}

</script>
<?php
} else {
?>
  <script LANGUAGE="JavaScript">

function Validar(form){
  

  if (form.tipo_comprobante_conciliacion.value == "" && form.tipo_comprobante_varios.value == ""){ 
    alert("Por favor ingrese el tipo de comprobante"); 
    form.tipo_comprobante_conciliacion.focus(); 
    return; 
  }

  if (form.cuenta.value == ""){ 
    alert("Por favor ingrese la cuenta del asiento"); 
    form.cuenta.focus(); 
    return; 
  }
  
  if (form.debe.value == "" && form.haber.value == ""){ 
    alert("Por favor ingrese el importe en el debe o haber"); 
    form.debe.focus(); 
    return; 
  }
  
  form.submit();
}

</script>
<?php
}
?>
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
  <h1>
  <?php
  if($_GET['ac']=='nuevo'){
  echo 'Nuevo Item del Asiento:';
  } else {
   echo 'Modificando Item del Asiento:';
  }
  ?> </h1>
   <form action="modifica_asiento.php" method="post"> 
   <?php
  if (empty ($_GET['nro'])){
  ?>
   <div class="etiqueta"><strong>Fecha del Asiento</strong></div>
   
  <input name="fecha" type="text" id="fecha" class="p_input" value="<?php echo $fe; ?>" placeholder="Seleccione fecha desde" autocomplete="off" readonly/>	
    <script type="text/javascript">
    Calendar.setup({
        inputField     :    "fecha",      // id of the input field
        ifFormat       :    "%d/%m/%Y",       // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
        singleClick    :    false,           // double-click mode
        step           :    1   ,
        singleClick    :" true"             // show all years in drop-down boxes (instead of every other year as default)
    });
</script>
<div id="alerta_fecha" style="color:#f00; font-size: 16px; text-align:center; padding:10px; border: solid 1px #f00; margin-top:5px; display:none;">La Fecha ingresada es incorrecta, corresponde a un Ejercicio cerrado</div>
<?php
}
?>
<p></p>
 <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <th width="7%">Cuenta:</th>
    <th width="12%">Debe:</th>
    <th width="12%">Haber:</th>
	
  </tr><?php
	if (!empty($data['fecha'])){
	$fe = substr($data['fecha'],8,2).'/'.substr($data['fecha'],5,2).'/'.substr($data['fecha'],0,4);
	}
	?>
  <tr>
  <td valign="top"> 

    <select name="cuenta" id="cuenta" class="select2">
  		<?php
  		$cc = $data['cuenta'];
  		$ccu = mysql_fetch_array(mysql_query("select * from cuentas where id_cuentas='$cc'"));
  		?>
      <option selected="selected" value="<?php echo $data['cuenta']; ?>"><?php echo $ccu['cuenta']; ?></option>
      <?php
      $qc = mysql_query("select * from cuentas order by cuenta asc");
      for ($z=0; $z<mysql_num_rows($qc);$z++){
      $ac = mysql_fetch_array($qc);
      echo '<option value="'.$ac['id_cuentas'].'">'.$ac['cuenta'].'</option>';
      }
      ?>
    </select>
  </td>
    
  <td valign="top"><input name="debe" type="number" id="debe" min="0" step="0.10" value="<?php echo $data['debe']; ?>" size="15" <?php if ($data['debe']=='0.00') {
      echo "disabled";
    } ?> /></td>
    <td valign="top"> <input name="haber" type="number" id="haber" min="0" step="0.10" value="<?php echo $data['haber']; ?>" size="15" <?php if ($data['haber']=='0.00') {
      echo "disabled";
    } ?> /></td>
    
  <div><strong>Tipo Comprobante Conciliacion</strong></div>
	 <select name="tipo_comprobante_conciliacion" id="tipo_comprobante_conciliacion" class="select2">
      <?php
      $cc = $data['id_tipo_comprobante_conciliacion'];
      $ccu = mysql_fetch_array(mysql_query("select * from tipos_comprobantes_conciliacion where id='$cc'"));
      ?>
      <option selected="selected" value="<?php echo $data['id_tipo_comprobante']; ?>"><?php echo $ccu['descripcion']; ?></option>
      <?php
      $qc = mysql_query("select * from tipos_comprobantes_conciliacion order by descripcion asc");
      for ($z=0; $z<mysql_num_rows($qc);$z++){
      $ac = mysql_fetch_array($qc);
      echo '<option value="'.$ac['id'].'">'.$ac['descripcion'].'</option>';
      }
      ?>
    </select><br><br>
    <div><strong>Tipo Comprobante Varios</strong></div>
   <select name="tipo_comprobante_varios" id="tipo_comprobante_varios" class="select2">
      <?php
      $cc = $data['id_tipo_comprobante_varios'];
      $ccu = mysql_fetch_array(mysql_query("select * from tipos_comprobantes_varios where id='$cc'"));
      ?>
      <option selected="selected" value="<?php echo $data['id_tipo_comprobante_varios']; ?>"><?php echo $ccu['descripcion']; ?></option>
      <?php
      $qc = mysql_query("select * from tipos_comprobantes_varios order by descripcion asc");
      for ($z=0; $z<mysql_num_rows($qc);$z++){
      $ac = mysql_fetch_array($qc);
      echo '<option value="'.$ac['id'].'">'.$ac['descripcion'].'</option>';
      }
      ?>
    </select><br><br>
    <div class=""><strong>N° de Comprobante/ Transacción</strong></div>
    <input type="text" class="" name="comprobante" id="comprobante" value="<?php echo $data['comprobante']; ?>" placeholder="Ingrese el N° de comprobante" autocomplete="off"/><br><br>
    <div class=""><strong>N° de Cheque</strong></div>
 <input type="text" class="" name="cheque" id="cheque" value="<?php echo $data['cheque']; ?>" placeholder="Ingrese el N° de cheque" autocomplete="off"/><br><br>
  </tr>
</table>	

<script>
  $(document).ready(function(){     
    $('#debe').click(function(){     
      $('#debe').css("border-color", "red");
      $("#haber").attr('disabled','disabled'); 
      $("#debe").attr('placeholder','Ingrese el monto...');        
    });

    $('#haber').click(function(){
      $('#haber').css("border-color", "red");
      $("#debe").attr('disabled','disabled'); 
      $("#haber").attr('placeholder','Ingrese el monto...'); 
    });

    //Compruebo que elija un solo combo, deshabilitandi el otro
    $("#tipo_comprobante_conciliacion").change(function(){
      $('#tipo_comprobante_varios').css("border-color", "red");
      $("#tipo_comprobante_varios").attr('disabled','disabled'); 
    }); 

    $("#tipo_comprobante_varios").change(function(){
      $('#tipo_comprobante_conciliacion').css("border-color", "red");
      $("#tipo_comprobante_conciliacion").attr('disabled','disabled'); 
    }); 
      

});
</script>

  <?php
  if (empty ($_GET['nro'])){
  ?> <div class="etiqueta"><strong>Detalle del Asiento</strong></div>
 <textarea name="detalle" class="p_input" rows="3" id=""><?php echo $data['detalle']; ?></textarea>
  <br><br>
 
  <?php
  }
  ?>
        <div><br>
	<input name="Submit" type="button" class="boton_form" onClick="Validar(this.form)" value="Guardar Item" id="boton_envia"/>
	</div>
	    <input name="id_us" type="hidden" id="id_us" value="<?php echo $_SESSION['usuario']; ?>" />
	    <input name="id_a" type="hidden" id="id_a" value="<?php echo $id_a; ?>" />
		<input name="nro" type="hidden" id="nro" value="<?php echo $_GET['nro']; ?>" />

  </form>
   <?php
  if (!empty ($_GET['nro'])){
  ?>
   <table width="100%" border="0" cellpadding="5" cellspacing="0" id="usuarios">
    <tr>
		<th>Fecha</th>
		<th>Nro</th>
      <th>Cuenta</th>
	  <th>Debe</th>
	  <th>Haber</th>
	  <th width=250>Detalle</th>
      <th>Modificar</th>
      <th>Quitar</th>
    </tr>
	<?php
	$sq = "select * from asientos INNER JOIN cuentas on asientos.cuenta = cuentas.id_cuentas where (asientos.nro =".$_GET['nro'].") order by asientos.id_a asc";
	$u=mysql_query($sq);
	$d=0;
	$h=0;
	for ($i = 0; $i < mysql_num_rows($u); $i = $i +1){
	$au=mysql_fetch_array($u);
    echo'<tr>
      <td>'.substr($au['fecha'],8,2).'/'.substr($au['fecha'],5,2).'/'.substr($au['fecha'],0,4).'</td>';
	    echo '<td>'.$au['nro'].'</td>
		<td>'.$au['cuenta'].'</td>
		<td> $ '.$au['debe'].'</td>
		<td> $ '.$au['haber'].'</td>
		<td>'.$au['detalle'].'</td>
		<td><a href="asiento.php?id_a='.$au['id_a'].'&nro='.$au['nro'].'">Modificar</a></td>';
    if($_SESSION["seccion"]=='administrador'){

        echo '<td rowspan="'.$na.'"><a href="quitar_asiento1.php?nro='.$au['nro'].'" title="Quitar este asiento" onclick="return confirmar(';
        echo "'¿Está seguro que desea quitar este asiento?'";
        echo ')" >Quitar</a></td></tr>';

      }else{
        echo '<td style="color:red;"> -- </td></tr>';
      }

    
	$d=$d+$au['debe'];
	$h=$h+$au['haber'];
	}
	?>
  </table>
  <div class = "resumen">
  <?php
  echo 'Total Debe = $ '.$d;
  echo '<br>';
  echo 'Total Haber = $ '.$h;
   echo '<br>';
   $sal = $h - $d;
   if ( $sal < 0.009 and $sal > -0.009){
   $sal = 0;
   }

   if ($sal==0) {
     $saldo = '<div>Saldo = $ '.$sal.'</div>';
   } else {
     $saldo = '<div style="color:red;">Saldo = $ '.$sal.'</div>';
   }
   
  echo $saldo;
  ?>
  </div>
  <?php
  if ($sal != 0){
  ?>
  <div id="bad">
    Atenci&oacute;n!!!! El asiento no está equilibrado
    <br />Si sale ahora no quedara guardado
  </div>
  <?php
  } else {
  ?>
  <div id="bien">
   El asiento se equilibró correctamente
  </div>
  </div> 
<div id="nuevo_a"><a href="verifica.php?nro=<?php echo $_GET['nro']; ?>&accion=nuevo">Guardar y Nuevo asiento</a> - <a href="verifica.php?nro=<?php echo $_GET['nro']; ?>&accion=mayor">Guardar e Ir al libro diario</a></div>
  <?php
  }}
  ?>


  
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
