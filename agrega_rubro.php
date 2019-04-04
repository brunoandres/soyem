<?php
include ("conecta.php");
$rubro = $_POST['rubro'];
$titulo = ($_POST['titulo']);
mysql_query("insert into con_rubros (rubro,titulo) values ('$rubro','$titulo')");
header ("location: cuentas.php?mostrar=1");
exit();
?>