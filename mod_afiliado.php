<?php
include("conecta.php");
$clave = $_POST['clave'];
$legajo = $_POST['legajo'];

$flag_modificar = false;
$existe = mysql_num_rows(mysql_query("select legajo from afiliado where legajo=".$legajo));
$afiliado = mysql_fetch_array(mysql_query("select legajo from afiliado where clave=".$clave));
$legajo_existente = $afiliado['legajo'];


if ($legajo_existente==$legajo) {

	$flag_modificar = true;

}else{

	if ($existe>0) {
		$flag_modificar = false;
	}else{
		$flag_modificar = true;
	}

}

if ($flag_modificar==true) {
		
	$nombre = $_POST['nombre'];
	$sexo = $_POST['sexo'];
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
	mysql_query("update afiliado set legajo = '$legajo' where clave = '$clave'");
	mysql_query("update afiliado set nombre = '$nombre' where clave = '$clave'");
	mysql_query("update afiliado set documento = '$documento' where clave = '$clave'");
	mysql_query("update afiliado set domicilio = '$domicilio' where clave = '$clave'");
	mysql_query("update afiliado set telefono = '$telefono' where clave = '$clave'");
	mysql_query("update afiliado set correo = '$correo' where clave = '$clave'");
	mysql_query("update afiliado set nacimiento = '$nacimiento' where clave = '$clave'");
	mysql_query("update afiliado set afiliacion = '$afiliacion' where clave = '$clave'");
	mysql_query("update afiliado set vencimiento = '$vencimiento' where clave = '$clave'");
	mysql_query("update afiliado set ipross = '$ipross' where clave = '$clave'");
	mysql_query("update afiliado set sector = '$sector' where clave = '$clave'");
	mysql_query("update afiliado set sueldo = '$sueldo' where clave = '$clave'");
	mysql_query("update afiliado set jubilado = '$jubilado' where clave = '$clave'");
	mysql_query("update afiliado set socioos = '$socioos' where clave = '$clave'");
	mysql_query("update afiliado set sexo = '$sexo' where clave = '$clave'");
	mysql_query("update afiliado set observaciones = '$observaciones' where clave = '$clave'");

	$cuil = $_POST['cuil'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'cuil' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD cuil VARCHAR(20)");
	}
	mysql_query("update afiliado set cuil = '$cuil' where clave = '$clave'");

	$estado_civil = $_POST['estado_civil'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'estado_civil' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD estado_civil VARCHAR(10)");
	}
	mysql_query("update afiliado set estado_civil = '$estado_civil' where clave = '$clave'");

	$os_esposa = $_POST['os_esposa'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'os_esposa' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD os_esposa VARCHAR(2)");
	}
	mysql_query("update afiliado set os_esposa = '$os_esposa' where clave = '$clave'");

	$nom_os_esposa = $_POST['nom_os_esposa'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'nom_os_esposa' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD nom_os_esposa VARCHAR(20)");
	}
	mysql_query("update afiliado set nom_os_esposa = '$nom_os_esposa' where clave = '$clave'");

	$celular = $_POST['celular'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'celular' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD celular VARCHAR(20)");
	}
	mysql_query("update afiliado set celular = '$celular' where clave = '$clave'");

	$categoria = $_POST['categoria'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'categoria' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD categoria VARCHAR(20)");
	}
	mysql_query("update afiliado set categoria = '$categoria' where clave = '$clave'");

	$antiquedad = $_POST['antiquedad'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'antiquedad' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD antiquedad VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci");
	}
	mysql_query("update afiliado set antiquedad = '$antiquedad' where clave = '$clave'");

	$coseguro = $_POST['coseguro'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'coseguro' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD coseguro VARCHAR(2)");
	}
	mysql_query("update afiliado set coseguro = '$coseguro' where clave = '$clave'");

	$motivo_coseguro = $_POST['motivo_coseguro'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'motivo_coseguro' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD motivo_coseguro VARCHAR(120) CHARACTER SET latin1 COLLATE latin1_spanish_ci");
	}
	mysql_query("update afiliado set motivo_coseguro = '$motivo_coseguro' where clave = '$clave'");


	$dona_sangre = $_POST['dona_sangre'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'dona_sangre' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD dona_sangre VARCHAR(2)");
	}
	mysql_query("update afiliado set dona_sangre = '$dona_sangre' where clave = '$clave'");


	$tipo_sangre = $_POST['tipo_sangre'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'tipo_sangre' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD tipo_sangre VARCHAR(20)");
	}
	mysql_query("update afiliado set tipo_sangre = '$tipo_sangre' where clave = '$clave'");


	$sugerencias = $_POST['sugerencias'];
	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'sugerencias' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD sugerencias BLOB ");
	}
	mysql_query("update afiliado set sugerencias = '$sugerencias' where clave = '$clave'");

	if (empty($_POST['f_actualiza'])){
	$f_actualiza= date("Y-m-d");
	} else {
	$f_actualiza = substr($_POST['f_actualiza'],6,4).'-'.substr($_POST['f_actualiza'],3,2).'-'.substr($_POST['f_actualiza'],0,2);
	}

	if ( mysql_num_rows(mysql_query("SHOW COLUMNS FROM afiliado LIKE 'f_actualiza' ")) != 1 ) {
	mysql_query("ALTER TABLE afiliado ADD f_actualiza DATE ");
	}
	mysql_query("update afiliado set f_actualiza = '$f_actualiza' where clave = '$clave'");


	header ("Location:confirmado.php?es=3");
	exit();
	

}else{

	header ("Location:confirmado.php?es=8");
	exit();
	
}



?>