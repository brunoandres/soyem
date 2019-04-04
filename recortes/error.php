<?php
include("../conecta.php");
$dat = mysql_fetch_array(mysql_query("select * from asientos where id_a = '58138'"));
echo $dat['detalle'];
?>