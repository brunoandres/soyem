<?php
include("conecta.php");
$clave = $_GET['clave'];
$id_fam = $_GET['id_fam'];
mysql_query("update familiares set activo='no' where id_fam='$id_fam'");
header("Location: datos_afiliado.php?clave=$clave");
exit();
?>