<?php
include("conecta.php");
include("auditoria.php");
$nro = $_GET['nro'];
$query="update asientos set activo='si' where nro='$nro'";
mysql_query($query);
auditar($query);
if ($_GET['accion']=='nuevo'){
header("Location:asiento.php?ac=nuevo");
} else {
header("Location:contabilidad.php");
}
exit();
?>
