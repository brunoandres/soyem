<?php
include ("conecta.php");
$id_rubro = $_POST['id_rubro'];
$rubro = $_POST['rubro'];
$titulo = $_POST['titulo'];

$query1 = "update con_rubros set rubro='$rubro' where id_rubro='$id_rubro'";
mysql_query($query1);
auditar($query1);

$query2 = "update con_rubros set titulo='$titulo' where id_rubro='$id_rubro'";
mysql_query($query2);
auditar($query2);

header ("location: confirmado_rubro.php");
exit();
?>