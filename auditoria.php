<?php
require_once 'conecta.php';
require_once 'secure.php';
function auditar($query) {
	$usuario = $_SESSION['usuario'];
	$query="INSERT INTO auditorias (query,usuario) VALUES (\"$query\",'$usuario')";

	$auditado = mysql_query($query);

	if ($auditado) {
		return true;
	}

}

?>
