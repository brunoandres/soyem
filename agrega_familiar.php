<?php
include("conecta.php");
$nombre = $_POST['nombre'];
$sexo = $_POST['sexo'];
$documento = $_POST['documento'];
$nacimiento = substr($_POST['nacimiento'],6,4).'-'.substr($_POST['nacimiento'],3,2).'-'.substr($_POST['nacimiento'],0,2);
$tipo = $_POST['tipo'];
$clave = $_POST['clave'];
$cursando_actualmente = $_POST['cursando_actualmente'];
$es_nro = mysql_num_rows(mysql_query("select * from familiares where id_af = '$clave'"));
if ($es_nro == 0){
$nro = 0;
} else {
$nro = $es_nro;
}

$estudio = $_POST['estudio'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM familiares LIKE 'estudio' ")) != 1 ) {
mysql_query("ALTER TABLE familiares ADD estudio INT(1)");
}


$discapacitado = $_POST['discapacitado'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM familiares LIKE 'discapacitado' ")) != 1 ) {
mysql_query("ALTER TABLE familiares ADD discapacitado VARCHAR(2)");
}

$existe = mysql_num_rows(mysql_query("select documento from familiares where id_af=".$clave." and documento=".$documento));
if ($existe>0) {
	
	header ("Location:confirmado.php?es=7");
	exit();
}else{
	mysql_query("insert into familiares (nombre, documento, nacimiento, tipo, nro, id_af, estudio, discapacitado, sexo, cursando_actualmente) values ('$nombre', '$documento', '$nacimiento', '$tipo', '$nro', '$clave', '$estudio', '$discapacitado', '$sexo',$cursando_actualmente)");
	header ("Location:confirmado.php?es=1");
	exit();
}


?>