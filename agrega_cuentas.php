<?php
include ("conecta.php");
$rubro = $_POST['rubro'];
$cuenta = ($_POST['cuenta']);
mysql_query("insert into cuentas (id_rubro,cuenta) values ('$rubro','$cuenta')");
header ("location: cuentas.php?mostrar=2");
exit();
?>