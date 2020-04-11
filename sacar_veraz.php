<?php
include("conecta.php");
include("auditoria.php");

$vz_id = $_GET['vz_id'];
$query ="delete from veraz where vz_id = '$vz_id'";
mysql_query($query);
auditar($query);
header("Location:veraz.php");
exit();
?>