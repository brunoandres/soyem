<?php
$page = 'listado_utiles';
include("secure.php");
include("conecta.php");
$funcion_r=$_SESSION['funcion'];

if ($_SESSION["usuario"] != "magui.galaz" and $_SESSION["usuario"] != "miryam.espeche" and $_SESSION["usuario"] != "sandra.quiñehual") { 
  header("Location:index.php?error=3"); 
  exit(); 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" charset="utf-8" />
<title>Sistema Administrativo - Listado de Utiles por afiliado</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function quitar() {
  return confirm('Confirma quitar utiles?');
}

function agregar() {
  return confirm('Confirma agregar utiles?');
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

<form method="post" action="listado_utiles.php">
<div class="subt"> Listado de Utiles por afiliado: </div>
<div class="etiqueta">Nro de Legajo:</div>
  <input name="leg" type="text" class="p_input" id="leg" placeholder="Ingrese un número de legajo" autocomplete="off"/>
  
        <label><br><br>
	<input type="submit" name="Submit" value="Buscar Datos"/>
	</label><input type="hidden" name="act" value="si" />
	</div>
</form>
<hr />
<?php
    
    $usuario_entrega = $_SESSION["usuario"];

    if(isset($_GET['legajo'])){
        $legajo = $_GET['legajo'];
    }elseif (isset($_POST['leg'])) {
        $legajo = $_POST['leg'];
    }

	if (!empty($legajo)){

        $filtro = '(legajo = '.$legajo.') order by edad asc';
        $sql = "select * from v_utiles where ".$filtro;
        $que = mysql_query($sql);
        $nn = mysql_num_rows($que);
        echo "Se encontraron ".$nn." coincidencias con el legajo <font color='ff0000'>".$legajo."</font>";
 	}
	echo '<table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr>
      <th>Afiliado</th>
      <th>Familiar Activo</th>
      <th>Nombre Familiar</th>
      <th>Documento</th>
      <th>Edad</th>
      <th>Kit</th>
      <th>Estado utiles</th>
      <th>Opciones</th>
    </tr>';
	for ($i=0; $i<$nn; $i++){
    $dat=mysql_fetch_array($que);
    
    $id_fam = $dat{'id_fam'};
    $query_utiles = "select * from legajos_utiles where id_familiar = '$id_fam'";
    $ejecuto = mysql_query($query_utiles);
    $utiles = mysql_fetch_array($ejecuto);
    
    if(empty($utiles['entregado'])){
        $estado = "<strong><p style='color:red'>No entregado</p></strong>";  
        $opcion = '<td><a onclick="return agregar()" href="procesa_utiles.php?legajo='.$dat['legajo'].'&id_fam='.$dat['id_fam'].'&kit='.$dat['kit'].'&usuario='.$usuario_entrega.'" title="Agregar kit">Agregar</a></td>';  
    }else{
        $estado = "<strong><p style='color:green'>Entregado</p></strong>";  
        $opcion = '<td><a onclick="return quitar()" href="quitar_utiles.php?legajo='.$dat['legajo'].'&id_fam='.$dat['id_fam'].'&kit='.$dat['kit'].'" title="Quitar kit">Quitar</a></td>';  
    }

	echo '<tr>
      <td>'.$dat{'familiar'}.'</td>
	  
      <td>'.$dat{'activo_familiar'}.'</td>
      <td>'.$dat{'nombre_familiar'}.'</td>
      <td>'.$dat{'documento_familiar'}.'</td>
      <td>'.$dat{'edad'}.'</td>
      <td>'.$dat{'kit'}.'</td>
      <td>'.$estado.'</td>
      <td align="left">'.$opcion.'</td>
    </tr>';
	}
	echo '</table>';

?>

  <hr>

  <?php  

  $sql_entregados = "select kit,count(*) as cantidad from legajos_utiles where entregado = 1 group by kit";
  $ejecuto_query = mysql_query($sql_entregados);

  ?>

  <h2>Kits Entregados</h2>

  <table style="width:100%">
    <tr>
      <th>Kit</th>
      <th>Cantidad entregados</th>
      <th></th>
    </tr>
    <?php while ($row = mysql_fetch_array($ejecuto_query)) { ?>
    <tr>
      
      
     

      <td><?php echo $row['kit']; ?></td>
      <td><?php echo $row['cantidad']; ?></td>
      <td><form action="utiles_entregados.php" method="POST">
          <input type="hidden" name="nivel" value="<?php echo $row['kit']; ?>" />
          <input type="submit" value="Ver" />
        </form></td>

      
    </tr>
    <?php } ?>
  </table>

  <hr>

  <?php  

  $sql_no_entregados = "select kit,count(*) as cantidad_entregar from v_utiles where not id_fam in (select id_familiar from legajos_utiles) group by kit order by cantidad_entregar asc";
  $query = mysql_query($sql_no_entregados);

  ?>

  <h2>Kits por entregar</h2>

  <table style="width:100%">
    <tr>
      <th>Kit</th>
      <th>Cantidad a entregar</th>
      <th></th>
    </tr>
    <?php while ($row = mysql_fetch_array($query)){ ?>
    <tr>
      
      
     

      <td><?php echo $row['kit']; ?></td>
      <td><strong><?php echo $row['cantidad_entregar']; ?></td>
        <td><form action="utiles_a_entregar.php" method="POST">
          <input type="hidden" name="nivel" value="<?php echo $row['kit']; ?>" />
          <input type="submit" value="Ver" />
        </form></td>
      
    </tr>
    <?php } ?>
  </table>

</div>
</div>
</body>
</html>
