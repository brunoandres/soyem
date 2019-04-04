<?php
include("conecta.php");
$nombre = $_POST['nombre'];
$documento = $_POST['documento'];
$nacimiento = substr($_POST['nacimiento'],6,4).'-'.substr($_POST['nacimiento'],3,2).'-'.substr($_POST['nacimiento'],0,2);
$tipo = $_POST['tipo'];
$id_fam = $_POST['id_fam'];
mysql_query("update familiares set nombre = '$nombre' where id_fam='$id_fam'");
mysql_query("update familiares set documento = '$documento' where id_fam='$id_fam'");
mysql_query("update familiares set nacimiento = '$nacimiento' where id_fam='$id_fam'");
mysql_query("update familiares set tipo = '$tipo' where id_fam='$id_fam'");

$estudio = $_POST['estudio'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM familiares LIKE 'estudio' ")) != 1 ) {
mysql_query("ALTER TABLE familiares ADD estudio INT(1)");
}
mysql_query("update familiares set estudio = '$estudio' where id_fam = '$id_fam'");

$discapacitado = $_POST['discapacitado'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM familiares LIKE 'discapacitado' ")) != 1 ) {
mysql_query("ALTER TABLE familiares ADD discapacitado VARCHAR(2)");
}
mysql_query("update familiares set discapacitado = '$discapacitado' where id_fam = '$id_fam'");


header ("Location:confirmado.php?es=2");
exit();
?>