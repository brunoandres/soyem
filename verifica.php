<?php
include("conecta.php");
$nro = $_GET['nro'];
mysql_query("update asientos set activo='si' where nro='$nro'");
if ($_GET['accion']=='nuevo'){
header("Location:asiento.php?ac=nuevo");
} else {
header("Location:contabilidad.php");
}
exit();
?>
