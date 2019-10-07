<?php  
include("secure1.php");
include("conecta.php");
include ("auditoria.php");

if (isset($_POST['btnForm'])) {
	
	if (!empty($_POST['mes']) && !empty($_POST['anio'])) {

		mysql_query("START TRANSACTION");
		$query = "update prestamos set pagado = 'I' where (vencimiento = '".$_POST['anio']."-".$_POST['mes']."-01' and banc='no' and pagado = 'P')";
		$sql_prestamos = mysql_query($query);

		$query_delete = "delete from historial_expo_muni where anio = '".$_POST['anio']."' and mes = '".$_POST['mes']."'";

		$sql_historial = mysql_query($query_delete);

		if ($sql_historial && $query_delete) {
		    mysql_query("COMMIT");
		    auditar($query);
		    auditar($query_delete);
		    header("location:listado_muni.php");
		} else {        
		    mysql_query("ROLLBACK");
		    header("location: listado_muni.php?error=2");
			exit();
		}

	}

}


?>