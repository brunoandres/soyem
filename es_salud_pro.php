<?php
include("conecta.php");
$t = "update empresas set es_salud ='".$_GET['es_salud']."' where clave_empresa='".$_GET['clave_empresa']."'";
mysql_query($t);
header("Location:empresas.php");
exit();
?>