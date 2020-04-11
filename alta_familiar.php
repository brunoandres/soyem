<?php
include("conecta.php");
include("auditoria.php");
$clave = $_GET['clave'];
$id_fam = $_GET['id_fam'];
$query = "update familiares set activo='si' where id_fam='$id_fam'";
$exec = mysql_query($query);

if ($exec) {
	auditar($query);
}

header("Location: datos_afiliado.php?clave=$clave");
exit();
?>