<?php
include("conecta.php");
include ("auditoria.php");

$rec_id = $_GET['rec_id'];
$query = "update recibos set rec_anulado = 'S' where rec_id= '$rec_id'";
$exec = mysql_query($query);

if ($exec) {
	auditar($query);
}

$data_rec = mysql_fetch_array(mysql_query("select * from recibos INNER JOIN conceptos_recibos ON recibos.rec_concepto=conceptos_recibos.cr_id where recibos.rec_id = '$rec_id'"));


$nnro = mysql_fetch_array(mysql_query("select * from asientos order by nro desc"));
$nro = $nnro['nro'] + 1;
$id_us = $_SESSION['usuario'];


	if ($data_rec['rec_importe_efectivo']>0){
		
		$detalle = "Anulacion del recibo ".$data_rec['rec_nro']." del dia ".$data_rec['rec_fecha']. " del señor ".$data_rec['rec_nombre']." en efectivo $ ".$data_rec['rec_importe_efectivo']." en concepto de ".$data_rec['cr_name'];
		$tx1 = "insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values (".$nro.", ".date("Y-m-d").", '1', ".$data_rec['rec_importe_efectivo'].", ".$detalle.", ".$id_us.", 'si')";
		mysql_query($tx1);
		$tx2 = "insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values (".$nro.", ".date("Y-m-d").", ".$data_rec['cr_cuenta'].", ".$data_rec['rec_importe_efectivo'].", ".$detalle.", ".$id_us.", 'si')";
		mysql_query($tx2);
	}
	if ($data_rec['rec_importe_cheque']>0){
		
		if ($data_rec['rec_importe_efectivo']>0){
			$nro++;
		}
		$detalle = "Anulacion de recibo ".$data_rec['rec_nro']." del dia ".$data_rec['rec_fecha']. " del señor ".$data_rec['rec_nombre']." en cheque $ ".$data_rec['rec_importe_cheque']." nro cheque ".$data_rec['rec_cheque_nro']." banco ".$data_rec['rec_banco']." en concepto de ".$data_rec['cr_name'];
		$tx3 = "insert into asientos (nro, fecha, cuenta, haber, detalle, id_us, activo) values (".$nro.", ".date("Y-m-d").", '85', ".$data_rec['rec_importe_cheque'].", ".$detalle.", ".$id_us.", 'si')";
		mysql_query($tx3);
		$tx4 = "insert into asientos (nro, fecha, cuenta, debe, detalle, id_us, activo) values (".$nro.", ".date("Y-m-d").",  ".$data_rec['cr_cuenta'].", ".$data_rec['rec_importe_cheque'].", ".$detalle.", ".$id_us.", 'si')";
		mysql_query($tx4);
	}


$vuelta = $_GET['vuelta'];
header("Location:$vuelta");
exit();
?>