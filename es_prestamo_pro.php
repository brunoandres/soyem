<?php
include("conecta.php");
$t = "update empresas set es_pres ='".$_GET['es_pres']."' where clave_empresa='".$_GET['clave_empresa']."'";
mysql_query($t);
header("Location:empresas.php");
exit();
?>