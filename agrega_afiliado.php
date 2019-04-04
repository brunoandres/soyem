<?php
include("conecta.php");
$legajo = $_POST['legajo'];
$nombre = $_POST['nombre'];
$documento = $_POST['documento'];
$domicilio = $_POST['domicilio'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$nacimiento = substr($_POST['nacimiento'],6,4).'-'.substr($_POST['nacimiento'],3,2).'-'.substr($_POST['nacimiento'],0,2);
$afiliacion = substr($_POST['afiliacion'],6,4).'-'.substr($_POST['afiliacion'],3,2).'-'.substr($_POST['afiliacion'],0,2);
$vencimiento = substr($_POST['vencimiento'],6,4).'-'.substr($_POST['vencimiento'],3,2).'-'.substr($_POST['vencimiento'],0,2);
$ipross = $_POST['ipross'];
$sector = $_POST['sector'];
$sueldo = $_POST['sueldo'];
$jubilado = $_POST['jubilado'];
$socioos = $_POST['socioos'];
$observaciones = $_POST['observaciones'];

$cuil = $_POST['cuil'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'cuil' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD cuil VARCHAR(20)");
}

$estado_civil = $_POST['estado_civil'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'estado_civil' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD estado_civil VARCHAR(10)");
}


$os_esposa = $_POST['os_esposa'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'os_esposa' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD os_esposa VARCHAR(2)");
}

$nom_os_esposa = $_POST['nom_os_esposa'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'nom_os_esposa' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD nom_os_esposa VARCHAR(20)");
}

$celular = $_POST['celular'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'celular' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD celular VARCHAR(20)");
}

$categoria = $_POST['categoria'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'categoria' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD categoria VARCHAR(20)");
}

$antiquedad = $_POST['antiquedad'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'antiquedad' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD antiquedad VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci");
}

$coseguro = $_POST['coseguro'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'coseguro' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD coseguro VARCHAR(2)");
}

$motivo_coseguro = $_POST['motivo_coseguro'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'motivo_coseguro' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD motivo_coseguro VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_spanish_ci");
}


$dona_sangre = $_POST['dona_sangre'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'dona_sangre' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD dona_sangre VARCHAR(2)");
}


$tipo_sangre = $_POST['tipo_sangre'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'tipo_sangre' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD tipo_sangre VARCHAR(20)");
}


$sugerencias = $_POST['sugerencias'];
if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'sugerencias' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD sugerencias BLOB ");
}

if (empty($_POST['f_actualiza'])){
$f_actualiza= date("Y-m-d");
} else {
$f_actualiza = substr($_POST['f_actualiza'],6,4).'-'.substr($_POST['f_actualiza'],3,2).'-'.substr($_POST['f_actualiza'],0,2);
}

if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'f_actualiza' ")) != 1 ) {
mysql_query("ALTER TABLE afiliado ADD f_actualiza DATE ");
}


$existe_afiliado = mysql_num_rows(mysql_query("select legajo from afiliado where legajo = '$legajo'"));

if (!$existe_afiliado>1) {
	mysql_query("insert into afiliado (legajo, nombre, documento, domicilio, telefono, correo, nacimiento, afiliacion, vencimiento, ipross, sector, sueldo, jubilado, socioos, observaciones, cuil, estado_civil, os_esposa, nom_os_esposa, celular, categoria, coseguro, motivo_coseguro, dona_sangre, tipo_sangre, sugerencias, f_actualiza) values ('$legajo', '$nombre', '$documento', '$domicilio', '$telefono', '$correo', '$nacimiento', '$afiliacion', '$vencimiento', '$ipross', '$sector', '$sueldo', '$jubilado', '$socioos', '$observaciones', '$cuil', '$estado_civil', '$os_esposa', '$nom_os_esposa', '$celular', '$categoria', '$coseguro', '$motivo_coseguro', '$dona_sangre', '$tipo_sangre', '$sugerencias', '$f_actualiza')");

		$ult = mysql_fetch_array(mysql_query("select * from afiliado where (nombre = '$nombre' and documento='$documento' and legajo='$legajo')"));
		header ("Location:datos_afiliado.php?clave=".$ult['clave']);
		exit();
}else{
	header("Location: nuevo.php?legajo=".$legajo);
}





?>