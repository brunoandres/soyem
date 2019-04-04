<?php
include ("conecta.php");
$id_rubro = $_POST['id_rubro'];
$rubro = $_POST['rubro'];
$titulo = $_POST['titulo'];
mysql_query("update con_rubros set rubro='$rubro' where id_rubro='$id_rubro'");
mysql_query("update con_rubros set titulo='$titulo' where id_rubro='$id_rubro'");
header ("location: confirmado_rubro.php");
exit();
?>