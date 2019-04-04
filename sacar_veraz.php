<?php
include("conecta.php");
$vz_id = $_GET['vz_id'];
mysql_query("delete from veraz where vz_id = '$vz_id'");
header("Location:veraz.php");
exit();
?>