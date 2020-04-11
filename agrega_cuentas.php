<?php
include ("conecta.php");
include ("auditoria.php");

$rubro = $_POST['rubro'];
$cuenta = ($_POST['cuenta']);
$query = "insert into cuentas (id_rubro,cuenta) values ('$rubro','$cuenta')";
$exec = mysql_query($query);

if ($exec) {
	auditar($query);
}

header ("location: cuentas.php?mostrar=2");
exit();
?>