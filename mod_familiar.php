<?php
include("conecta.php");
include ("auditoria.php");
$nombre = $_POST['nombre'];
$sexo = $_POST['sexo'];
$documento = $_POST['documento'];
$nacimiento = substr($_POST['nacimiento'],6,4).'-'.substr($_POST['nacimiento'],3,2).'-'.substr($_POST['nacimiento'],0,2);
$tipo = $_POST['tipo'];
$cursando_actualmente = $_POST['cursando_actualmente'];
$id_fam = $_POST['id_fam'];

$query = "update familiares set nombre = '$nombre', documento = '$documento', nacimiento = '$nacimiento', tipo = '$tipo', sexo = '$sexo', cursando_actualmente = $cursando_actualmente where id_fam='$id_fam'";

$exec = mysql_query($query);
if ($exec) {
	auditar($query);
}

/*mysql_query("update familiares set nombre = '$nombre' where id_fam='$id_fam'");
mysql_query("update familiares set documento = '$documento' where id_fam='$id_fam'");
mysql_query("update familiares set nacimiento = '$nacimiento' where id_fam='$id_fam'");
mysql_query("update familiares set tipo = '$tipo' where id_fam='$id_fam'");
mysql_query("update familiares set sexo = '$sexo' where id_fam='$id_fam'");
mysql_query("update familiares set cursando_actualmente = $cursando_actualmente where id_fam='$id_fam'");*/

$estudio = $_POST['estudio'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM familiares LIKE 'estudio' ")) != 1 ) {
mysql_query("ALTER TABLE familiares ADD estudio INT(1)");
}

$query_estudio = "update familiares set estudio = '$estudio' where id_fam = '$id_fam'";
$exec_query = mysql_query($query_estudio);
if ($exec_query) {
	auditar($query_estudio);
}

$discapacitado = $_POST['discapacitado'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM familiares LIKE 'discapacitado' ")) != 1 ) {
mysql_query("ALTER TABLE familiares ADD discapacitado VARCHAR(2)");
}

$query_disc = "update familiares set discapacitado = '$discapacitado' where id_fam = '$id_fam'";
$exec_query_dis = mysql_query($query_disc);

if ($exec_query_dis) {
	auditar($query_disc);
}


header ("Location:confirmado.php?es=2");
exit();
?>