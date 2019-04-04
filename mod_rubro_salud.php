<?php
include("conecta.php");
$t = "update empresas set ru_salud = '".$_GET['ru_salud']."' where clave_empresa = '".$_GET['clave_empresa']."'";
mysql_query($t);
header("Location: empresas.php");
exit()
?>